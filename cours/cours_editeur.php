<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editeur de Cours</title>


    <?php
    require_once '../db.php';
    function getSingleValue($db, $sql, $parameters)
    {
        $q = $db->prepare($sql);
        $q->execute($parameters);
        return $q->fetchColumn();
    }

    $url = $_SERVER['REQUEST_URI'];

    $url_components = parse_url($url);

    parse_str($url_components['query'], $params);

    $course_id = $params['id'];

    $course_name = getSingleValue($db, "SELECT titre FROM courses WHERE id=?", [$course_id]);
    $course_name_without_php_extension = str_replace(".php", "", $course_name);

    $nom_du_cours = $params['nom'];


    $file_to_inject_to = $_SERVER['DOCUMENT_ROOT'] . "/cours/" . $course_id . "/" . $params['nom'];

    $nb_chap = getSingleValue($db, "SELECT nb_chap FROM courses WHERE id=?", [$course_id]);

    $data = file_get_contents($file_to_inject_to);

    preg_match('/<cours>(.*?)<\/cours>/s', $data, $match);
    $cours = $match[0];



    // echo ($cours_with);

    ?>



    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#mytextarea',
        });
    </script>

</head>

<body>
    <h1>Editeur de cours</h1>
    <form action="">
        <label for="chapitre">Selectionnez le chapitre à modifier/créer</label>
        <select id="chapitre" name="chapitre" type="text" onchange="location = this.value;">
            <option selected disabled hidden>Chapitre</option>
            <option value="<?php echo ('cours_editeur.php?id=' . $course_id . '&nom=' . $course_name); ?>.php">Présentation</option>
            <?php
            for ($x = 0; $x <= $nb_chap; $x++) {
                //echo ('<option value='.$course_id.'/'.$course_name_without_php_extension.'_'.$x.'.php>Chapitre' . $x . '</option>');
                echo ('<option value=?id=' . $course_id . '&nom=' . $course_name_without_php_extension . '_' . $x . '.php>Chapitre' . $x . '</option>');
            }
            ?>
        </select>
    </form>








    <textarea name="" id="mytextarea" cols="30" rows="10"><?php echo ($cours); ?> </textarea>

    <?php
    $url = $course_id . '/' . $nom_du_cours;

    if (isset($_REQUEST['submit'])) //button name "btn_register"
    {

        $include_html = '<!DOCTYPE html>
                    <html lang="en">
                        
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <link rel="stylesheet" href="../cours.css">

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
                        
                        
                        
                            <cours>' . $_COOKIE["cours_input"] . '</cours>
                        
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
                                $stmt->bindParam(":udate_inscription",$now_date );
                                $stmt->execute();
                            }
                            ?>
                            <form action="" class="comm" method="post" name="inscrire" enctype="multipart/form-data">
                               <input type="submit" name="inscrire"  value="Commencer le cours !" />
                            </form>
                            <a href="<?php echo($uri_segments."_".$file_to_inject_to) ?>"></a>

                            <?php
                            include("../formateur_info.php");
                            include("../../footer.php");
                            ?>
                        
                        </body>
                        
                    </html>
                        
                        
                        
                        
                        <style>

                                .comm {
                                    width: 20%;
                                    margin: auto;
                                }
                                
                                .comm input[type=submit] {
                                    width: 280px;
                                    height: 60px;
                                    color: white;
                                    font-size: 20px;
                                    font-weight: 600;
                                    text-transform: uppercase;
                                    background-color: #A771FE;
                                    border-radius: 20px;
                                    box-shadow: 2px 2px 2px black;
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

                        </style>';




        file_put_contents($file_to_inject_to, $include_html);
    }
    ?>

    <div class="buttons">
        <button onclick="modifier()">modifier</button>

        <form method="post" action="">
            <input type="submit" name="submit" value="Publier" id="submit" />
        </form>
        <button onclick="aperçu()">Aperçu</button>
    </div>


    <script>
        var jsvar = '<?php echo ('fzefzfefezfefez') ?>';
        console.log(jsvar);
    </script>







</body>
<script>
    // Creating a cookie after the document is ready

    // Function to create the cookie
    function createCookie(name, value, days) {
        var expires;

        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }

        document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
    }


    function modifier() {
        cours_saisie = tinymce.get("mytextarea").getContent();
        createCookie("cours_input", cours_saisie, "2");

    }

    function aperçu() {
        URL = '<?php echo ($url); ?>';
        window.open(URL, '_blank');
    }
</script>



<style>
    .buttons {
        display: flex;
        flex-direction: row;
        margin-top: 20px;
    }

    .buttons input {
        font-size: 20px;
        color: white;
        height: 43px;
        width: auto;
        background-color: blue;
        border-radius: 5px 0px 0px 5px;
        transition: background-color 0.2s;
        margin-right: 2px;
    }

    .buttons button {
        font-size: 20px;
        color: black;
        height: 43px;
        width: auto;
        background-color: white;
        border-radius: 5px 0px 0px 5px;
        transition: background-color 0.2s;
        margin-right: 2px;
    }

    select {
        background-color: blue;
        color: white;
        font-size: 20px;
        margin-bottom: 20px;
    }
</style>