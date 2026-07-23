<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$stmt = mysqli_prepare($conn,"
SELECT
applications.application_id,
applications.status,
applications.applied_at,
jobs.job_title,
jobs.location,
jobs.salary,
companies.company_name

FROM applications

JOIN jobs
ON applications.job_id = jobs.job_id

JOIN companies
ON jobs.company_id = companies.company_id

WHERE applications.student_id=?

ORDER BY applications.applied_at DESC");

mysqli_stmt_bind_param($stmt,"i",$student_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Applications | CareerConnect</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="app">

<?php include("../includes/sidebar_student.php"); ?>

<main class="main">

<?php include("../includes/topbar_student.php"); ?>

<div class="applications-page">

<div class="page-header">

<div>

<h1>My Applications</h1>

<p>Track every application you've submitted.</p>

</div>

<a href="job.php" class="browse-btn">

<i class="bi bi-search"></i>

Browse Jobs

</a>

</div>



<div class="application-grid">

<?php while($application=mysqli_fetch_assoc($result)){ ?>

<div class="application-card">

<div class="card-top">

<div class="company">

<div class="company-logo">

<i class="bi bi-building"></i>

</div>

<div>

<h2>

<?php echo $application['job_title']; ?>

</h2>

<h4>

<?php echo $application['company_name']; ?>

</h4>

</div>

</div>

<span class="status

<?php echo strtolower($application['status']); ?>

">

<?php echo $application['status']; ?>

</span>

</div>



<div class="info-grid">

<div>

<i class="bi bi-calendar-event-fill"></i>

Applied

<br>

<strong>

<?php echo $application['applied_at']; ?>

</strong>

</div>

<div>

<i class="bi bi-geo-alt-fill"></i>

<?php echo $application['location']; ?>

</div>

<div>

<i class="bi bi-briefcase-fill"></i>

<?php echo $application['work_mode']; ?>

</div>

<div>

<i class="bi bi-cash-stack"></i>

₹ <?php echo $application['salary']; ?>

</div>

</div>



<div class="card-footer">

<a href="#" class="details-btn">

View Details

</a>

</div>

</div>

<?php } ?>

</div>

</div>

</main>

</div>

</body>

</html>