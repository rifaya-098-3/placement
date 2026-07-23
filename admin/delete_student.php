<?php

include("../config/database.php");

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM students WHERE student_id='$id'");

header("Location:students.php");

?>