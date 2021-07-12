<?php
session_start();
require_once "db.php";
echo($_SESSION['email_ens']);
echo($_SESSION['email_etd']);
if(isset($_SESSION['email_ens'])){
$query = $db->prepare("DELETE FROM enseignant WHERE id_ens = :uid_ens");
$query->execute(array(':uid_ens' => $_SESSION['email_ens'] ));
echo('compte supprimmer avec succées');
session_destroy();
header("refresh:2; index.php");      //refresh 2 second after redirect to "welcome.php" page

}


elseif(isset($_SESSION['email_etd'])){
    $query = $db->prepare("DELETE FROM etudiant WHERE id_etd = :uid_etd");
    $query->execute(array(':uid_etd' => $_SESSION['email_etd'] ));
    echo('compte supprimmer avec succées');
    session_destroy();
    header("refresh:2; index.php");      //refresh 2 second after redirect to "welcome.php" page

    }
