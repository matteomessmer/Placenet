<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<title>Settings</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">

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
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css"/>
	</head>
	<body>
		<div id="content">
			<div class="container">
				<div class="jumbotron">
					<?php
						require "connect.php";
						
						session_start();
					
						if($_SESSION["ID"] == "") {
							header("location: /index.html");
						}
						
					?>
					<div>
						<h2>Personalize you profile</h2>
						<button class="btn btn-primary" onClick='chooseCoverImage()'>Change cover image</button>
						
						<h2>Change your information</h2>
						<input class="input-sm" placeholder=""/>
						
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
								Sex
							<span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
								<li role="presentation">
									<a role="menuitem" tabindex="-1" onclick="sexChanged('M')">
										<i class="fa fa-mars" aria-hidden="true"></i> Man
									</a>
								</li>
								<li role="presentation">
									<a role="menuitem" tabindex="-1" onclick="sexChanged('F')">
										<i class="fa fa-venus" aria-hidden="true"></i> Woman
									</a>
								</li>
							</ul>
						</div>
						
						<h2>Address</h2><p id="placeSelected" class="address"></p>
						<input hidden id="longitude">
						<input hidden id="latitude">
						
						<form class="settingsAddress" action="javascript:queryCoordinate()">
							<input id="queryInput" class="input-sm form-control" placeholder="Home address">
							<button type="submit" class="btn btn-primary btn-sm">Search</button>
						</form>
						<div id="findCanvas" class="findCanvas settingsFindCanvas">
							<div id="listPlaces"></div>
						</div>
						
						<br/>
						
						<button class="btn btn-warning btn-lg" onclick="redirect('user.php')">Discard</button>
						<button class="btn btn-success btn-lg" onclick="save()">Save</button>
					</div>
					<div>
						<h2>Change your password</h2>
						<form action="javascript:changePassword()">
							<input id="oldPwd" type="password" class="input-sm" placeholder="Old Password"/>
							<input id="pwd" type="password" class="input-sm" placeholder="New Password"/>
							<input id="pwdAgain" type="password" class="input-sm" placeholder="New Password Again"/>
							<button class="btn btn-success btn-sm">Save</button>
						</form>
						<h3 id="changePwdRes"></h3>
					</div>
				</div>
			</div>
		</div>
		
		<form class="fileInput" id="formCoverImage">
			<input type="file" id="imageInput" name="imageInput" onchange="changeCoverImage()" accept="image/*"/>
		</form>
		<!-- Scripts -->
		
		<!--
		<script language="javascript" type="text/javascript" src="assets/js/sketch a.js"></script>
		<script language="javascript" type="text/javascript" src="assets/js/particle.js"></script>
		<script language="javascript" type="text/javascript" src="assets/js/libraries/p5.js"></script>
		<script language="javascript" src="assets/js/libraries/p5.dom.js"></script>
		-->

		<script language="javascript" type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
		<script language="javascript" type="text/javascript" src="assets/js/sha3.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="crossorigin="anonymous"></script>
		<script language="javascript" src="assets/js/script.js"></script>
		<script language="javascript" src="assets/js/main.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap3/bootstrap.min.js"></script>

	</body>
</html>
