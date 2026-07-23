<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

$student_id=$_SESSION['student_id'];

$job_id=$_GET['id'];

$message="";

$check=mysqli_prepare($conn,"
SELECT *
FROM applications
WHERE student_id=?
AND job_id=?");

mysqli_stmt_bind_param($check,"ii",$student_id,$job_id);

mysqli_stmt_execute($check);

$result=mysqli_stmt_get_result($check);

if(mysqli_num_rows($result)>0)
{
    $message="You have already applied for this job.";
}
else
{
    $status="Pending";

    $stmt=mysqli_prepare($conn,"
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
        $message="Application Submitted Successfully.";
    }
    else
    {
        $message="Application Failed.";
    }
}

?>

<!DOCTYPE html>

<html>

<head>

<title>Apply Job</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="alert alert-primary">

<h3>

<?php echo $message; ?>

</h3>

</div>

<a
href="view_jobs.php"
class="btn btn-success">

Back to Jobs

</a>

</div>

</body>

</html>