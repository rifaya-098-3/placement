<?php
include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['company_id']))
{
    header("Location:login.php");
    exit();
}

$message="";

if(isset($_POST['post_job']))
{
    $company_id=$_SESSION['company_id'];
    $job_title=$_POST['job_title'];
    $location=$_POST['location'];
    $salary=$_POST['salary'];
    $job_type=$_POST['job_type'];
    $skills=$_POST['skills'];
    $cgpa=$_POST['cgpa'];
    $description=$_POST['description'];
    $last_date=$_POST['last_date'];

    $stmt=mysqli_prepare($conn,"
    INSERT INTO jobs
    (company_id,job_title,location,salary,job_type,skills,cgpa,description,last_date)
    VALUES(?,?,?,?,?,?,?,?,?)");

    mysqli_stmt_bind_param(
    $stmt,
    "isssdssss",
    $company_id,
    $job_title,
    $location,
    $salary,
    $job_type,
    $skills,
    $cgpa,
    $description,
    $last_date
    );

   if(mysqli_stmt_execute($stmt))
{
    $message="Job Posted Successfully";
}
else
{
   $message = mysqli_stmt_error($stmt);
}
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Post Job</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>Post New Job</h3>

</div>

<div class="card-body">

<?php
if($message!="")
{
echo "<div class='alert alert-success'>$message</div>";
}
?>

<form method="POST">

<label>Job Title</label>
<input
type="text"
name="job_title"
class="form-control mb-3"
required>

<label>Location</label>
<input
type="text"
name="location"
class="form-control mb-3"
required>

<label>Salary</label>
<input
type="number"
name="salary"
class="form-control mb-3"
required>

<label>Job Type</label>

<select
name="job_type"
class="form-control mb-3">

<option>Internship</option>

<option>Placement</option>

</select>

<label>Required Skills</label>

<input
type="text"
name="skills"
class="form-control mb-3">

<label>Minimum CGPA</label>

<input
type="number"
step="0.01"
name="cgpa"
class="form-control mb-3">

<label>Description</label>

<textarea
name="description"
class="form-control mb-3"
rows="5"></textarea>

<label>Last Date</label>

<input
type="date"
name="last_date"
class="form-control mb-3">

<button
class="btn btn-primary"
name="post_job">

Post Job

</button>

<a
href="dashboard.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</body>

</html>