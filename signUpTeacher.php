<?php
	$servername = "198.71.227.98:3306";
	$username = "atothejax";
	$password = "Asteath652";
	$dbName = "ClassBase";

	if(isset($_POST["Teachers_name"]) && isset($_POST["Teachers_password"]))
	{
		$conn = new mysqli($servername, $username, $password, $dbName);

		if ($conn->connect_error) 
		    die("Connection failed: " . $conn->connect_error);

		$sqlSignUpTeacher = "INSERT INTO Teachers (name, password) VALUES ('" . $_POST['Teachers_name'] . "', '" . $_POST['Teachers_password'] . "')";

		if ($conn->query($sqlSignUpTeacher) === TRUE)
			$result = "Success!";
		else
			$result = "Failure!";

		echo json_encode($result);
		$conn->close();
	}
?>