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

/*
$target_dir = "Cours/" . $_SESSION["email_ens"] . "/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
*/

/*
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

*/

if (isset($_REQUEST['creer_cours_btn'])) //button name "btn_register"
{


    $titre  = strip_tags($_REQUEST['titre']);
    $description  = strip_tags($_REQUEST['description']);
    $categorie  = strip_tags($_REQUEST['categorie']);
    $difficulte    = strip_tags($_REQUEST['difficulte']);
    $duree  = strip_tags($_REQUEST['duree']);
    $id_ens = $_SESSION["email_ens"];
    $url_cours = "Cours/" . str_replace(' ', '_', $titre) . ".html";
    $url_img = "fziegfizeu";


    //echo($titre ."/".$description ."/".$categorie ."/".$difficulte ."/".$duree ."/".$id_ens ."/".$url_cours ."/".$url_img ."/");

    /*

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
            echo('no error');
*/

    if (!isset($errorMsg)) //check no "$errorMsg" show then continue
    {
        $select_stmt = $db->prepare("SELECT email_etd FROM etudiant 
WHERE email_etd=:uemail"); // sql select query
        $select_stmt->execute(array(':uemail' => $email)); //execute query 
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        $insert_stmt = $db->prepare("INSERT INTO cours (id_cours,nom_cours,cat_cours,desc_cours,duree_cours,difficulte_cours,id_ens,url_cours,url_img_cours) VALUES
																(:id,:unom,:ucat,:udesc,:uduree,:udiff,:uid_ens,:uurl_cours,:uurl_img)");     //sql insert query					

        if ($insert_stmt->execute(array(
            ':id' => 5,
            ':unom' => $titre,
            ':ucat'  => $categorie,
            ':udesc'  => $description,
            ':uduree' => $duree,
            ':udiff' => $difficulte,
            ':uid_ens'  => $id_ens,
            ':uurl_cours'  => $url_cours,
            ':uurl_img' => $url_img,
        ))) {
            $registerMsg = "Register Successfully..... "; //execute query success message
            $_SESSION["email_etd"] = $row["id_etd"];  //session name is "user_login"
            header("refresh:2; index.php");      //refresh 2 second after redirect to "welcome.php" page
        }
    }
}










/* -------------------------image upload -----------------------------------*/


/*

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

*/
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
        <form action="" method="POST" name="creer_cours" enctype="multipart/form-data">
            <div class="inputs_no_submit">
                <div class="inputs">
                    <label for="fname">Titre du Cours</label>
                    <input type="text" name="titre" placeholder="Apprenez à créer un cours...">

                    <select id="categorie" name="categorie">
                        <option selected disabled hidden>categorie</option>
                        <option value="informatique">informatique</option>
                        <option value="marketing">marketing</option>
                        <option value="art">art</option>
                    </select>

                    <label for="lname">Description</label>
                    <textarea type="text" name="description" placeholder="Découvrer comment créer un cours.."></textarea>

                    <label for="difficulte">Difficulté</label>
                    <select id="country" name="difficulte">
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