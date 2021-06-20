<?php
require_once "db.php";
session_start();

if (isset($_REQUEST['register_etd_btn'])) //button name "btn_register"
{
  $nom  = strip_tags($_REQUEST['txt_nom']);
  $prenom  = strip_tags($_REQUEST['txt_prenom']);
  $email    = strip_tags($_REQUEST['txt_email']);
  $password  = strip_tags($_REQUEST['txt_password']);


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

      $insert_stmt = $db->prepare("INSERT INTO etudiant (nom_etd,prenom_etd,email_etd,mdp_etd) VALUES
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
  }
} else if (isset($_REQUEST['btn_ens_register'])) {
  $nom  = strip_tags($_REQUEST['txt_nom']);
  $prenom  = strip_tags($_REQUEST['txt_prenom']);
  $email    = strip_tags($_REQUEST['txt_email']);
  $password  = strip_tags($_REQUEST['txt_password']);


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

    $select_stmt = $db->prepare("SELECT email_ens FROM enseignant WHERE email_ens=:uemail"); //sql select query
    $select_stmt->execute(array(':uemail' => $email)); //execute query 
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['email_ens'] == $email) {
      $errorMsg[] = "Desolé l'email exist déja ! ";  //check condition email already exists 
    } else if (!isset($errorMsg)) //check no "$errorMsg" show then continue
    {
      $new_password = password_hash($password, PASSWORD_DEFAULT); //encrypt password using password_hash()

      $insert_stmt = $db->prepare("INSERT INTO enseignant	(nom_ens,prenom_ens,email_ens,mdp_ens) VALUES
																(:unom,:uprenom,:uemail,:upassword)");     //sql insert query					

      if ($insert_stmt->execute(array(
        ':unom' => $nom,
        ':uprenom'  => $prenom,
        ':uemail'  => $email,
        ':upassword' => $new_password
      ))) {
        $registerMsg = "Register Successfully..... "; //execute query success message
        $_SESSION["email_ens"] = $row["id_ens"];  //session name is "user_login"
        header("refresh:2; index.php");      //refresh 2 second after redirect to "welcome.php" page
      }
    }
  }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <script src="RESSOURCES/js/registration.js"></script>
  <link rel="stylesheet" href="RESSOURCES/css/registration.css">
  <title>Registration</title>
</head>

<body>
  <nav style="background-color: white;">
    <div class="logo">
      <a href="index.php"><img src="RESSOURCES/css/img/logo.png" alt="logo tepee" style="height: 60px; width:auto;"></a>
    </div>
    <p>Avez-vous deja un compte? <a href="login.php">Connectez vous !</a> </p>
  </nav>
  <div class="container">
    <div class="split left">
      <h1>Étudiant</h1>
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

      <form class="form-etudiant" name="etd-form" action="" method="post">
        <div>
          <div class="field-container">
            <input class="field-input" id="inputid" name="txt_nom" type="text" placeholder=" ">
            <label class="field-placeholder" for="inputName">Nom</label>
          </div>
        </div>
        <div>
          <div class="field-container">
            <input class="field-input" id="inputid" name="txt_prenom" type="text" placeholder=" ">
            <label class="field-placeholder" for="inputName">Prenom</label>
          </div>
        </div>
        <div>
          <div class="field-container">
            <input class="field-input" id="inputid" name="txt_email" type="email" placeholder=" ">
            <label class="field-placeholder" for="inputName">Email</label>
          </div>
        </div>
        <div>
          <div class="field-container">
            <input class="field-input" id="inputid" name="txt_password" type="password" placeholder=" ">
            <label class="field-placeholder" for="inputName">Mot de passe</label>
          </div>
        </div>

        <div class="condition">
          <input type="checkbox" id="accepter">
          <label for="accepter"> j'ai lu j'ai accepter les <a href="">Conditions generales d'utilisation</a>et <a href="">Politique de protection des donnees personnelles</a></label>
        </div>

        <input class="btn" type="submit" name="register_etd_btn" value="S'inscrire">
      </form>
    </div>




















    <div class="split right">
      <h1>Enseignant</h1>
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




      <form class="form-enseignant" name="ens-form" action="" method="post">
        <div>
          <div class="field-container">
            <input class="field-input" id="inputid" name="txt_nom" type="text" placeholder=" ">
            <label class="field-placeholder" for="inputName">Nom</label>
          </div>
        </div>
        <div>
          <div class="field-container">
            <input class="field-input" id="inputid" name="txt_prenom" type="text" placeholder=" ">
            <label class="field-placeholder" for="inputName">Prenom</label>
          </div>
        </div>
        <div>
          <div class="field-container">
            <input class="field-input" id="inputid" name="txt_email" type="email" placeholder=" ">
            <label class="field-placeholder" for="inputName">Email</label>
          </div>
        </div>
        <div>
          <div class="field-container">
            <input class="field-input" id="inputid" name="txt_password" type="password" placeholder=" ">
            <label class="field-placeholder" for="inputName">Mot de passe</label>
          </div>
        </div>
        <div class="condition">
          <input type="checkbox" id="accepter" required>
          <label for="accepter"> j'ai lu j'ai accepter les <a href="">Conditions generales d'utilisation</a> et <a href="">Politique de protection des donnees personnelles</a></label>
        </div>
        <input class="btn" type="submit" name="btn_ens_register" value="S'inscrire">
      </form>




    </div>
  </div>



</body>

</html>









<script>
  const left = document.querySelector('.left')
  const right = document.querySelector('.right')
  const container = document.querySelector('.container')

  left.addEventListener('mouseenter', () => container.classList.add('hover-left'))
  left.addEventListener('mouseleave', () => container.classList.remove('hover-left'))

  right.addEventListener('mouseenter', () => container.classList.add('hover-right'))
  right.addEventListener('mouseleave', () => container.classList.remove('hover-right'))
</script>