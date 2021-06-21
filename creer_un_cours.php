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
require("db.php");
session_start();

/* -------------------------image upload -----------------------------------*/


$target_dir = "Cours/" . $_SESSION["email_ens"] . "/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));






// Check if image file is a actual image or fake image
if (isset($_REQUEST["create_course"])) {




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








/*
require_once "db.php";

if (empty($nom)) {
  $errorMsg[] = "Entrez votre nom s'il vous plait";
} else if (empty($prenom)) {
  $errorMsg[] = "Entrez votre prenom s'il vous plait";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errorMsg[] = "Entrez votre email s'il vous plait";
} else if (empty($password)) {
  $errorMsg[] = "Entrez votre mot de passe s'il vous plait";
} else if (strlen($password) < 6) {
  $errorMsg[] = "Le mot de passe doit se composer d'au moins 7 caractéres";
} else {

    $select_stmt = $db->prepare("SELECT email_etd FROM etudiant 
                                      WHERE email_etd=:uemail"); // sql select query
    $select_stmt->execute(array(':uemail' => $email)); //execute query 
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['email_etd'] == $email) {
      $errorMsg[] = "Desolé l'email exist déja ! ";  //check condition email already exists 
    } else if (!isset($errorMsg)) //check no "$errorMsg" show then continue
    {
      $new_password = password_hash($password, PASSWORD_DEFAULT); //encrypt password using password_hash()

      $insert_stmt = $db->prepare("INSERT INTO etudiant	(nom_etd,prenom_etd,email_etd,mdp_etd) VALUES
                                                              (:unom,:uprenom,:uemail,:upassword)");     //sql insert query					

      if ($insert_stmt->execute(array(
        ':unom' => $nom,
        ':uprenom'  => $prenom,
        ':uemail'  => $email,
        ':upassword' => $new_password
      ))) {
        $registerMsg = "Register Successfully..... "; //execute query success message
        $_SESSION["email_etd"] = $row["id_etd"];  //session name is "user_login"
        header("refresh:2; index.php");      //refresh 2 second after redirect to "welcome.php" page
      }
    }

*/




/*
$nom_ens = stripslashes($_REQUEST['create']);


if (empty($nom_ens)) {
    $errorMsg[] = "Entrez votre nom s'il vous plait";
  } else

$title = $_GET['course_name'];
$new_title = str_replace(' ', '_', $title);
mkdir($_SERVER['DOCUMENT_ROOT'].'/Cours/'.$_SESSION["email_ens"].'/');
$createfile = fopen($_SERVER['DOCUMENT_ROOT'].'/Cours/'.$_SESSION["email_ens"].'/'.$new_title.'.php',"w",true); // read only
chmod($_SERVER['DOCUMENT_ROOT'].'/Cours/'.$new_title.'.php', 0777);
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
        <form action="" method="post" name="cree_ficher" enctype="multipart/form-data">
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
            <input type="submit" name="create_course" value="Submit">
        </form>
    </div>




</body>

</html>