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
    SET status='Selected'
    WHERE application_id='$id'
    ");

    // Get student and job details
    $sql = "SELECT
            applications.student_id,
            jobs.job_title
            FROM applications
            JOIN jobs
            ON applications.job_id = jobs.job_id
            WHERE applications.application_id=?";

    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result))
    {
        $student_id = $row['student_id'];
        $job_title = $row['job_title'];

        $title = "Application Selected";
        $message = "Congratulations! You have been selected for the job: ".$job_title;

        $stmt2 = mysqli_prepare($conn,"
        INSERT INTO notifications(student_id,title,message)
        VALUES(?,?,?)
        ");

        mysqli_stmt_bind_param(
            $stmt2,
            "iss",
            $student_id,
            $title,
            $message
        );

        mysqli_stmt_execute($stmt2);
    }

    header("Location:view_applicants.php");
    exit();
}

?>