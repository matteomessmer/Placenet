<?php
	require "../connect.php";
	
	session_start();
	$userId = $conn->real_escape_string($_GET["userId"]);
	$loggeduser = $_SESSION["ID"];
	
	$sql = "SELECT posts.idPost, content, creationTime, Name, Surname, Profile_img, link, ID FROM users, posts LEFT JOIN photos ON posts.idPost = photos.IdPost WHERE ID = posts.idUser AND onIdUser = $userId order by creationTime";
	$result1 = mysqli_query($conn, $sql);
	
	$sql = "SELECT posts.idPost FROM postlikes, posts WHERE posts.idUser = $userId AND posts.idPost = postlikes.idPost  AND postlikes.idUser = $loggeduser";
	$result2 = mysqli_query($conn, $sql);

	$sql = "SELECT posts.idPost FROM postdislikes, posts WHERE posts.idUser = $userId AND posts.idPost = postdislikes.idPost  AND postdislikes.idUser = $loggeduser";
	$result3 = mysqli_query($conn, $sql);
	
	$liked = array();
	$disliked = array();
	
	while(($r =  mysqli_fetch_assoc($result2))) {
		$liked[] = $r['idPost'];
	}
	
	while(($r =  mysqli_fetch_assoc($result3))) {
		$disliked[] = $r['idPost'];
	}
	
	$rows = array();
	while($r = mysqli_fetch_assoc($result1)) {
		if(in_array($r["idPost"], $liked)){
			$r["like"] = true;
		}
		else {
			$r["like"] = false;
		}
		if(in_array($r["idPost"], $disliked)){
			$r["dislike"] = true;
		}
		else {
			$r["dislike"] = false;
		}
		$rows[] = $r;
	}
	mysqli_close($conn);
	echo json_encode($rows);
?>
