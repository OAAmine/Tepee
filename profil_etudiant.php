<!DOCTYPE html>
<html>

<head>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="RESSOURCES/css/profil.css" />
    <title>Tableau de Bord</title>
</head>

<body>
    <?php

    session_start();
    require('db.php');
    if (isset($_SESSION["email_ens"]))    //check condition user login not direct back to index.php page
    {
        header("location: profil_enseignant.php");
    }
    include("navbar.php");



    ?>

    <div class="container">



        <div class="right_content">
            <h2>cours suivis</h2>
            <table class="cours_propose">

                <tr>
                    <th>titre du cours </th>
                    <th>date d'inscription</th>
                </tr>
                <?php
                
                $result = $db->prepare("SELECT courses.*,etudiant_cours.* FROM etudiant_cours NATURAL JOIN courses WHERE id_etd = 1;");
                $result->execute(array(":uid_etd" => $_SESSION['email_etd']));
                $result->execute();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><a href="<?php echo($row['url_cours']); ?>"> <?php echo ($row['titre']); ?> </td></a>
                        <td><?php echo ($row['date_inscription']); ?></td>
                    </tr>
                <?php } ?>
            </table>


        </div>
    </div>

    <?php
    include("footer.php");
    ?>

</body>

</html>



<script>
    document.getElementById("myButton").onclick = function() {
        location.href = "ajouter_cours.php";
    };
    /*
    function show_input() {
        var x = document.getElementById("cree_un_cours");
        var y = document.getElementById("ajouter_btn")
        if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "none";
        }
    }
    */
</script>