<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    function getSingleValue($db, $sql, $parameters)
    {
        $q = $db->prepare($sql);
        $q->execute($parameters);
        return $q->fetchColumn();
    }
    //-----------------------
    $r = $_SERVER['REQUEST_URI'];
    $r = explode('/', $r);
    $r = array_filter($r);
    $r = array_merge($r, array());
    $course_id = $r[1];

    $ens = array();









    // $query = $db->prepare("SELECT * FROM enseignant WHERE id_ens = :uid_ens");
    // $query->execute(array(":uid_ens" => 12));
    // $query->execute();
    // while ($ligne = $query->fetch(PDO::FETCH_ASSOC)) {
    //         $var = $ligne['nom_ens'];
    // }

    // $query = $db->prepare("SELECT * FROM courses WHERE titre LIKE '%$keyword%' or description LIKE '%$keyword%' or categorie LIKE '%$keyword%'");
    // $query->execute();

    // while ($row = $query->fetch()) {




    $result = $db->prepare("SELECT enseignant.* FROM enseignant_cours NATURAL JOIN enseignant WHERE id_cours = :uid_cours");
    $result->execute(array(":uid_cours" => $course_id));
    $result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    

    ?>
    <div class="teacher">
        <h4>Le professeur</h4>
        <div class="teacher_text">
            <img src="RESSOURCES/css/img/teacher.jpg" alt="" width="100px" height="auto">
            <div>
                <h5><?php echo ($row['nom_ens']) ?></h5>
                <p><?php echo ($row['prenom_ens']) ?> </p>
            </div>
        </div>
    </div>

    <?php } ?>
</body>

</html>


<style>
    .teacher {
        background-color: grey;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 0 20%;
    }

    .teacher_text {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .teacher img {
        border-radius: 500px;
        margin-right: 20px;
    }
</style>