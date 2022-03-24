<?php
session_start();
	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password)){
			//read from database
			$user_id = random_num(20);
			$query = "SELECT * FROM users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result){
				if($result && mysqli_num_rows($result) > 0){
					$user_data = mysqli_fetch_assoc($result);

					if($user_data['password'] === $password){
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			echo "Wrong username or password!";
			
		}
		else{
			echo "Please enter some valid information!";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<img class="wave" src="img/image.png">
	<div class="container">
		<div class="login">
			<img class="imglogin" src="img/login.svg">
		</div>
		<div class="login-container">
			<form method="post">
				<img class="avatar" src="img/avatar.svg">
				<h2>Login</h2>
				<div class="input-div">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div>
						<h5>Username</h5>
						<input class="input" type="text" name="user_name">
					</div>
				</div>
				<div class="input-div">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div>
						<h5>Password</h5>
						<input class="input" type="password" name="password">
					</div>
				</div>
				<input type="submit" class="btn" value="Login">
				<p>Don't have an account yet? <a href="signup.php">Sign Up</a></p><br><br>
			</form>
		</div>
	</div>
		<script type="text/javascript" src="js/main.js"></script>
</body>
</html>