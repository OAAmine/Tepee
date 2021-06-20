<?php
  try {
    $conn = new PDO("mysql:host=localhost;dbname=Tepee", "root", "");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connected to the database.<br>';

    $sql = 'SELECT name FROM employee';
    
    print "Employee Name:<br>";
    foreach ($conn->query($sql) as $row) {
        print $row['name'] . "<br>";
    }
    $conn = null;

  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }
?>
