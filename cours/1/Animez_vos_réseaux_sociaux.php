<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/RESSOURCES/css/cours.css">
    <title><?php $title = str_replace("_", " ", basename(__FILE__));
            echo ($title);
            ?></title>

</head>

</head>

<body>

    <?php
    session_start();
    require_once "../../db.php";
    include("../../navbar.php");
    include("../cours_header.php");

    $uri_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $uri_segments = explode("/", $uri_path);
    $course_id = $uri_segments[2];

    $select_stmt = $db->prepare("SELECT id_ens FROM enseignant_cours WHERE id_cours = :eidcours"); //sql select query
    $select_stmt->execute(array(":eidcours" => $course_id));    //execute query with bind parameter
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_SESSION["email_ens"])) {
        if ($row["id_ens"] == $_SESSION["email_ens"]) { ?>
            <form method="POST" class="cours_du_ens"> <label for="submit">Ce cours vous apparitent</label> <input type="submit" value="MODIFIER" name="submit" class="login-button" />
            </form>
    <?php
        }
    }

    if (isset($_REQUEST["submit"])) {
        header("Location: ../cours_editeur.php?id=" . $uri_segments[2] . "&nom=" . $uri_segments[3]);
    }
    ?>



    <div class="cours">
        <ul>
            <p>Bienvenue à toutes et à tous !</p>
            <p>‌Est-ce que vous vous êtes déjà demandé comment :</p>
            <ul>
                <li>Expliquer l'intérêt du marketing digital et ses champs d'action</li>
                <li>Créer un plan marketing</li>
                <li>Mesurer l'efficacité des actions marketing avec les indicateurs de performances</li>
            </ul>
            <p>Alors le marketing digital devrait vous intéresser !‌</p>
            <p>Je suis ravi de partager avec vous ma passion pour le marketing digital.
                Si vous savez déjà plus ou moins en quoi consiste la publicité en ligne, le référencement, l’e-mailing
                ou encore le community management, vous connaissez quelques-unes des nombreuses branches du marketing
                digital – mais il y en a tellement que vous vous demandez peut-être par où commencer !
                Ou bien, si vous débutez, peut-être que le terme “marketing digital” n’est pas encore clair pour vous : ne vous
                inquiét
                ez pas ! Dans ce cours d’initiation, c'est de zéro qu'on va commencer.

                Et c’est progressivement que je vous familiariserai avec les méthodes fondamentales et les techniques
                incontournables de ce domaine passionnant.</p>
            <ul>
                <li>À la fin de la première partie de ce cours, vous serez vous-même capable d’expliquer à un débutant en quoi
                    ça consiste.</li>
                <li>CDans la deuxième partie de ce cours, vous apprendrez à élaborer une stratégie web marketing actionnable, et
                    à l'intégrer dans le livrable par excellence du marketeur : le plan marketing.

                </li>
                <li>Enfin, dans la troisième partie, une fois que vous maîtriserez les bases, je vous montrerai comment
                    améliorer la performance de vos actions web marketing à chaque niveau de la relation client.</li>
            </ul>

            <p>Je suis convaincu qu'avant la fin de ce cours, vous aurez les connaissances et les compétences nécessaires pour
                bien commencer dans le marketing digital ett explorer les différentes branches du marketing digital. J’ai tout
                fait pour le rendre aussi intéressant et complet que possible ; alors, que vous soyez un véritable débutant ou
                non, n’hésitez plus : suivez ce cours dès maintenant !</p>
            </div>

            <div class="peda">
                <h4>Objectifs pédagogiques</h4>
                <p>À la fin de ce cours, vous serez capable de :</p>
                <ul>
                    <li>Expliquer l'intérêt du marketing digital et ses champs d'action</li>
                    <li>Créer un plan marketing</li>
                    <li>Mesurer l'efficacité des actions marketing avec les indicateurs de performances</li>
                </ul>
            </div>

            <div class="pre">
                <h4>Prérequis:</h4>
                <p> aucun !</p>
            </div>
</div>

    <?php
    $uri_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $uri_segments = explode("/", $uri_path);
    $course_id = $uri_segments[2];



    if (isset($_REQUEST["inscrire"])) {

        $now_date = date("Y/m/d");
        $stmt = $db->prepare("INSERT INTO etudiant_cours (id_etd,id_cours,date_inscription) VALUES
                                (:uid_etd,:uid_cours,:udate_inscription)");
        $stmt->bindParam(":uid_etd", $_SESSION["id_etd"]);
        $stmt->bindParam(":uid_cours", $course_id);
        $stmt->bindParam(":udate_inscription", $now_date);
        $stmt->execute();
    }
    ?>
    <form action="" method="post" name="inscrire" enctype="multipart/form-data">
        <input type="submit" name="inscrire" value="Commencer le cours !" />
    </form>
    <a href="<?php echo ($uri_segments . "_" . $file_to_inject_to) ?>"></a>

    <?php
    include("../../footer.php");
    ?>

</body>

</html>




<style>
    .cours{
        margin: 0 60px;
    }

    .cours_du_ens {
        display: block;
        text-align: center;
        font-size: 25px;
    }

    .cours_du_ens input {
        border-radius: 5px;
        padding: 7px 5px;
        margin-right: 5px;
        border: 2px solid blue;
        text-decoration: none;
        font-weight: 600;
        text-decoration: none;
        padding-right: 5px;
        color: white;
        background-color: blue;
    }

    .cours_du_ens input:hover {
        color: blue;
        background-color: white;
        cursor: pointer;
    }
</style>