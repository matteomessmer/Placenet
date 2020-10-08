<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<title>Research</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">

		<link rel="icon" type="image/x-icon" href="assets/icon/favicon.ico">
		<meta name="theme-color" content="#4e8ef7">

		<link rel="stylesheet" href="assets/css/bootstrap3/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<div id="content">
			<div class="container">
				<div class="research pull-right">
					<form action="results.php" method="POST">
						<input class="input-sm researchBar" type="text" name="toSearch" />
						<button class="btn-1 btn btn-primary btn-sm" type="submit" class="researchButton">Search</button>
					</form>
				</div>
				<div class="jumbotron">
					<div class="resultsTitle">
						<?php
							session_start();
							
							if($_SESSION["ID"] == "") {
								header("location: /index.html");
							}
							
							require "connect.php";
							$toSearch = $conn->real_escape_string(strtolower(trim($_POST["toSearch"])));
							
							if($toSearch != "" && strlen($toSearch) > 2){
								$toSearch = explode(' ', $toSearch);
								
								echo "<h2>Here is what I found for: <i>" . $_POST['toSearch'] . "</i></h2>";
								echo "</div>";
								echo '<div class="main-line">
										<div class="col-sm-12">';

								$sql = "SELECT id, name, surname, profile_img
										FROM users
										WHERE ";
								
								for ($i = 0; $i < count($toSearch) - 1; $i++) {
									$sql = $sql . "LOWER(CONVERT(name USING utf8)) LIKE '%" . $toSearch[$i] . "%' OR LOWER(CONVERT(surname USING utf8)) LIKE '%" . $toSearch[$i] . "%' OR ";
								}

								$sql = $sql . "LOWER(CONVERT(name USING utf8)) LIKE '%" . $toSearch[count($toSearch) - 1] . "%' OR LOWER(CONVERT(surname USING utf8)) LIKE '%" . $toSearch[count($toSearch) - 1] . "%'";

								$result = mysqli_query($conn, $sql);

								$resultList = "";
								while ($row = mysqli_fetch_assoc($result)) {
									if($row["id"] != $_SESSION["ID"]) {
										$resultList = $resultList . 
										'<a href="user.php?userid=' . $row["id"] . '" class="user">' .
											'<img class="icon" src="' . (is_null($row["profile_img"])?'assets/images/user.png':$row["profile_img"]) . '">' .
											'<h4 class="username" style="margin: 20px">' . $row["name"] . ' ' . $row["surname"] . '</h4>' .
										'</a>';
									}
								}
								echo $resultList;
								echo '</div>		
									</div>';
							}
							else{
								if(!isset($_POST["mobile"])){
									echo "<h2>Write almost 3 characters</h2>";
								}
							}
							$conn->close();
						?>
				</div>
			</div>
		</div>
		<!-- Scripts -->
		
		<!--
		<script language="javascript" type="text/javascript" src="assets/js/sketch a.js"></script>
		<script language="javascript" type="text/javascript" src="assets/js/particle.js"></script>
		<script language="javascript" type="text/javascript" src="assets/js/libraries/p5.js"></script>
		<script language="javascript" src="assets/js/libraries/p5.dom.js"></script>
		-->

		<script language="javascript" type="text/javascript" src="assets/js/jquery-1.8.3.min.js"></script>
		<script language="javascript" src="assets/js/script.js"></script>
		<script language="javascript" src="assets/js/main.js"></script>
		<script language="javascript" type="text/javascript" src="assets/js/bootstrap.min.js"></script>

	</body>
</html>
