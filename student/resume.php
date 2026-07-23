<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

$student_id=$_SESSION['student_id'];

$student_query=mysqli_query(
$conn,
"SELECT * FROM students WHERE student_id='$student_id'"
);

$student=mysqli_fetch_assoc($student_query);

$resume_query=mysqli_query(
$conn,
"SELECT * FROM resumes
WHERE student_id='$student_id'
ORDER BY resume_id DESC
LIMIT 1"
);

$resume=mysqli_fetch_assoc($resume_query);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Resume Center | CareerConnect</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="app">

<?php include("../includes/sidebar_student.php"); ?>

<main class="main">

<?php include("../includes/topbar_student.php"); ?>

<div class="resume-page">

<div class="page-header">

<div>

<h1>Resume Center</h1>

<p>Manage your professional resume.</p>

</div>

<a href="upload_resume.php" class="upload-btn">

<i class="bi bi-upload"></i>

Upload Resume

</a>

</div>



<div class="resume-grid">



<div class="resume-preview">

<div class="preview-top">

<i class="bi bi-file-earmark-pdf-fill"></i>

<div>

<h2><?php echo $student['full_name']; ?></h2>

<p>Professional Resume</p>

</div>

</div>



<div class="resume-view">

<?php

if($resume)
{

?>

<i class="bi bi-file-earmark-check-fill"></i>

<h2>Resume Uploaded</h2>

<p>

<?php echo $resume['resume_file']; ?>

</p>

<?php

}
else
{

?>

<i class="bi bi-file-earmark-x-fill"></i>

<h2>No Resume Found</h2>

<p>

Upload your resume to start applying.

</p>

<?php

}

?>

</div>



<div class="resume-buttons">

<?php

if($resume)
{

?>

<a

href="../uploads/resumes/<?php echo $resume['resume_file']; ?>"

class="download"

target="_blank"

>

<i class="bi bi-download"></i>

Download

</a>

<?php

}

?>

<a href="upload_resume.php" class="replace">

Replace Resume

</a>

</div>

</div>





<div class="resume-right">

<div class="resume-card">

<h3>Status</h3>

<?php

if($resume)
{

echo "<h2 class='success'>Uploaded</h2>";

}
else
{

echo "<h2 class='danger'>Not Uploaded</h2>";

}

?>

</div>



<div class="resume-card">

<h3>ATS Score</h3>

<h2>92%</h2>

</div>



<div class="resume-card">

<h3>Resume Tips</h3>

<ul>

<li>Keep it to one page</li>

<li>Add projects</li>

<li>Update technical skills</li>

<li>Mention internships</li>

<li>Keep CGPA updated</li>

</ul>

</div>

</div>



</div>

</div>

</main>

</div>

</body>

</html>