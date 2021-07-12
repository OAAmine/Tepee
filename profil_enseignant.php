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
    if (isset($_SESSION["email_etd"]))    //check condition user login not direct back to index.php page
    {
        header("location: profil_etudiant.php");
    }
    include("navbar.php");



    ?>

    <div class="container">

        <div class="left_menu">
            <h2>Mes Cours</h2>
            <a href="#">cours proposé</a>
            <a href="ajouter_cours.php">ajouter un cours</a>
        </div>

        <div class="right_content">
            <h2>cours proposé</h2>
            <table class="cours_propose">

                <tr>
                    <th>titre du cours </th>
                    <th>date de publication</th>
                    <th>Collab</th>
                </tr>

                <?php
                $result = $db->prepare("SELECT * FROM courses,enseignant_cours WHERE courses.id_ens = :uid_ens and enseignant_cours.id_ens =:uid_ens");
                $result->execute(array(":uid_ens" => $_SESSION['email_ens']));
                $result->execute();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $x = $row['id'];
                ?>
                    <tr>
                        <td><a href="<?php echo ($row['url_cours']); ?>"> <?php echo ($row['titre']); ?> </a></td>
                        <td><?php echo ($row['date_creation']); ?></td>
                        <td>
                            <form class="form-etudiant" name="etd-form" action="" method="post">
                                <input type="text" name="collab" placeholder="id de l'enseignant" style="width: 150px;">
                                <input class="btn" type="submit" name="register_etd_btn" value="id de l'enseignant">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <div class="ajouter_un_cours">
                <a id="myButton" class="ajouter_btn" onclick="show_input()">
                    <ion-icon class="add_icon" name="add-outline" href="#"></ion-icon>AJOUTER UN COURS
                </a>


            </div>
        </div>
    </div>

    <?php
    $row[0]['id_cours'];
    include("footer.php");
    $now_date = date("Y/m/d");
                    echo($x);
    if (isset($_REQUEST['register_etd_btn'])) {
        $collaborateur = strip_tags($_REQUEST['collab']);
        $stmt = $db->prepare("INSERT INTO enseignant_cours(id_ens,id_cours,date_creation) VALUES (:uid_ens,;uid_cours,:udate");
        $stmt->bindParam(':uid_ens', $collaborateur);
        $stmt->bindParam(':uid_cours', $x);
        $stmt->bindParam(':udate', $now_date);
        if ($stmt->execute()) {
    ?>
            <h1 style="color: red;"><?php echo ('email changé avec succées');  ?></h1>
    <?php
        }
    }
    ?>

</body>

</html>





<script>
    document.getElementById("myButton").onclick = function() {
        location.href = "ajouter_cours.php";
    }
</script>