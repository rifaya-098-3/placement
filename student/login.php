<?php

include("../config/database.php");
include("../config/session.php");


$message = "";


if(isset($_POST['login']))
{

    $email = trim($_POST['email']);
    $password = $_POST['password'];


    $sql = "SELECT * FROM students WHERE email=?";


    $stmt = mysqli_prepare($conn,$sql);

    mysqli_stmt_bind_param($stmt,"s",$email);

    mysqli_stmt_execute($stmt);


    $result = mysqli_stmt_get_result($stmt);



    if(mysqli_num_rows($result)==1)
    {

        $student = mysqli_fetch_assoc($result);



        if(password_verify($password,$student['password']))
        {


            $_SESSION['student_id'] = $student['student_id'];

            $_SESSION['student_name'] = $student['name'];



            header("Location:dashboard.php");

            exit();


        }

        else
        {

            $message="Invalid Password.";

        }



    }

    else
    {

        $message="Email Not Found.";

    }

}

?>


<!DOCTYPE html>

<html lang="en">


<head>


<meta charset="UTF-8">


<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Student Login</title>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">


</head>



<body>



<div class="login-page">



<div class="left-panel">


<div class="brand">


<h1>CareerConnect</h1>


<p>

Build Skills.<br>

Find Opportunities.

</p>


</div>




<div class="features">


<div>

<i class="bi bi-check-circle-fill"></i>

<span>Create Professional Profile</span>

</div>



<div>

<i class="bi bi-check-circle-fill"></i>

<span>Apply For Jobs & Internships</span>

</div>




<div>

<i class="bi bi-check-circle-fill"></i>

<span>Upload Resume Easily</span>

</div>




<div>

<i class="bi bi-check-circle-fill"></i>

<span>Track Application Status</span>

</div>



</div>



</div>





<div class="right-panel">



<div class="login-card">



<div class="login-header">


<h2>

Student Login

</h2>



<p>

Welcome back! Continue your career journey.

</p>



</div>




<?php

if($message!="")
{

?>

<div class="alert alert-danger">

<?php echo $message; ?>

</div>


<?php

}

?>





<form method="POST">



<div class="mb-3">


<label>Email Address</label>


<div class="input-group">


<span class="input-group-text">

<i class="bi bi-envelope"></i>

</span>



<input

type="email"

name="email"

class="form-control"

placeholder="student@example.com"

required>


</div>


</div>






<div class="mb-4">


<label>Password</label>


<div class="input-group">


<span class="input-group-text">


<i class="bi bi-lock"></i>


</span>




<input

type="password"

name="password"

class="form-control"

placeholder="Enter Password"

required>


</div>


</div>






<button

type="submit"

name="login"

class="btn btn-primary btn-login w-100">


<i class="bi bi-box-arrow-in-right"></i>


Login


</button>






<div class="text-center mt-4">


<p class="mb-2 text-muted">


Don't have a student account?


</p>



<a href="register.php" class="register-link">


Register Here


</a>



</div>



</form>



</div>


</div>



</div>



</body>


</html>