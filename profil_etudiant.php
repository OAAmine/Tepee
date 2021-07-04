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
    if (isset($_SESSION["email_ens"]))	//check condition user login not direct back to index.php page
	{
		header("location: profil_etudiant.php");
	}
    include("navbar.php");
    ?>
 <h1></h1>   
<h1>Cours suivie</h1>
        <table>
            <tr class="premiereligne">
                <td class="premiercolonne">
                    titre de cours
                </td>
                <td>
                    <center>date d'inscription</center>
                </td>
                <td class="troisiemecolonne">
                    continuer
                </td>
            </tr>



        <?php

    $current_user = $_SESSION['email_etd'];
    // store the id of the current session user in a variable
    $sql_etudiant = "SELECT id_etd FROM etudiant WHERE email_etd = '" . $current_user . "'";
    $result_etudiant = mysqli_query($con, $sql_etudiant);
    $rse = mysqli_fetch_array($result_etudiant);
    //id de l'utilisateur de la session 
    $etudiant_id = $rse['id_etd'];

    $test_join = "SELECT cours.*,etudiant_cours.date_inscription FROM cours INNER JOIN etudiant_cours ON cours.id_cours = etudiant_cours.id_cours ORDER BY date_creation ASC";
    $coursRes=mysqli_query($con,$test_join);
   

    // $test_join = "SELECT cours.*,etudiant_cours.date_inscription FROM cours INNER JOIN etudiant_cours ON etudiant_cours.id_etd = ? ORDER BY date_inscription ASC";
    // bind_param("sss", $etudiant_id, $cours_id, $date);
    // $coursRes=mysqli_query($con,$test_join);

    // $stmt = $con->prepare("SELECT cours.*,etudiant_cours.date_inscription FROM cours INNER JOIN etudiant_cours ON etudiant_cours.id_etd = ? ORDER BY date_inscription ASC");
    // $stmt->bind_param("sss", $etudiant_id);
    // $stmt->execute();

    while($build = mysqli_fetch_array($coursRes))
    {
    

    ?>
            <tr>
                <td class="premierecolonne"><?php  echo($build["nom_cours"]);?></td>
                <td>
                    <center><?php  echo $build['date_inscription'];?></center>
                </td>
                <td class="troisiemecolonne">
                    <center><a href="<?php  echo $build['url_cours'];?>">continuer</a></center>
                </td>
            </tr>
    <?php } ;?> 
    
    </table>
    <?php include("footer.php");?> 

</body>

</html>