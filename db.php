<?php
/*
  $user = 'root';
  $pass = "root";
  try
  {
    $db = new PDO('mysql:host=localhost;dbname=tepee' , $user , $pass ,array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
  }
  catch(Exception $db)
  {
    echo $db ->getMessage();  }

    */
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.

    $db = new PDO('mysql:host=localhost;dbname=tepee', 'root', 'root123456789');


    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>