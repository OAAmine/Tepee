<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (basename(__FILE__)); ?></title>

</head>

</head>

<body>

    <?php
    session_start();
    include("../../navbar.php");

    if(session_status() == $_SESSION['email_ens']){
        echo("hello");
    }
    ?>

    <cours id="cours">


    </cours>

    <?php

    ?>



    <?php
    include("../../footer.php");
    ?>

</body>

</html>