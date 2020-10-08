<?php
	require "../connect.php";
	connectDB();
	sec_session_start();
	$idUser = $_SESSION["ID"];
	$onIdUser = $conn->real_escape_string($_POST["onIdUser"]);
	$content = $conn->real_escape_string($_POST["content"]);
	$latitude = $conn->real_escape_string($_POST["latitude"]);
	$longitude = $conn->real_escape_string($_POST["longitude"]);
	$sql = "INSERT INTO posts(idUser, content, onIdUser) VALUES($idUser, '$content', $onIdUser)";
	mysqli_query($conn, $sql);
	$IdPost = mysqli_insert_id($conn);
	$msg = "OK";

	do {
		$imageUID = 'images/posts/' . uniqid() . $_SESSION["ID"] . $_FILES['fileInput']['name'];
		if (is_uploaded_file($_FILES['fileInput']['tmp_name'])) {
			if ($_FILES['fileInput']['size'] > 16777216) {
				$msg = "SizeError";
				break;
			}
			list($width, $height, $type, $attr) = getimagesize($_FILES['fileInput']['tmp_name']);
			if (($type!=1) && ($type!=2) && ($type!=3)) {
				$msg = "FormatError";
				break;
			}
			if (!move_uploaded_file($_FILES['fileInput']['tmp_name'], "../" . $imageUID)) {
				$msg = "UploadError";
				break;
			}
			
			$sql = "INSERT INTO photos(latitude, longitude, IdUser, link, IdPost) VALUES ($latitude, $longitude, $idUser, '$imageUID', $IdPost)";
			$msg = $sql;
			mysqli_query($conn, $sql);
			
			/*$msg = array();
			$msg["status"] = 200;
			$msg["path"] = "$imageUID";*/
		}
	} while(false);

	mysqli_close($conn);
	echo json_encode($msg);
?>