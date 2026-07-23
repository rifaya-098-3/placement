<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

$id = $_SESSION['student_id'];

$message = "";

if(isset($_POST['update_profile']))
{
    $phone = trim($_POST['phone']);
    $branch = trim($_POST['branch']);
    $cgpa = $_POST['cgpa'];
    $skills = trim($_POST['skills']);
    $address = trim($_POST['address']);

    $stmt = mysqli_prepare($conn, "
    UPDATE students
    SET phone=?, branch=?, cgpa=?, skills=?, address=?
    WHERE student_id=?");

    mysqli_stmt_bind_param($stmt, "ssdssi", $phone, $branch, $cgpa, $skills, $address, $id);

    if(mysqli_stmt_execute($stmt))
    {
        $message = "<div class='alert-box success'>Profile updated successfully.</div>";
    }
    else
    {
        $message = "<div class='alert-box danger'>Something went wrong. Please try again.</div>";
    }
}

if(isset($_POST['update_password']))
{
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];

    $check = mysqli_query($conn, "SELECT password FROM students WHERE student_id='$id'");
    $row = mysqli_fetch_assoc($check);

    if(password_verify($current, $row['password']))
    {
        $hashed = password_hash($new, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "UPDATE students SET password=? WHERE student_id=?");
        mysqli_stmt_bind_param($stmt, "si", $hashed, $id);
        mysqli_stmt_execute($stmt);
        $message = "<div class='alert-box success'>Password updated successfully.</div>";
    }
    else
    {
        $message = "<div class='alert-box danger'>Current password is incorrect.</div>";
    }
}

$result = mysqli_query($conn, "SELECT * FROM students WHERE student_id='$id'");
$student = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Settings | CareerConnect</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/placement/assets/css/app.css">

</head>

<body>

<div class="app">

<?php include("../includes/sidebar_student.php"); ?>

<div class="main">

<div class="page-header">
<h1>Settings</h1>
<p>Update your profile details and password.</p>
</div>

<?php echo $message; ?>

<div class="settings-grid">

<div class="settings-card">
<h3>Profile Details</h3>

<form method="POST">

<div class="form-field">
<label>Phone</label>
<input type="text" name="phone" value="<?php echo htmlspecialchars($student['phone']); ?>">
</div>

<div class="form-field">
<label>Branch</label>
<input type="text" name="branch" value="<?php echo htmlspecialchars($student['branch']); ?>">
</div>

<div class="form-field">
<label>CGPA</label>
<input type="number" step="0.01" name="cgpa" value="<?php echo htmlspecialchars($student['cgpa']); ?>">
</div>

<div class="form-field">
<label>Skills (comma separated)</label>
<input type="text" name="skills" value="<?php echo htmlspecialchars($student['skills']); ?>">
</div>

<div class="form-field">
<label>Address</label>
<textarea name="address"><?php echo htmlspecialchars($student['address']); ?></textarea>
</div>

<button type="submit" name="update_profile" class="btn-save">
<i class="bi bi-check-circle"></i> Save Changes
</button>

</form>
</div>

<div class="settings-card">
<h3>Change Password</h3>

<form method="POST">

<div class="form-field">
<label>Current Password</label>
<input type="password" name="current_password" required>
</div>

<div class="form-field">
<label>New Password</label>
<input type="password" name="new_password" required>
</div>

<button type="submit" name="update_password" class="btn-save">
<i class="bi bi-shield-lock"></i> Update Password
</button>

</form>
</div>

</div>

</div>
</div>

</body>
</html>
