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

    echo($course_id);
    $course_name = getSingleValue($db, "SELECT titre FROM courses WHERE id=?", [$course_id]);
    $course_name_without_php_extension = str_replace(".php", "", $course_name);

    $file_to_inject_to = $_SERVER['DOCUMENT_ROOT'] . "/cours/" . $course_id . "/" . $params['nom'];

    $nb_chap = getSingleValue($db, "SELECT nb_chap FROM courses WHERE id=?", [$course_id]);

    $data = file_get_contents($file_to_inject_to);

    preg_match('/<cours id="cours">(.*?)<\/cours>/s', $data, $match);

    $cours = $match[0];

    $cours_with_plus = str_replace('"', '+', $cours);
    $cours_with = str_replace("'", '%', $cours_with_plus);


    // echo ($cours_with);

    ?>



    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#mytextarea',
            setup: function(editor) {
                editor.on('init', function(e) {
                    editor.setContent('fefef');
                });
            }
        });
    </script>

</head>

<body>
    <h1>Editeur de cours</h1>
    <form action="">
        <label for="chapitre">Selectionnez le chapitre à modifier/créer</label>
        <select id="chapitre" name="chapitre" type="text" onchange="location = this.value;">
            <option selected disabled hidden>Chapitre 2</option>
            <option value="<?php echo ('cours_editeur.php?id=' . $course_id . '&nom=' . $course_name); ?>.php">Présentation</option>
            <?php
            for ($x = 0; $x <= $nb_chap; $x++) {
                //echo ('<option value='.$course_id.'/'.$course_name_without_php_extension.'_'.$x.'.php>Chapitre' . $x . '</option>');
                echo ('<option value=?id=' . $course_id . '&nom=' . $course_name_without_php_extension . '_' . $x . '.php>Chapitre' . $x . '</option>');
            }
            ?>
        </select>
    </form>





    <cours id="cours">


    </cours>




    <textarea name="" id="mytextarea" cols="30" rows="10"></textarea>
    <!-- <button onclick="turn_to_html()">turn_to_html</button> -->

    <?php



    $include_html = '<!DOCTYPE html>
                    <html lang="en">
                        
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                header("Location: ../cours_editeur.php?id=" . $uri_segments[2] . "?nom=" . $uri_segments[3]);
                            }
                            ?>
                        
                        
                        
                            <cours id="cours">
                            ' . $_COOKIE["cours_input"] . '
                        
                            </cours>
                        
                        
                        
                        
                            <?php
                            include("../../footer.php");
                            ?>
                        
                        </body>
                        
                    </html>
                        
                        
                        
                        
                        <style>
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

    ?>

    <div class="buttons">
        <button onclick="turn_to_editor()">Aperçu</button>

        <form method="post" action="">
            <input type="submit" name="submit" value="Publier" id="submit" />
        </form>
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




    function turn_to_editor() {
        cours = document.getElementById("cours").innerHTML;
        // tinymce.get("mytextarea").setContent(cours);
        tinymce.get("mytextarea").setContent(x);
        createCookie("cours_input", cours, "2");
    }

    function turn_to_html() {
        x = tinymce.get("mytextarea").getContent();
        document.getElementById("cours").innerHTML = x;
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
    select{
        background-color: blue;
        color: white;
        font-size: 20px;
        margin-bottom: 20px;
    }

</style>