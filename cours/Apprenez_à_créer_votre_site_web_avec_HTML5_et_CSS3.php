<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> parite cour</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cours.css">
    <link rel="stylesheet" href="master.css">
    <script src="https://kit.fontawesome.com/011613b7bc.js" crossorigin="anonymous"></script>
    <script src="RESSOURCES/js/pr-cour.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    include("../navbar.php");

    require('../db.php');



    // $mysqli = new mysqli("localhost", "root", "root", "tepee");
    // $current_user = $_SESSION['email_etd'];
    // $current_url = $_SERVER['REQUEST_URI'];

    // echo($_SERVER['REQUEST_URI']);

    //                    echo the number of rows returned by the query 
    // if ($result = $con->query("SELECT id_etd FROM etudiant WHERE email_etd = '" .$current_user  . "'")) {

    //   echo "Returned rows are: " . $result->num_rows;
    //   Free result set
    //   $result->free_result();
    // }


    // store the id of the current session user in a variable
    // $sql_etudiant = "SELECT id_etd FROM etudiant WHERE email_etd = '" . $current_user . "'";
    // $result_etudiant = mysqli_query($con, $sql_etudiant);
    // $rse = mysqli_fetch_array($result_etudiant);

    //id de l'utilisateur de la session 
    // $etudiant_id = $rse['id_etd'];

    // // -------------------------------------------------------------

    // // -------------------------------------------------------------


    // //// store the id of course in a variable 
    // $sql_cours = "SELECT id_cours FROM cours WHERE url_cours = '" . $current_url . "'";


    // $result_cours = mysqli_query($con, $sql_cours);
    // $rsc = mysqli_fetch_array($result_cours);

    // //id du cours 
    // $cours_id = $rsc['id_cours'];

    // $date = date("Y-m-d");
    // //insert into table cours_etudiant when commencer is clicked

    session_start();
    require_once "../../db.php";
    include("../../navbar.php");


    $uri_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $uri_segments = explode("/", $uri_path);
    $course_id = $uri_segments[2];

    if (isset($_REQUEST['submit'])) {
        $stmt = $db->prepare("INSERT INTO etudiant_cours (id_etd,id_cours,date_inscription) VALUES
        (:uid_etd,:uid_cours,:udate_inscription)");
        $stmt->bindParam(':uid_etd', $_SESSION['id_etd']);
        $stmt->bindParam(':uid_cours', $course_id);
        $stmt->bindParam(':udate_inscription', date("Y/m/d"));
        $stmt->execute();
    }




    ?>
    <div class="titre">
        <h1>Initiez-vous au marketing digital</h1>
        <div class="specs">
            <div><img src="../RESSOURCES/css/img/duree.png" width="auto" height="22px" alt="">
                <p> 10 heures</p>
            </div>
            <div><img src="../RESSOURCES/css/img/diff.png" width="auto" height="22px" alt="">
                <p>Facile </p>
            </div>
        </div>
    </div>


    <section class="cours" id="cours">
        <div class="desc">
            <p>Bienvenue ?? toutes et ?? tous !</p>
            <p>???Est-ce que vous vous ??tes d??j?? demand?? comment :</p>
            <ul>
                <li>Expliquer l'int??r??t du marketing digital et ses champs d'action</li>
                <li>Cr??er un plan marketing</li>
                <li>Mesurer l'efficacit?? des actions marketing avec les indicateurs de performances</li>
            </ul>
            <p>Alors le marketing digital devrait vous int??resser !???</p>
            <p>Je suis ravi de partager avec vous ma passion pour le marketing digital.
                Si vous savez d??j?? plus ou moins en quoi consiste la publicit?? en ligne, le r??f??rencement, l???e-mailing
                ou encore le community management, vous connaissez quelques-unes des nombreuses branches du marketing
                digital ??? mais il y en a tellement que vous vous demandez peut-??tre par o?? commencer !
                Ou bien, si vous d??butez, peut-??tre que le terme ???marketing digital??? n???est pas encore clair pour vous : ne vous
                inqui??t
                ez pas ! Dans ce cours d???initiation, c'est de z??ro qu'on va commencer.

                Et c???est progressivement que je vous familiariserai avec les m??thodes fondamentales et les techniques
                incontournables de ce domaine passionnant.</p>
            <ul>
                <li>?? la fin de la premi??re partie de ce cours, vous serez vous-m??me capable d???expliquer ?? un d??butant en quoi
                    ??a consiste.</li>
                <li>CDans la deuxi??me partie de ce cours, vous apprendrez ?? ??laborer une strat??gie web marketing actionnable, et
                    ?? l'int??grer dans le livrable par excellence du marketeur : le plan marketing.

                </li>
                <li>Enfin, dans la troisi??me partie, une fois que vous ma??triserez les bases, je vous montrerai comment
                    am??liorer la performance de vos actions web marketing ?? chaque niveau de la relation client.</li>
            </ul>

            <p>Je suis convaincu qu'avant la fin de ce cours, vous aurez les connaissances et les comp??tences n??cessaires pour
                bien commencer dans le marketing digital ett explorer les diff??rentes branches du marketing digital. J???ai tout
                fait pour le rendre aussi int??ressant et complet que possible ; alors, que vous soyez un v??ritable d??butant ou
                non, n???h??sitez plus : suivez ce cours d??s maintenant !</p>
        </div>

        <div class="peda">
            <h4>Objectifs p??dagogiques</h4>
            <p>?? la fin de ce cours, vous serez capable de :</p>
            <ul>
                <li>Expliquer l'int??r??t du marketing digital et ses champs d'action</li>
                <li>Cr??er un plan marketing</li>
                <li>Mesurer l'efficacit?? des actions marketing avec les indicateurs de performances</li>
            </ul>
        </div>

        <div class="pre">
            <h4>Pr??requis:</h4>
            <p> aucun !</p>
        </div>

        <form class="comm" method="submit" action="">
            <input type="submit" name="nw_update" value="Commencer le cours !" />
        </form>
        <!-- <div class="comm">
            <button type="button" name="button">commencer le cour</button>
        </div> -->
    </section>

    <div class="sidenav">
        <a href="#" class="debut">Table des mati??res</a>
        <button class="dropdown-btn">
            <i class="fas fa-book-reader">
            </i>Partie 1 - D??couvrez l'int??r??t du marketing digital
            et ses champs d'action
            <span class="fa fa-chevron-right" aria-hidden="true"></span>
        </button>
        <div class="dropdown-container">
            <a href="#">1. Ne confondez plus marketing et communication </a>
            <a href="#">2. D??couvrez l'??cosyst??me du marketing digital </a>
            <a href="#">3. Comparez le marketing digital et le marketing traditionnel </a>
        </div><button class="dropdown-btn"><i class="fas fa-book-reader"></i>Partie 2 - Cr??ez un plan marketing pour
            atteindre vos objectifs
            <span class="fa fa-chevron-right" aria-hidden="true"></span>
        </button>
        <div class="dropdown-container">
            <a href="#">1. Planifiez vos actions pour augmenter vos r??sultats </a>
            <a href="#">2. Clarifiez les objectifs de vos campagnes marketing </a>
            <a href="#">3. Conduisez une ??tude de march?? </a>
            <a href="#">4. ??laborez une strat??gie adapt??e ?? votre offre </a>

        </div><button class="dropdown-btn"><i class="fas fa-book-reader"></i>Partie 3 - Mesurez l'efficacit?? de vos actions
            marketing
            <span class="fa fa-chevron-right" aria-hidden="true"></span>
        </button>
        <div class="dropdown-container">
            <a href="#">1. G??rez la relation client en ligne </a>
            <a href="#"> 2. Attirez des visiteurs sur votre site Internet </a>
            <a href="#"> 3. Transformez vos visiteurs en prospects </a>
            <a href="#"> 4. Obtenez des ventes gr??ce ?? l'appel ?? action </a>
        </div>

    </div>

    <div class="teacher">
        <h4>Le professeur</h4>
        <div class="teacher_text">
            <img src="../RESSOURCES/css/img/teacher.jpg" alt="" width="100px" height="auto">
            <div>
                <h5>Rodolphe Vonthron</h5>
                <p>Expert en Communication et Marketing
                    Digital avec un parcours de 20 ans Agences
                    &amp; annonceurs au service de marques. </p>
            </div>
        </div>
    </div>
    <?php include("../footer.php") ?>









</html>