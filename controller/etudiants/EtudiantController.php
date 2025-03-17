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
        $email     = trim($_POST["email"] ?? "");
        $password  = trim($_POST["password"] ?? "");
        $matricule = trim($_POST["matricule"] ?? "");
        $telephone = trim($_POST["telephone"] ?? "");
        $photo     = $_FILES["photo"] ?? null;
        $adresse   = trim($_POST["adresse"] ?? "");
        $createdBy = $_SESSION["id"] ?? ""; 

        // Vérification des champs
        if (
            empty($nom) || 
            empty($email) || 
            empty($password) || 
            empty($matricule) || 
            empty($telephone) || 
            empty($photo) || 
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
                $photoName,
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
            "etudiantMainController"
        );
    }

    // Affichage de la liste des étudiants
    public function listeEtudiants()
    {
        // Par exemple, on récupère seulement les étudiants actifs : etat=1
        $etudiants = $this->etudiantRepository->getAll(1); 
        include("../../view/pages/admin/etudiants/liste.php"); 
    }
}
