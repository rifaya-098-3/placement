<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
header("Location:login.php");
exit();
}

$student=$_SESSION['student_id'];

$internship=$_GET['id'];

$stmt=mysqli_prepare($conn,"
INSERT INTO applications
(student_id,internship_id)

VALUES(?,?)");

mysqli_stmt_bind_param(
$stmt,
"ii",
$student,
$internship
);

mysqli_stmt_execute($stmt);

echo "<script>

alert('Applied Successfully');

window.location='internships.php';

</script>";

?>