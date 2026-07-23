<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location:login.php");
    exit();
}

$students = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM students"));
$companies = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM companies"));
$jobs = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM jobs"));
$applications = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM applications"));
$messages = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM contact_messages"));

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/placement/assets/css/app.css">

</head>

<body>

<div class="admin-topbar">
<div class="brand"><span class="dot"></span> CareerConnect Admin</div>
<a href="logout.php" class="logout-link"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<div class="admin-container">
<div class="admin-page">

<div class="admin-hero">
<div class="admin-title">
<h1>Welcome, Admin</h1>
<p>Placement &amp; Internship Management System</p>
</div>
</div>

<div class="admin-stats">

<a href="students.php" class="admin-stat">
<i class="bi bi-mortarboard"></i>
<h2><?php echo $students; ?></h2>
<span>Total Students</span>
</a>

<a href="companies.php" class="admin-stat">
<i class="bi bi-building"></i>
<h2><?php echo $companies; ?></h2>
<span>Total Companies</span>
</a>

<a href="view_jobs.php" class="admin-stat">
<i class="bi bi-briefcase"></i>
<h2><?php echo $jobs; ?></h2>
<span>Total Jobs</span>
</a>

<a href="application.php" class="admin-stat">
<i class="bi bi-file-earmark-text"></i>
<h2><?php echo $applications; ?></h2>
<span>Total Applications</span>
</a>

<a href="contact_messages.php" class="admin-stat">
<i class="bi bi-envelope"></i>
<h2><?php echo $messages; ?></h2>
<span>Contact Messages</span>
</a>

</div>

</div>
</div>

</body>
</html>
