<?php
	require "../connect.php";

	$userId = $conn->real_escape_string($_GET["userId"]);
	
	$sql = "SELECT Name, Surname, Profile_img, ID FROM users, relations WHERE (ID = IDA AND IDB = $userId) OR (ID = IDB AND IDA = $userId)";
	$result = mysqli_query($conn, $sql);
	
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r;
	}
	mysqli_close($conn);
	echo json_encode($rows);
?>
