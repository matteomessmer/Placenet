<?php
	require "../connect.php";
	session_start();
	do {
		$imageUID = 'images/profiles/' . uniqid() . $_SESSION["ID"] . $_FILES['profileImageInput']['name'];
		if (is_uploaded_file($_FILES['profileImageInput']['tmp_name'])) {
			if ($_FILES['profileImageInput']['size'] > 16777216) {
				$msg = "SizeError";
				break;
			}
			list($width, $height, $type, $attr) = getimagesize($_FILES['profileImageInput']['tmp_name']);
			if (($type!=1) && ($type!=2) && ($type!=3)) {
				$msg = "FormatError";
				break;
			}
			if (!move_uploaded_file($_FILES['profileImageInput']['tmp_name'], "../" . $imageUID)) {
				$msg = "UploadError";
				break;
			}
			
			$sql = "UPDATE users SET Profile_img = '$imageUID' WHERE ID = " .$_SESSION['ID'];
			
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			
			$msg = array();
			$msg["status"] = 200;
			$msg["path"] = "$imageUID";
		}
	} while(false);
	echo json_encode($msg);
?>