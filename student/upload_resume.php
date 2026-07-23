<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Upload Resume | CareerConnect</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="app">

<?php include("../includes/sidebar_student.php"); ?>

<main class="main">

<?php include("../includes/topbar_student.php"); ?>

<div class="upload-page">

<div class="page-header">

<h1>Upload Resume</h1>

<p>Keep your resume updated for recruiters.</p>

</div>



<div class="upload-card">

<form action="upload_resume_process.php" method="POST" enctype="multipart/form-data">

<div class="upload-area">

<i class="bi bi-cloud-arrow-up-fill"></i>

<h2>Select Resume</h2>

<p>Only PDF files are allowed.</p>

<input type="file" name="resume" required>

</div>



<div class="resume-info">

<div>

<i class="bi bi-file-earmark-pdf-fill"></i>

<span>Supported Format : PDF</span>

</div>

<div>

<i class="bi bi-file-earmark-check-fill"></i>

<span>Maximum Size : 5 MB</span>

</div>

</div>



<button type="submit" class="upload-btn">

<i class="bi bi-upload"></i>

Upload Resume

</button>

</form>

</div>

</div>

</main>

</div>

</body>

</html>