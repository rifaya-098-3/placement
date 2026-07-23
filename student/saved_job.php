<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$sql = "SELECT

saved_jobs.saved_id,

jobs.job_id,
jobs.job_title,
jobs.location,
jobs.salary,

companies.company_name

FROM saved_jobs

JOIN jobs
ON saved_jobs.job_id = jobs.job_id

JOIN companies
ON jobs.company_id = companies.company_id

WHERE saved_jobs.student_id=?

ORDER BY saved_jobs.saved_at DESC";

$stmt = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($stmt,"i",$student_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Saved Jobs | CareerConnect</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="app">

<?php include("../includes/sidebar_student.php"); ?>

<main class="main">

<?php include("../includes/topbar_student.php"); ?>

<div class="saved-page">

<div class="page-header">

<h1>Saved Jobs</h1>

<p>Your bookmarked opportunities.</p>

</div>

<div class="saved-grid">

<?php while($job=mysqli_fetch_assoc($result)){ ?>

<div class="saved-card">

<div class="top">

<div class="logo">

<i class="bi bi-building-fill"></i>

</div>

<div>

<h2><?php echo $job['job_title']; ?></h2>

<h4><?php echo $job['company_name']; ?></h4>

</div>

</div>

<div class="info">

<span>

<i class="bi bi-geo-alt-fill"></i>

<?php echo $job['location']; ?>

</span>

<span>

<i class="bi bi-cash-stack"></i>

₹ <?php echo $job['salary']; ?>

</span>

</div>

<div class="buttons">

<a href="apply.php?job_id=<?php echo $job['job_id']; ?>" class="apply">

Apply

</a>

<a href="remove_saved_job.php?job_id=<?php echo $job['job_id']; ?>" class="remove">

<i class="bi bi-trash"></i>

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