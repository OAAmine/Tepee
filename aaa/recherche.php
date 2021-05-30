<?php

 $bdd = new PDO('mysql:host=localhost;dbname=tepee;', 'root', 'root');


$articles = $bdd->query('SELECT nom_matiere,nom_ens,description_ens FROM matiere , enseignant where matiere.id_ens=enseignant.id_ens');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/recherche.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
     <style>
      .msg_vide{
        text-align:center;
        font-size:65px;
        padding-top:30px;
      }
     </style>
</head>
<body>
    <div class="header">
        <div class="background"></div>
        <div class="header-text">
            <div class="logo">
                <a href="index.html"><img src="imgs/logo.png" alt="logo"></a>
            </div>
            <div  name="q" class="search-box">
              <div name="q" class="dropdown">

               <!-- <div  name="q" class="dropdown__select">
                  <span  name="q"  class="dropdown__selected">Sélectionner une matière</span>
                  <i class="fa fa-caret-down dropdown__caret"></i>
                </div> -->

                <form action="" method="POST">
                <select name="nom_matiere" class="dropdown__select" id="">
                  <option value="0">Sélectionner une matière</option>
                  <option value="1">Mathématique </option>
                  <option value="2">Physique</option>
                  <option value="3">Science</option>
                  <option value="4">Philosophie</option>
                  <option value="5">Arabe</option>
                  <option value="6">Français</option>
                  <option value="7">Anglais</option>
                  <option value="8">Poo</option>
                 
                </select>

                  <input type="submit" name='recherche' value="Recherche" >
                </form>
                </div>

            
              
            </div>
        </div>  

        <?php    
                
             function select_nom_matiere($choix)
                   {
                     $matiere="";
                      switch($choix)
                        {
                           case "1" : $matiere="Mathématique"; break;
                           case "2" : $matiere="Physique"; break;
                           case "3" : $matiere="Science"; break;
                           case "4" : $matiere="Philosophie"; break;
                           case "5" : $matiere="Arabe"; break;
                           case "6" : $matiere="Français"; break;
                           case "7" : $matiere="Anglais"; break;
                           case "8" : $matiere="Poo"; break;
                        
                     }
                           return $matiere;
                   }

           if(isset($_POST['recherche']))
           { 
             if(isset($_POST['nom_matiere']))
             {
              $matiere_choisi = select_nom_matiere($_POST['nom_matiere']);
              $reqrecherche = $bdd->prepare("SELECT nom_ens,prenom_ens,description_ens , nom_matiere from matiere , enseignant where matiere.id_ens=enseignant.id_ens AND nom_matiere = ?  ");
              $reqrecherche->execute(array($matiere_choisi));
              
             }
            $nbr = $reqrecherche->rowcount();
            if ($nbr == 0)  { ?>
           <h2 class="msg_vide"><?php  echo  "rien trouve"; ?></h2>  
         
           <?php  }
           while( $inforeq = $reqrecherche->fetch()) 
             { 
              $nom =$inforeq['nom_ens'];
              $prenom =$inforeq['prenom_ens'];
              $description =$inforeq['description_ens'];
              $matiere =$inforeq['nom_matiere'];
  ?>
            <div class="cards">
            <div class="card" onclick="toggle()" id="blur">
                <div class="left-card">
                    <div class="card-photo">
                        <img src="" alt="">
                    </div>
                    <div class="card-text">
                        <div class="nom"><?php echo $nom.' '.$prenom?></div>
                        <div class="matiere">
                            <h1>Matiere</h1>
                            
                            <p ><?= $matiere ?></p>
                           
                        </div> 
                    </div>
                    
                </div>
                <div class="v-line"></div>
                <div class="right-card">
                    <h2>Presentation</h2>
                    <p><?= $description ?></p>
                </div>
       
            </div>
        
          </div> 
          <?php } 
           }
           else
            {  
             while($a = $articles->fetch()) 
             { 
               ?>

       <div class="cards">
            <div class="card">
                <div class="left-card">
                    <div class="card-photo">
                        <img src="" alt="">
                    </div>
                    <div class="card-text">
                        <div class="nom"><?=$a['nom_ens']?></div>
                        <div class="matiere">
                            <h1>Matiere</h1>
                            
                            <p ><?= $a['nom_matiere'] ?></p>
                           
                        </div> 
                    </div>
                    
                </div>
                <div class="v-line"></div>
                <div class="right-card">
                    <h2>Presentation</h2>
                    <p><?= $a['description_ens'] ?></p>
                </div>
       
            </div>
        
          </div> 
           
           <?php
             }
          } ?> 
           <div id="popup">
            <div class="BIGcard-top">
                <div class="left-BIGcard">
                    <div class="card-photo">
                        <img src="" alt="">
                    </div>
                    <div class="card-text">
                        <div class="nom">Nom prenom</div>
                        <div class="matiere">
                            <h1>Matiere</h1>
                            <p>mathématique</p>
                            <p>Physique</p>
                        </div>
                    </div>
                </div>
                <div class="v-line-BIGcard"></div>
                <div class="right-BIGcard">
                    <div class="next-to-next tel">
                        <i class="fas fa-phone fa-3x"></i>
                        <h1>0557622554</h1>
                    </div>
                    <div class="next-to-next Email ">
                        <i class="far fa-envelope fa-3x"></i>
                        <h1>lylo.tibe6@gmail.com</h1>
                    </div>
                </div>
            </div>    
                <div class="BIGcard-presentaion commun">
                    <h1>Presentation</h1>
                    <p><?= $a['description_ens'] ?></p>
                </div>
                <div class="reviews commun">
                    <h1>Commentaires</h1>
                    <form  method="POST">
                    <input type="submit" name='commentaire' value="envoyer">
                   
                    <input  name ="com" type="text" />
                   
                    </form>
                   
                   
             
             <?php

             $recherche = $bdd->query('SELECT * FROM avis
           ORDER BY id_avis DESC'); 
       $recherche = $recherche->fetchAll();
       foreach( $recherche as $r){
       ?>
      
       
       <p ><?= $r['commentaire'] ?></p>
        
       <?php
       }
       ?>
                    
                    

                </div>
                <div class="btn">
                    <a href="#" onclick="toggle()">Retour</a>
                 </div>
        </div>   

</body>
<script src="js/recheche.js"></script>
</html>
