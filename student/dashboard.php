<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

/* ==========================================================
   STUDENT DETAILS
========================================================== */

$student_query = mysqli_query(
$conn,
"SELECT * FROM students WHERE student_id='$student_id'"
);

$student = mysqli_fetch_assoc($student_query);

/* ==========================================================
   DASHBOARD COUNTS
========================================================== */

$job_query = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM jobs
");

$total_jobs = mysqli_fetch_assoc($job_query)['total'];

$app_query = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM applications
WHERE student_id='$student_id'
");

$total_applications = mysqli_fetch_assoc($app_query)['total'];

$company_query = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM companies
");

$total_companies = mysqli_fetch_assoc($company_query)['total'];

/* ==========================================================
   PROFILE STRENGTH
========================================================== */

$profile_strength = 0;

if(!empty($student['full_name'])) $profile_strength += 10;
if(!empty($student['email'])) $profile_strength += 10;
if(!empty($student['phone'])) $profile_strength += 10;
if(!empty($student['gender'])) $profile_strength += 10;
if(!empty($student['dob'])) $profile_strength += 10;
if(!empty($student['branch'])) $profile_strength += 10;
if(!empty($student['cgpa'])) $profile_strength += 10;
if(!empty($student['skills'])) $profile_strength += 10;
if(!empty($student['photo'])) $profile_strength += 10;
if(!empty($student['resume'])) $profile_strength += 10;

/* ==========================================================
   GREETING
========================================================== */

date_default_timezone_set("Asia/Kolkata");

$hour = date("H");

if($hour < 12)
{
    $greeting = "Good Morning";
}
elseif($hour < 17)
{
    $greeting = "Good Afternoon";
}
else
{
    $greeting = "Good Evening";
}

/* ==========================================================
   LATEST JOBS
========================================================== */

$jobs = mysqli_query(
$conn,
"SELECT jobs.*, companies.company_name
FROM jobs
JOIN companies ON jobs.company_id = companies.company_id
ORDER BY job_id DESC
LIMIT 5"
);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
CareerConnect | Student Dashboard
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet"
href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="app">

<?php include("../includes/sidebar_student.php"); ?>

<main class="main">

<?php include("../includes/topbar_student.php"); ?>

<section class="dashboard">

<div class="hero-card">

<div class="hero-content">

<span class="hero-tag">

CareerConnect Student Portal

</span>

<h1>

<?php echo $greeting; ?>,

<br>

<?php echo $student['full_name']; ?>

</h1>

<p>

Discover new opportunities, track your applications and build your career with top companies across India.

</p>

<div class="hero-btns">

<a href="view_jobs.php"
class="btn-primary">

<i class="bi bi-search"></i>

Explore Jobs

</a>

<a href="upload_resume.php"
class="btn-secondary">

<i class="bi bi-upload"></i>

Upload Resume

</a>

</div>

</div>

<div class="hero-progress">

<div class="circle">

<?php echo $profile_strength; ?>%

</div>

<h4>

Profile Strength

</h4>

<p>

Complete your profile to improve your placement chances.

</p>

</div>

</div>

<!-- STATS START HERE -->

<!-- =========================
        STATS
========================= -->

<div class="stats-grid">

    <div class="stat-card">

        <div class="stat-icon gold">
            <i class="bi bi-briefcase-fill"></i>
        </div>

        <div class="stat-info">

            <h2><?php echo $total_jobs; ?></h2>

            <span>Available Jobs</span>

        </div>

    </div>



    <div class="stat-card">

        <div class="stat-icon blue">
            <i class="bi bi-send-check-fill"></i>
        </div>

        <div class="stat-info">

            <h2><?php echo $total_applications; ?></h2>

            <span>Applications</span>

        </div>

    </div>



    <div class="stat-card">

        <div class="stat-icon green">
            <i class="bi bi-building-fill"></i>
        </div>

        <div class="stat-info">

            <h2><?php echo $total_companies; ?></h2>

            <span>Companies</span>

        </div>

    </div>



    <div class="stat-card">

        <div class="stat-icon purple">
            <i class="bi bi-person-check-fill"></i>
        </div>

        <div class="stat-info">

            <h2><?php echo $profile_strength; ?>%</h2>

            <span>Profile Strength</span>

        </div>

    </div>

</div>


<!-- =========================
        CONTENT
========================= -->

<div class="dashboard-grid">


    <!-- LEFT -->

    <div class="jobs-section">

        <div class="section-head">

            <h2>

                Latest Opportunities

            </h2>

            <a href="view_jobs.php">

                View All

            </a>

        </div>


        <?php

        if(mysqli_num_rows($jobs)>0)
        {

        while($job=mysqli_fetch_assoc($jobs))
        {

        ?>

        <div class="job-card">

            <div class="job-left">

                <div class="company-icon">

                    <i class="bi bi-building"></i>

                </div>

                <div class="job-details">

                    <h3>

                        <?php echo htmlspecialchars($job['job_title']); ?>

                    </h3>

                    <p>

                        <?php echo htmlspecialchars($job['company_name']); ?>

                    </p>

                    <div class="job-tags">

                        <span>Latest</span>

                        <span>Campus</span>

                    </div>

                </div>

            </div>


            <a href="view_jobs.php" class="apply-btn">

                Apply Now

            </a>

        </div>

        <?php

        }

        }

        else

        {

        ?>

        <div class="empty-box">

            <i class="bi bi-briefcase"></i>

            <h3>

                No Jobs Available

            </h3>

            <p>

                New opportunities will appear here once companies post them.

            </p>

        </div>

        <?php } ?>

    </div>




    <!-- RIGHT -->

    <div class="right-side">


        <!-- PROFILE STATUS -->

        <div class="widget">

            <h3>

                Profile Progress

            </h3>

            <div class="timeline">

                <div>

                    <i class="bi bi-person-fill-check"></i>

                    Personal Details

                </div>

                <div>

                    <i class="bi bi-file-earmark-arrow-up-fill"></i>

                    Resume

                </div>

                <div>

                    <i class="bi bi-tools"></i>

                    Skills

                </div>

                <div>

                    <i class="bi bi-send-check-fill"></i>

                    Applications

                </div>

                <div>

                    <i class="bi bi-trophy-fill"></i>

                    Placement

                </div>

            </div>

        </div>



        <!-- QUICK ACCESS -->

        <div class="widget">

            <h3>

                Quick Access

            </h3>

            <a href="profile.php">

                <i class="bi bi-person-circle"></i>

                My Profile

            </a>

            <a href="upload_resume.php">

                <i class="bi bi-file-earmark-arrow-up-fill"></i>

                Upload Resume

            </a>

            <a href="view_jobs.php">

                <i class="bi bi-search"></i>

                Browse Jobs

            </a>

            <a href="applications.php">

                <i class="bi bi-send-check-fill"></i>

                My Applications

            </a>

        </div>


    </div>


</div>

</section>

</main>

</div>

</body>

</html>
