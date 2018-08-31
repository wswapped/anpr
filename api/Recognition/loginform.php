
<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="loginbox">
		<img src="1.jpg"class="user">
    <form action=""method="post">
	<input type="text" name="user"placeholder="username"required/><br><br>
	<input type="password" name="pass"placeholder="password"required/><br><br>
	<input type="submit" name="login"value="login"/><br>
</form>


<?php
if (isset($_POST['login'])) {

	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$data = mysqli_query($conn, "SELECT * FROM registeruser WHERE username = '$user' AND password = '$pass'");
	$rows = mysqli_fetch_array($data);
	$username = $rows['username'];
	$password = $rows['password'];
	$level = $rows['level'];
	if ($user == $username && $pass == $password) {
		$_SESSION['level'] = $level;
		header('location:adminpanel.php');
	}else{
		include("wrong_login.php");
	}
}
</div>
</body>
</html>