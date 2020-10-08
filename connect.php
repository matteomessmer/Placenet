<?php
	$conn = new mysqli("localhost", "sec_user", "soadSFadf64auwef8asUhw8HHFASDHAW", "socialnetwork");
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
?>