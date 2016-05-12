<?php
	session_start();

	$servername = "198.71.227.98:3306";
	$username = "atothejax";
	$password = "Asteath652";
	$dbName = "ClassBase2";

	if(isset($_POST["Classes_name"]) && isset($_POST["Students_name"]))
	{
		$conn = new mysqli($servername, $username, $password, $dbName);

		if ($conn->connect_error) 
		{
		    die("Connection failed: " . $conn->connect_error);
		}

		if(isset($_SESSION["loggedIn"]))
		{
			$sqlGetClassId = "SELECT id FROM Classes WHERE name = '" . $_POST['Classes_name'] . "'";

			$resultGetClassId = $conn->query($sqlGetClassId);
			if($resultGetClassId->num_rows === 1)
			{
				$classId = $resultGetClassId->fetch_assoc()['id'];

				$sqlGetTeacherClasses = "SELECT classes FROM Teachers WHERE name = '" . $_SESSION['loggedIn'] . "'";

				$resultGetTeacherClasses = $conn->query($sqlGetTeacherClasses);
				if($resultGetTeacherClasses->num_rows === 1)
				{
					$teacherClasses = explode(" ", $resultGetTeacherClasses->fetch_assoc()['classes']);
					array_pop($teacherClasses);
					$teacherClasses = array_map('intval', $teacherClasses);

					$result = $teacherClasses;

					if(in_array((int) $classId, $teacherClasses, true))
					{
						$sqlCheckSameStudent = "SELECT name FROM Students WHERE name = '" . $_POST['Students_name'] . "'";

						$resultCheckSameStudent = $conn->query($sqlCheckSameStudent);
						if($resultCheckSameStudent->num_rows === 0)
						{
							$sqlCreateStudent = "INSERT INTO Classes (name) VALUES ('" . $_POST['Students_name'] . "')";

							if($conn->query($sqlCreateStudent) === true)
							{
								$sqlGetStudentId = "SELECT id FROM Classes WHERE name = '" . $_POST['Students_name'] . "'";

								$resultGetStudentId = $conn->query($sqlGetStudentId);
								if($resultGetStudentId->num_rows === 1)
								{
									$sqlAddClass = "UPDATE Classes SET students = CONCAT(IFNULL(students, ''), '" . $resultGeStudenttId->fetch_assoc()['id'] . " ') WHERE name = '" . $_POST['Teachers_name'] . "' AND password = '" . $_POST['Teachers_password'] . "'";

									if($conn->query($sqlAddClass) === true)
									{
										$result = "Success!";
									}
									else
									{
										$result = "Error: Failed to add student to class.";
									}
								}
								else
								{
									$result = "Error: Failed to get student id.";
								}
							}
							else
							{
								$result = "Error: Failed to create student.";
							}
						}
						else
						{
							$result = "Error: There is already a student with that name.";
						}
					}
					else
					{
						$result = "Error: Teacher does not control that class.";
					}
				}
				else
				{
					$result = "Error: Failed to get teacher class list.";
				}
			}
			else
			{
				$result = "Error: Failed to get class id.";
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