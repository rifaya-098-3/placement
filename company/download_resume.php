<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['company_id']))
{
    header("Location:login.php");
    exit();
}

if(!isset($_GET['student_id']))
{
    die("Invalid Request");
}

$student_id = intval($_GET['student_id']);

$stmt = mysqli_prepare($conn,"
SELECT resume_file
FROM resumes
WHERE student_id=?
ORDER BY uploaded_at DESC
LIMIT 1");

mysqli_stmt_bind_param($stmt,"i",$student_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result)==1)
{
    $row = mysqli_fetch_assoc($result);

    $file = "../uploads/resumes/".$row['resume_file'];

    if(file_exists($file))
    {
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=\"".$row['resume_file']."\"");
        header("Content-Length: ".filesize($file));

        readfile($file);
        exit();
    }
    else
    {
        echo "<h3>Resume file not found.</h3>";
    }
}
else
{
    echo "<h3>No resume uploaded.</h3>";
}
?>