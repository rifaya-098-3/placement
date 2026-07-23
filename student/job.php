<?php
include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

$sql="SELECT jobs.*, companies.company_name
FROM jobs
INNER JOIN companies
ON jobs.company_id=companies.company_id
ORDER BY jobs.created_at DESC";

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Available Jobs | CareerConnect</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="app">

<?php include("../includes/sidebar_student.php"); ?>

<main class="main">

<?php include("../includes/topbar_student.php"); ?>

<div class="jobs-page">

<div class="page-header">

<div>

<h1>Available Opportunities</h1>

<p>Discover internships and placement opportunities matched for you.</p>

</div>

<div class="job-search">

<input type="text" placeholder="Search jobs...">

<button>

<i class="bi bi-search"></i>

</button>

</div>

</div>



<div class="job-grid">

<?php while($job=mysqli_fetch_assoc($result)){ ?>

<div class="job-card">

<div class="job-top">

<div class="company-logo">

<i class="bi bi-building"></i>

</div>

<div>

<h2>

<?php echo $job['job_title']; ?>

</h2>

<h4>

<?php echo $job['company_name']; ?>

</h4>

</div>

<span class="job-badge">

<?php echo $job['work_mode']; ?>

</span>

</div>



<div class="job-details">

<div>

<i class="bi bi-geo-alt-fill"></i>

<?php echo $job['location']; ?>

</div>

<div>

<i class="bi bi-cash-stack"></i>

₹ <?php echo $job['salary']; ?>

</div>

<div>

<i class="bi bi-mortarboard-fill"></i>

<?php echo $job['branch']; ?>

</div>

<div>

<i class="bi bi-award-fill"></i>

CGPA

<?php echo $job['cgpa']; ?>

</div>

</div>



<div class="skills">

<?php

$skills = explode(",", $job['skills']);

foreach($skills as $skill){

?>

<span>

<?php echo trim($skill); ?>

</span>

<?php } ?>

</div>



<p class="description">

<?php echo substr($job['job_description'],0,150); ?>...

</p>



<div class="bottom">

<div class="date">

<i class="bi bi-calendar-event-fill"></i>

Last Date :

<?php echo $job['last_date']; ?>

</div>



<div class="buttons">

<a href="save_job.php?job_id=<?php echo $job['job_id']; ?>" class="save">

<i class="bi bi-bookmark"></i>

</a>

<a href="apply.php?job_id=<?php echo $job['job_id']; ?>" class="apply">

Apply Now

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</main>

</div>

</body>

</html>