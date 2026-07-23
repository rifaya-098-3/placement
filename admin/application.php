<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location:login.php");
    exit();
}

$sql="SELECT

applications.application_id,
applications.status,
applications.applied_at,

students.full_name,

companies.company_name,

jobs.job_title

FROM applications

JOIN students
ON applications.student_id=students.student_id

JOIN jobs
ON applications.job_id=jobs.job_id

JOIN companies
ON jobs.company_id=companies.company_id

ORDER BY applications.applied_at DESC";

$result=mysqli_query($conn,$sql);

$total=mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>All Applications</title>

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
<h2>All Applications</h2>
<div class="table-actions"><span style="color:var(--text-muted);font-size:14px;">Total: <?php echo $total; ?></span></div>
</div>

<div class="table-responsive">
<table class="table">
<tr>
<th>ID</th>
<th>Student</th>
<th>Company</th>
<th>Job</th>
<th>Status</th>
<th>Applied On</th>
</tr>

<?php
if($total>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
?>
<tr>
<td><?php echo $row['application_id']; ?></td>
<td><?php echo $row['full_name']; ?></td>
<td><?php echo $row['company_name']; ?></td>
<td><?php echo $row['job_title']; ?></td>
<td>
<?php
if($row['status']=="Pending")
{
    echo "<span class='badge bg-warning'>Pending</span>";
}
elseif($row['status']=="Selected")
{
    echo "<span class='badge bg-success'>Selected</span>";
}
else
{
    echo "<span class='badge bg-danger'>Rejected</span>";
}
?>
</td>
<td><?php echo $row['applied_at']; ?></td>
</tr>
<?php
    }
}
else
{
?>
<tr>
<td colspan="6" style="text-align:center;color:var(--text-muted);">No Applications Found</td>
</tr>
<?php
}
?>

</table>
</div>
</div>

<a href="dashboard.php" class="admin-back"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>

</div>

</body>
</html>
