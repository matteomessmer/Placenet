function redirect(url) {
	window.location.href = url;
}
function redirectPost(url, data) {
	var form = document.createElement('form');
	form.method = 'post';
	form.action = url;
	for (var name in data) {
		var input = document.createElement('input');
		input.type = 'hidden';
		input.name = name;
		input.value = data[name];
		form.appendChild(input);
	}
	$('body').append(form);
	form.submit();
}
function mapBtn() {
	redirectPost('map.php', {'userId':userId});
}
function friendsBtn() {
	redirectPost('friends.php', {'userId':userId});
}
function profileBtn() {
	redirect('user.php');
}
function chooseFile() {
	$("#fileInput").click();
}
function calculateDistance(coord1, coord2) {
	return Math.hypot(coord1[0] - coord2[0], coord1[1] - coord2[1]);
}
function closePost(index) {
	overlay[index].setPosition(undefined);
	return false;
}
function getImages() {
	$.getJSON(
		"API/getPhotos.php?userId=" + userId,
		function(data) {
			for (var i = 0; i < data.length; i++) {
				setTimeout(updatePhotos(data[i], i), 0);
			}
			setPosts();
		}
	);
}
function openCanvas(index) {
	imgCanvas.style.display = "-webkit-box";
	document.getElementById("openedImg").src = document.getElementById("imgPopup" + index).src;
}
function closeCanvas() {
	imgCanvas.style.display = "none";
}
function updatePhotos(data, i) {
	document.getElementById("posts").innerHTML += '<div id="popup' + i + '" class="ol-popup" onclick="openCanvas(' + i + ')">' +
			'<div id="popup-content' + i + '"></div>' +
		'</div>';
	
	var container = document.getElementById('popup' + i);
	var content = document.getElementById('popup-content' + i);
	var closer = document.getElementById('popup-closer' + i);
	
	content.innerHTML = '<image id="imgPopup' + i + '" src="' + data.link + '" class="post-img"></image>';

	var latitude = parseFloat(data.latitude);
	var longitude = parseFloat(data.longitude);
	
	var coord = ol.proj.fromLonLat([longitude, latitude]);
	
	var overlayObject = new ol.Overlay(/** @type {olx.OverlayOptions} */ ({
		element: container,
		autoPan: true,
		autoPanAnimation: {
			duration: 250
		},
		position: coord
	}));
	overlay.push(overlayObject);
	
	overlay[i].setMap(map);
}
function setPosts() {	
	for (var i = 0; i < overlay.length - 1; i++) {
		for (var ii = i + 1; ii < overlay.length; ii++) {
			var d = calculateDistance([ 
					parseInt(overlay[i].a.He.replace('px','')),
					parseInt(overlay[i].a.uf.replace('px',''))
				],
				[
					parseInt(overlay[ii].a.He.replace('px','')),
					parseInt(overlay[ii].a.uf.replace('px',''))
				]);
			//console.log(d); //59
			//se meno di 50 si fa che aggiorna l'array di overlay
			//togliendo i due post e mettendone uno a metà tra 
			//i due originali
			//
			//http://dev.openlayers.org/docs/files/OpenLayers/Popup-js.html
		}
	}
}
function newPost() {
	new_post.style.display = "-webkit-box";
}
function closeNewPost() {
	new_post.style.display = "none";
}
function onFileSelected(event) {
	var selectedFile = event.target.files[0];
	var reader = new FileReader();

	var imgtag = document.getElementById("postImg");
	imgtag.innerHTML = selectedFile.name;
	imgtag.title = selectedFile.name;

	/*reader.onload = function(event) {
		imgtag.src = event.target.result;
	};*/

	reader.readAsDataURL(selectedFile);
}
function getPosts() {
	$.getJSON(
		"API/getPosts.php?userId=" + userId,
		function(data) {
			for (var i = 0; i < data.length; i++) {
				setTimeout(updatePosts(data[i]), 0);
			}
		}
	);
}
function updatePosts(data) {
	if(!document.getElementById('post' + data.idPost)) {
		var profileImg = data.Profile_img?data.Profile_img:'assets/images/user.png';
		var btnLike = {};
		if(data.like) {
			btnLike.class = "btn-success";
			btnLike.text = "I like it"
		}
		else {
			btnLike.class = "btn-info";
			btnLike.text = "Like";
		}

		var btnDislike = {};
		if(data.dislike) {
			btnDislike.class = "btn-danger";
			btnDislike.text = "I dislike it"
		}
		else {
			btnDislike.class = "btn-info";
			btnDislike.text = "Dislike";
		}

		var img = "";
		//console.log(data.link);
		if(data.link != null) {
			img = "<img class='post-img' src='" + data.link + "' />";
		}
		document.getElementById("posts").innerHTML = '<div class="post" id="post' + data.idPost + '">' +
			'<div class="post-user" onclick="redirect(\'user.php?userid=' + data.ID + '\')">' +
				'<image src="' + profileImg + '"></image>' +
				'<h2 class="username">' + data.Name + ' ' + data.Surname + '</h2>' +
			'</div>' +
			'<div class="post-content">' +
				'<p>' +
					data.content +
				'</p>' +
				img +
			'</div>' +
			'<div class="post-buttons">' +
				'<button id="like_btn' + data.idPost + '" onclick="likePost(' + data.idPost + ')" class="btn-4 btn ' + btnLike.class + ' btn-md" type="button">' +
					'<i class="fa fa-thumbs-up" aria-hidden="true"></i>' +
					 btnLike.text + 
				'</button>' +
				'<button id="dislike_btn' + data.idPost + '" onclick="dislikePost(' + data.idPost + ')" class="btn-4 btn ' + btnDislike.class + ' btn-md" type="button">' +
					'<i class="fa fa-thumbs-down" aria-hidden="true"></i>' +
					btnDislike.text +
				'</button>' +
				'<button id="comment_btn" name="comment_btn" onclick="showComments(' + data.idPost + ')" class="btn-2 btn btn-info btn-md" type="button">' +
					'<i class="fa fa-comments-o" aria-hidden="true"></i>' +
					'Comment' +
				'</button>' +
			'</div>' +
			'<div id="comments' + data.idPost + '" class="comments comments-closed">' +
				'<div id="yourComment' + data.idPost + '" class="write-comment input-group">' +
					'<input id="yourCommentInput' + data.idPost + '" placeholder="Write your comment..." class="form-control comment-input"></input>' +
					'<span class = "input-group-btn"><button onclick="sendComment(' + data.idPost + ')" type="button" class="btn btn-md">Send</button></span>' +
				'</div>' +
				'<div id="commentsPost' + data.idPost + '"></div>' +
			'</div>' +
		'</div>' + document.getElementById("posts").innerHTML;
	}
}
function createPost() {
	var data = new FormData($("#newPost")[0]);

	jQuery.ajax({
		type: 'POST',
		url:"API/newPost.php",
		data: data,
		processData: false, 
		contentType: false, 
		success: function(data){
			redirect(window.location.href);
		}
	});
}
function showFindPlace() {
	if($("#findCanvas").hasClass("canvasClosed")) {
		$("#findCanvas").switchClass("canvasClosed", "canvasOpened", 500, "easeInOutQuad");
		$("#findPlace").css("display","inline");
		document.getElementById("listPlaces").innerHTML = "";
	}
	else {
		closeFindPlace();
	}
}
function closeFindPlace() {
	$("#findCanvas").switchClass("canvasOpened", "canvasClosed", 500, "easeInOutQuad", function() {
		document.getElementById("listPlaces").innerHTML = "";
		$("#findPlace").css("display","none");
	});
}
function queryCoordinate() {
	if($("#findCanvas").hasClass("canvasClosed")) {
		showFindPlace();
	}
	var query = queryInput.value;
	$("#findCanvas").css("height","auto");
	$.ajax({
		url:"http://dev.virtualearth.net/REST/v1/Locations?query=" + query + "&key=AlDnM25LPuT-ARaG6oys1-7U-gAPmNXKeFieem_Jslsbde3SgfR1bkEJffEzqrG-",
		dataType: "jsonp",
		jsonp: "jsonp",
		success: function (data) {
			if(data.resourceSets.length > 0){
				var s = "";
				var res = data.resourceSets[0].resources;

				for(var i = 0; i < res.length; i++) {
					if(i%2==0)
						s += "<div id='placeItem" + i + "' class='place placeA' onclick='submitPlace(" + res[i].point.coordinates[0] + ", " + res[i].point.coordinates[1] + ", " + i + ")'>" + res[i].name + "</div>";
					else
						s += "<div id='placeItem" + i + "' class='place placeB' onclick='submitPlace(" + res[i].point.coordinates[0] + ", " + res[i].point.coordinates[1] + ", " + i + ")'>" + res[i].name + "</div>";

				}
				document.getElementById("listPlaces").innerHTML = s;
				//console.log(data.resourceSets[0].resources[0].point.coordinates);
			}
		},
		error: function (e) {
			console.log(e.statusText);
		}
	});
}
function submitPlace(lat, lon, index) {
	document.getElementById("longitude").value = lon;
	document.getElementById("latitude").value = lat;
	document.getElementById("placeSelected").innerHTML = document.getElementById("placeItem" + index).innerHTML;
	closeFindPlace();
}
function likePost(idPost) {
	$.post( "API/likePost.php", { idPost: idPost })
		.done(function(data) {
			if(data == "liked") {
				$("#like_btn" + idPost).removeClass("btn-info").addClass("btn-success");
				document.getElementById("like_btn" + idPost).innerHTML = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>I like it';
				
				$("#dislike_btn" + idPost).removeClass("btn-danger").addClass("btn-info");
				document.getElementById("dislike_btn" + idPost).innerHTML = '<i class="fa fa-thumbs-down" aria-hidden="true"></i>Dislike';
			}
			else if(data == "deliked") {
				$("#like_btn" + idPost).removeClass("btn-success").addClass("btn-info");
				document.getElementById("like_btn" + idPost).innerHTML = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>Like';
			}
	});
}
function dislikePost(idPost) {
	$.post( "API/dislikePost.php", { idPost: idPost })
		.done(function(data) {
			if(data == "disliked") {
				$("#dislike_btn" + idPost).removeClass("btn-info").addClass("btn-danger");
				document.getElementById("dislike_btn" + idPost).innerHTML = '<i class="fa fa-thumbs-down" aria-hidden="true"></i>I dislike it';

				$("#like_btn" + idPost).removeClass("btn-success").addClass("btn-info");
				document.getElementById("like_btn" + idPost).innerHTML = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>Like';
			}
			else if(data == "dedisliked") {
				$("#dislike_btn" + idPost).removeClass("btn-danger").addClass("btn-info");
				document.getElementById("dislike_btn" + idPost).innerHTML = '<i class="fa fa-thumbs-down" aria-hidden="true"></i>Dislike';
			}
	});
}
function fileSelected() {
	jQuery.ajax({
		type: 'POST',
		url:"API/uploadPhoto.php",
		data: new FormData($("#formProfilePhoto")[0]),
		processData: false, 
		contentType: false, 
		success: function(data){
			redirect("user.php");
		}
	});
}
function changeProfilePicture() {
	$("#profileImageInput").click();
}
function overProfilePicture() {
	$("#profilePicture").css('opacity', '0.5');
}
function leaveProfilePicture() {
	$("#profilePicture").css('opacity', '1');
}
function showComments(idPost) {
	if($("#comments" + idPost).hasClass("comments-closed")) {
		getComments(idPost);
		$("#comments" + idPost).switchClass("comments-closed", "comments-opened", 500, "easeInOutQuad");
		$("#yourComment" + idPost).css("display","inline");
	}
	else {
		$("#comments" + idPost).switchClass("comments-opened", "comments-closed", 500, "easeInOutQuad");
	}
}
function getComments(idPost) {
	$.getJSON(
		"API/getComments.php?idPost=" + idPost,
		function(data) {
			var commentsHTML = "";
			for (var i = 0; i < data.length; i++) {
				var profileImg = data[i].Profile_img?data[i].Profile_img:'assets/images/user.png';
				commentsHTML += '<div id="comment' + data[i].idComment + '" class="comment">' +
									'<div class="comment-user">' +
										'<image src="' + profileImg + '"></image>' +
										'<h4>' + data[i].Name + ' ' + data[i].Surname + '</h4>' +
									'</div>' +
									'<p>' + data[i].content + '</p>' +
								'</div>';
			}
			document.getElementById("commentsPost" + idPost).innerHTML = commentsHTML;
		}
	);
}
function sendComment(idPost) {
	var content = $("#yourCommentInput" + idPost).val();
	
	$.post( "API/newComment.php", { idPost: idPost, content: content })
		.done(function(data) {
			$("#yourCommentInput" + idPost).val("");
			getComments(idPost);
	});
}
function getFriends(idUser) {
	$.getJSON(
		"API/getFriends.php?userId=" + idUser,
		function(data) {
			var friendsHTML = "";
			for (var i = 0; i < data.length; i++) {
				var profileImg = data[i].Profile_img?data[i].Profile_img:'assets/images/user.png';
				friendsHTML += '<div class="user">' +
									'<a href="user.php?userid=' + data[i].ID + '" class="user-inline">' +
										'<img class="icon" src="' + profileImg + '">' +
										'<h4>' + data[i].Name + ' ' + data[i].Surname + '</h4>' +
									'</a>' +
								'</div>';
			}
			document.getElementById("friends").innerHTML = friendsHTML;
		}
	);
}
function getFriendRequests(callback) {
	$.getJSON(
		"API/getFriendRequests.php",
		function(data) {
			callback(data);
		}
	);
}
function updateFriendRequests(data) {
	var friendRequestsHTML = "";
	for (var i = 0; i < data.length; i++) {
		var profileImg = data.Profile_img?data.Profile_img:'assets/images/user.png';
		friendRequestsHTML += '<div class="user">' +
									'<a href="user.php?userid=' + data[i].ID + '" class="user-inline">' +
										'<img class="icon" src="' + profileImg + '">' +
										'<h4>' + data[i].Name + ' ' + data[i].Surname + '</h4>' +
									'</a>' +
									'<button class="btn btn-success" onclick="acceptRequest(' + data[i].ID + ')">Accept</button>' +
								'</div>';
	}
	if(friendRequestsHTML == "") {
		document.getElementById("title-request").innerHTML = "";
	} else {
		document.getElementById("friendRequests").innerHTML = friendRequestsHTML;
	}
}
function getBadge() {
	getFriendRequests(function(data) { 
		if(data.length > 0) {
			document.getElementById("friends-badge").innerHTML = data.length;
		}
	});
}
function acceptRequest(id) {
	$.post( "friendActions.php", { userId: id, accept: true })
		.done(function(data) {
			redirect(window.location.href);
	});
}
function chooseCoverImage() {
	$("#imageInput").click();
}
function changeCoverImage() {
	jQuery.ajax({
		type: 'POST',
		url:"API/changeCoverImage.php",
		data: new FormData($("#formCoverImage")[0]),
		processData: false, 
		contentType: false, 
		success: function(data){
			redirect("settings.php");
		}
	});
}
function sexChanged(s) {
	if(s == 'M') {
		menu1.innerHTML = 'Man <span class="caret"></span>';
	}
	else if(s == 'F') {
		menu1.innerHTML = 'Woman <span class="caret"></span>';
	}
	else {
		console.log("error");
	}
}
function save() {
	var sex = menu1.innerHTML.split(' ')[0]=='Man'?'M':(menu1.innerHTML.split(' ')[0]=='Woman'?'F':null);
	
	var address = {
		'lat': latitude.value,
		'lon': longitude.value
	};
	
	var data = {};
	
	if(sex) {
		data.sex = sex;
	}
	if(address.lat && address.lon) {
		data.lat = address.lat;
		data.lon = address.lon;
	}
	//console.log(data);
	
	jQuery.ajax({
		type: 'POST',
		url:"API/updateInfo.php",
		data: data,
		success: function(res){
			if(res == "OK") {
				redirect("user.php");
			}
			else {
				console.log(res);
			}
		}
	});
}
function changePassword() {
	if(pwd.value == "" || oldPwd.value == "" || pwdAgain.value == "") {
		if(oldPwd.value == "")
			$( "#oldPwd" ).effect( "shake" );		
		if(pwd.value == "")
			$( "#pwd" ).effect( "shake" );
		if(pwdAgain.value == "")
		$( "#pwdAgain" ).effect( "shake" );
		document.getElementById("changePwdRes").innerHTML = "Input Left Empty";
	} else { 		
		if(pwd.value == pwdAgain.value) {
			var data = {
				pwd: sha3_512(pwd.value),
				oldPwd: sha3_512(oldPwd.value)
			};

			jQuery.ajax({
				type: 'POST',
				url:"API/changePassword.php",
				data: data,
				success: function(res){
					if(res == "200") {
						document.getElementById("oldPwd").value = "";
						document.getElementById("pwd").value = "";
						document.getElementById("pwdAgain").value = "";
						document.getElementById("changePwdRes").innerHTML = "Password Changed Succesfully";
						//console.log(data.pwd);
					}
					else if(res == "610") {
						document.getElementById("changePwdRes").innerHTML = "Try Again";
					} else {
						$( "#oldPwd" ).effect( "shake" );
						$( "#pwd" ).effect( "shake" );
						$( "#pwdAgain" ).effect( "shake" );
						document.getElementById("changePwdRes").innerHTML = "Input Left Empty";
					}
				}
			});
		}
		else {
			$( "#pwd" ).effect( "shake" );
			$( "#pwdAgain" ).effect( "shake" );
			document.getElementById("changePwdRes").innerHTML = "These have to be equals";
		}
	}
}
/*
function logout(){
	$.post("API/logout.php",
		function(data) {
			return true;
		}
	);
}*/