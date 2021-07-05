<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="RESSOURCES/css/ajouter_cours.css">
    <script src="RESSOURCES/js/ajouter_cours.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>course editor</title>
</head>


<?php
session_start();
require("db.php");






$titre  = strip_tags($_REQUEST['titre']);
$description  = strip_tags($_REQUEST['description']);
$categorie  = strip_tags($_REQUEST['categorie']);
$chap  = strip_tags($_REQUEST['chap']);
$difficulte    = strip_tags($_REQUEST['difficulte']);
$duree  = strip_tags($_REQUEST['duree']);
$id_ens = $_SESSION["email_ens"];
//$url_cours = "cours/" . $id_ens . "/" . str_replace(' ', '_', $titre) . ".html";

$empty = "";



if (empty($titre)) {
    $errorMsg[] = "Entrez le titre du cours s'il vous plait";
} else if (empty($categorie)) {
    $errorMsg[] = "selectionnez la categorie du cours s'il vous plait";
} else if (empty($description)) {
    $errorMsg[] = "Entrez la description du cours s'il vous plait";
} else if (!filter_var($difficulte)) {
    $errorMsg[] = "selectionnez la difficulté s'il vous plait";
} else if (empty($duree)) {
    $errorMsg[] = "préciseé la duré du cours s'il vous plait";
} else {
    if (!isset($errorMsg)) //check no "$errorMsg" show then continue
    {
        $nb = 0;
        $stmt = $db->prepare("INSERT INTO courses (titre,categorie,description,difficulte,nb_chap,duree,id_ens,url_cours, url_image,est_en_ligne) VALUES
																(:unom,:ucat,:udesc,:udiff,:uchap,:uduree,:uid_ens,:uurl_cours,:uurl_img,:uis_online)");
        $stmt->bindParam(':unom', $titre);
        $stmt->bindParam(':ucat', $categorie);
        $stmt->bindParam(':udesc', $description);
        $stmt->bindParam(':udiff', $difficulte);
        $stmt->bindParam(':uchap', $chap);
        $stmt->bindParam(':uduree', $duree);
        $stmt->bindParam(':uid_ens', $id_ens);
        $stmt->bindParam(':uurl_cours', $empty);
        $stmt->bindParam(':uurl_img', $empty);
        $stmt->bindParam(':uis_online',$nb);
        if ($stmt->execute()) {

            $course_id =  $db->lastInsertId();
            echo ($course_id);


            $new_titre = str_replace(' ', '_', $titre);
            $new_course_dir = $_SERVER['DOCUMENT_ROOT'] . '/cours/' . $course_id . '/';
            $new_file_dir = $new_course_dir . $new_titre . ".php";


            $header = "cours/cours_editeur.php?id=" . $course_id . "&nom=" . $new_titre . '.php';

            $url_img = $new_course_dir . basename($_FILES["fileToUpload"]["name"]);
        }

        $stmt_ii = $db->prepare("UPDATE courses SET url_cours = :uurl_cours ,url_image = :uurl_img WHERE id = :uid");
        $stmt_ii->bindParam(':uurl_cours', $new_file_dir);
        $stmt_ii->bindParam(':uurl_img', $url_img);
        $stmt_ii->bindParam(':uid', $course_id);


        if ($stmt_ii->execute()) {
            echo ("success 2 ");
            mkdir($new_course_dir);
            $createfile = fopen($new_file_dir, "w", true); // read only
            chmod($new_file_dir, 0777);

            $include_html = '<!DOCTYPE html>
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
                        header("Location: ../cours_editeur.php?id=" . $uri_segments[2] . "?nom=" . $uri_segments[3]);
                    }
                    ?>
                
                
                
                    <cours id="cours">
                
                
                    </cours>
                
                
                
                
                    <?php
                    include("../../footer.php");
                    ?>
                
                </body>
                
                </html>
                
                
                
                
                <style>
                    .cours_du_ens {
                        display: block;
                        text-align: center;
                        font-size: 25px;
                    }
                
                    .cours_du_ens input {
                        border-radius: 5px;
                        padding: 7px 5px;
                        margin-right: 5px;
                        border: 2px solid blue;
                        text-decoration: none;
                        font-weight: 600;
                        text-decoration: none;
                        padding-right: 5px;
                        color: white;
                        background-color: blue;
                    }
                
                    .cours_du_ens input:hover {
                        color: blue;
                        background-color: white;
                        cursor: pointer;
                    }
                </style>
';

            file_put_contents($new_file_dir, $include_html);
            header("Location: $header");
        }
    }
}






?>

<body>
    <h1>welcome to the course maker !</h1>

    <?php
    if (isset($errorMsg)) {
        foreach ($errorMsg as $error) {
    ?>
            <div class="alert alert-danger">
                <strong>WRONG ! <?php echo $error; ?></strong>
            </div>
        <?php
        }
    }
    if (isset($registerMsg)) {
        ?>
        <div class="alert alert-success">
            <strong><?php echo $registerMsg; ?></strong>
        </div>
    <?php
    }
    ?>




    <div class="container">
        <div class="rendu">
            <img src="rendu.png" alt="">
        </div>
        <form action="" method="post" name="creer_cours" enctype="multipart/form-data">
            <div class="inputs_no_submit">
                <div class="inputs">
                    <label for="titre">Titre du cours</label>
                    <input type="text" name="titre" type="text" placeholder="Apprenez à créer un cours...">

                    <select id="categorie" name="categorie" type="text">
                        <option selected disabled hidden>categorie</option>
                        <option value="informatique">informatique</option>
                        <option value="marketing">marketing</option>
                        <option value="art">art</option>
                    </select>

                    <label for="descrition">Description</label>
                    <textarea type="text" name="description" placeholder="Découvrer comment créer un cours.."></textarea>

                    <label for="difficulte">Difficulté</label>
                    <select id="country" name="difficulte" type="text">
                        <option selected disabled hidden>difficulté</option>
                        <option value="facile">Facile</option>
                        <option value="moyen">moyen</option>
                        <option value="difficile">difficile</option>
                    </select>

                    <label for="chap">Nombre de chapitre</label>
                    <input type="text" name="chap" type="text" placeholder="...">

                    <div class="duree">
                        <label for="duree">Durée</label>
                        <input type="text" name="duree" placeholder="x heures">
                        <p>Heures</p>
                    </div>
                </div>
                <div class="upload_img">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
            </div>
            <input type="submit" value="submit" name="creer_cours_btn">

        </form>
    </div>




</body>

</html>