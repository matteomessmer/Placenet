<?php
	require "../connect.php";
	session_start();
	$userId = $_SESSION["ID"];
	
	$sql = "SELECT ID, Name, Surname, Profile_img, date, message FROM users, friend_requests WHERE ID = IDA AND IDB = $userId";
	$result = mysqli_query($conn, $sql);
	
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r;
	}
	mysqli_close($conn);
	echo json_encode($rows);
?>
