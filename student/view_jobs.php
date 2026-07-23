<?php
include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

$query = "SELECT jobs.*, companies.company_name
FROM jobs
INNER JOIN companies
ON jobs.company_id = companies.company_id
ORDER BY jobs.job_id DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Available Jobs</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/placement/assets/css/app.css">

</head>

<body>

<div class="admin-topbar">
<div class="brand"><span class="dot"></span> CareerConnect</div>
<a href="dashboard.php" class="logout-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
</div>

<div class="admin-container">

<div class="page-header" style="margin-bottom:28px;">
<h1>Available Jobs</h1>
<p>Browse open roles from verified companies and apply in one click.</p>
</div>

<div class="job-listing-grid">

<?php while($row=mysqli_fetch_assoc($result)) { ?>

<div class="job-listing-card">

<div class="job-listing-top">
<span class="job-type-badge"><?php echo htmlspecialchars($row['job_type']); ?></span>
</div>

<h4><?php echo htmlspecialchars($row['job_title']); ?></h4>

<div class="job-listing-meta">
<span><i class="bi bi-building"></i> <?php echo htmlspecialchars($row['company_name']); ?></span>
<span><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($row['location']); ?></span>
</div>

<div class="job-listing-stats">
<div>
<label>Salary</label>
<span>₹ <?php echo number_format($row['salary']); ?></span>
</div>
<div>
<label>Min. CGPA</label>
<span><?php echo $row['cgpa']; ?></span>
</div>
</div>

<a href="apply_job.php?id=<?php echo $row['job_id']; ?>" class="job-apply-btn">
Apply Now <i class="bi bi-arrow-right"></i>
</a>

</div>

<?php } ?>

</div>

<a href="dashboard.php" class="admin-back"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>

</div>

</body>
</html>
