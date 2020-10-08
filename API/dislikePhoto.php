<?php
	require "../connect.php";
	
	session_start();
	$idUser = $_SESSION["ID"];
	$idPost = $conn->real_escape_string($_POST["idPhoto"]);
	
	$sql = "INSERT INTO photoDislikes(idUser, idPhoto) VALUES($idUser, $idPost)";
	mysqli_query($conn, $sql);
	echo "OK";
	
	
	mysqli_close($conn);
?>