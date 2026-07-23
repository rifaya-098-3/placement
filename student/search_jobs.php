<?php
include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

$search="";

if(isset($_GET['search']))
{
    $search=$_GET['search'];
}

$stmt=mysqli_prepare($conn,"
SELECT jobs.*,companies.company_name
FROM jobs
JOIN companies
ON jobs.company_id=companies.company_id

WHERE
job_title LIKE ?
OR company_name LIKE ?
OR location LIKE ?

ORDER BY jobs.created_at DESC");

$keyword="%".$search."%";

mysqli_stmt_bind_param($stmt,"sss",$keyword,$keyword,$keyword);

mysqli_stmt_execute($stmt);

$result=mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>

<html>

<head>

<title>Search Jobs</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2>Search Jobs</h2>

<form method="GET">

<div class="input-group mb-4">

<input
type="text"
name="search"
class="form-control"
placeholder="Search by Job, Company or Location"
value="<?php echo htmlspecialchars($search); ?>">

<button class="btn btn-primary">

Search

</button>

</div>

</form>

<div class="row">

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<div class="col-md-6">

<div class="card shadow mb-4">

<div class="card-body">

<h4><?php echo $row['job_title']; ?></h4>

<p><b>Company:</b> <?php echo $row['company_name']; ?></p>

<p><b>Location:</b> <?php echo $row['location']; ?></p>

<p><b>Salary:</b> ₹<?php echo $row['salary']; ?></p>

<p><b>Work Mode:</b> <?php echo $row['work_mode']; ?></p>

<a href="apply.php?job_id=<?php echo $row['job_id']; ?>" class="btn btn-success">

Apply

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</body>

</html>