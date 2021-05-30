<?php
    session_start();
    if(!isset($_SESSION["email_etd"]) || !isset($_SESSION["email_ens"])) {
        header("Location: login.php");
        exit();
    }else if (isset($_SESSION["email_etd"])){
        header("Location: profil_etudiant.php");
    }else{
        header("Location: profil_enseignant.php");
    }
?>