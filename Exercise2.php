<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$dbname = "dbstudent";
$connection = mysqli_connect($host, $user, $pass, $dbname);

if (isset($_GET["studentId"])) {
    $stdId = $_GET["studentId"];
    $sqlStmt = "SELECT StudentId, LastName, Address, photo, GroupId FROM student WHERE StudentID = $stdId";
    $queryId = mysqli_query($connection, $sqlStmt);
    $count = mysqli_num_rows($queryId);
    if ($count > 0) {

        while ($rec=mysqli_fetch_array($queryId)){     
            $name = $rec ["LastName"];
            $address = $rec["Address"];
            $photo = $rec["photo"];
            $group = $rec["GroupId"];
            
        echo "
            <label>Student Id: </label>
            <input type='number' name='studentId' id='studentId' value='$stdId'/><br/>
            <button type='button' onclick='go()'>Go</button><br/>
            <label>Name: </label>
            <input type='text' name='name' value='$name'/><br/>
            <label>Address: </label>
            <input type='text' name='address' value='$address'/><br/>
            <label>Photo: </label>
            <input type='text' name='photo' value='$photo'/><br/>
            <label>Group: </label>
            <input type='text' name='group' value='$group'/><br/>
            <br/>
            ";
        
        //$sqlStmt2 = "SELECT CourseId, RegisDate FROM take_courses WHERE StudentID = $stdId";
        $sqlStmt2 = "SELECT take_courses.CourseId, RegisDate, course.CourseDesc, course.NbreHours FROM take_courses JOIN course ON take_courses.CourseID=course.CourseID WHERE take_courses.StudentID = $stdId";
        $queryId2 = mysqli_query($connection, $sqlStmt2);
        $count2 = mysqli_num_rows($queryId2);
        if ($count2 > 0){
            echo "<table border='1'>
                     	<tr><th>Course Id</th>
                     	<th>Course description</th>
                     	<th>Nb Hours</th>
                     	<th>Register date</th></tr>";
            while ($rec=mysqli_fetch_array($queryId2)){
                $courseId = $rec["CourseId"];
                $regisDate = $rec["RegisDate"];
                $courseDesc = $rec["CourseDesc"];
                $nbHours = $rec["NbreHours"];
                echo "<tr>
                         <td>$courseId</td>
                         <td>$courseDesc</td>
                         <td>$nbHours</td>
                         <td>$regisDate</td>
                      </tr>";
            }
            echo "</table>";
        }
//         if ($count2 > 0){
//             while ($rec=mysqli_fetch_array($queryId2)){
//                 $courseId = $rec ["CourseId"];
//                 $registDate = $rec ["RegisDate"];
                
//                 $sqlStmt3 = "SELECT * FROM course WHERE CourseId = $courseId";
//                 $queryId3 = mysqli_query($connection, $sqlStmt3);
//                 $count3 = mysqli_num_rows($queryId3);
                
//                 if ($count3 > 0){
//                     while ($rec=mysqli_fetch_array($queryId3)){
//                         $courseDesc = $rec [1];
//                         $nbHours = $rec [2];
                        
//                         echo "
//                             <table border='1'>
//                             	<tr><th>Course Id</th>
//                             	<th>Course description</th>
//                             	<th>Nb Hours</th>
//                             	<th>Register date</th></tr>
//                                 <tr>
//                                     <td>$courseId</td>
//                                     <td>$courseDesc</td>
//                                     <td>$nbHours</td>
//                                     <td>$registDate</td>
//                                 </tr>
//                             </table>
//                         ";
//                     }
//                 }
//             }
//         }
        
        }
    }
    else {
        echo "No students found, try again: <br/><br/>
            <label>Student Id: </label>
            <input type='number' name='studentId' id='studentId'/><br/>
            <button type='button' onclick='go()'>Go</button><br/>
            <label>Name: </label>
            <input type='text' name='name'/><br/>
            <label>Address: </label>
            <input type='text' name='address'/><br/>
            <label>Photo: </label>
            <input type='text' name='photo'/><br/>
            <label>Group: </label>
            <input type='text' name='group'/><br/>
            <br/>
            ";
    }
}
else {
    echo "Search for a student: <br/><br/>
            <label>Student Id: </label>
            <input type='number' name='studentId' id='studentId'/><br/>
            <button type='button' onclick='go()'>Go</button><br/>
            <label>Name: </label>
            <input type='text' name='name'/><br/>
            <label>Address: </label>
            <input type='text' name='address'/><br/>
            <label>Photo: </label>
            <input type='text' name='photo'/><br/>
            <label>Group: </label>
            <input type='text' name='group'/><br/>
            <br/>
            ";
}

?>

<script>
function go(){
var studentId = document.getElementById("studentId").value;
if (!studentId){
	studentId = null
}
window.location = 'Exercise2.php?studentId='+studentId;
}
</script>
</html>