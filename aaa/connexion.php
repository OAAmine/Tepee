<?php
session_start();

try {

    $bdd = new PDO('mysql:host=localhost;dbname=tepee;charset=utf8', 'root', 'root');
} catch (Exception $e) {

    die('Erreur: ' . $e->getMessage());
}

if (isset($_POST['submit'])) {
    $mailconnect = $_POST['mailconnect'];
    $mdpconnect = $_POST['mdpconnect'];
    if (!empty($mailconnect) and !empty($mdpconnect)) {
        $requser = $bdd->prepare("SELECT * FROM enseignant where  email_ens = ? AND mdp_ens = ? ");
        $requser->execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();
       
        if ($userexist == 1) {
           
          
            
            header("Location: enseigant.php");
        } else {
            $erreur = "Mauvais mail ou mot de passe";
        }
    } else {
        $erreur = "Tous les champs doivent etre remplis";
    }
}
if($_SERVER["REQUEST_METHOD"] == "POST" AND isset($_POST['submit1']))
 {   
                 
          if(!empty($_POST['email']) AND !empty($_POST['motdepasse']) )
          {
              $emailconnect = htmlspecialchars($_POST['email']);
              $pswconnect = htmlspecialchars($_POST['motdepasse']);

               $requser =$bdd->prepare("SELECT * FROM etudiant WHERE email = ? AND motdepasse = ? ");
               $requser->execute(array($emailconnect,$pswconnect));
               $userexist = $requser->rowCount();
                     // verifier si l etudiant existe
                      if($userexist == true)
                      {
                       
                        
                         // url vers la page recherche
                        header("Location: recherche.php");
                                                        
                      } 
                      else
                      {  
                          // email ou mot de passe sont pas valides
                         
                          echo "<div style='text-align:center;margin-top:50px;font-size:18px;padding:20px;line-height:1.7;'>";
                          echo " Email ou mot de passe invalide ! <br>";
                          echo "Veuillez saisir votre email et mot de passe correctement .<br>";
                          echo"<a style='text-decoration:none;' href=' index.html' > Aller vers page d'accueil </a>";
                          echo "</div>";
                          
                      }

          }   
          
           
 }


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="css/connexion.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form  method="POST" action="#" class="sign-in-form">
            <h2 class="title">Connexion Elève</h2>
        
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="text" name ="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="motdepasse"  placeholder="Mot de passe" />
            </div>
            <input type="submit" value="Se connecter" name ="submit1" class="btn solid" /> 
           

          </form>
          <form action="#" method="POST"class="sign-up-form">
            <h2 class="title">Connexion Enseignant</h2>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="email"  name ="mailconnect" placeholder="Email" />
            </div><div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="password" name="mdpconnect" placeholder="Mot de passe" />
            </div>
            
            <input type="submit" name ="submit"class="btn" value="Se connecter" />
            <?php if (isset($erreur)) {
               echo "<p style='color:red; text-align:center'>".$erreur."</p>";
            }
            
            ?>
           

            
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Vous faites déja partie de study en tant qu'enseignant? </h3> <br>
           
            <button class="btn transparent" id="sign-up-btn">
              Connectez-vous
            </button>
          </div>
          <img src="imgs/eleve.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Vous faites déja partie de study en tant qu'élève?</h3>
            <br>
            <button class="btn transparent" id="sign-in-btn">
              Connectez-vous
            </button>
          </div>
          <img src="imgs/enseignant.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="js/app.js"></script>
  </body>
</html>