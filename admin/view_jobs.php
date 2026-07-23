<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location:login.php");
    exit();
}

$result=mysqli_query($conn,"
SELECT jobs.*,companies.company_name
FROM jobs
JOIN companies
ON jobs.company_id=companies.company_id
ORDER BY job_id DESC");

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Manage Jobs</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="admin-topbar">
<div class="brand"><span class="dot"></span> CareerConnect Admin</div>
<a href="logout.php" class="logout-link"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<div class="admin-container">

<div class="table-card">

<div class="table-header">
<h2>Manage Jobs</h2>
</div>

<div class="table-responsive">
<table class="table">
<tr>
<th>ID</th>
<th>Company</th>
<th>Job</th>
<th>Location</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['job_id']; ?></td>
<td><?php echo $row['company_name']; ?></td>
<td><?php echo $row['job_title']; ?></td>
<td><?php echo $row['location']; ?></td>
<td><a href="delete_job.php?id=<?php echo $row['job_id']; ?>" class="table-action delete">Delete</a></td>
</tr>
<?php } ?>

</table>
</div>
</div>

<a href="dashboard.php" class="admin-back"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>

</div>

</body>
</html>
