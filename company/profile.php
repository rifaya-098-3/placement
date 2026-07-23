<?php
include("../config/database.php");
include("../config/session.php");

if (!isset($_SESSION['company_id'])) {
    header("Location: login.php");
    exit();
}

$company_id = $_SESSION['company_id'];

if (isset($_POST['update'])) {

    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $industry = $_POST['industry'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $stmt = mysqli_prepare($conn, "UPDATE companies SET company_name=?, email=?, website=?, industry=?, location=?, description=? WHERE company_id=?");

    mysqli_stmt_bind_param($stmt, "ssssssi",
        $company_name,
        $email,
        $website,
        $industry,
        $location,
        $description,
        $company_id
    );

    if (mysqli_stmt_execute($stmt)) {
        $message = "Profile Updated Successfully";
    }
}

$stmt = mysqli_prepare($conn, "SELECT * FROM companies WHERE company_id=?");
mysqli_stmt_bind_param($stmt, "i", $company_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$company = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>

<title>Company Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Company Profile</h3>

</div>

<div class="card-body">

<?php
if(isset($message))
{
    echo "<div class='alert alert-success'>$message</div>";
}
?>

<form method="POST">

<label>Company Name</label>
<input type="text" name="company_name" class="form-control mb-3"
value="<?php echo $company['company_name']; ?>">

<label>Email</label>
<input type="email" name="email" class="form-control mb-3"
value="<?php echo $company['email']; ?>">

<label>Website</label>
<input type="text" name="website" class="form-control mb-3"
value="<?php echo $company['website']; ?>">

<label>Industry</label>
<input type="text" name="industry" class="form-control mb-3"
value="<?php echo $company['industry']; ?>">

<label>Location</label>
<input type="text" name="location" class="form-control mb-3"
value="<?php echo $company['location']; ?>">

<label>Description</label>
<textarea name="description" class="form-control mb-3"><?php echo $company['description']; ?></textarea>

<button name="update" class="btn btn-primary">
Update Profile
</button>

<a href="dashboard.php" class="btn btn-secondary">
Back
</a>

</form>

</div>

</div>

</div>

</body>
</html>