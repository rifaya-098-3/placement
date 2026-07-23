<?php

include("../config/session.php");
include("../config/database.php");

if(!isset($_SESSION['company_id']))
{
    header("Location:login.php");
    exit();
}

$company_id=$_SESSION['company_id'];

$total_jobs=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM jobs WHERE company_id='$company_id'"));

$total_internships=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM internships WHERE company_id='$company_id'"));

$total_applications=mysqli_num_rows(mysqli_query($conn,"
SELECT applications.application_id
FROM applications
JOIN jobs ON applications.job_id=jobs.job_id
WHERE jobs.company_id='$company_id'
"));

$total_selected=mysqli_num_rows(mysqli_query($conn,"
SELECT applications.application_id
FROM applications
JOIN jobs ON applications.job_id=jobs.job_id
WHERE jobs.company_id='$company_id'
AND applications.status='Selected'
"));

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Company Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/app.css?v=3">

</head>

<body>

<!-- ================= Sidebar ================= -->

<div class="sidebar">

    <div class="logo">
        CareerConnect
    </div>

    <div class="menu">

        <a href="dashboard.php" class="active">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>

        <a href="post_job.php">
            <i class="bi bi-briefcase-fill"></i>
            <span>Post Job</span>
        </a>

        <a href="post_internship.php">
            <i class="bi bi-mortarboard-fill"></i>
            <span>Internship</span>
        </a>

        <a href="manage_jobs.php">
            <i class="bi bi-folder2-open"></i>
            <span>Manage Jobs</span>
        </a>

        <a href="view_applicants.php">
            <i class="bi bi-people-fill"></i>
            <span>Applicants</span>
        </a>

        <a href="profile.php">
            <i class="bi bi-building"></i>
            <span>Company Profile</span>
        </a>

    </div>

    <div class="logout">

        <a href="logout.php">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </a>

    </div>

</div>

<!-- ================= Main ================= -->

<div class="main">

<!-- ================= Header ================= -->

<header class="header">

    <div class="header-left">

        <h5>Good Afternoon 👋</h5>

        <h2>
            Welcome,
            <?php echo $_SESSION['company_name']; ?>
        </h2>

        <p>
            Manage your recruitment activities from one place.
        </p>

    </div>

    <div class="header-right">

        <a href="profile.php" class="profile">

            <?php
            echo strtoupper(substr($_SESSION['company_name'],0,1));
            ?>

        </a>

    </div>

</header>

<!-- ================= Hero ================= -->

<section class="hero">

    <div class="hero-overlay">

        <div class="hero-content">

            <span class="badge-text">
                CareerConnect Premium
            </span>

            <h1>
                Hire Tomorrow's Talent Today
            </h1>

            <p>
                Find skilled students, manage applications and recruit
                the best candidates from one powerful platform.
            </p>

            <div class="hero-buttons">

                <a href="post_job.php" class="primary-btn">
                    Post New Job
                </a>

                <a href="view_applicants.php" class="secondary-btn">
                    View Applicants
                </a>

            </div>

        </div>

    </div>

</section>

<!-- ================= Statistics ================= -->

<section class="stats">

    <div class="stat-card">

        <div class="stat-icon">
            <i class="bi bi-briefcase-fill"></i>
        </div>

        <h2><?php echo $total_jobs; ?></h2>

        <p>Jobs Posted</p>

    </div>

    <div class="stat-card">

        <div class="stat-icon">
            <i class="bi bi-mortarboard-fill"></i>
        </div>

        <h2><?php echo $total_internships; ?></h2>

        <p>Internships</p>

    </div>

    <div class="stat-card">

        <div class="stat-icon">
            <i class="bi bi-people-fill"></i>
        </div>

        <h2><?php echo $total_applications; ?></h2>

        <p>Applicants</p>

    </div>

    <div class="stat-card">

        <div class="stat-icon">
            <i class="bi bi-patch-check-fill"></i>
        </div>

        <h2><?php echo $total_selected; ?></h2>

        <p>Selected</p>

    </div>

</section>

<!-- ================= Main Content ================= -->

<div class="content-grid">

    <!-- Recent Applicants -->

    <div class="card-box">

        <div class="card-header">

            <h3>Recent Applicants</h3>

            <a href="view_applicants.php">View All</a>

        </div>

        <table class="table custom-table">

            <thead>

                <tr>

                    <th>Student</th>

                    <th>Job</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

<?php

$applicant_query=mysqli_query($conn,"
SELECT students.full_name,
jobs.job_title,
applications.status
FROM applications
JOIN students
ON applications.student_id=students.student_id
JOIN jobs
ON applications.job_id=jobs.job_id
WHERE jobs.company_id='$company_id'
ORDER BY applications.application_id DESC
LIMIT 5
");

if(mysqli_num_rows($applicant_query)>0)
{

while($row=mysqli_fetch_assoc($applicant_query))
{

?>

<tr>

<td>

<?php echo $row['full_name']; ?>

</td>

<td>

<?php echo $row['job_title']; ?>

</td>

<td>

<span class="status">

<?php echo $row['status']; ?>

</span>

</td>

</tr>

<?php

}

}

else

{

?>

<tr>

<td colspan="3" class="text-center">

No Applicants Yet

</td>

</tr>

<?php

}

?>

            </tbody>

        </table>

    </div>





    <!-- Latest Jobs -->

    <div class="card-box">

        <div class="card-header">

            <h3>Latest Jobs</h3>

            <a href="manage_jobs.php">Manage</a>

        </div>

<?php

$job_query=mysqli_query($conn,"
SELECT job_title,location
FROM jobs
WHERE company_id='$company_id'
ORDER BY job_id DESC
LIMIT 5
");

if(mysqli_num_rows($job_query)>0)
{

while($job=mysqli_fetch_assoc($job_query))
{

?>

<div class="job-item">

<div>

<h5>

<?php echo $job['job_title']; ?>

</h5>

<p>

<?php echo $job['location']; ?>

</p>

</div>

<i class="bi bi-arrow-right-circle-fill"></i>

</div>

<?php

}

}

else

{

?>

<p class="empty">

No Jobs Posted Yet

</p>

<?php

}

?>

    </div>

</div>





<!-- Quick Actions -->

<section class="quick-section">

<h3>

Quick Actions

</h3>

<div class="quick-grid">

<a href="post_job.php">

<i class="bi bi-plus-circle-fill"></i>

<span>Post Job</span>

</a>

<a href="post_internship.php">

<i class="bi bi-mortarboard-fill"></i>

<span>Internship</span>

</a>

<a href="manage_jobs.php">

<i class="bi bi-folder-fill"></i>

<span>Manage Jobs</span>

</a>

<a href="profile.php">

<i class="bi bi-building-fill"></i>

<span>Profile</span>

</a>

</div>

</section>





<footer class="footer">

CareerConnect © 2026

</footer>

</div>

</body>

</html>