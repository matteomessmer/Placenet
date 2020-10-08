<?php
	require "../connect.php";
	
	$userId = $conn->real_escape_string($_GET["userId"]);
	
	$sql = "SELECT * FROM photos WHERE IdUser = $userId";
	$result = mysqli_query($conn, $sql);
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r;
	}
	mysqli_close($conn);
	echo json_encode($rows);
?>