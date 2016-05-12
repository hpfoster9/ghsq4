<?php
	session_start();

	$servername = "198.71.227.98:3306";
	$username = "atothejax";
	$password = "Asteath652";
	$dbName = "ClassBase2";

	if(isset($_POST["Classes_name"]))
	{
		$conn = new mysqli($servername, $username, $password, $dbName);

		if ($conn->connect_error) 
		{
		    die("Connection failed: " . $conn->connect_error);
		}

		if(isset($_SESSION["loggedIn"]))
		{
			$sqlCheckSameClass = "SELECT name FROM Classes WHERE name = '" . $_POST['Classes_name'] . "'";

			$resultCheckSameClass = $conn->query($sqlCheckSameClass);
			if($resultCheckSameClass->num_rows === 0)
			{
				$sqlCreateClass = "INSERT INTO Classes (name) VALUES ('" . $_POST['Classes_name'] . "')";

				if($conn->query($sqlCreateClass) === true)
				{
					$sqlGetId = "SELECT id FROM Classes WHERE name = '" . $_POST['Classes_name'] . "'";

					$resultGetId = $conn->query($sqlGetId);
					if($resultGetId->num_rows === 1)
					{
						$sqlAddClass = "UPDATE Teachers SET classes = CONCAT(IFNULL(classes, ''), '" . $resultGetId->fetch_assoc()['id'] . " ') WHERE name = '" . $_SESSION["loggedIn"] . "'";

						if($conn->query($sqlAddClass) === true)
						{
							$result = "Success!";
						}
						else
						{
							$result = "Error: Failed to add class to teacher.";
						}
					}
					else
					{
						$result = "Error: Failed to get class id.";
					}
				}
				else
				{
					$result = "Error: Failed to create class.";
				}
			}
			else
			{
				$result = "Error: There is already a class with that name.";
			}
		}
		else
		{
			$result = "Error: Teacher is not logged in.";
		}

		echo json_encode($result);
		$conn->close();
	}
?>