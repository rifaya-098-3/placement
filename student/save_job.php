<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

if(!isset($_GET['job_id']))
{
    header("Location:view_jobs.php");
    exit();
}

$student_id=$_SESSION['student_id'];
$job_id=$_GET['job_id'];

$check=mysqli_prepare($conn,"
SELECT *
FROM saved_jobs
WHERE student_id=?
AND job_id=?");

mysqli_stmt_bind_param($check,"ii",$student_id,$job_id);

mysqli_stmt_execute($check);

$result=mysqli_stmt_get_result($check);

if(mysqli_num_rows($result)==0)
{
    $stmt=mysqli_prepare($conn,"
    INSERT INTO saved_jobs
    (student_id,job_id)
    VALUES(?,?)");

    mysqli_stmt_bind_param($stmt,"ii",$student_id,$job_id);

    mysqli_stmt_execute($stmt);
}

header("Location:view_jobs.php");

exit();

?>