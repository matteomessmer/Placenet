<?php
	require "../connect.php";
	$userId = 190;//$_SESSION['ID'];
	$sex = $conn->real_escape_string($_POST["sex"]);
	$addressLat = $conn->real_escape_string($_POST["lat"]);
	$addressLon = $conn->real_escape_string($_POST["lon"]);
	
	$sql = "UPDATE users SET";
	$mod = false;

	if($sex == 'F' || $sex == 'M') {
		$sql = $sql . " sex = '$sex'";
		$mod = true;
	}
	if($addressLat != "" && $addressLon != "") {
		$sql = $sql . " addressLat = " . floatval($addressLat) . ", addressLon = " . floatval($addressLon);
		$mod = true;
	}

	$sql = $sql . " WHERE ID = $userId";

	if($mod)
		mysqli_query($conn, $sql);
	
	echo "OK";
?>
