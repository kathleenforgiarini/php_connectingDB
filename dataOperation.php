<?php

require_once 'dbconfig.php';

$operation = $_GET["op"];

switch ($operation) {
    case "1": insertOneTeacher(); break;
    case "2": updateOneTeacher(); break;
    case "3": deleteOneTeacher(); break;
    case "4": selectOneTeacher(); break;
    case "5": selectAllTeachers(); break;
    case "6": selectAllTeachers2(); break;
    case "7": selectAllTeachers3(); break;
    case "8": listOfOption(); break;
}

function insertOneTeacher(){
    global $connection;
    $sqlStmt = "INSERT INTO teacher VALUES (600, 'Simon', '5144565678', 'sim@gmail.com')";
    $queryId = mysqli_query($connection, $sqlStmt);
    if ($queryId == true)
        echo "One teacher has been added successfully <br/>";
    else
        echo mysqli_error($connection). "<br/>";
    
    mysqli_close($connection);
}

function updateOneTeacher(){
    global $connection;
    $teacherId = 500;
    $sqlStmt = "UPDATE teacher set phone = '4509001233' WHERE teacher_id = $teacherId";
    $queryId = mysqli_query($connection, $sqlStmt);
    if ($queryId == true){
        if (mysqli_affected_rows($connection))
            echo "The phone of the teacher $teacherId has beed updated successfully <br/>";
        else
            echo "No change in the database table tacher <br/>";          
    }
    else
        echo mysqli_error($connection). "<br/>";
            
    mysqli_close($connection);
}

function deleteOneTeacher(){
    global $connection;
    $teacherId = 60000;
    $sqlStmt = "DELETE FROM teacher WHERE teacher_id = $teacherId";
    $queryId = mysqli_query($connection, $sqlStmt);
    if ($queryId == true){
        if (mysqli_affected_rows($connection))
            echo "The teacher $teacherId has beed deleted successfully <br/>";
            else
                echo "No change in the database table tacher <br/>";
    }
    else
        echo mysqli_error($connection). "<br/>";
        
        mysqli_close($connection);
}

function selectOneTeacher(){
    global $connection;
    $teacher_id = "1000";
    $sqlStmt = "SELECT teacher_id, name, phone, email FROM teacher WHERE teacher_id = $teacher_id";
    $queryId = mysqli_query($connection, $sqlStmt);
    $count = mysqli_num_rows($queryId);
    if ($count > 0){
        echo "The total numbr of rows is $count <br/>";
        echo "<table border='1'>";
        echo "<tr><th>Teacher Id</th><th>Name</th><th>Phone</th>";
        echo "<th>Email</th></tr>";
        while ($rec=mysqli_fetch_array($queryId)){
            //             $teacherId = $rec[0];
            //             $name = $rec[1];
            //             $phone = $rec[2];
            //             $email = $rec[3];
            
            $teacherId = $rec["teacher_id"];
            $name = $rec ["name"];
            $phone = $rec["phone"];
            $email = $rec["email"];
            
            echo "<tr><td>$teacherId</td><td>$name</td><td>$phone</td><td>$email</td></tr>";
            
        }
        echo "</table>";
    }
    else
        echo "The teacher $teacher_id does not exist <br/>";
        
    mysqli_close($connection);
}

function selectAllTeachers(){
    global $connection;
    $sqlStmt = "SELECT teacher_id, name, phone, email FROM teacher";
    $queryId = mysqli_query($connection, $sqlStmt);
    $count = mysqli_num_rows($queryId);
    if ($count > 0){
        echo "The total numbr of rows is $count <br/>";
        echo "<table border='1'>";
        echo "<tr><th>Teacher Id</th><th>Name</th><th>Phone</th>";
        echo "<th>Email</th></tr>";
        while ($rec=mysqli_fetch_array($queryId)){
//             $teacherId = $rec[0];
//             $name = $rec[1];
//             $phone = $rec[2];
//             $email = $rec[3];

            $teacherId = $rec["teacher_id"];
            $name = $rec ["name"];
            $phone = $rec["phone"];
            $email = $rec["email"];
            
            echo "<tr><td>$teacherId</td><td>$name</td><td>$phone</td><td>$email</td></tr>";
            
        }
        echo "</table>";
    }
    else
        echo "No row in the table teacher";
    
    mysqli_close($connection);
}

function selectAllTeachers2(){
    global $connection;
    $sqlStmt = "SELECT * FROM teacher";
    $queryId = mysqli_query($connection, $sqlStmt);
    $count = mysqli_num_rows($queryId);
    if ($count > 0){
        echo "The total numbr of rows is $count <br/>";
        echo "<table border='1'>";
        echo "<tr><th>Teacher Id</th><th>Name</th><th>Phone</th>";
        echo "<th>Email</th></tr>";
        while ($rec=mysqli_fetch_row($queryId)){
            $teacherId = $rec[0];
            $name = $rec[1];
            $phone = $rec[2];
            $email = $rec[3];
            
            echo "<tr><td>$teacherId</td><td>$name</td><td>$phone</td><td>$email</td></tr>";
            
        }
        echo "</table>";
    }
    else
        echo "No row in the table teacher";
        
        mysqli_close($connection);
}

function selectAllTeachers3(){
    global $connection;
    $sqlStmt = "SELECT teacher_id, name, phone, email FROM teacher";
    $queryId = mysqli_query($connection, $sqlStmt);
    $count = mysqli_num_rows($queryId);
    if ($count > 0){
        echo "The total numbr of rows is $count <br/>";
        echo "<table border='1'>";
        echo "<tr><th>Teacher Id</th><th>Name</th><th>Phone</th>";
        echo "<th>Email</th></tr>";
        while ($rec=mysqli_fetch_assoc($queryId)){
            $teacherId = $rec["teacher_id"];
            $name = $rec ["name"];
            $phone = $rec["phone"];
            $email = $rec["email"];
            
            echo "<tr><td>$teacherId</td><td>$name</td><td>$phone</td><td>$email</td></tr>";
            
        }
        echo "</table>";
    }
    else
        echo "No row in the table teacher";
        
        mysqli_close($connection);
}

function listOfOption(){
    global $connection;
    $sqlStmt = "SELECT teacher_id, name, phone, email FROM teacher";
    $queryId = mysqli_query($connection, $sqlStmt);
    
    echo "<select name='list'>";
    while ($rec=mysqli_fetch_array($queryId)){
        $teacherId = $rec["teacher_id"];
        $name = $rec ["name"];
        
        echo "<option value='$teacherId'>$name</option>";
    }
    echo "</select></br>";
        
    mysqli_close($connection);
}

?>

<a href="manipulateDatabase.php">Return</a><br/>

