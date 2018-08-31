<!doctype html>
<?php
//declaration of database connection elements
$servername = "localhost";
$username="root";
$password="";
$dbname="license";

//declaration of database fields
$plate="";
$fname="";
$lname="";
$address="";
$email="";
$category="";
$contact="";
 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
 
//connect to mysql database

try{
$conn =mysqli_connect($servername,$username,$password,$dbname);
}catch(MySQLi_Sql_Exception $ex){
echo("Error In Connecting");
}
//get data from the form
function getData()
{
$data = array();
$data[0]=$_POST['plate'];
$data[1]=$_POST['fname'];
$data[2]=$_POST['lname'];
$data[3]=$_POST['address'];
$data[4]=$_POST['email'];
$data[5]=$_POST['category'];
$data[6]=$_POST['contact'];
return $data;
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
include("select.html"); 

}
} else{
echo("Result Error");
}
 
}

//insert data into table called license_table
if(isset($_POST['insert'])){
$info = getData();
$insert_query="INSERT INTO `tb_lincense`(`plate`,`fname`, `lname`, `address`, `email`, `category`,`contact`) VALUES ('$info[0]','$info[1]','$info[2]','$info[3]','$info[4]','$info[5]','$info[6]')";
try{
$insert_result=mysqli_query($conn, $insert_query);
if($insert_result)
{
if(mysqli_affected_rows($conn)>0){
	include("insertion_correct.html"); 
}else{
include("wrong_insertion.html"); 
}
}
}catch(Exception $ex){
echo("Error Inserted".$ex->getMessage());
}
}

//delete data from database codes
if(isset($_POST['delete'])){
$info = getData();
$delete_query = "DELETE FROM `tb_lincense` WHERE plate = '$info[0]'";
try{
$delete_result = mysqli_query($conn, $delete_query);
if($delete_result){
if(mysqli_affected_rows($conn)>0)
{
include("data_deleted.html"); 
}else{
include("data_not_deleted.html"); 
}
}
}catch(Exception $ex){
echo("Error In Delete".$ex->getMessage());
}
}
//edit data from database
if(isset($_POST['update'])){
$info = getData();
$update_query="UPDATE `tb_lincense` SET `plate`='$info[0]',`fname`='$info[1]',lname='$info[2]',address='$info[3]',email='$info[4]',category='$info[5]',contact='$info[6]' WHERE plate = '$info[0]'";
try{
$update_result=mysqli_query($conn, $update_query);
if($update_result){
if(mysqli_affected_rows($conn)>0){
echo("Data Updated");
}else{
include("data_not_updated.html"); 
}
}
}catch(Exception $ex){
echo("Error In Update".$ex->getMessage());
}
}
?>

<!--html codes-->
<html>
<head>
<meta charset="utf-8">
<title>License</title>
<link rel="icon"type="image"href="image/logo.jpg"><!---logo-->
<link rel="stylesheet" type="text/css" href="style.css"><!--css codes-->
</head>
<div id="body">
	<form method ="post" action="super_admin.php">
<h3>WELCOME TO SUPERVISOR PAGE:</h3>
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
<td><input type="submit" name="insert" value="INSERT"></td>
<td><input type="submit" name="delete" value="DELETE"></td>
<td><input type="submit" name="update" value="UPDATE"></td>
</tr>
<tr>
<td><input type="submit" name="search" value="SEARCH"></td>
<td><a href="report.php">REPORT</a></td>
<td><input type="reset" name="reset" value="CLEAR"></td>
</tr>
<tr>
	<td><a href="index.php">Back</td>
	<td>&nbsp</td>
	<td><a href="Logout_exit.php">Exit</td>
</tr>
</table>
</form>
</div>
</body>
</html>