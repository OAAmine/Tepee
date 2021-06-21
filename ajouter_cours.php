<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="RESSOURCES/css/ajouter_cours.css">
    <script src="RESSOURCES/js/ajouter_cours.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <title>Course editor</title>
</head>


<?php
session_start();
require("db.php");

$target_dir = "Cours/" . $_SESSION["email_ens"] . "/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST['creer_cours_btn'])) //button name "btn_register"
{

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }







    $titre  = strip_tags($_REQUEST['titre']);
    $description  = strip_tags($_REQUEST['description']);
    $categorie  = strip_tags($_REQUEST['categorie']);
    $difficulte    = strip_tags($_REQUEST['difficulte']);
    $duree  = strip_tags($_REQUEST['duree']);
    $id_ens = $_SESSION["email_ens"];
    $url_cours = "Cours/" . $id_ens . "/" . str_replace(' ', '_', $titre) . ".html";
    $url_img = "Cours/" . $id_ens . "/" . basename($_FILES["fileToUpload"]["name"]);



    $new_titre = str_replace(' ', '_', $titre);
    mkdir($_SERVER['DOCUMENT_ROOT'] . '/Cours/' . $_SESSION["email_ens"] . '/');
    $createfile = fopen($_SERVER['DOCUMENT_ROOT'] . '/Cours/' . $_SESSION["email_ens"] . '/' . $new_titre . '.html', "w", true); // read only
    chmod($_SERVER['DOCUMENT_ROOT'] . '/Cours/' . $new_titre . '.html', 0777);

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

            $stmt = $db->prepare("INSERT INTO courses (titre,categorie,description,difficulte,duree,id_ens,url_cours,url_image) VALUES
																(:unom,:ucat,:udesc,:udiff,:uduree,:uid_ens,:uurl_cours,:uurl_img)");
            $stmt->bindParam(':unom', $titre);
            $stmt->bindParam(':ucat', $categorie);
            $stmt->bindParam(':udesc', $description);
            $stmt->bindParam(':udiff', $difficulte);
            $stmt->bindParam(':uduree', $duree);
            $stmt->bindParam(':uid_ens', $id_ens);
            $stmt->bindParam(':uurl_cours', $url_cours);
            $stmt->bindParam(':uurl_img', $url_img);
            if ($stmt->execute()){

            header("Location: $url_cours");  
        }
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
                    <label for="titre">Titre du Cours</label>
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