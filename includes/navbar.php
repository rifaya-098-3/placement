<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>CareerConnect | Placement & Internship Platform</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="/placement/assets/css/app.css?v=3">
<link rel="stylesheet" href="/placement/assets/css/site.css?v=3">

</head>

<body class="site">

<?php
$current = basename($_SERVER['PHP_SELF']);
function nav_active($page, $current) { return $page === $current ? 'active' : ''; }
?>

<nav class="site-nav">
<div class="container">

<a class="brand" href="/placement/index.php">
<span class="dot"></span>
CareerConnect
</a>

<div class="nav-links" id="navLinks">
<a href="/placement/index.php" class="<?php echo nav_active('index.php', $current); ?>">Home</a>
<a href="/placement/about.php" class="<?php echo nav_active('about.php', $current); ?>">About</a>
<a href="/placement/contact.php" class="<?php echo nav_active('contact.php', $current); ?>">Contact</a>
<a href="/placement/faq.php" class="<?php echo nav_active('faq.php', $current); ?>">FAQ</a>
<a href="/placement/student/login.php">Student</a>
<a href="/placement/company/login.php">Company</a>
<a href="/placement/admin/login.php">Admin</a>
</div>

<div class="nav-cta">
<a href="/placement/student/login.php" class="btn btn-outline">Log In</a>
<a href="/placement/student/register.php" class="btn btn-primary">Get Started</a>
<button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
<i class="bi bi-list"></i>
</button>
</div>

</div>
</nav>
