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

            $stmt = $db->prepare("INSERT INTO courses (titre,categorie,description,difficulte,duree,id_ens,url_cours, url_image) VALUES
																(:unom,:ucat,:udesc,:udiff,:uduree,:uid_ens,:uurl_cours,:uurl_img)");
            $stmt->bindParam(':unom', $titre);
            $stmt->bindParam(':ucat', $categorie);
            $stmt->bindParam(':udesc', $description);
            $stmt->bindParam(':udiff', $difficulte);
            $stmt->bindParam(':uduree', $duree);
            $stmt->bindParam(':uid_ens', $id_ens);
            $stmt->bindParam(':uurl_cours', $empty);
            $stmt->bindParam(':uurl_img', $empty);
            if ($stmt->execute()) {

                $course_id =  $db->lastInsertId();
                echo ($course_id );


                $new_titre = str_replace(' ', '_', $titre);
                $new_course_dir = $_SERVER['DOCUMENT_ROOT'] . '/cours/' . $course_id . '/';
                $new_file_dir = $new_course_dir . $new_titre . ".php";

                $header = "cours/".$course_id."/".$new_titre.'.php';

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
                $include_html = '<?php include("' . $_SERVER['DOCUMENT_ROOT'].'/cours/cours_model.php'.'")?>';
                file_put_contents($new_file_dir,$include_html);
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