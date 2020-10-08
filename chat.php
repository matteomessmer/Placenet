<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<title>Chat</title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<link rel="icon" type="image/x-icon" href="assets/icon/favicon.ico">
		
		<meta name="theme-color" content="#4e8ef7">
		
		<link rel="stylesheet" href="assets/css/bootstrap3/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<?php
			session_start();
			if($_SESSION["ID"] == "") {
				header("location: /index.html");
			}
			require "connect.php";
		
			$sql = "SELECT profile_img
					FROM Users
					WHERE ID = " . $_POST["id"];

			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			
			echo "<div class='chat-bar'>";
				echo "<div class='user-inline'>";
					echo "<img class='icon-100 round-img' src='" . (is_null($row["profile_img"])?'assets/images/user.png':$row["profile_img"]) . "' />";

					$sql = "SELECT Name, Surname
							FROM Users
							WHERE ID = " . $_POST["id"];

					$result = $conn->query($sql);
					$row = $result->fetch_assoc();

					echo "<h3>" . $row["Name"] . ' ' . $row["Surname"] . "</h3>";
				echo "</div>";
			echo "</div>";
			
			echo "<div id='' class='chat-messages' style='overflow-y: scroll; height:400px; background-color: #444'>" .
					"<div style='color: #fff'>" .
						"<div style='width: 100%; height: 30px'>" .
							"<p style='float: right'>ciao</p>" .
						"</div>" .
						"<div style='width: 100%; height: 30px'>" .
							"<p style='float: left'>ciao</p>" .
						"</div>" .
					"</div>" .
				"</div>";
				
			echo "<div class='chat-box'>";
				echo "<textarea></textarea>";
				echo "<button>Send</button>";
			echo "</div>";
		?>
		<!-- Scripts -->
		<script language="javascript" type="text/javascript" src="assets/js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap3/bootstrap.min.js"></script>
		
		<script language="javascript" src="assets/js/script.js"></script>
		<script language="javascript" src="assets/js/main.js"></script>
	
	</body>
</html>
