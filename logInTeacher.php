<?php
	session_start();

	$servername = "198.71.227.98:3306";
	$username = "atothejax";
	$password = "Asteath652";
	$dbName = "ClassBase2";

	if(isset($_POST["Teachers_name"]) && isset($_POST["Teachers_password"]))
	{
		$conn = new mysqli($servername, $username, $password, $dbName);

		if ($conn->connect_error) 
		{
		    die("Connection failed: " . $conn->connect_error);
		}

		$sqlCheckTeacherInfo = "SELECT name FROM Teachers WHERE name = '" . $_POST['Teachers_name'] . "' AND password = '" . $_POST['Teachers_password'] . "'";

		$resultCheckTeacherInfo = $conn->query($sqlCheckTeacherInfo);
		if($resultCheckTeacherInfo->num_rows === 1)
		{
			$_SESSION["loggedIn"] = $resultCheckTeacherInfo->fetch_assoc()['name'];
			$result = "Success!";
		}
		else
		{
			$result = "Error: Failed to validate teacher info.";
		}
	}

	echo json_encode($result);
	$conn->close();
?>