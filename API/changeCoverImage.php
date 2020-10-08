<?php
	session_start();
	do {
		$imageUID = 'images/covers/' . uniqid() . $_SESSION["ID"] . $_FILES['imageInput']['name'];
		if (is_uploaded_file($_FILES['imageInput']['tmp_name'])) {
			if ($_FILES['imageInput']['size'] > 16777216) {
				$msg = "SizeError";
				break;
			}
			list($width, $height, $type, $attr) = getimagesize($_FILES['imageInput']['tmp_name']);
			if (($type!=1) && ($type!=2) && ($type!=3)) {
				$msg = "FormatError";
				break;
			}
			if (!move_uploaded_file($_FILES['imageInput']['tmp_name'], "../" . $imageUID)) {
				$msg = "UploadError";
				break;
			}
			
			require "../connect.php";
			
			$sql = "UPDATE users SET Cover_img = '$imageUID' WHERE ID = " .$_SESSION['ID'];
			
			mysqli_query($conn, $sql);
			mysqli_close($conn);
			
			$msg = array();
			$msg["status"] = 200;
			$msg["path"] = "$imageUID";
		}
	} while(false);
	echo json_encode($msg);
?>