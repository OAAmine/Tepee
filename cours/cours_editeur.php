<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editeur de Cours</title>

    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
</head>

<body>
    <?php
    require_once '../db.php';


    $url = $_SERVER['REQUEST_URI'];

    $url_components = parse_url($url);

    parse_str($url_components['query'], $params);

    $course_id = $params['id'];
    $course_name = $params['nom'];


    $new_file_dir = $_SERVER['DOCUMENT_ROOT'] . "/cours/84/ghjk.php";

    $select_stmt = $db->prepare("SELECT * FROM cours WHERE email_etd = :etemail"); //sql select query
    $select_stmt->execute(array(':etemail' => $email));    //execute query with bind parameter
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <h1>Createur de Cours</h1>
    <form action="">
        <label for="chapitre">Chapitre</label>
        <select id="chapitre" name="chapitre" type="text">
            <option selected disabled hidden>Chapitre</option>
            <option value="Presentation">Présentation</option>
            <?php
            for ($x = 0; $x <= $row['nb_chap']; $x++) {
                echo ('<option value="Chapitre' . $x . '">Présentation</option>');
            }




            ?>

        </select>




    </form>





    <cours id="cours">
        dzadazdaz
        <p>dzadazdazdaz</p>
        <a href="dazdaz">dzadoaiuzhdaziuhdiuazgdizaugdiu</a>


    </cours>
    <textarea id="mytextarea">Hello, World!</textarea>
    <button onclick="turn_to_editor()">turn_to_editor</button>
    <button onclick="turn_to_html()">turn_to_html</button>

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
                </style>
';
    file_put_contents($new_file_dir, $include_html);

    ?>

    <form method="post" action="">
        <input type="submit" name="submit" value="Send" id="submit" />
    </form>

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
        tinymce.get("mytextarea").setContent(cours);
        createCookie("cours_input", cours, "2");
    }

    function turn_to_html() {
        x = tinymce.get("mytextarea").getContent();
        document.getElementById("cours").innerHTML = x;
    }
</script>