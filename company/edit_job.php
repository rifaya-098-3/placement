<?php
include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['company_id']))
{
    header("Location:login.php");
    exit();
}

$id=$_GET['id'];

$result=mysqli_query($conn,"SELECT * FROM jobs WHERE job_id='$id'");
$job=mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{

$title=$_POST['job_title'];
$description=$_POST['job_description'];
$location=$_POST['location'];
$salary=$_POST['salary'];
$cgpa=$_POST['cgpa'];
$skills=$_POST['skills'];
$last_date=$_POST['last_date'];

mysqli_query($conn,"
UPDATE jobs SET

job_title='$title',
job_description='$description',
location='$location',
salary='$salary',
cgpa='$cgpa',
skills='$skills',
last_date='$last_date'

WHERE job_id='$id'
");

header("Location:manage_jobs.php");

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Job</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>Edit Job</h3>

</div>

<div class="card-body">

<form method="POST">

<input
class="form-control mb-3"
name="job_title"
value="<?php echo $job['job_title'];?>">

<textarea
class="form-control mb-3"
name="job_description"><?php echo $job['job_description'];?></textarea>

<input
class="form-control mb-3"
name="location"
value="<?php echo $job['location'];?>">

<input
class="form-control mb-3"
name="salary"
value="<?php echo $job['salary'];?>">

<input
class="form-control mb-3"
name="cgpa"
value="<?php echo $job['cgpa'];?>">

<textarea
class="form-control mb-3"
name="skills"><?php echo $job['skills'];?></textarea>

<input
type="date"
class="form-control mb-3"
name="last_date"
value="<?php echo $job['last_date'];?>">

<button
class="btn btn-success"
name="update">

Update Job

</button>

</form>

</div>

</div>

</div>

</body>

</html>