<?php
include("../config/database.php");

$message="";

if(isset($_POST['register']))
{
    $company_name = trim($_POST['company_name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = trim($_POST['phone']);
    $website = trim($_POST['website']);
    $industry = trim($_POST['industry']);
    $location = trim($_POST['location']);
    $description = trim($_POST['description']);

    $logo = "";

    if(!empty($_FILES['logo']['name']))
    {
        $logo = time()."_".basename($_FILES['logo']['name']);
        move_uploaded_file($_FILES['logo']['tmp_name'], "../uploads/company_logo/".$logo);
    }

    $check = mysqli_prepare($conn,"SELECT company_id FROM companies WHERE email=?");
    mysqli_stmt_bind_param($check,"s",$email);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if(mysqli_stmt_num_rows($check)>0)
    {
        $message="Email already exists.";
    }
    else
    {
        $sql="INSERT INTO companies(company_name,email,password,phone,website,industry,location,description,logo)
              VALUES(?,?,?,?,?,?,?,?,?)";

        $stmt=mysqli_prepare($conn,$sql);

        mysqli_stmt_bind_param($stmt,"sssssssss",
        $company_name,
        $email,
        $password,
        $phone,
        $website,
        $industry,
        $location,
        $description,
        $logo
        );

        if(mysqli_stmt_execute($stmt))
        {
            $message="Company Registered Successfully.";
        }
        else
        {
            $message="Registration Failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Company Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="background"></div>

<div class="overlay"></div>

<div class="register-container">

<div class="register-card">

<div class="logo">

<i class="bi bi-buildings-fill"></i>

</div>

<h1>CareerConnect</h1>

<p class="subtitle">

Create your company account

</p>

<?php

if($message!="")

{

?>

<div class="alert alert-info">

<?php echo $message; ?>

</div>

<?php

}

?>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">
Company Name
</label>

<input
type="text"
name="company_name"
class="form-control"
placeholder="Enter Company Name"
required>

</div>

<div class="mb-3">

<label class="form-label">
Email Address
</label>

<input
type="email"
name="email"
class="form-control"
placeholder="company@example.com"
required>

</div>

<div class="mb-3">

<label class="form-label">
Password
</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Create Password"
required>

</div>

<div class="mb-3">

<label class="form-label">
Phone Number
</label>

<input
type="text"
name="phone"
class="form-control"
placeholder="+91 9876543210">

</div>

<div class="mb-3">

<label class="form-label">
Website
</label>

<input
type="text"
name="website"
class="form-control"
placeholder="https://company.com">

</div>

<div class="mb-3">

<label class="form-label">
Industry
</label>

<input
type="text"
name="industry"
class="form-control"
placeholder="Software Development">

</div>

<div class="mb-3">

<label class="form-label">
Location
</label>

<input
type="text"
name="location"
class="form-control"
placeholder="Chennai, Tamil Nadu">

</div>

<div class="mb-3">

<label class="form-label">
Company Description
</label>

<textarea
name="description"
class="form-control"
rows="4"
placeholder="Tell students about your company..."></textarea>

</div>

<div class="mb-4">

<label class="form-label">
Company Logo
</label>

<input
type="file"
name="logo"
class="form-control">

</div>

<button
type="submit"
name="register"
class="register-btn">

Create Company Account

</button>

<div class="bottom-text">

Already have an account?

<a href="login.php">

Login

</a>

</div>

</form>

</div>

</div>

</body>

</html>