<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="RESSOURCES/css/search.css">
    <title>Document</title>
</head>
<body>
    

<?php
require 'db.php';
if (isset($_POST['search'])) {
?>
    <table class="table table-bordered">
        <thead class="alert-info">

        </thead>
        <tbody>
            <?php
            $keyword = $_POST['keyword'];
            $query = $db->prepare("SELECT * FROM courses WHERE titre LIKE '%$keyword%' or description LIKE '%$keyword%' or categorie LIKE '%$keyword%'");
            $query->execute();
            while ($row = $query->fetch()) {
            ?>
                <a class="carte_cours" href="<?php echo $row['url_cours']; ?>">

                    <div class="cours_image">
                        <img src="RESSOURCES/css/img/<?php echo $row['url_img_cours']; ?>" alt="">
                    </div>

                    <div class="cours_text">
                        <div class="titre_cat">
                            <h1 style="font-size: 200%;"><?php echo $row['titre']; ?></h1>
                            <h2 style="font-size: 150%;"><?php echo $row['categorie']; ?></h2>
                        </div>
                        <h3 style=""><?php echo $row['description']; ?></h3>
                        <!-- <h4 style="font-size: 120%;"><?php echo $row['id_ens']; ?></h4> -->
                    </div>

                    <div class="cours_desc">
                        <div class="duree_cours">
                            <img src="RESSOURCES/css/img/duree.png" alt="">
                            <h3><?php echo $row['duree']; ?> heures</h3>
                        </div>
                        <div class="diff_cours">
                            <img src="RESSOURCES/css/img/diff.png" alt="" height="15px" width="auto">
                            <h3><?php
                                if ($row['difficulte'] == 1) {
                                    echo 'facile';
                                } else if ($row['difficulte'] == 2) {
                                    echo 'moyen';
                                } else {
                                    echo 'difficile';
                                }
                                ?>



                            </h3>
                        </div>
                    </div>

                </a>


            <?php
            }
            ?>
        </tbody>
    </table>
<?php
} else {
?>
    <table class="table table-bordered">
        <thead class="alert-info">
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $db->prepare("SELECT * FROM `member`");
            $query->execute();
            while ($row = $query->fetch()) {
            ?>
                <tr>
                    <td><?php echo $row['titre'] ?></td>
                    <td><?php echo $row['categorie'] ?></td>
                    <td><?php echo $row['descrition'] ?></td>
                </tr>


            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
?>

</body>
</html>