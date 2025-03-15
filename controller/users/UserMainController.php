<?php 
    require_once("UserController.php");

    //Creation d'objet UserController
    $userController = new UserController();

    // authentification
    if(isset($_POST['formLogin']))
    {
        $userController->auth();
    }

    // Déconnexion
    if(isset($_GET['logout']))
    {
        $userController->logout(); 
    }
?>