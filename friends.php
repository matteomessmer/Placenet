<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<title>Friends</title>
		<base href="/" />
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="msapplication-tap-highlight" content="no">
		<link rel="apple-touch-icon" sizes="57x57" href="/assets/icon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/assets/icon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/assets/icon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/assets/icon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/assets/icon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/assets/icon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/assets/icon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/assets/icon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/assets/icon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/assets/icon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/assets/icon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/assets/icon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/assets/icon/favicon-16x16.png">
		<link rel="manifest" href="/assets/icon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/assets/icon/ms-icon-144x144.png">
		<meta name="theme-color" content="#4e8ef7">

		<link rel="stylesheet" href="assets/css/bootstrap3/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/css/main.css"/>
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css"/>
	</head>
	<body>
		<?php 
			session_start();
		
			if($_SESSION["ID"] == "") {
				header("location: /index.html");
			}
		
			if(!isset($_GET["userid"])){
				$userId = $_SESSION["ID"];
			}
			else{
				$userId = $_GET["userid"];
			}
			
			echo "<script>var userId = $userId;</script>";
		?>
		<div id="content">
			<div class="container">
				<div class="jumbotron">
					<div class="main-line">
						<div class="col-sm-12">
							<h2 id="title-request">Friend's Requests</h2>
							<div class="users-list" id="friendRequests"></div>

							<h2>Your Friends</h2>
							<div class="users-list" id="friends"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Scripts -->
		<script language="javascript" type="text/javascript" src="assets/js/jquery-1.8.3.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="crossorigin="anonymous"></script>
		<script language="javascript" src="assets/js/script.js"></script>
		<script>
			setTimeout(function() {
				getFriends(userId);
			}, 0);
			setTimeout(function() {
				getFriendRequests(updateFriendRequests);
			}, 0);
		</script>
	</body>
</html>