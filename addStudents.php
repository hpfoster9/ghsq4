<?php
	$servername = "198.71.227.98:3306";
	$username = "atothejax";
	$password = "Asteath652";
	$dbName = "ClassBase";

	if(isset($_POST["Teachers_name"]) && isset($_POST["Teachers_password"]) && isset($_POST["Teachers_students"]))
	{
		$conn = new mysqli($servername, $username, $password, $dbName);

		if ($conn->connect_error) 
		    die("Connection failed: " . $conn->connect_error);

		$sqlAddStudents = "UPDATE Teachers SET students = CONCAT(IFNULL(students, ''), '" . $_POST['Teachers_students'] . " ') WHERE name = '" . $_POST['Teachers_name'] . "' AND password = '" . $_POST['Teachers_password'] . "'";

		if ($conn->query($sqlAddStudents) === TRUE)
			$result = "Success!";
		else
			$result = "Failure!";

		echo json_encode($result);
		$conn->close();
	}
?>