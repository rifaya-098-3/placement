<?php

include("../config/database.php");
include("../config/session.php");


if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}


$id=$_SESSION['student_id'];


$result=mysqli_query(
$conn,
"SELECT * FROM students WHERE student_id='$id'"
);


$student=mysqli_fetch_assoc($result);


$skills=explode(",",$student['skills']);

$app_result = mysqli_query($conn, "
SELECT status FROM applications
WHERE student_id='$id'
ORDER BY applied_at DESC
LIMIT 1
");

$app_status = "";
if($app_result && mysqli_num_rows($app_result) > 0)
{
    $app_row = mysqli_fetch_assoc($app_result);
    $app_status = $app_row['status'];
}

function step_class($step, $app_status)
{
    if($app_status == "Rejected")
    {
        return ($step == "applied") ? "status done" : "status rejected";
    }
    if($app_status == "Selected")
    {
        return "status done";
    }
    if($app_status == "Pending")
    {
        return ($step == "applied") ? "status done" : "status";
    }
    return "status";
}

?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
Student Profile | CareerConnect
</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">


<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>


<body>



<div class="app profile-app">



<!-- TOP NAV -->


<header class="header">


<div class="brand">
CareerConnect
</div>


<div class="portal">
Student Portal
</div>


</header>







<!-- PROFILE INTRO -->


<section class="intro">


<div class="intro-left">


<div class="avatar">

<i class="bi bi-person-fill"></i>

</div>



<div>


<h1>

<?php echo $student['full_name']; ?>

</h1>


<p>

<?php echo $student['branch']; ?>

</p>


<span>

AI Student

</span>


</div>


</div>





<div class="completion">


<p>
Profile Completion
</p>


<h2>
85%
</h2>


<div class="line">

<div></div>

</div>


</div>



</section>








<!-- MAIN AREA -->


<div class="content">





<div class="left">





<section>


<h3>
Personal Information
</h3>


<div class="details">


<p>
<label>Name</label>

<?php echo $student['full_name']; ?>

</p>



<p>
<label>Email</label>

<?php echo $student['email']; ?>

</p>




<p>
<label>Phone</label>

<?php echo $student['phone']; ?>

</p>



<p>
<label>Department</label>

<?php echo $student['branch']; ?>

</p>



<p>
<label>CGPA</label>

<?php echo $student['cgpa']; ?>

</p>


</div>


</section>








<section>


<h3>
Career Skills
</h3>


<div class="skills">


<?php

foreach($skills as $skill)
{

echo "

<span>
".trim($skill)."
</span>

";

}

?>


</div>


</section>







<section>


<h3>
About
</h3>


<p class="about">


<?php

if(!empty($student['address']))
{
echo $student['address'];
}
else
{
echo "Add your professional summary.";
}

?>


</p>


</section>



</div>









<div class="right">





<div class="side-box">


<h3>
Resume
</h3>


<i class="bi bi-file-earmark-text"></i>


<p>
Keep your resume updated for recruiters.
</p>


<a href="upload_resume.php" class="upload-btn">
Upload Resume
</a>


</div>








<div class="side-box">


<h3>
Placement Status
</h3>



<div class="<?php echo step_class('applied', $app_status); ?>">

<i class="bi bi-send"></i>

Applied

</div>


<div class="<?php echo step_class('review', $app_status); ?>">

<i class="bi bi-eye"></i>

Under Review

</div>



<div class="<?php echo step_class('interview', $app_status); ?>">

<i class="bi bi-people"></i>

Interview

</div>



<div class="<?php echo step_class('selected', $app_status); ?>">

<i class="bi bi-trophy"></i>

<?php echo ($app_status == "Rejected") ? "Rejected" : "Selected"; ?>

</div>



</div>







</div>


</div>






</div>


</body>


</html>

