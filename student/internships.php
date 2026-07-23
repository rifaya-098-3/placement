<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
header("Location:login.php");
exit();
}

$sql="SELECT internships.*,companies.company_name

FROM internships

JOIN companies

ON internships.company_id=companies.company_id

ORDER BY internship_id DESC";

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html>

<head>

<title>Internships</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="container mt-5">

<h2>

Available Internships

</h2>

<div class="row">

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<div class="col-md-6">

<div class="card shadow mb-4">

<div class="card-body">

<h4>

<?php echo $row['title']; ?>

</h4>

<p>

<b>Company :</b>

<?php echo $row['company_name']; ?>

</p>

<p>

<b>Duration :</b>

<?php echo $row['duration']; ?>

</p>

<p>

<b>Location :</b>

<?php echo $row['location']; ?>

</p>

<p>

<b>Stipend :</b>

₹ <?php echo $row['stipend']; ?>

</p>

<p>

<b>Skills :</b>

<?php echo $row['skills']; ?>

</p>

<p>

<b>Last Date :</b>

<?php echo $row['last_date']; ?>

</p>

<a
href="apply_internship.php?id=<?php echo $row['internship_id'];?>"
class="btn btn-success">

Apply

</a>

</div>

</div>

</div>

<?php

}

?>

</div>

</div>

</body>

</html>