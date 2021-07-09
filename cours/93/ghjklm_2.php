<!DOCTYPE html>
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
                    <p>Hello, World!</p>
<p>Hello, World!</p>
<p>Hello, World!</p>
<p>Hello, World!</p>
                
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
