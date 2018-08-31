<!doctype html>
<?php
//declaration of database connection element
$servername = "localhost";
$username="root";
$password="";
$dbname="license";

//declaration of fields
$plate="";
$fname="";
$lname="";
$address="";
$email="";
$category="";
$contact="";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 
//connection of database

try{
$conn =mysqli_connect($servername,$username,$password,$dbname);
}catch(MySQLi_Sql_Exception $ex){
echo("Error In Connecting");
}
//search data from database
if(isset($_POST['search']))
{
$info = getData();
$search_query="SELECT * FROM tb_lincense WHERE plate = '$info[0]'";
$search_result=mysqli_query($conn, $search_query);
if($search_result)
{
if(mysqli_num_rows($search_result))
{
while($rows = mysqli_fetch_array($search_result))
{
$plate = $rows['plate'];
$fname = $rows['fname'];
$lname = $rows['lname'];
$address = $rows['address'];
$email = $rows['email'];
$category = $rows['category'];
$contact = $rows['contact'];
}
}else{
echo("No Data Are Available");
}
} else{
echo("Result Error");
}
}
?>


<!--HTML CODE FOR Supervisor page-->
<html>
<head>
<meta charset="utf-8">
<title>License</title>
<link rel="icon"type="image"href="image/logo.jpg">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<div id="body">
	<form method ="post" action="super_admin2.php">
<h3>WELCOME TO ASSISTANT SUPERVISOR PAGE </h3>
<table class="add_plate_table">
<tr>
<td>PLATE NUMBER: </td>
<td><input type="text" name="plate" placeholder="Plate number" value="<?php echo($plate);?>"required></td>
</tr>
<tr>
<td>FIRST NAME :</td>
 <td><input type="text" name="fname" placeholder="First Name" value="<?php echo($fname);?>"></td>
 </tr>
 <tr>
 <td>LAST NAME :</td>
 <td><input type="text" name="lname" placeholder="Last Name" value="<?php echo($lname);?>"></td>
</tr>
 <tr>
<td>ADDRESS   :</td>
 <td><input type="text" name="address" placeholder="Address" value="<?php echo($address);?>"></td>
</tr>
 <tr>
<td>EMAIL :</td>
 <td><input type="text" name="email" placeholder="example@example.com" value="<?php echo($email);?>"></td>
</tr>
<tr>
	<tr>
<td>CLASSIFICATION</b></td>
<td><input type="text" name="category" placeholder="staff&student" value="<?php echo($category);?>"></td>
</tr>
<tr>
<td>TELEPHONE   :</td> 
 <td><input type="text" name="contact" placeholder="Telephone" value="<?php echo($contact);?>"></td>
</tr>
<tr>
<td><input type="submit" name="search" value="SEARCH"></td>
<td><a target='_blank'href="report.php">REPORT</a></td>
<td><input type="reset" name="reset" value="CLEAR"></td>
</tr>
<tr>
	<td><a href="index.php">Back</td>
	<td>&nbsp</td>
	<td><a href="Logout_exit.php">Exit</td>
</tr>
</table>
</form>
</body>
</html>