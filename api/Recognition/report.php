<?php

if(isset($_POST['search']))
{
       $valueToSearch = $_POST['valueToSearch'];
       $query = "SELECT *
FROM `tb_carsarrived`
WHERE CONCAT (`id`, `plate`, `dateArrived`) LIKE '%".$valueToSearch."%'";
$search_result = filterTable($query);

}
else
 {
    $query = "SELECT * FROM tb_carsarrived";
    $search_result = filterTable($query);
}
function filterTable($query)
{
	$conn = mysqli_connect('localhost','root','','license');
	$filter_Result = mysqli_query($conn, $query);
	return $filter_Result;
}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="icon"type="image"href="image/logo.jpg">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Report</title>
	<style>
		table
		{
			border-collapse: collapse;
			width: 32%;
			color: #000;
			font-family: monospace;
			font-size: 20px;
			margin-left: 270px;
		}
		th{
			background-color: #588c7e;
			color: white;
			padding: 15px;
			font-size: 20px;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2; 
		}
	</style>
</head>
 <body>
<form>
	<br>
   <input type="button"name="print"value="Print Report"color="green"onclick="window.print()"><br><br>
	<table>
		<tr>
			<th>PLATE</th>
			<th>TIME CAR ARRIVED</th>
		</tr>
		<?php while ($row = mysqli_fetch_array($search_result)):?>
			<tr>
				<td><?php echo $row['plate'];?></td>
				<td><?php echo $row['dateArrived'];?></td>
			</tr>
		<?php endwhile;?>
	</table>
</form>
</body>
</html>