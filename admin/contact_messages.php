<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['admin_id']))
{
    header("Location:login.php");
    exit();
}

$result = mysqli_query($conn,"
SELECT *
FROM contact_messages
ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>Contact Messages</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">

</head>

<body>

<div class="admin-topbar">
<div class="brand"><span class="dot"></span> CareerConnect Admin</div>
<a href="logout.php" class="logout-link"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<div class="admin-container">

<div class="table-card">

<div class="table-header">
<h2>Contact Messages</h2>
</div>

<div class="table-responsive">
<table class="table">
<tr>
<th>Name</th>
<th>Email</th>
<th>Subject</th>
<th>Message</th>
<th>Date</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['subject']; ?></td>
<td><?php echo $row['message']; ?></td>
<td><?php echo $row['created_at']; ?></td>
</tr>
<?php } ?>

</table>
</div>
</div>

<a href="dashboard.php" class="admin-back"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>

</div>

</body>
</html>
