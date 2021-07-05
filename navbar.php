
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <nav class="main_nav">
        <div class="logo_explore">
            <a href="index.php"><img src="/RESSOURCES/css/img/logo.png" alt="Logo"></a>
            <div class="drpdwn">
                <button class="btn__ drpbtn"><span>Catégories</span>
                    <i class="fsa fcd"></i>
                </button>
                <div class="drpdwn_cntnt">
                    <a href="#">Développement</a>
                    <a href="#">Business</a>
                    <a href="#">Design</a>
                    <a href="#">Marketing</a>
                    <a href="#">Mode de vie</a>
                    <a href="#">Musique</a>
                </div>
            </div>
        </div>

        <form class="recherche" action="search.php" method="post">
            <input type="submit" name="submit">
            <input type="text" name="search">
        </form>


        <div class="sign_up_in">
            <?php if ((isset($_SESSION['email_etd']))) { ?>
                <div class="drpdwn compte">
                    <button class="drpbtn"> <a href="#"><img src="/RESSOURCES/css/img/profil_placeholder.png" alt=""></a>
                        <i class="fsa fcd"></i>
                    </button>
                    <div class="drpdwn_cntnt">
                        <a href="<?php echo ('profil_etudiant.php') ?>">Mon tableau de bord</a>
                        <a href="logout.php">Déconnexion</a>
                    </div>
                </div>
        </div>
    <?php } else if ((isset($_SESSION['email_ens']))) { ?>
        <div class="drpdwn compte">
            <button class="drpbtn"> <a href="#"><img src="/RESSOURCES/css/img/profil_placeholder.png" alt=""></a>
                <i class="fsa fcd"></i>
            </button>
            <div class="drpdwn_cntnt">
                <a href="<?php echo ('profil_enseignant.php') ?>">Mon tableau de bord</a>
                <a href="logout.php">Déconnexion</a>
            </div>
        </div>
    <?php } else { ?>
        <a class="btn_connect" href="login.php">Se Connecter</a>
        <a class="btn__ btn_inscrire" href="registration_etudiant.php">S'inscrire gratuitement</a>
    <?php } ?>
    </div>

    </nav>

</body>

</html>