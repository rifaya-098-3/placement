<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

if(!isset($_GET['id']))
{
    header("Location:saved_job.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$saved_id = intval($_GET['id']);

$stmt = mysqli_prepare($conn,"
DELETE FROM saved_jobs
WHERE saved_id=?
AND student_id=?");

mysqli_stmt_bind_param($stmt,"ii",$saved_id,$student_id);

mysqli_stmt_execute($stmt);

header("Location:saved_job.php");
exit();

?>