<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $title = str_replace("_", " ", basename(__FILE__));
            echo ($title);
            ?></title>

</head>

</head>

<body>

    <?php
    session_start();
    require_once "../../db.php";
    include("../../navbar.php");
    include("../cours_header.php");


    $uri_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $uri_segments = explode("/", $uri_path);
    $course_id = $uri_segments[2];

    $select_stmt = $db->prepare("SELECT id_ens FROM enseignant_cours WHERE id_cours = :eidcours"); //sql select query
    $select_stmt->execute(array(":eidcours" => $course_id));    //execute query with bind parameter
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_SESSION["email_ens"])) {
        if ($row["id_ens"] == $_SESSION["email_ens"]) { ?>
            <form method="POST" class="cours_du_ens"> <label for="submit">Ce cours vous apparitent</label> <input type="submit" value="MODIFIER" name="submit" class="login-button" />
            </form>
    <?php
        }
    }

    if (isset($_REQUEST["submit"])) {
        header("Location: ../cours_editeur.php?id=" . $uri_segments[2] . "&nom=" . $uri_segments[3]);
    }
    ?>



    <cours>
        <h1>grand titre</h1>
        <p>paragraph</p>
    </cours>

    <?php
    $uri_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $uri_segments = explode("/", $uri_path);
    $course_id = $uri_segments[2];



    if (isset($_REQUEST["inscrire"])) {

        $now_date = date("Y/m/d");
        $stmt = $db->prepare("INSERT INTO etudiant_cours (id_etd,id_cours,date_inscription) VALUES
                                (:uid_etd,:uid_cours,:udate_inscription)");
        $stmt->bindParam(":uid_etd", $_SESSION["id_etd"]);
        $stmt->bindParam(":uid_cours", $course_id);
        $stmt->bindParam(":udate_inscription", $now_date);
        $stmt->execute();
    }
    ?>
    <form action="" class="comm" method="post" name="inscrire" enctype="multipart/form-data">
        <input type="submit" name="inscrire" value="Commencer le cours !" />
    </form>
    <a href="<?php echo ($uri_segments . "_" . $file_to_inject_to) ?>"></a>

    <?php
    include("../formateur_info.php");
    include("../../footer.php");
    ?>

</body>

</html>




