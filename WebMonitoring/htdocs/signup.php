<?php
session_start();
	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//something was posted
		$email = $_POST['email'];
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($email) && !empty($user_name) && !empty($password)){
			//save to database
			$user_id = random_num(20);
			$query = "INSERT INTO users (user_id,email,user_name,password) values ('$user_id','$email','$user_name','$password')";
			mysqli_query($con, $query);
			header("Location: login.php");
			die;
		}
		else{
			echo "Please enter some valid information!";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
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
				<h2>Sign Up</h2>
				<div class="input-div">
					<div class="i">
						<i class="fas fa-envelope"></i>
					</div>
					<div>
						<h5>Email</h5>
						<input class="input" type="email" name="email">
					</div>
				</div>
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
				<input type="submit" class="btn" value="Sign Up">
				<p>Already have an account? <a href="login.php">Login Here</a></p><br><br>
			</form>
		</div>
	</div>
		<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
