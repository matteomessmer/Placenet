var show1 = $("#show1");
var show2 = $("#show2");
var signupRedirect = false;
checkErrors();
function signupClick() {
	$( "#login" ).switchClass("btn-66", "btn-3", 500, "easeInOutQuad");
	$( "#signup" ).switchClass("btn-3", "btn-66", 500, "easeInOutQuad");
	$("#signup").blur(); 
	if(signupRedirect){
		var mail = $("input[name=mail]").val();
		var name = $("input[name=name]").val();
		var surname = $("input[name=surname]").val();
		var pwdA = $("input[name=passwordA]").val();
		var pwdB = $("input[name=passwordB]").val();
		var termsconditions = $("input[name=termsconditions]")[0].checked;
		
		if (mail !== "" && 
			name !== "" &&
			surname !== "" &&
			pwdA !== "" &&
			pwdB !== "" &&
			pwdA === pwdB &&
			termsconditions){
				redirectPost('home.php', {mail: mail, name: name, surname: surname, passwordA: sha3_512(pwdA), passwordB: sha3_512(pwdB), signup: true});
		} else if(pwdA !== pwdB) {
			document.getElementById("errh3").innerHTML = "Passwords Are Different";
			$("#errh3").css("display", "initial");
			$( "#pwda" ).effect( "shake", "fast" );
			$( "#pwdb" ).effect( "shake", "fast" );
		} else if (!termsconditions) {
			document.getElementById("errh3").innerHTML = "Accept Terms and Conditions";
			$("#termscond").effect( "shake", "fast" );
		} else {
			document.getElementById("errh3").innerHTML = "Fill The Form";
			$("#errh3").css("display", "initial");
		}
	}
	else{
		show1.stop().fadeIn("fast", function() {
		});
		show2.stop().fadeIn("fast", function() {
			signupRedirect = true;
		});
	}
}
$( "#signup" ).click(function() {
	signupClick();
});
$( "#login" ).click(function() {
	$( "#signup" ).switchClass("btn-66", "btn-3");
	$( "#login" ).switchClass("btn-3", "btn-66");
	$("#login").blur(); 
	if(!signupRedirect){
		var mail = $("input[name=mail]").val();
		var pwd = $("input[name=passwordA]").val();
		if(mail !== "" && pwd !== "") {
			redirectPost('home.php', {mail: mail, passwordA: sha3_512(pwd), login: true});
		}
	}
	else {
		show1.stop().fadeOut("fast", function() {
		});
		show2.stop().fadeOut("fast", function() {
			signupRedirect = false;
		});
	}
});
function checkErrors() {
	var err = getSearchParams("err");
	if(err != undefined) {
		if(err == 800) {
			document.getElementById("errh3").innerHTML = "Login Err";
			$("#errh3").css("display", "initial");
		} else if(err == 810) {
			document.getElementById("errh3").innerHTML = "Invalid Mail";
			$("#errh3").css("display", "initial");
		} else if(err ==  820) {
			document.getElementById("errh3").innerHTML = "Passoword Wrong";
			$("#errh3").css("display", "initial");
		} else if(err ==  830) {
			document.getElementById("errh3").innerHTML = "Fill The Form";
			$("#errh3").css("display", "initial");
		} else if(err ==  910) {
			document.getElementById("errh3").innerHTML = "Invalid Mail";
			$("#errh3").css("display", "initial");
			signupClick();
		} else if(err ==  920) {
			document.getElementById("errh3").innerHTML = "Passwords Are Different";
			$("#errh3").css("display", "initial");
			$( "#pwda" ).effect( "shake" );
			$( "#pwdb" ).effect( "shake" );
			signupClick();
		} else if(err ==  930) {
			document.getElementById("errh3").innerHTML = "Fill The Form";
			$("#errh3").css("display", "initial");
			signupClick();
		} else if(err ==  1000) {
			document.getElementById("errh3").innerHTML = "Retry";
			$("#errh3").css("display", "initial");
		} else {
			document.getElementById("errh3").innerHTML = "Retry";
			$("#errh3").css("display", "initial");
		}
	}
}
function getSearchParams(k){
	var p={};
	location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){p[k]=v})
	return k?p[k]:p;
}