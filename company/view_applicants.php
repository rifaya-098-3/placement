<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['company_id']))
{
    header("Location:login.php");
    exit();
}

$company_id = $_SESSION['company_id'];

$sql = "SELECT
applications.application_id,
applications.status,
applications.applied_at,

students.student_id,
students.full_name,
students.email,
students.phone,
students.branch,
students.cgpa,
students.skills,
students.resume,

jobs.job_title

FROM applications

JOIN students
ON applications.student_id = students.student_id

JOIN jobs
ON applications.job_id = jobs.job_id

WHERE jobs.company_id = ?

ORDER BY applications.applied_at DESC";

$stmt = mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"i",$company_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html>

<head>

<title>Job Applicants</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2 class="mb-4">Job Applicants</h2>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Branch</th>
<th>CGPA</th>
<th>Skills</th>
<th>Job</th>
<th>Status</th>
<th>Resume</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($result)>0)
{

while($row=mysqli_fetch_assoc($result))
{

$status = trim($row['status']);

if($status=="")
{
    $status="Pending";
}

?>

<tr>

<td><?php echo $row['full_name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['branch']; ?></td>

<td><?php echo $row['cgpa']; ?></td>

<td><?php echo $row['skills']; ?></td>

<td><?php echo $row['job_title']; ?></td>

<td>

<?php

if($status=="Pending")
{
    echo "<span class='badge bg-warning text-dark'>Pending</span>";
}
elseif($status=="Selected")
{
    echo "<span class='badge bg-success'>Selected</span>";
}
elseif($status=="Rejected")
{
    echo "<span class='badge bg-danger'>Rejected</span>";
}
else
{
    echo "<span class='badge bg-secondary'>$status</span>";
}

?>

</td>

<td>

<?php

if(!empty($row['resume']))
{
?>

<a href="download_resume.php?student_id=<?php echo $row['student_id']; ?>" class="btn btn-info btn-sm">

Download

</a>

<?php
}
else
{
    echo "<span class='text-danger'>No Resume</span>";
}
?>

</td>

<td>

<?php

if($status=="Pending")
{
?>

<a href="select_student.php?id=<?php echo $row['application_id']; ?>" class="btn btn-success btn-sm">

Select

</a>

<a href="reject_student.php?id=<?php echo $row['application_id']; ?>" class="btn btn-danger btn-sm">

Reject

</a>

<?php
}
else
{
    echo "<b>-</b>";
}
?>

</td>

</tr>

<?php

}

}
else
{

?>

<tr>

<td colspan="10" class="text-center">

No Applicants Found

</td>

</tr>

<?php

}

?>

</tbody>

</table>

<a href="dashboard.php" class="btn btn-secondary">

Back to Dashboard

</a>

</div>

</body>

</html>