<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="RESSOURCES/css/search.css">
    <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
    <title>Document</title>
</head>

<body>


    <?php
    require('db.php');
    include('navbar.php');

    $search_value = $_POST["search"];
    // $con = mysqli_connect("localhost","root","root","tepee");
    if (isset($_REQUEST['search'])) {
        $sql = "select * from cours where desc_cours like '%$search_value%'";

        $res = $con->query($sql);
        while ($row = $res->fetch_assoc()) {

    ?>
            <!-- echo 'id_cours:  '.$row["nom_cours"]; -->


            <a class="carte_cours" href="<?php echo $row['url_cours']; ?>">

                    <div class="cours_image">
                        <img src="RESSOURCES/css/img/<?php echo $row['url_img_cours']; ?>" alt="" >
                    </div>

                    <div class="cours_text">
                        <div class="titre_cat">
                            <h1 style="font-size: 200%;"><?php echo $row['nom_cours']; ?></h1>
                            <h2 style="font-size: 150%;"><?php echo $row['cat_cours']; ?></h2>
                        </div>
                        <h3 style=""><?php echo $row['desc_cours']; ?></h3>
                        <!-- <h4 style="font-size: 120%;"><?php echo $row['id_ens']; ?></h4> -->
                    </div>

                    <div class="cours_desc">
                        <div class="duree_cours">
                            <img src="RESSOURCES/css/img/duree.png" alt="">
                            <h3><?php echo $row['duree_cours']; ?> heures</h3>
                        </div>
                        <div class="diff_cours">
                            <img src="RESSOURCES/css/img/diff.png" alt="" height="15px" width="auto">
                            <h3
                            ><?php
                            if ($row['difficulte_cours'] == 1){echo 'facile'; }
                            else if ($row['difficulte_cours'] == 2){echo 'moyen'; }
                            else{echo 'difficile';}
                                ?>
                            
                            
                            
                            </h3>
                        </div>
                    </div>

            </a>
    <?php
        }
    }

    ?>

<!-- <form action="" method="post">
        <input type="text" name="search">
        <input type="submit" name="submit" value="Search">
        <a href="#"></a>
    </form> -->

</body>

</html>