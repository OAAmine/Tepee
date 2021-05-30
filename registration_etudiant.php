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
    if (isset($_REQUEST['nom_etd'])) {
        // removes backslashes

        $nom_etd = stripslashes($_REQUEST['nom_etd']);
        //escapes special characters in a string
        $nom_etd = mysqli_real_escape_string($con, $nom_etd);

        $prenom_etd = stripslashes($_REQUEST['prenom_etd']);
        $prenom_etd = mysqli_real_escape_string($con, $prenom_etd);

        $email_etd    = stripslashes($_REQUEST['email_etd']);
        $email_etd    = mysqli_real_escape_string($con, $email_etd);

        $mdp_etd = stripslashes($_REQUEST['mdp_etd']);
        $mdp_etd = mysqli_real_escape_string($con, $mdp_etd);


        $query    = "INSERT into `etudiant` (nom_etd, prenom_etd, email_etd, mdp_etd)
                     VALUES ('$nom_etd', '$prenom_etd', '$email_etd' , '" . md5($mdp_etd) . "')";
        $result   = mysqli_query($con, $query);
        
        if ($result) {
          $_SESSION['email_etd'] = $email_etd;
          // Redirect to user dashboard page
          header("Location: index.php");
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
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
            <input id="etudiant" type="radio" name="type_inscription" value="etudiant" checked/>
            <label class="drinkcard-cc etudiant" for="etudiant">Étudiant</label>
          </div>
          <div class="ou">ou</div>
          <div>
            <input id="enseignant" type="radio" name="type_inscription" value="enseignant" Onclick="location.href = 'registration_enseignant.php';" />
            <label class="drinkcard-cc enseignant" for="enseignant">Enseignant</label>
          </div>
        </div>
        </div>

        <!-- -------------------------------------------------------- -->


        <input  type="text" class="login-input" name="nom_etd" placeholder="Nom" required> <br>
        <input type="text" class="login-input" name="prenom_etd" placeholder="Prenom" required> <br>
        <input type="email" class="login-input" name="email_etd" placeholder="Email" required> <br>
        <input type="password" class="login-input" name="mdp_etd" placeholder="Mot de passe" required> <br>
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
      <img src="RESSOURCES/css/img/register_etd.png" alt="étudiant">
    </div>
  </div>
  <?php
    }
    ?>
</body>

</html>