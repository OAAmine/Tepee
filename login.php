<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <script src="script.js"></script>
    <link rel="stylesheet" href="RESSOURCES/css/login.css">
    <title>connexion</title>
</head>

<body>
    <?php

    require('db.php');

    session_start();

    // When form submitted, check and create user session.
    if (isset($_POST['email'])) {
        $email = stripslashes($_REQUEST['email']);    // removes backslashes
        $email = mysqli_real_escape_string($con, $email);

        $mdp = stripslashes($_REQUEST['mdp']);
        $mdp = mysqli_real_escape_string($con, $mdp);

        // Check if user exists in the database

        $query_ens    = "SELECT * FROM `enseignant` WHERE email_ens='$email'
                     AND mdp_ens='" . md5($mdp) . "'";
        $result_ens = mysqli_query($con, $query_ens) or die(mysql_error());
        $rows_ens = mysqli_num_rows($result_ens);
        $res_ens = $con->query($query_ens);



        $query_etudiant    = "SELECT * FROM `etudiant` WHERE email_etd='$email'
                    AND mdp_etd='" . md5($mdp) . "'";
        $result_etd = mysqli_query($con, $query_etudiant) or die(mysql_error());
        $rows_etd = mysqli_num_rows($result_etd);
        $res_etd = $con->query($query_etudiant);


        if ($rows_etd == 1) {
            $_SESSION['email_etd'] = $email;
            // Redirect to user dashboard page
            header("Location: profil_etudiant.php");
        } else if (mysqli_num_rows($result_ens) == 1) {
            $_SESSION['email_ens'] = $email;
            // Redirect to user dashboard page
            header("Location: profil_enseignant.php");
        } else {
            echo "<div class='form'>
                  <h3>combinaison email/mot de passe incorrect.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
    ?>


        <div class="tout">
            <div class="logo">
                <a href="index.php"><img src="RESSOURCES/css/img/logo.png" alt="img logo"></a>
            </div>
            <div class="cote-form">
                <form class="form" method="post" name="login">
                    <h1>Se connecter</h1>
                    <div class="reseaux">
                        <div class="google"><a href="google.com"><img src="RESSOURCES/css/img/google.png" alt="google"></a></div>
                        <div class="facebook"><a href="facebook.com"><img src="RESSOURCES/css/img/facebook.png" alt="facebook"></a></div>
                        <div class="linkedin"><a href="linkedin.com"><img src="RESSOURCES/css/img/linkedin.png" alt="linkedin"></a></div>
                        <div class="twitter"><a href="twitter.com"><img src="RESSOURCES/css/img/twitter.png" alt="twitter"></a> </div>
                    </div>
                    <div class="champs">
                        <input type="text" class="login-input" name="email" placeholder="Email" autofocus="true" />
                        <input type="password" class="login-input" name="mdp" placeholder="Mot de passe" />
                    </div>

                    <br>
                    <input type="submit" value="Login" name="submit" class="login-button" />
                    <p>Vous n'avez pas encore de compte ? <a href="registration_etudiant.php">Inscrivez-vous gratuitement</a> </p>
                </form>


            </div>
            <div class="image">
                <img src="RESSOURCES/css/img/login.png" alt="">
            </div>
        </div>

    <?php
    }
    ?>
</body>

</html>