<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

if(!isset($_GET['job_id']))
{
    header("Location:jobs.php");
    exit();
}

$job_id = $_GET['job_id'];

/* Check if already applied */

$check = mysqli_prepare($conn,"
SELECT application_id
FROM applications
WHERE student_id=?
AND job_id=?");

mysqli_stmt_bind_param($check,"ii",$student_id,$job_id);

mysqli_stmt_execute($check);

mysqli_stmt_store_result($check);

if(mysqli_stmt_num_rows($check)>0)
{
    echo "<script>
    alert('You have already applied for this job.');
    window.location='jobs.php';
    </script>";
    exit();
}

/* Apply for Job */

$status = "Pending";

$stmt = mysqli_prepare($conn,"
INSERT INTO applications
(student_id,job_id,status)
VALUES(?,?,?)");

mysqli_stmt_bind_param(
$stmt,
"iis",
$student_id,
$job_id,
$status
);

if(mysqli_stmt_execute($stmt))
{
    echo "<script>
    alert('Application Submitted Successfully.');
    window.location='applications.php';
    </script>";
}
else
{
    echo "<script>
    alert('".mysqli_error($conn)."');
    window.location='jobs.php';
    </script>";
}

?>