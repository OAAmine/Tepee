<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <script src="RESSOURCES/js/registration.js"></script>
  <link rel="stylesheet" href="RESSOURCES/css/registration.css">
  <title>Document</title>
</head>

<body>
<?php
    require('db.php');
    session_start();

    // When form submitted, insert values into the database.
    if (isset($_REQUEST['nom_ens'])) {
        // removes backslashes

        $nom_ens = stripslashes($_REQUEST['nom_ens']);
        //escapes special characters in a string
        $nom_ens = mysqli_real_escape_string($con, $nom_ens);

        $prenom_ens = stripslashes($_REQUEST['prenom_ens']);
        $prenom_ens = mysqli_real_escape_string($con, $prenom_ens);

        $email_ens    = stripslashes($_REQUEST['email_ens']);
        $email_ens    = mysqli_real_escape_string($con, $email_ens);

        $mdp_ens = stripslashes($_REQUEST['mdp_ens']);
        $mdp_ens = mysqli_real_escape_string($con, $mdp_ens);


        $query    = "INSERT into `enseignant` (nom_ens, prenom_ens, email_ens, mdp_ens)
                     VALUES ('$nom_ens', '$prenom_ens', '$email_ens' , '" . md5($mdp_ens) . "')";
        $result   = mysqli_query($con, $query);
        
        if ($result) {
          $_SESSION['email_ens'] = $email_ens;
          // Redirect to user dashboard page
          header("Location: index.php");
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  </div>";
        }
    } else {
    ?>
  <div class="tout">
    <div class="cote-form">
      <div class="logo">
        <a href="index.php"><img src="RESSOURCES/css/img/logo.png" alt="logo tepee"></a>
      </div>
      <form class="form" name="myForm" action="" method="post">

        <!-- -----------------------les deux boutons ---------------------------- -->

        <div class="cc-selector">
          <h3>choisissez votre type de Compte</h3>
          <div class="choose">
          <div>
            <input id="etudiant" type="radio" name="type_inscription" value="etudiant" Onclick="location.href = 'registration_etudiant.php';"/>
            <label class="drinkcard-cc etudiant" for="etudiant">Étudiant</label>
          </div>
          <div class="ou">ou</div>
          <div>
            <input id="enseignant" type="radio" name="type_inscription" value="enseignant" Onclick="location.href = 'registration_enseignant.php';" checked/>
            <label class="drinkcard-cc enseignant" for="enseignant">Enseignant</label>
          </div>
        </div>
        </div>

        <!-- -------------------------------------------------------- -->


        <input  type="text" class="login-input" name="nom_ens" placeholder="Nom" required> <br>
        <input type="text" class="login-input" name="prenom_ens" placeholder="Prenom" required> <br>
        <input type="email" class="login-input" name="email_ens" placeholder="Email" required> <br>
        <input type="password" class="login-input" name="mdp_ens" placeholder="Mot de passe" required> <br>
        <div class="condition">
          <input type="checkbox" id="accepter" required>
          <label for="accepter"> j'ai lu j'ai accepter les <a href="">Conditions generales d'utilisation</a> et <a
              href="">Politique de protection des donnees personnelles</a> la </label>
        </div>
        <br>
        <input type="submit" name="submit" value="S'inscrire">
        <p>Avez-vous deja un compte? <a href="login.php">Connectez vous !</a> </p>
      </form>

    </div>
    <div class="image">
      <img src="RESSOURCES/css/img/register_ens.png" alt="étudiant">
    </div>
  </div>
  <?php
    }
    ?>
</body>

</html>