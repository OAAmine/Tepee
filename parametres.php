<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="/RESSOURCES/css/parametres.css" />
    <title>mon profil</title>

</head>

<body>
    <?php
    require_once 'db.php';

    include("navbar.php");


    if (isset($_SESSION['email_etd'])) {
        $select_stmt = $db->prepare("SELECT * FROM etudiant WHERE id_etd = :uid_etd"); //sql select query
        $select_stmt->execute(array(":uid_etd" => $_SESSION['email_etd']));    //execute query with bind parameter
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        $id = $_SESSION['email_etd'];
        $email = $row['email_etd'];
        $mdp = $row['mdp_etd'];
    }

    if (isset($_SESSION['email_ens'])) {
        $select_stmt = $db->prepare("SELECT * FROM enseignant WHERE id_ens = :uid_ens"); //sql select query
        $select_stmt->execute(array(":uid_ens" => $_SESSION['email_ens']));    //execute query with bind parameter
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        $id = $_SESSION['email_ens'];
        $email = $row['email_ens'];
        $mdp = $row['mdp_ens'];
    }

    ?>



    <h2 class="id">Votre Identifiant est : <?php echo ($_SESSION['email_ens']) . ($_SESSION['email_etd']) ?>, donner le a un enseignant qui souhaite vous a jouter comme collaborateur dans un cours</h2>
    <div class="ensemble">
        <form id="changeEmail">
            <div class="content">
                <h2 class="admin_title">Votre e-mail</h2>
                <h4>votre email actuel : <?php echo $email ?> </h4>

                <label class="labelformEmail required" for="change_email_new">Nouvel e-mail</label>
                <input type="email" id="change_email_new" name="change_email" required="required" class="inputformEmail" value="Email">

                <input type="submit" value="Changer" class="btn-primary admin_validation" name="email_validation_button">
            </div>
        </form>
        <form id="changepass">
            <div class="content">
                <h2 class="admin_title">Changer votre mot de passe</h2>

                <label autofocus="autofocus" class="labelformPassword required" for="changePassword_password">Ancien mot de passe</label>
                <input type="password" id="changePassword_password" name="changePassword" required="required" class="inputformPassword">

                <label class="labelformPassword required" for="changePassword_newPassword_first">Nouveau mot depasse</label>
                <input type="password" id="changePassword_newPassword_first" name="changePassword" required="required" class="inputformPassword">

                <label autofocus="autofocus" class="labelformPassword required" for="">Réécrire le nouveau mot de passe</label>
                <input type="password" id="changePassword_newPassword_second" name="new_password" required="required" class="inputformPassword">

                <input type="hidden" id="changePassword__token" name="changePassword">
            </div>
            <div class="envoyer">
                <input type="submit" value="Changer" class="btn-primary admin_validation" name="password_validation_button">
            </div>
        </form>
        <form class="supprimermoncompte">
            <h2 class="supprimer">Supprimer Votre Compte</h2>
            <a class="jeveuxsupprimer" onclick="delete_account()" href="#">je veux supprimer mon compte</a>
        </form>

        <?php
        if (isset($_REQUEST['email_validation_button'])) { //button name "btn_register"
            $new_email  = strip_tags($_REQUEST['change_email']);
            $stmt = $db->prepare("UPDATE etudiant SET email_etd = :uemail_etd WHERE id_etd = :uid_etd");
            $stmt->bindParam(':uemail_etd', $new_email);
            $stmt->bindParam(':uid_etd', $id);
            if($stmt->execute()){
                $msg = 'email changé avec succées';
                ?>
                <h1 style="color: red;"><?php  echo('email changé avec succées');  ?></h1>


        <?php 
            }
            // $old_password  = strip_tags($_REQUEST['changePassword']);
            // $new_password  = strip_tags($_REQUEST['new_password']);
        }


        ?>



    </div>
</body>

</html>



<script>
    function delete_account() {


        if (window.confirm('Voulez-vous vraiement supprimer votre compte ? ')) {
            window.location.replace("/supprimer_compte.php");
        } else {
            // They clicked no
        }
    }
</script>