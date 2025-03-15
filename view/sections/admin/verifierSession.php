<?php
    session_start();

    // si user n'est pas connecté, $_SESSION["email"] n'existe pas 
    if (!$_SESSION["email"]) {
        header(
            "Location:login?Error=1&message=" 
            . urlencode("Merci de vous connecter. ") . 
            "&title=" . urlencode("Accés refusé !")
        );
    }

    // Si user est connecté , sauvegarde les données de user connecté
    $nom = $_SESSION["nom"];
    $nom = $_SESSION["email"];
    $nom = $_SESSION["etat"];
    $nom = $_SESSION["photo"];
?>