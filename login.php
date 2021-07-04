<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<script src="script.js"></script>
	<link rel="stylesheet" href="RESSOURCES/css/login.css">
	<title>connexion</title>
</head>

<body>
	<?php

	require_once 'db.php';

	session_start();

	if (isset($_SESSION["email_etd"]) || isset($_SESSION["email_ens"]))	//check condition user login not direct back to index.php page
	{
		header("location: index.php");
	}

	if (isset($_REQUEST['submit']))	//button name is "btn_login" 
	{
		$email		= strip_tags($_REQUEST["email"]);	//textbox name "txt_username_email"
		$password	= strip_tags($_REQUEST["mdp"]);			//textbox name "txt_password"

		if (empty($email)) {
			$errorMsg[] = "please enter username or email";	//check "username/email" textbox not empty 
		} else if (empty($password)) {
			$errorMsg[] = "please enter password";	//check "passowrd" textbox not empty 
		} else {
			try {
				$select_stmt_etd = $db->prepare("SELECT * FROM etudiant WHERE email_etd = :etemail"); //sql select query
				$select_stmt_etd->execute(array(':etemail' => $email));	//execute query with bind parameter
				$row_etd = $select_stmt_etd->fetch(PDO::FETCH_ASSOC);

				$select_stmt_ens = $db->prepare("SELECT * FROM enseignant WHERE email_ens = :enemail"); //sql select query
				$select_stmt_ens->execute(array(':enemail' => $email));	//execute query with bind parameter
				$row_ens = $select_stmt_ens->fetch(PDO::FETCH_ASSOC);

				if ($select_stmt_etd->rowCount() > 0)	//check condition database record greater zero after continue
				{
					if ($email == $row_etd["email_etd"]) //check condition user taypable "username or email" are both match from database "username or email" after continue
					{
						if (password_verify($password, $row_etd["mdp_etd"])) //check condition user taypable "password" are match from database "password" using password_verify() after continue
						{
							$_SESSION["email_etd"] = $row_etd["id_etd"];	//session name is "user_login"
							$loginMsg = "Successfully Login...";		//user login success message
							header("refresh:2; index.php");			//refresh 2 second after redirect to "welcome.php" page
							session_start();
						} else {
							$errorMsg[] = "wrong password";
						}
					} else {
						$errorMsg[] = "wrong username or email";
					}
				} else if ($select_stmt_ens->rowCount() > 0) {
					if ($email == $row_ens["email_ens"]) //check condition user taypable "username or email" are both match from database "username or email" after continue
					{
						if (password_verify($password, $row_ens["mdp_ens"])) //check condition user taypable "password" are match from database "password" using password_verify() after continue
						{
							$_SESSION["email_ens"] = $row_ens["id_ens"];	//session name is "user_login"
							$loginMsg = "Successfully Login...";		//user login success message
							header("refresh:2; index.php");			//refresh 2 second after redirect to "welcome.php" page
							session_start();
						} else {
							$errorMsg[] = "wrong password";
						}
					} else {
						$errorMsg[] = "wrong username or email";
					}
				} else {
					$errorMsg[] = "wrong username or email";
				}
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}
	}
	?>



	<div class="tout">
		<div class="logo">
			<a href="index.php"><img src="RESSOURCES/css/img/logo.png" alt="img logo"></a>
		</div>
		<div class="cote-form">
			<?php
			if (isset($errorMsg)) {
				foreach ($errorMsg as $error) {
			?>
					<div class="alert alert-danger">
						<strong><?php echo $error; ?></strong>
					</div>
				<?php
				}
			}
			if (isset($loginMsg)) {
				?>
				<div class="alert alert-success">
					<strong><?php echo $loginMsg; ?></strong>
				</div>
			<?php
			}
			?>
			<form class="form" method="post" name="login">
				<h1>Se connecter</h1>

				<div class="champs">
					<input type="text" class="login-input" name="email" placeholder="Email" autofocus="true" />
					<input type="password" class="login-input" name="mdp" placeholder="Mot de passe" />
				</div>

				<br>
				<input type="submit" value="Login" name="submit" class="login-button" />
				<p>Vous n'avez pas encore de compte ? <a href="registration_etudiant.php">Inscrivez-vous gratuitement</a> </p>
			</form>


		</div>
		<div class="image">
			<img src="RESSOURCES/css/img/login.png" alt="">
		</div>
	</div>


</body>

</html>