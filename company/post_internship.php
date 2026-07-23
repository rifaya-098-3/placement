<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['company_id']))
{
    header("Location:login.php");
    exit();
}

$message="";
$messageType="success";

if(isset($_POST['post']))
{
    $company_id=$_SESSION['company_id'];

    $title=trim($_POST['title']);
    $location=trim($_POST['location']);
    $duration=trim($_POST['duration']);
    $stipend=trim($_POST['stipend']);
    $skills=trim($_POST['skills']);
    $last_date=$_POST['last_date'];

    $stmt=mysqli_prepare($conn,"
    INSERT INTO internships
    (company_id,title,location,duration,stipend,skills,last_date)
    VALUES(?,?,?,?,?,?,?)");

    mysqli_stmt_bind_param(
    $stmt,
    "issssss",
    $company_id,
    $title,
    $location,
    $duration,
    $stipend,
    $skills,
    $last_date
    );

    if(mysqli_stmt_execute($stmt))
    {
        $message="Internship Posted Successfully.";
    }
    else
    {
        $message="Failed to Post Internship.";
        $messageType="danger";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Post Internship</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3 class="mb-0">Post Internship</h3>

</div>

<div class="card-body">

<?php
if($message!="")
{
?>
<div class="alert alert-<?php echo $messageType; ?>">
<?php echo $message; ?>
</div>
<?php
}
?>

<form method="POST">

<label class="form-label">Internship Title</label>

<input
type="text"
name="title"
class="form-control mb-3"
required>

<label class="form-label">Location</label>

<input
type="text"
name="location"
class="form-control mb-3"
required>

<label class="form-label">Duration</label>

<input
type="text"
name="duration"
class="form-control mb-3"
placeholder="Example: 3 Months"
required>

<label class="form-label">Stipend</label>

<input
type="text"
name="stipend"
class="form-control mb-3"
placeholder="Example: ₹10000 / month"
required>

<label class="form-label">Required Skills</label>

<textarea
name="skills"
class="form-control mb-3"
rows="4"></textarea>

<label class="form-label">Last Date</label>

<input
type="date"
name="last_date"
class="form-control mb-4"
required>

<button
type="submit"
name="post"
class="btn btn-primary">

Post Internship

</button>

<button
type="reset"
class="btn btn-warning">

Clear

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

</div>

</div>

</body>

</html>