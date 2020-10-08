<html>
	<head>
		<script language="javascript" type="text/javascript" src="assets/js/jquery-1.8.3.min.js"></script>
		<script language="javascript" src="assets/js/script.js"></script>
		<script language="javascript" src="assets/js/main.js"></script></head>
	<body>
		<?php
			session_start();
			if($_SESSION["ID"] == "") {
				header("location: /index.html");
			}
			
			require "connect.php";
		
			$userid =  $conn->real_escape_string($_POST["userId"]);
		
			if(isset($_POST["add"])) {
				$sql = "SELECT * 
						FROM  friend_requests
						WHERE (IDA = '" . $_SESSION["ID"] . "'
						AND IDB = '" . $userid ."')
						OR (IDB = '" . $_SESSION["ID"] . "'
						AND IDA = '" . $userid ."')";
						
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();

				if ($row["IDA"] == "") {
					$sql = "INSERT INTO friend_requests(IDA, IDB)
							VALUES(" . $_SESSION["ID"] . ", " . $userid . ")";
				} else {
					$sql = "DELETE FROM friend_requests
							WHERE (IDA = '" . $_SESSION["ID"] . "'
							AND IDB = '" . $userid ."')
							OR (IDB = '" . $_SESSION["ID"] . "'
							AND IDA = '" . $userid ."')";
				}
				$conn->query($sql);

				echo "<script type='text/javascript'>redirectPost('user.php?userid=" . $userid . "', {});</script>";
			}
			else if(isset($_POST["message"])) {
				echo "<script type='text/javascript'>redirectPost('chat.php', {id: '" . $userid . "'});</script>";
			} else if(isset($_POST["accept"])) {
				$sql = "INSERT INTO relations (IDA, IDB)
						VALUES(" .$_SESSION['ID'] . ", $userid)";
						
				$conn->query($sql);
				
				$sql = "DELETE FROM friend_requests
						WHERE (IDA = '" . $_SESSION["ID"] . "'
						AND IDB = '" . $userid ."')
						OR (IDB = '" . $_SESSION["ID"] . "'
						AND IDA = '" . $userid ."')";
						
				$conn->query($sql);
				
				echo "<script type='text/javascript'>redirectPost('user.php?userid=" . $userid . "', {});</script>";
			} else if(isset($_POST["remove"])){
				$sql = "DELETE FROM relations
						WHERE (IDA = '" . $_SESSION["ID"] . "'
						AND IDB = '" . $userid ."')
						OR (IDB = '" . $_SESSION["ID"] . "'
						AND IDA = '" . $userid ."')";
						
				$conn->query($sql);
				
				echo "<script type='text/javascript'>redirectPost('user.php?userid=" . $userid . "', {});</script>";
			}
			else {
				echo "error";
			}
			
			$conn->close();
		?>
	</body>
</html>