<?php
session_start();
require_once("../../model/EtudiantRepository.php");

class EtudiantController
{
    private $etudiantRepository;

    public function __construct()
    {
        $this->etudiantRepository = new EtudiantRepository();
    }

    // Message d'erreur + redirection
    private function setErrorAndRedirect($message, $title, $redirectUrl = 'login') {
        $_SESSION["error"] = $message;
        header(
            "Location:" . $redirectUrl . "?error=1&message=" . 
            urlencode($message) . 
            "&title=" . urlencode($title)
        ); 
        exit;
    }

    // Message de succès + redirection
    private function setSuccessAndRedirect($message, $title, $redirectUrl = 'admin') {
        $_SESSION["success"] = $message;
        header(
            "Location:" . $redirectUrl . "?success=1&message=" . 
            urlencode($message) . 
            "&title=" . urlencode($title)
        );
        exit;
    }

    // Ajout d'un étudiant
    public function addEtudiant()
    {
        // Récupération des informations du formulaire
        $nom       = trim($_POST["nom"] ?? "");
        $prenom    = trim($_POST["prenom"] ?? "");
        $email     = trim($_POST["email"] ?? "");
        $photo     = $_FILES["photo"] ?? null;
        $password  = trim($_POST["password"] ?? "");
        $matricule = trim($_POST["matricule"] ?? "");
        $telephone = trim($_POST["telephone"] ?? "");
        $adresse   = trim($_POST["adresse"] ?? "");
        $createdBy = $_SESSION["id"] ?? ""; 

        // Vérification des champs
        if (
            empty($nom) || 
            empty($prenom) || 
            empty($email) || 
            empty($photo) || 
            empty($password) || 
            empty($matricule) || 
            empty($telephone) || 
            empty($adresse) || 
            empty($createdBy) || 
            $photo['error'] !== UPLOAD_ERR_OK
        ) {
            $this->setErrorAndRedirect(
                "Tous les champs sont requis.", 
                "Erreur de validation", 
                "etudiants"
            );
        }

        // Traitement de l'upload de l'image
        $uploadDir = "../../public/images/etudiants/";
        $basename = basename($photo['name']);
        $photoName = uniqid() . '_' . $basename;
        $uploadPath = $uploadDir . $photoName;

        if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
            $this->setErrorAndRedirect(
                "Erreur lors de l'upload de l'image", 
                "Erreur d'upload", 
                "etudiants"
            );
        }

        // Insertion en base de données
        try {
            $newEtudiantId = $this->etudiantRepository->add(
                $nom,
                $prenom,
                $photoName,  // on stocke le nom final dans la BDD
                $email,
                $password,
                $matricule,
                $telephone,
                $adresse,
                $createdBy
            );
        } catch (Exception $e) {
            // Gérer l'erreur d'insertion
            $this->setErrorAndRedirect(
                "Erreur lors de l'ajout de l'étudiant : " . $e->getMessage(),
                "Erreur d'ajout",
                "etudiants"
            );
        }

        // Redirection si tout est OK
        $this->setSuccessAndRedirect(
            "Étudiant ajouté avec succès ! (ID : $newEtudiantId)",
            "Ajout réussi",
            "listeEtudiants"
        );
    }

    // Affichage de la liste des étudiants
    public function listeEtudiants()
    {
        // Par exemple, on récupère seulement les étudiants actifs : etat=1
        $etudiants = $this->etudiantRepository->getAll(1);

        // Inclure la vue qui affiche la liste
        include("../../view/etudiants/listeEtudiants.php");
    }
}
