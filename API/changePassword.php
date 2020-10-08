<?php
	require "../connect.php";
	session_start();
	if($_POST["oldPwd"] != "" && $_POST["pwd"]) { 
		$sql = "SELECT Password FROM users WHERE ID = 190";// .$_SESSION['ID'];

		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);

		if($row["Password"] === $_POST["oldPwd"]) {
			$pwd = $conn->real_escape_string($_POST["pwd"]);

			$sql = "UPDATE users SET Password = '$pwd' WHERE ID = 190";// . $_SESSION['ID'];
			
			if(mysqli_query($conn, $sql)) {
				echo "200";
			} else {
				echo "500";
			}
		} else {
			echo "610";
		}
	} else {
		echo "0";
	}
		
	mysqli_close($conn);
?>