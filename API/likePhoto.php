<?php
	require "../connect.php";
	
	session_start();
	$idUser = $_SESSION["ID"];
	$idPhoto = $conn->real_escape_string($_POST["idPhoto"]);
	
	$sql = "INSERT INTO photoLikes(idUser, idPhoto) VALUES($idUser, $idPhoto)";
	mysqli_query($conn, $sql);
	echo "OK";
?>