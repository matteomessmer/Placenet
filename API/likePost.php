<?php
	require "../connect.php";
	
	session_start();
	$idUser = $_SESSION["ID"];
	$idPost = $conn->real_escape_string($_POST["idPost"]);
	
	$sql = "DELETE FROM postlikes WHERE idUser = $idUser AND idPost = $idPost";
	mysqli_query($conn, $sql);
	
	if(mysqli_affected_rows ($conn) === 0) {
		$sql = "DELETE FROM postdislikes WHERE idUser = $idUser AND idPost = $idPost";
		mysqli_query($conn, $sql);
		
		$sql = "INSERT INTO postlikes(idUser, idPost) VALUES($idUser, $idPost)";
		if(mysqli_query($conn, $sql)) {
			echo "liked";
		}
		else {
			echo "ERROR";
		}
	}
	else {
		echo "deliked";
	}
	
	mysqli_close($conn);
?>