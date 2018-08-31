<?php
	include_once 'connection.php';

	//License plate sent from kit in GET request
	$license_plate = $_GET['license'];

	#response define_syslog_variables()
	$response = '';

	//log the arrival in the database
	$conn->query("INSERT INTO tb_carsArrived(plate) VALUES(\"$license_plate\") ");

	//checking the database
	$query = $conn->query("SELECT * FROM tb_lincense WHERE plate = \"$license_plate\"");
	if($query && $query->num_rows>0){
		$response = true;
	}else{
		$response = false;
	}

	echo json_encode($response);
?>