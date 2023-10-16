<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "dbstudent";
$connection = mysqli_connect($host, $user, $pass, $dbname);

?>
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
		<form method="post">
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
			<button type="submit" name="add">Add</button>
			<button type="submit" name="update">Update</button>
			<button type="submit" name="delete">Delete</button>
		</form>
	</div>
</body>
</html>

<?php
        $message = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $student_id = $_POST['student_id'];
            $student_name = $_POST['student_name'];
            $address = $_POST['address'];
            $birthdate = $_POST['birthdate'];
            $group_id = $_POST['group_id'];
            $photo = $_POST['photo'];

            if (isset($_POST['add'])) {
                $query = "INSERT INTO student VALUES ('$student_id', '$student_name', '$address', '$birthdate', '$group_id', '$photo')";
                mysqli_query($connection, $query);
                $message = "Add: $student_name";
            } elseif (isset($_POST['update'])) {
                $updatedFields = [];
                if (!empty($student_name)) {
                    $updatedFields[] = "Student Name";
                }
                if (!empty($address)) {
                    $updatedFields[] = "Address";
                }
                if (!empty($birthdate)) {
                    $updatedFields[] = "Birth Date";
                }
                if (!empty($group_id)) {
                    $updatedFields[] = "Group Id";
                }
                if (!empty($photo)) {
                    $updatedFields[] = "Photo";
                }
                
                if (!empty($updatedFields)) {
                    $updatedFieldsStr = implode(", ", $updatedFields);
                    $message = "Update: $student_name - Updated Fields: $updatedFieldsStr";
                } else {
                    $message = "Update: $student_name - No Fields Updated";
                }
                
                $query = "UPDATE student SET LastName='$student_name', Address='$address', BirthDate='$birthdate', GroupId='$group_id', photo='$photo' WHERE StudentId='$student_id'";
                mysqli_query($connection, $query);
            } elseif (isset($_POST['delete'])) {
                $query = "DELETE FROM student WHERE StudentId='$student_id'";
                mysqli_query($connection, $query);
                $message = "Delete: $student_id";
            }
        }

        echo $message; // Exibe a mensagem diretamente na página
        ?>