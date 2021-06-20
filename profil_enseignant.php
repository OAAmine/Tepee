<?php

if (isset($_REQUEST['submit'])) {
    $course_title = strip_tags($_GET["course_name"]);
}


/*
        $current_user = $_SESSION['email_ens'];

        $select_stmt = $db->prepare("SELECT * FROM cours WHERE id_ens = :uid_ens"); //sql select query
        $select_stmt->execute(array(':uid_ens' => $current_user)); //execute query 
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        if ($select_stmt->rowCount() > 0) {
        echo ("yes there is ");
    }


    $nb_rows = $select_stmt->rowCount();




    while ($nb_rows > 0) {
        echo ($row['nom_cours'] . $row['cat_cours']);
        $nb_rows--;
    }

?titre=<?php echo ($course_title) . "?" ?>

    */

?>



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
    include("navbar.php");
    ?>

    <div class="container">

        <div class="left_menu">
            <a href="#">cours suivis</a>
            <a href="#">cours proposé</a>
            <a href="#">ajouter un cours</a>
        </div>

        <div class="right_content">
            <h1>bienvenue dans votre tableau de board @nom de user ajouter avec php</h1>
            <h2>cours suivis</h2>

            <table class="cours_suivis">
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Age</th>
                </tr>
                <tr>
                    <td>Jill</td>
                    <td>Smith</td>
                    <td>50</td>
                </tr>
                <tr>
                    <td>Eve</td>
                    <td>Jackson</td>
                    <td>94</td>
                </tr>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>80</td>
                </tr>
            </table>

            <h2>cours proposé</h2>
            <table class="cours_propose">
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Age</th>
                </tr>
                <tr>
                    <td>Jill</td>
                    <td>Smith</td>
                    <td>50</td>
                </tr>
                <tr>
                    <td>Eve</td>
                    <td>Jackson</td>
                    <td>94</td>
                </tr>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>80</td>
                </tr>
            </table>

            <div class="ajouter_un_cours">
                <a id="myButton" class="ajouter_btn" onclick="show_input()">
                    <ion-icon class="add_icon" name="add-outline" href="#"></ion-icon>AJOUTER UN COURS
                </a>


            </div>
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