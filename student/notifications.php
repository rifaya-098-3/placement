<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
header("Location:login.php");
exit();
}

$id=$_SESSION['student_id'];

$stmt=mysqli_prepare($conn,"
SELECT *
FROM notifications
WHERE student_id=?
ORDER BY created_at DESC");

mysqli_stmt_bind_param($stmt,"i",$id);

mysqli_stmt_execute($stmt);

$result=mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Notifications | CareerConnect</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

<<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="app">

<?php include("../includes/sidebar_student.php"); ?>

<main class="main">

<?php include("../includes/topbar_student.php"); ?>

<div class="notification-page">

<div class="page-header">

<h1>Notifications</h1>

<p>Latest updates from recruiters and placements.</p>

</div>

<?php while($notification=mysqli_fetch_assoc($result)){ ?>

<div class="notification-card">

<div class="notify-icon">

<i class="bi bi-bell-fill"></i>

</div>

<div class="notify-content">

<h3>

<?php echo $notification['title']; ?>

</h3>

<p>

<?php echo $notification['message']; ?>

</p>

<span>

<?php echo $notification['created_at']; ?>

</span>

</div>

</div>

<?php } ?>

</div>

</main>

</div>

</body>

</html>