<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
	<title>License</title>
</head>
<body>
	
<?php
$level = $_SESSION['level'] == 'user';
if ($level) {
	include 'super_admin2.php';
?>
<a href="Logout.php"></a>

<?php }else { ?>
	<?php
       include 'super_admin.php';
	?>
	<a href="Logout.php"></a>
<?php } ?>


</body>
</html>