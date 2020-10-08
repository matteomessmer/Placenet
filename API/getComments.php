<?php
	require "../connect.php";
	connectDB();
	
	$idPost = $conn->real_escape_string($_GET["idPost"]);
	
	$sql = "SELECT comments.*, Name, Surname, Profile_img FROM comments, users WHERE idPost = $idPost AND ID = idUser order by publicationTime desc";
	
	$result = mysqli_query($conn, $sql);
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r;
	}
	mysqli_close($conn);
	echo json_encode($rows);
?>