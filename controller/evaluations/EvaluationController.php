<?php
session_start();
require_once("../../model/EvaluationRepository.php");

class EvaluationController
{
    private $evaluationRepository;

    public function __construct()
    {
        $this->evaluationRepository = new EvaluationRepository();
    }

    // Message d'erreur + redirection
    private function setErrorAndRedirect($message, $title, $redirectUrl = 'login')
    {
        $_SESSION["error"] = $message;
        header(
            "Location:" . $redirectUrl . "?error=1&message=" .
            urlencode($message) .
            "&title=" . urlencode($title)
        );
        exit;
    }

    // Message de succès + redirection
    private function setSuccessAndRedirect($message, $title, $redirectUrl = 'admin')
    {
        $_SESSION["success"] = $message;
        header(
            "Location:" . $redirectUrl . "?success=1&message=" .
            urlencode($message) .
            "&title=" . urlencode($title)
        );
        exit;
    }

    // Ajouter une évaluation
    public function addEvaluation()
    {
        $nom = trim($_POST["nom"] ?? "");
        $semestre = trim($_POST["semestre"] ?? "");
        $type = trim($_POST["type"] ?? "");
        $createdBy = $_SESSION["id"] ?? "";

        if (empty($nom) || empty($semestre) || empty($type)) {
            $this->setErrorAndRedirect(
                "Veuillez remplir tous les champs",
                "Erreur de saisie",
                "evaluation"
            );
        }

        try {
            // Call the add() method without assigning its result
            $newEvalution = $this->evaluationRepository->add($nom, $semestre, $type, $createdBy);

        } catch (Exception $e) {
            $this->setErrorAndRedirect(
                "Erreur lors de l'ajout de l'évaluation",
                "Erreur base de données",
                "evaluations"
            );
        }

        // Optionally, set a success message
        $this->setSuccessAndRedirect(
            "Évaluation ajoutée avec succès",
            "Succès",
            "evaluationMainController"
        );
    }

    // Lister les évaluations
    public function listeEvaluations()
    {
        // Par exemple, on récupère seulement les étudiants actifs : etat=1
        $evaluations = $this->evaluationRepository->getAll();
        include("../../view/pages/admin/evaluations/liste.php");
    }
}


?>