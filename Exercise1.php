<!DOCTYPE html>
<html>
<head>
<title>Student Management</title>
<style>
* {
	box-sizing: border-box;
	margin: 0;
	padding: 0;
}

body {
	font-family: Arial, sans-serif;
	background-color: #f4f4f4;
}

#container {
	max-width: 400px;
	margin: 20px auto;
	background-color: #fff;
	padding: 20px;
	border-radius: 5px;
	box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
}

label {
	display: block;
	margin-bottom: 5px;
	font-weight: bold;
}

input[type="number"], input[type="text"], input[type="date"] {
	width: 100%;
	padding: 10px;
	margin-bottom: 10px;
	border: 1px solid #ccc;
	border-radius: 3px;
}

input[type="file"] {
	width: 100%;
	margin-bottom: 10px;
}

button {
	background-color: #007bff;
	color: #fff;
	border: none;
	padding: 10px 20px;
	cursor: pointer;
	border-radius: 3px;
}
</style>
</head>
<body>
	<div id="container">
		<h1>Student Management</h1>
		<form action="Exercise1.php" method="GET">
			<label for="student_id">Student Id:</label> <input type="number"
				id="student_id" name="student_id" /> <br /> <label
				for="student_name">Student name:</label> <input type="text"
				id="student_name" name="student_name" /> <br /> <label for="address">Address:</label>
			<input type="text" id="address" name="address" /> <br /> <label
				for="birthdate">Birth Date:</label> <input type="date"
				id="birthdate" name="birthdate" /> <br /> <label for="group_id">Group
				Id:</label> <input type="number" id="group_id" name="group_id" /> <br />
			<label for="photo">Photo:</label> <input type="file" id="photo"
				name="photo" /> <br />
			<button type="submit" name="oper" value="add">Add</button>
			<button type="submit" name="oper" value="upd">Update</button>
			<button type="submit" name="oper" value="del">Delete</button>
		</form>
	</div>
</body>
</html>
<?php
require_once 'dbConfigEx1.php';

if (isset($_GET["oper"])) {
    $oper = $_GET["oper"];

    $stdId = $_GET["student_id"];
    $stdName = $_GET["student_name"];
    $address = $_GET["address"];
    $birthdate = $_GET["birthdate"];
    $groupId = $_GET["group_id"];
    $photo = $_GET["photo"];

    function insert($stdId, $stdName, $address, $birthdate, $groupId, $photo)
    {
        global $connection;
        if (!empty($stdId) && !empty($stdName) && !empty($groupId)) {
            $sqlStmt = "INSERT INTO student VALUES ($stdId, '$stdName', '$address', '$birthdate', $groupId, '$photo')";
            $queryId = mysqli_query($connection, $sqlStmt);
            if ($queryId) {
                echo "The person with the id $stdId has been added successfully <br/>";
            } else {
                echo mysqli_error($connection);
            }
        } else {
            echo "Please fill out the Student ID, Name, and Group ID";
        }
    }

    function update($stdId, $stdName, $address, $birthdate, $groupId, $photo)
    {
        global $connection;
        $checkExistenceQuery = "SELECT * FROM student WHERE StudentId=$stdId";
        $result = mysqli_query($connection, $checkExistenceQuery);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            
            $updateFields = array();
            if (!empty($stdName) && $stdName !== $row['LastName']) {
                $updateFields[] = "LastName='$stdName'";
            }
            if (!empty($address) && $address !== $row['Address']) {
                $updateFields[] = "Address='$address'";
            }
            if (!empty($birthdate) && $birthdate !== $row['BirthDate']) {
                $updateFields[] = "BirthDate='$birthdate'";
            }
            if (!empty($groupId) && $groupId !== $row['GroupId']) {
                $updateFields[] = "GroupId=$groupId";
            }
            if (!empty($photo) && $photo !== $row['photo']) {
                $updateFields[] = "photo='$photo'";
            }
            
            if (count($updateFields) > 0) {
                $sqlStmt = "UPDATE student SET " . implode(', ', $updateFields) . " WHERE StudentId=$stdId";
                $queryId = mysqli_query($connection, $sqlStmt);
                if ($queryId) {
                    echo "The person with the id $stdId has been updated successfully. Updated fields: " . implode(', ', $updateFields) . "<br/>";
                } else {
                    echo mysqli_error($connection);
                }
            } else {
                echo "No fields to update.";
            }
        } else {
            echo "The student with ID $stdId does not exist.";
        }
    }
    

    function delete($stdId)
    {
        global $connection;
        $checkExistenceQuery = "SELECT * FROM student WHERE StudentId=$stdId";
        $result = mysqli_query($connection, $checkExistenceQuery);
        
        if (mysqli_num_rows($result) > 0) {
            $deleteQuery = "DELETE FROM student WHERE StudentId=$stdId";
            $deleteResult = mysqli_query($connection, $deleteQuery);
            if ($deleteResult) {
                echo "The person with the id $stdId has been deleted successfully <br/>";
            } else {
                echo mysqli_error($connection);
            }
        } else {
            echo "The student with ID $stdId does not exist.";
        }
    }

    if ($oper == 'add') {
        insert($stdId, $stdName, $address, $birthdate, $groupId, $photo);
    } else if ($oper == 'del') {
        if (!empty($stdId)) {
            delete($stdId);
        } else {
            echo "Fill out the student ID";
        }
    } else if ($oper == 'upd') {
        update($stdId, $stdName, $address, $birthdate, $groupId, $photo);
    } else {
        echo "Invalid operation";
    }
}
?>
