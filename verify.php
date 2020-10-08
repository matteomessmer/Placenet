<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<title>Verify</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">

		<link rel="icon" type="image/x-icon" href="assets/icon/favicon.ico">
		<meta name="theme-color" content="#4e8ef7">

		<link rel="stylesheet" href="assets/css/bootstrap3/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
		
		<script language="javascript" type="text/javascript" src="assets/js/jquery-1.8.3.min.js"></script>
		<script language="javascript" src="assets/js/script.js"></script>
		<script language="javascript" src="assets/js/main.js"></script>
	</head>
	<body ng-app="starter">
		<div id="content">
			<div class="container">
				<div class="jumbotron text-center">
					<div>
						<h1>

							<?php
								$token = $_GET['token'];
								require "connect.php";

								$sql = "SELECT *
										FROM tokens
										WHERE token = '" . $token . "'";

								$result = $conn->query($sql);
								$row = $result->fetch_assoc();
								$mail = $row["mail"];
								$password = $row['password'];

								if ($row["token"] != "") {
									$sql = "INSERT INTO users (Name, Surname, Mail, Password, registrationDate) VALUES ('" . $row["name"] . "', '" . $row["surname"] . "', '" . $row["mail"] . "', '" . $row["password"] . "', NOW())";

									if ($conn->query($sql) === TRUE) {
										$sql = "DELETE FROM tokens WHERE token = '" . $token . "'";
										$conn->query($sql);

										$sql = "SELECT ID
												FROM users
												WHERE Mail = '" . $row['mail'] . "'
												AND Password = '" . $row['password'] ."'";

										$result = $conn->query($sql);
										$row = $result->fetch_assoc();

										echo "<script type='text/javascript'>redirectPost('home.php', {mail: '" . $mail . "', passwordA: '" . $password . "', login: 'login'});</script>";
									} else {
										echo "Error: " . $sql . "<br>" . $conn->error;
									}
								} else {
									echo "This token isn't valid!";
								}

								$conn->close();
							?>
						</h1>
					</div>
					<div class="main-line">
						<div class="col-sm-12">
							<p>Go to <a href="index.html">Home Page</a>!</p>
							</br>
						</div>		
					</div>
				</div>
			</div>
		</div>
		<!-- Scripts -->
		
		<script type="text/javascript" src="assets/js/bootstrap3/bootstrap.min.js"></script>
		
	</body>
</html>
