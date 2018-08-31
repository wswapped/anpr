<?php
session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>License</title>
	<link rel="icon"type="image"href="image/logo.jpg">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<div id="body" >
	<form action=""method="post">
	<div id="logform">
		<h3><u>YOU HAVE TO LOGIN!!!</u></h3>
    
<table class="login_table">
<tr>
<td rowspan="4">
<img src="image/login_img.png"width="130"height="130"/>
</td>
</tr>
<tr>
    	<td>USERNAME:</td>
	<td><input id="name1" ="name"type="text" name="user"placeholder="   example@gmail.com"required/></td>
	</tr>
<tr>
	<td>PASSWORD:</td>
	<td><input id="pass1" type="password" name="pass"placeholder="      ***********************"required/></td>
	</tr>
<tr>
	<td><input id="sub"type="submit" name="login"value="LOGIN"class="button"/></td>
		<td><input id="res" type="reset"name="reset"value="CANCEL"class="button"></td>
</tr>
</table>
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

		include("wrong_login.html");
	}
}
?>
</div>
</body>
</html>