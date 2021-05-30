<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="RESSOURCES/css/profil.css" />
    <title>Tableau de Bord</title>
</head>

<body>
<?php
    require('db.php');

    session_start();
    include("navbar.php");
?>
<h4>Bienvenue <?php echo $_SESSION['email_ens'] ?> dans votre tableau de bord !</h4>   
<h1>Cours publiés</h1>
        <table>
            <tr class="premiereligne">
                <td class="premiercolonne">
                    titre de cours
                </td>
                <td>
                    <center>date de publication</center>
                </td>
                <td class="troisiemecolonne">
                    Consulter
                </td>
                <td class="troisiemecolonne">
                    Supprimer
                </td>
            </tr>



        <?php

    $current_user = $_SESSION['email_ens'];
    // store the id of the current session user in a variable
    $sql_enseignant = "SELECT id_ens FROM enseignant WHERE email_ens = '" . $current_user . "'";
    $result_enseignant = mysqli_query($con, $sql_enseignant);
    $rse = mysqli_fetch_array($result_enseignant);
    //id de l'utilisateur de la session 
    $enseignant_id = $rse['id_ens'];
    
    $test_join = "SELECT cours.*,enseignant_cours.date_creation FROM cours INNER JOIN enseignant_cours ON enseignant_cours.id_cours = cours.id_cours ORDER BY date_creation ASC";
    $coursRes=mysqli_query($con,$test_join);





    // echo( $enseignant_id.'         '. $cours_id);
    // if (isset($_POST['supp_cours'])) {
    //     $stmt = $con->prepare("DELETE FROM `enseignant_cours`  WHERE id_ens = ? AND id_cours = ?");
    //     $stmt->bind_param("ss", $enseignant_id, $cours_id);
    //     $stmt->execute();
    // }



    
    while($build = mysqli_fetch_array($coursRes))
    {
    

    ?>
            <tr>
                <td class="premierecolonne"><?php  echo($build["nom_cours"]);?></td>
                <td>
                    <center><?php  echo $build['date_creation'];?></center>
                </td>
                <td class="troisiemecolonne">
                    <center><a href="<?php  echo $build['url_cours'];?>">Consulter</a></center>
                </td>  
            </tr>
    <?php } ;?> 
    
    </table>
    <?php include("footer.php");?> 

</body>

</html>