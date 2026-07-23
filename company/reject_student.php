<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['company_id']))
{
    header("Location:login.php");
    exit();
}

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    // Update application status
    mysqli_query($conn,"
    UPDATE applications
    SET status='Rejected'
    WHERE application_id='$id'
    ");

    // Get student and job details
    $result = mysqli_query($conn,"
    SELECT
        applications.student_id,
        jobs.job_title
    FROM applications
    JOIN jobs
    ON applications.job_id = jobs.job_id
    WHERE applications.application_id='$id'
    ");

    if($row = mysqli_fetch_assoc($result))
    {
        $student_id = $row['student_id'];
        $job_title = $row['job_title'];

       $title = "Application Rejected";

$message = "Your application for '".$job_title."' has not been been selected. We wish you the best for future opportunities.";

mysqli_query($conn,"
INSERT INTO notifications(student_id,title,message)
VALUES('$student_id','$title','$message')
");
    }

    header("Location:view_applicants.php");
    exit();
}

?>