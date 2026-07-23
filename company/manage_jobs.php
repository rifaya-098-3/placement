<?php
include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['company_id']))
{
    header("Location:login.php");
    exit();
}

$company_id=$_SESSION['company_id'];

$result=mysqli_query($conn,"
SELECT * FROM jobs
WHERE company_id='$company_id'
ORDER BY job_id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manage Jobs</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/placement/assets/css/app.css">

</head>

<body>

<div class="admin-topbar">
<div class="brand"><span class="dot"></span> CareerConnect</div>
<a href="dashboard.php" class="logout-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
</div>

<div class="admin-container">

<div class="table-card">

<div class="table-header">
<h2>Manage Jobs</h2>
<div class="table-actions">
<a href="post_job.php" class="table-action"><i class="bi bi-plus-circle"></i> Post New Job</a>
</div>
</div>

<div class="table-responsive">
<table class="table">
<tr>
<th>ID</th>
<th>Job Title</th>
<th>Location</th>
<th>Salary</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $row['job_id']; ?></td>
<td><?php echo $row['job_title']; ?></td>
<td><?php echo $row['location']; ?></td>
<td>₹ <?php echo $row['salary']; ?></td>
<td>
<a href="edit_job.php?id=<?php echo $row['job_id'];?>" class="table-action">Edit</a>
<a href="view_applicants.php?id=<?php echo $row['job_id'];?>" class="table-action">Applicants</a>
<a href="delete_job.php?id=<?php echo $row['job_id'];?>" class="table-action delete" onclick="return confirm('Delete this job?')">Delete</a>
</td>
</tr>
<?php } ?>

</table>
</div>
</div>

<a href="dashboard.php" class="admin-back"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>

</div>

</body>
</html>
