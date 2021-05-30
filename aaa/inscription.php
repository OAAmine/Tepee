
<?php 

try {
    $bdd = new PDO('mysql:host=localhost;dbname=tepee;charset=utf8', 'root', 'root');
} catch (Exception $e) {

    die('Erreur: ' . $e->getMessage());
}


if (isset($_POST['btn'])) {

    if (
        !empty($_POST['nom']) AND !empty($_POST['pnom']) AND !empty($_POST['mail']
        ) AND !empty($_POST['mdp'])and
    !empty($_POST['num']) AND !empty($_POST['des'])  
        
    ) {
        $nom = $_POST['nom'];
        $pnom = $_POST['pnom'];
        $mail = $_POST['mail'];
        $num = $_POST['num'];
        $des = $_POST['des'];
        $mdp = $_POST['mdp'];
      
      
       
      
                $insertmbr = $bdd->prepare("INSERT INTO 
                enseignant(nom_ens, prenom_ens, email_ens, mdp_ens,description_ens,tel_ens)
                VALUES(?,?,?,?,?,?)");
                $insertmbr->execute(array($nom, $pnom,  $mail, $mdp,$des,$num));


             

             

    }}

    // verifier si le formulaire est bien envoye 
if ( isset($_POST['forminscription']) and $_SERVER["REQUEST_METHOD"] == "POST" )
{
    // verifier les champs sont pas vides 
   if(!empty($_POST['nom1']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['motdepasse']))
       {
            $nom = htmlspecialchars($_POST['nom1']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);
            $motdepasse = htmlspecialchars($_POST['motdepasse']);


            //inserer les donnees dans la table etudiant 
         $insertuser = $bdd-> prepare("INSERT INTO etudiant(nom,prenom,email,motdepasse)values(?,?,?,?)"); 
         $insertuser ->execute(array($nom,$prenom,$email,$motdepasse));


         header("location: recherche.php");
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
    <link rel="stylesheet" href="css/inscription.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="POST" action="#" class="sign-in-form">
            <h2 class="title">Inscription Elève</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="nom1" placeholder="Nom" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="prenom" placeholder="Prenom" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="text"  name="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password"  name="motdepasse" placeholder="Mot de passe" />
            </div>
            <input type="submit"  name="forminscription" value="S'inscrire" class="btn solid" /> 
          </form>

          <form method="POST" action="#" class="sign-up-form">
            <h2 class="title">Inscription Enseignant</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="nom" placeholder="Nom" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="pnom" placeholder="Prenom" />
            </div>
            <div class="input-field">
              <i class="fas fa-phone"></i>
              <input type="number"  name="num" value="" placeholder="Tél" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="mail" placeholder="Email" />
            </div><div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="mdp" placeholder="Mot de passe" />
            </div>
            <div class="input-field">
              <i class="fas fa-book"></i>
              <input type="text" name="mat" placeholder="Matière" />
            </div>
            <div class="input-field">
              <i class="fas fa-sticky-note"></i>
              <input type="text" name="des" placeholder="Déscription" />
            </div>
            <input type="submit"  name="btn" class="btn" value="S'inscrire" />
            
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Nouveau parmi nous en tant qu'enseignant? </h3> <br>
           
            <button class="btn transparent" id="sign-up-btn">
              S'inscrire en tant qu'enseignant
            </button>
          </div>
          <img src="imgs/registerr.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Nouveau parmi nous en tant qu'élève?</h3>
            <br>
            <button class="btn transparent" id="sign-in-btn">
              S'inscrire en tant qu'élève
            </button>
          </div>
          <img src="imgs/office.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="js/app.js"></script>
  </body>
</html>