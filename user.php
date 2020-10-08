<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<title>User</title>
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
	<link rel="stylesheet" href="assets/css/common.css" type="text/css">
		<link rel="stylesheet" href="assets/css/main.css"/>
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css"/>
	</head>
	<body>
			<?php 
				session_start(); 
				
				if(!isset($_GET["userid"])){
					$userId = $_SESSION["ID"];
				}
				else{
					$userId = $_GET["userid"];
				}
				
				echo "<script>var userId = $userId;</script>";

				require "connect.php";
		
				$sql = "SELECT cover_img, profile_img, Name, Surname, sex, Mail, registrationDate
						FROM users
						WHERE ID = " . $userId;
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();

				echo '<div class="cover-img" style="background-image:url(\'' . $row["cover_img"] . '\');">';
			?>
			<div class="nav-bar">
				<div class="nav-buttons">
					<button class="btn-1 btn btn-default" onclick="profileBtn()">
						<i class="fa fa-user fa-lg" aria-hidden="true"></i>
					</button>
					<button class="btn-1 btn btn-default" onclick="mapBtn()">
						<i class="fa fa-map-o fa-lg" aria-hidden="true"></i>
					</button>
					<button class="btn-1 btn btn-default badged-btn" onclick="friendsBtn()">
						<i class="fa fa-users fa-lg" aria-hidden="true"></i>
						<p id="friends-badge" class="badge"></p>
					</button>
					<div class="dropdown">
						<button class="btn-1 btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<!--<li class="dropdown-header">Dropdown header 1</li>
							<li><a href="#">HTML</a></li>
							<li><a href="#">CSS</a></li>
							<li><a href="#">JavaScript</a></li>
							<li class="divider"></li>-->
							<li class="dropdown-header"><?php echo $row["Name"]; ?></li>
							<li><a href="settings.php">Settings</a></li>
							<li><a href="API/logout.php">Logout</a></li>
						</ul>
					</div>
				</div>
				<div class="research">
					<form action="results.php" method="POST">
						<div class="big">
							<input class="input-sm form-control" type="text" name="toSearch"/>
							<button class="btn-1 btn btn-primary btn-sm" type="submit">Search</button>
						</div>
						<div class="small">
							<button class="btn-1 btn btn-primary btn-sm" onclick="redirect('results.php')" name="mobile">
								<i class="fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="profile col-sm-4">	
			<?php
				$profilePicActions = ($userId==$_SESSION["ID"])?"onClick='changeProfilePicture()' onMouseOver='overProfilePicture()' onMouseLeave='leaveProfilePicture()' ":"";
				echo 	"<div class='profileContainer'>" .
							"<img id='profilePicture' " . $profilePicActions . "class='profile-img' src='" . (is_null($row["profile_img"])?'assets/images/user.png':$row["profile_img"]) . "' />" .
							"<div class='over-profile-img'></div>" .
						"</div>" .
					"</div>" .
					'<div class="name">';
		
				echo "<h2 class='username'>" . $row["Name"] . ' ' . $row["Surname"] . "</h2>";
				$userData = $row;
				if($userId != $_SESSION["ID"]){
					$sql = "SELECT IDA, IDB
							FROM relations
							WHERE (IDA = " .  $userId . "
							AND IDB = " . $_SESSION["ID"] . ")
							OR (IDB = " .  $userId . "
							AND IDA = " . $_SESSION["ID"] . ")";

					$result = $conn->query($sql);
					$row_cnt = $result->num_rows;
					echo 	"<form class='friendActions' action='friendActions.php' method='POST'>
								<input style='display: none' name='userId' value='" . $userId . "'/>";
					if($row_cnt === 0) {
						$sql = "SELECT IDA, IDB
							FROM friend_requests
							WHERE (IDA = " .  $userId . "
							AND IDB = " . $_SESSION["ID"] . ")
							OR (IDB = " .  $userId . "
							AND IDA = " . $_SESSION["ID"] . ")";

						$result = $conn->query($sql);
						$row_cnt = $result->num_rows;
						$row = $result->fetch_assoc();
						if($row_cnt === 0) {
							echo "<button class='btn-1 btn btn-primary btn-sm' name='add'>Add friend</button>";
						} else {
							if($row['IDA'] === $_SESSION['ID']) {
								echo "<button class='btn-1 btn btn-warning btn-sm' name='add'>Request Sent</button>";
							}
							else if($row['IDB'] === $_SESSION['ID']) {
								echo "<button class='btn-1 btn btn-success btn-sm' name='accept'>Accept Request</button>";
							}
							else {
								echo "error";
							}
						}
					} else {
						echo "<button class='btn-1 btn btn-danger btn-sm' name='remove'>Remove Friend</button>";
					}
					echo 		"<button class='btn-1 btn btn-primary btn-sm' name='message'>Send message</button>
							</form>
						</div>";
					/*echo '<div class="menu">
							<button type="button" onclick="redirectPost(\'map.php\', { userId: ' . $userId . '})" class="btn btn-default btn-lg">
								<img src="images/icons/map.png"/>
							</button>
						</div>*/
					echo '</div>';
				}
				else {
					/*echo '<div class="menu">
							<button type="button" onclick="redirectPost(\'map.php\', { userId: ' . $userId . '})" class="btn btn-default btn-lg">
								<img src="images/icons/map.png"/>
							</button>
							<button type="button" onclick="chooseFile()" class="btn btn-default btn-lg">
								<img src="images/icons/create.png"/>
							</button>
							<button type="button" class="btn btn-default btn-lg">
								<img src="images/icons/settings.png"/>
							</button>
						</div>*/
					echo '</div>';
				}
				
				$infoSex = $userData['sex'];
				if($infoSex) {
					$infoSex = "<p>Sex: $infoSex</p>";
				}
			
				echo "<div class='information'>" .
						"<h4>Information</h4>" .
							"<p>Mail: " . $userData["Mail"] . "</p>" .
							$infoSex .
							"<p>Registered on: " . $userData["registrationDate"] . "</p>" .
					"</div>";
				
				mysqli_close($conn);
			?>
			
		<div class="innerNewPost">
			<div id="new_post" class="new-post">
				<form class="user-post" id="newPost">
					<p id="placeSelected"></p>
					<textarea class="text-post" name="content" placeholder="Write a post"></textarea>
					<div class="buttons-left-post">
						<button type="button" onclick="chooseFile()" class="btn btn-default">
							<i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i>
						</button>
						<button type="button" class="btn btn-default">
							<i class="fa fa-smile-o fa-lg" aria-hidden="true"></i>
						</button>
						<button type="button" onclick="showFindPlace()" class="btn btn-default">
							<i class="fa fa-map-o fa-lg" aria-hidden="true"></i>
						</button>
					</div>

					<p id="postImg" class="imgName"></p>
					<input id="latitude" name="latitude" placeholder="Latitude" style="display: none" />
					<input id="longitude" name="longitude" placeholder="Longitude" style="display: none" />
					<div class="buttons-right-post">
						<button type="button" onclick="createPost()" class="btn btn-success">Save</button>
					</div>

					<input type="file" onchange="onFileSelected(event)" id="fileInput" name="fileInput" style="display: none" accept="image/*"/>

					<input value="<?php echo $userId; ?>" name="onIdUser" hidden />
				</form>
				<div id="findCanvas" class="findCanvas canvasClosed">
					<div id="findPlace" class="findPlace">
						<form action="javascript:queryCoordinate()">
							<input id="queryInput" class="input-sm form-control" placeholder="Find a Place">
							<button type="submit" class="btn btn-primary btn-sm">Search</button>
						</form>
						<div id="listPlaces"></div>
					</div>
				</div>
			</div>
		</div>
			
		<div class="posts" id="posts"></div>
			
		<form class="fileInput" id="formProfilePhoto">
			<input type="file" id="profileImageInput" name="profileImageInput" onchange="fileSelected()" accept="image/*"/>
		</form>
		<!-- Scripts -->
		<script language="javascript" type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="crossorigin="anonymous"></script>
		<script type="text/javascript" src="assets/js/bootstrap3/bootstrap.min.js"></script>
		
		<script language="javascript" src="assets/js/script.js"></script>
		<script>
			getPosts();
			getBadge();
			setInterval(getPosts, 1000);
		</script>
	</body>
</html>