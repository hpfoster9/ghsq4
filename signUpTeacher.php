<?php
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

		$sqlCheckSameTeacher = "SELECT name FROM Teachers WHERE name = '" . $_POST['Teachers_name'] . "'";

		$resultCheckSameTeacher = $conn->query($sqlCheckSameTeacher);
		if($resultCheckSameTeacher->num_rows === 0)
		{
			$sqlSignUpTeacher = "INSERT INTO Teachers (name, password) VALUES ('" . $_POST['Teachers_name'] . "', '" . $_POST['Teachers_password'] . "')";

			if ($conn->query($sqlSignUpTeacher) === TRUE)
			{
				$result = "Success!";
			}
			else
			{
				$result = "Error: Failed to create teacher!";
			}
		}
		else
		{
			$result = "Error: There is already a teacher with that name.";
		}

		echo json_encode($result);
		$conn->close();
	}
?>