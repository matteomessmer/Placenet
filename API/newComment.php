<?php
	require "../connect.php";
	
	session_start();
	$idUser = $_SESSION["ID"];
	$idPost = $conn->real_escape_string($_POST["idPost"]);
	$content = $conn->real_escape_string($_POST["content"]);
	
	$sql = "INSERT INTO comments(idUser, idPost, content) VALUES($idUser,$idPost,'$content')";

	mysqli_query($conn, $sql);
	mysqli_close($conn);
	echo json_encode("OK");
?>