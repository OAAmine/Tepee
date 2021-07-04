<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <?php
    // if (isset($_SESSION['email_etd'])) {
    //     echo '<li class="drpdwn"><a href="logout.php"><span>Log Out</span></a></li>';
    // } else {
    //     echo '<li class="drpdwn"><a href="login.php"><span>Log In</span></a></li>';
    // }
    ?>
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
        <?php } else if  ((isset($_SESSION['email_ens']))) { ?>
            <div class="drpdwn compte">
                <button class="drpbtn"> <a href="#"><img src="RESSOURCES/css/img/profil_placeholder.png" alt=""></a>
                    <i class="fsa fcd"></i>
                </button>
                <div class="drpdwn_cntnt">
                    <a href="<?php echo ('profil_enseignant.php') ?>">Mon tableau de bord</a>
                    <a href="logout.php">Déconnexion</a>
                </div>
            </div>
            <?php } else { ?>
                <a class="btn_connect" href="login.php">Se Connecter</a>
                <a class="btn__ btn_inscrire" href="registration.php">S'inscrire gratuitement</a>
            <?php }?>
        </div>

    </nav>

</body>

</html>



<style>
    /*---------------BASIC SETUP--------------*/

    * {
        padding: 0px;
        margin: 0px;
        box-sizing: border-box;
        outline: none;
    }

    html,
    body {
        background-color: #fff;
        color: #1f1f1f;
        font-weight: 400;
        text-rendering: optimizeLegibility;
        overflow-x: hidden;
    }

    nav {

        font-size: 18px;
        border-bottom: 1px solid #d0d0d0;
        font-weight: 400;
        font-family: Montserrat;


    }

    /*----------------------------------------*/
    /*---------------NAV-BAR------------------*/
    .btn__ {
        border-radius: 5px;
        padding: 7px 5px;
        margin-right: 5px;
        border: 2px solid blue;
        text-decoration: none;
        font-weight: 600;
    }

    .btn_connect {
        text-decoration: none;
        color: blue;
        padding-right: 5px;
    }

    .btn_connect:hover {

        text-decoration: underline;
        color: blue;
    }

    .btn_inscrire {
        color: white;
        background-color: blue;
        transition: background-color 0.1s;
    }

    .btn_inscrire:hover {
        background-color: #5555ff;
    }

    .drpbtn span {
        text-decoration: none;
        background-color: blue;
        border-radius: 10px;
        padding: 10px 15px;
        transition: background-color 0.2s, color 0.1s;
        font-family: Montserrat;
        font-weight: 400;
    }




    .drpdwn .drpbtn {
        font-size: 16px;
        border: none;
        outline: none;
        color: white;
        background-color: inherit;
        font-family: inherit;
    }

    .drpdwn_cntnt {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .drpdwn_cntnt a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .drpdwn_cntnt a:hover {
        background-color: #ddd;
    }

    .drpdwn:hover .drpdwn_cntnt {
        display: block;
    }



    .main_nav {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        height: 70px;
        background-color: white;
    }

    .logo_explore {
        width: 20%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .logo_explore img {
        width: auto;
        height: 70px;
        margin-right: 30px;
    }

    .recherche {
        width: 40%;
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .recherche input[type=text] {
        width: 90%;
        padding: 10px 0;
        font-size: 17px;
        border-radius: 0 5px 5px 0;
        background-color: white;
        border: 1px solid gray;
    }

    .recherche input[type=submit] {
        background: url(/RESSOURCES/css/img/search-magnifying-glass.svg) no-repeat scroll 11px 11px;
        height: 43px;
        width: auto;
        color: transparent;
        background-color: blue;
        border-radius: 5px 0px 0px 5px;
        transition: background-color 0.2s;
        margin-right: 2px;
    }


    .sign_up_in {
        color: #1687A7;
        width: 30%;
    }
    .compte{
        width: 10%;
    }
    .compte img {
        height: 30px;
        width: auto;
        border-radius: 50px;
    }
</style>