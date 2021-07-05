<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
            $title = str_replace('_', ' ', basename(__FILE__));
            echo ($title);

            ?></title>

</head>

</head>

<body>

    <?php
    session_start();
    include("../../navbar.php");
    ?>

    <cours id="cours">


    </cours>




    <?php
    include("../../footer.php");
    ?>

</body>

</html>