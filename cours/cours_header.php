<?php

$uri_path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri_segments = explode("/", $uri_path);
$course_id = $uri_segments[2];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <?php
    $result = $db->prepare("SELECT * FROM courses WHERE id = :uid_cours");
    $result->execute(array(":uid_cours" => $course_id));
    $result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    ?>
        <div class="titre">
            <h1><?php echo($row['titre']) ?></h1>
            <div class="specs">
                <div><img src="../../RESSOURCES/css/img/duree.png" width="auto" height="22px" alt="">
                    <p><?php echo($row['duree']) ?></p>
                </div>
                <div><img src="../../RESSOURCES/css/img/diff.png" width="auto" height="22px" alt="">
                    <p><?php echo($row['difficulte']) ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>





<style>
    .titre {
        margin-top: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background-color: #0057ec;
        padding: 0 20%;
        padding-top: 20px;
        height: 150px;
    }

    .specs {
        display: flex;
        flex-direction: row;

    }

    .specs div {
        color: white;
        display: flex;
        flex-direction: row;
        align-items: center;
        padding-right: 7%;
    }

    .specs img {
        padding-right: 10px;
    }
</style>