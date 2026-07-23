<?php

include("../config/database.php");
include("../config/session.php");


$message="";


if(isset($_POST['login']))
{

    $email = trim($_POST['email']);
    $password = $_POST['password'];



    $sql="SELECT * FROM admin WHERE email=?";


    $stmt=mysqli_prepare($conn,$sql);

    mysqli_stmt_bind_param($stmt,"s",$email);

    mysqli_stmt_execute($stmt);


    $result=mysqli_stmt_get_result($stmt);



    if(mysqli_num_rows($result)==1)
    {

        $admin=mysqli_fetch_assoc($result);



        if(password_verify($password,$admin['password']))
        {


            $_SESSION['admin_id']=$admin['admin_id'];

            $_SESSION['admin_name']=$admin['name'];



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


<title>Admin Login</title>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">



<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">


</head>




<body>



<div class="login-page">



<div class="left-panel">


<div class="brand">


<h1>
CareerConnect
</h1>


<p>

Manage Better.<br>

Control Smarter.

</p>


</div>





<div class="features">


<div>

<i class="bi bi-check-circle-fill"></i>

<span>Manage Students & Companies</span>

</div>



<div>

<i class="bi bi-check-circle-fill"></i>

<span>Monitor Placement Activities</span>

</div>




<div>

<i class="bi bi-check-circle-fill"></i>

<span>Approve Job Opportunities</span>

</div>



<div>

<i class="bi bi-check-circle-fill"></i>

<span>Generate Placement Reports</span>

</div>


</div>



</div>







<div class="right-panel">



<div class="login-card">



<div class="login-header">


<h2>
Admin Login
</h2>


<p>
Welcome administrator. Access your control panel.
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

<i class="bi bi-person-lock"></i>

</span>




<input

type="email"

name="email"

class="form-control"

placeholder="admin@example.com"

required>



</div>


</div>








<div class="mb-4">


<label>Password</label>


<div class="input-group">


<span class="input-group-text">

<i class="bi bi-shield-lock"></i>

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





</form>



</div>


</div>



</div>



</body>

</html>