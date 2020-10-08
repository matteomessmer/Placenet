<html>
<head>
	<title>Map</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="theme-color" content="#4e8ef7">
	
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
	
	<link rel="stylesheet" href="assets/css/bootstrap3/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="assets/css/common.css" type="text/css">
	<link rel="stylesheet" href="assets/css/map.css" type="text/css">
	<link rel="stylesheet" href="https://openlayers.org/en/v4.1.1/css/ol.css" type="text/css">
</head>
<body>
	<div id="map" class="map" tabindex="0"></div>
	<div class="nav-bar">
		<div class="nav-buttons">
			<button type="button" onclick="profileBtn()" class="btn btn-default">
				<i class="fa fa-user fa-lg" aria-hidden="true"></i>
			</button>
		</div>
		<!--button type="button" onclick="newPost()" class="btn btn-default">
			New
		</button-->
		<div class="filters">
			<button type="button" onclick="newPost()" class="btn btn-default">
				Posts
			</button>
			<button type="button" onclick="newPost()" class="btn btn-default">
				Photos
			</button>
		</div>
	</div>
	<div id="posts"></div>
	
	<!--div id="new_post" class="new-post">
		<form class="user-post" id="newPost">
			<textarea class="text-post" name="content"></textarea>
			<div class="buttons-left-post">
				<button type="button" onclick="chooseFile()" class="btn btn-default">
					<i class="fa fa-camera-retro fa-lg" aria-hidden="true"></i>
				</button>
				<button type="button" class="btn btn-default">
					<i class="fa fa-smile-o fa-lg" aria-hidden="true"></i>
				</button>
				<button type="button" class="btn btn-default">
					<i class="fa fa-map-o fa-lg" aria-hidden="true"></i>
				</button>
			</div>
			
			<p id="postImg" class="imgName"></p>
			<input name="latitude" placeholder="Latitude"/>
			<input name="longitude" placeholder="Longitude"/>
			<div class="buttons-right-post">
				<button type="button" onclick="closeNewPost()" class="btn btn-warning">Discard</button>
				<button type="button" onclick="createPost()" class="btn btn-success">Save</button>
			</div>
			
			<input type="file" onchange="onFileSelected(event)" id="fileInput" name="fileInput" style="display: none" accept="image/*"/>

			<input value="<?php// echo $userId; ?>" name="onIdUser" hidden />
		</form>
	</div-->
	
	<div id="imgCanvas" class="imgCanvas">
		<img id="openedImg" class="openedImg" />
		<img src="images/icons/close.png" class="close" onclick="closeCanvas()" />
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://openlayers.org/en/v4.1.1/build/ol.js"></script>
	<script language="javascript" src="assets/js/script.js"></script>
	<?php 
		session_start();
		if($_SESSION["ID"] == "") {
			header("location: /index.html");
		}
		echo "<script>var userId = " . $_POST["userId"] . ";</script>";
	?>
	<script>
		var overlay = [];
		
		var map = new ol.Map({
			layers: [
				new ol.layer.Tile({
					source: new ol.source.OSM()
				})
			],
			target: 'map',
			view: new ol.View({
				center: [0, 0],
				zoom: 2,
				minZoom: 2,
				maxZoom: 20
			})
		});
		
		getImages();
	</script>
</body>
</html>