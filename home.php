<?php
	if (isset($_POST['login'])) {
		if ($_POST['mail'] != "" &&
			$_POST['passwordA'] != "") {
			if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
				require "connect.php";
				
				$mail = $conn->real_escape_string($_POST['mail']);
				$password =  $conn->real_escape_string($_POST['passwordA']);
				
				$sql = "SELECT ID, Password
						FROM users
						WHERE Mail = '$mail'";
						
				$result = mysqli_query($conn, $sql);

				$r =  mysqli_fetch_assoc($result);

				if ($r["ID"] != "") {
					if($r["Password"] == $password) {
						session_start();
						$_SESSION["ID"] = $r["ID"];

						mysqli_close($conn);
						header("location:/user.php");
					}
					else{
						mysqli_close($conn);
						header("location:/index.html?err=820");
					}
				} else {
					mysqli_close($conn);
					header("location:/index.html?err=800");
				}
			}
			else {
				header("location:/index.html?err=810");
			}
		}
		else {
			header("location:/index.html?err=830");
		}
	}
	elseif (isset($_POST['signup'])) {
		if (isset($_POST['name']) &&
			isset($_POST['surname']) &&
			isset($_POST['mail']) &&
			$_POST['passwordA'] != "" &&
			$_POST['passwordB'] != "") {
			if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
				if($_POST['passwordA'] == $_POST['passwordB']) {
					$token = md5(uniqid($_POST['mail'], true));

					require "connect.php";
					
					$mail =  $conn->real_escape_string($_POST['mail']);
					$name =  $conn->real_escape_string($_POST['name']);
					$surname =  $conn->real_escape_string($_POST['surname']);
					$password =  $conn->real_escape_string($_POST['passwordA']);

					
					$sql = "INSERT INTO tokens (token, mail, name, surname, password)
							VALUES ('$token', '$mail', '$name', '$surname', '$password')";

					if ($conn->query($sql) === TRUE) {
						$conn->close();

						$address = $_POST['mail'];
						require "mail.php";
						header("location:/temp.html");
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
				else {
					header("location:/index.html?err=920");
				}
			}
			else {
				header("location:/index.html?err=910");
			}
		}
		else {
			header("location:/index.html?err=930");
		}
	}
	else {
		header("location:/index.html?err=1000");
	}
?>