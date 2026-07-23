<?php
include("../config/database.php");

$message = "";

if(isset($_POST['register']))
{
    $name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = trim($_POST['phone']);
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $branch = $_POST['branch'];
    $cgpa = $_POST['cgpa'];
    $skills = trim($_POST['skills']);
    $address = trim($_POST['address']);

    // Check duplicate email
    $check = mysqli_prepare($conn,"SELECT student_id FROM students WHERE email=?");
    mysqli_stmt_bind_param($check,"s",$email);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if(mysqli_stmt_num_rows($check)>0)
    {
        $message="Email already exists!";
    }
    else
    {
        $photo="";

        if(!empty($_FILES['photo']['name']))
        {
            $photo=time()."_".basename($_FILES['photo']['name']);
            move_uploaded_file($_FILES['photo']['tmp_name'],"../uploads/photos/".$photo);
        }

        $sql="INSERT INTO students(full_name,email,password,phone,gender,dob,branch,cgpa,skills,address,photo)
              VALUES(?,?,?,?,?,?,?,?,?,?,?)";

        $stmt=mysqli_prepare($conn,$sql);

        mysqli_stmt_bind_param($stmt,"sssssssdsss",
        $name,
        $email,
        $password,
        $phone,
        $gender,
        $dob,
        $branch,
        $cgpa,
        $skills,
        $address,
        $photo
        );

        if(mysqli_stmt_execute($stmt))
        {
            $message="Registration Successful!";
        }
        else
        {
            $message="Something went wrong.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="register-container">
<div class="background"></div>

<div class="overlay">
<div class="register-card">

<div class="logo"><i class="bi bi-mortarboard-fill"></i> CareerConnect</div>
<p class="subtitle">Create your student profile and start applying to jobs and internships.</p>

<?php
if($message!="")
{
    $cls = ($message == "Registration Successful!") ? "alert-info" : "alert-info";
    echo "<div class='$cls'>$message</div>";
}
?>

<form method="POST" enctype="multipart/form-data">

<div class="form-grid">

<div class="mb-3">
<label class="form-label">Full Name</label>
<input type="text" name="full_name" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Phone</label>
<input type="text" name="phone" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Gender</label>
<select name="gender" class="form-select">
<option>Male</option>
<option>Female</option>
<option>Other</option>
</select>
</div>

<div class="mb-3">
<label class="form-label">Date of Birth</label>
<input type="date" name="dob" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Branch</label>
<input type="text" name="branch" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">CGPA</label>
<input type="number" step="0.01" name="cgpa" class="form-control">
</div>

<div class="mb-3 full">
<label class="form-label">Skills</label>
<textarea name="skills" class="form-control"></textarea>
</div>

<div class="mb-3 full">
<label class="form-label">Address</label>
<textarea name="address" class="form-control"></textarea>
</div>

<div class="mb-3 full">
<label class="form-label">Profile Photo</label>
<input type="file" name="photo" class="form-control">
</div>

<div class="full">
<button class="register-btn" name="register">
<i class="bi bi-check-circle"></i> Register
</button>
</div>

</div>

</form>

<p class="bottom-text">Already have an account? <a href="login.php">Log in</a></p>

</div>
</div>
</div>

</body>
</html>
