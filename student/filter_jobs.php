<?php
include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

$where=[];

if(!empty($_GET['location']))
{
    $location=mysqli_real_escape_string($conn,$_GET['location']);
    $where[]="jobs.location='$location'";
}

if(!empty($_GET['work_mode']))
{
    $mode=mysqli_real_escape_string($conn,$_GET['work_mode']);
    $where[]="jobs.work_mode='$mode'";
}

$sql="SELECT jobs.*,companies.company_name
FROM jobs
JOIN companies
ON jobs.company_id=companies.company_id";

if(count($where)>0)
{
    $sql.=" WHERE ".implode(" AND ",$where);
}

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html>

<head>

<title>Filter Jobs</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="container mt-5">

<h2>Filter Jobs</h2>

<form>

<div class="row">

<div class="col-md-5">

<input
class="form-control"
name="location"
placeholder="Location">

</div>

<div class="col-md-5">

<select
class="form-control"
name="work_mode">

<option value="">All</option>

<option>Remote</option>

<option>Hybrid</option>

<option>Onsite</option>

</select>

</div>

<div class="col-md-2">

<button class="btn btn-primary w-100">

Filter

</button>

</div>

</div>

</form>

<hr>

<table class="table table-bordered">

<tr>

<th>Company</th>

<th>Job</th>

<th>Location</th>

<th>Mode</th>

<th>Salary</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['company_name']; ?></td>

<td><?php echo $row['job_title']; ?></td>

<td><?php echo $row['location']; ?></td>

<td><?php echo $row['work_mode']; ?></td>

<td>₹<?php echo $row['salary']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>