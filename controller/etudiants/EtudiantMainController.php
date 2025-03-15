<?php 
    require_once("EtudiantController.php");

    $etudiantController = new EtudiantController();

    // Ajout d'un étudiant
    if(isset($_POST["formAjoutEtudiant"]))
    {
        $etudiantController->addEtudiant();
    }

    // Affichage de la liste des étudiants
    if(isset($_GET["listEtudiant"]))
    {
        $etudiantController->listeEtudiants();
    }
?>