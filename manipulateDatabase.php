<?php
require_once 'dbconfig.php';
echo "<h2>Welcome $user to the database $dbname </h2>";
?>

<a href="dataOperation.php?op=1">Insert</a><br/>
<a href="dataOperation.php?op=2">Update</a><br/>
<a href="dataOperation.php?op=3">Delete</a><br/>
<a href="dataOperation.php?op=4">Select</a><br/>
<a href="dataOperation.php?op=5">List 1</a><br/>
<a href="dataOperation.php?op=6">List 2</a><br/>
<a href="dataOperation.php?op=7">List 3</a><br/>
<a href="dataOperation.php?op=8">List of option</a><br/>