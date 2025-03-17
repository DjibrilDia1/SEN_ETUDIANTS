<?php

require_once("EvaluationController.php");

$evaluationController = new EvaluationController();

// Ajout d'une évaluation
if (isset($_POST["formAjoutEvaluation"])) {
    $evaluationController->addEvaluation();
}

// Affichage de la liste des évaluations
$evaluationController->listeEvaluations();

?>