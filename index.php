<?php

include("config/database.php");

$students = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM students")
);

$companies = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM companies")
);

$jobs = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM jobs")
);

$applications = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM applications")
);

include("includes/navbar.php");

?>

<!-- ================= HERO ================= -->

<section class="hero">
<div class="container">

<div class="hero-content">

<span class="eyebrow"><i class="bi bi-stars"></i> Placement & Internship Platform</span>

<h1>Build your <span class="accent">career</span> on one connected platform</h1>

<p class="lead">
Students find internships and jobs, companies find verified talent,
and placement teams keep every stage of the process in one place —
no spreadsheets, no back-and-forth emails.
</p>

<div class="hero-actions">
<a href="/placement/student/register.php" class="btn btn-primary btn-lg">
<i class="bi bi-arrow-right"></i> Get Started as a Student
</a>
<a href="/placement/company/register.php" class="btn btn-outline btn-lg">
Register Your Company
</a>
</div>

<div class="hero-meta">
<div><b data-count="<?php echo (int)$students; ?>">0+</b><span>Registered Students</span></div>
<div><b data-count="<?php echo (int)$companies; ?>">0+</b><span>Partner Companies</span></div>
<div><b data-count="<?php echo (int)$jobs; ?>">0+</b><span>Open Roles</span></div>
</div>

</div>

<div class="path-graphic reveal">
<div class="path-label">How the placement journey works</div>

<svg class="path-svg" viewBox="0 0 400 230" xmlns="http://www.w3.org/2000/svg">

<path class="path-line" d="M40,190 C90,150 95,70 140,95 C185,120 215,175 260,130 C295,95 315,55 360,40" />
<path class="path-line-progress" d="M40,190 C90,150 95,70 140,95 C185,120 215,175 260,130 C295,95 315,55 360,40" />

<circle class="path-node" cx="40" cy="190" r="7" />
<circle class="path-node" cx="140" cy="95" r="7" />
<circle class="path-node" cx="260" cy="130" r="7" />
<circle class="path-node final" cx="360" cy="40" r="8" />

<text class="path-tag strong" x="14" y="212">Profile</text>
<text class="path-tag" x="118" y="76">Apply</text>
<text class="path-tag" x="222" y="152">Interview</text>
<text class="path-tag strong" x="322" y="24">Hired</text>

</svg>
</div>

</div>
</section>

<!-- ================= FEATURES ================= -->

<section id="features" class="section">
<div class="container">

<div class="section-title reveal">
<span class="eyebrow">What's inside</span>
<h2>Everything you need for your career</h2>
<p>A complete platform connecting students, companies and placement teams.</p>
</div>

<div class="features-grid">

<div class="feature-card reveal reveal-delay-1">
<div class="icon-wrap"><i class="bi bi-person-circle"></i></div>
<h4>Student Profile</h4>
<p>Build a professional profile, upload your resume and showcase your skills to recruiters.</p>
</div>

<div class="feature-card reveal reveal-delay-2">
<div class="icon-wrap"><i class="bi bi-building"></i></div>
<h4>Company Opportunities</h4>
<p>Explore jobs and internships posted directly by verified, registered companies.</p>
</div>

<div class="feature-card reveal reveal-delay-3">
<div class="icon-wrap"><i class="bi bi-send"></i></div>
<h4>Easy Applications</h4>
<p>Apply in a click and track every application's status from one dashboard.</p>
</div>

<div class="feature-card reveal reveal-delay-1">
<div class="icon-wrap"><i class="bi bi-file-earmark-person"></i></div>
<h4>Resume Management</h4>
<p>Upload, update and manage the resume recruiters see when they review you.</p>
</div>

<div class="feature-card reveal reveal-delay-2">
<div class="icon-wrap"><i class="bi bi-search"></i></div>
<h4>Smart Search</h4>
<p>Filter jobs and internships by skills, role and location to find the right fit fast.</p>
</div>

<div class="feature-card reveal reveal-delay-3">
<div class="icon-wrap"><i class="bi bi-graph-up"></i></div>
<h4>Career Growth</h4>
<p>Track your progress across applications and interviews in one clear view.</p>
</div>

</div>
</div>
</section>

<!-- ================= ROLE SHOWCASE ================= -->

<section class="section" style="padding-top:0;">
<div class="container">

<div class="section-title reveal">
<span class="eyebrow">Built for every role</span>
<h2>One platform, three points of view</h2>
<p>Students, companies and placement admins each get tools built for their part of the process.</p>
</div>

<div class="role-grid">

<div class="role-card reveal reveal-delay-1">
<span class="role-index">Student</span>
<h4><i class="bi bi-mortarboard"></i> For Students</h4>
<ul>
<li><i class="bi bi-check-circle-fill"></i> Create a profile and upload your resume</li>
<li><i class="bi bi-check-circle-fill"></i> Search and filter live job & internship listings</li>
<li><i class="bi bi-check-circle-fill"></i> Apply, save roles, and track application status</li>
</ul>
</div>

<div class="role-card reveal reveal-delay-2">
<span class="role-index">Company</span>
<h4><i class="bi bi-briefcase"></i> For Companies</h4>
<ul>
<li><i class="bi bi-check-circle-fill"></i> Post jobs and internships in minutes</li>
<li><i class="bi bi-check-circle-fill"></i> Review applicants and download resumes</li>
<li><i class="bi bi-check-circle-fill"></i> Shortlist or reject candidates from one dashboard</li>
</ul>
</div>

<div class="role-card reveal reveal-delay-3">
<span class="role-index">Admin</span>
<h4><i class="bi bi-shield-check"></i> For Placement Teams</h4>
<ul>
<li><i class="bi bi-check-circle-fill"></i> Approve and manage companies and job posts</li>
<li><i class="bi bi-check-circle-fill"></i> Monitor students, applications and messages</li>
<li><i class="bi bi-check-circle-fill"></i> Keep placement records accurate in one system</li>
</ul>
</div>

</div>
</div>
</section>

<!-- ================= STATISTICS ================= -->

<section class="section" style="padding-top:0;">
<div class="container">

<div class="stats-bar">

<div class="stat-box reveal reveal-delay-1">
<h2 data-count="<?php echo (int)$students; ?>">0+</h2>
<p>Registered Students</p>
</div>

<div class="stat-box reveal reveal-delay-2">
<h2 data-count="<?php echo (int)$companies; ?>">0+</h2>
<p>Partner Companies</p>
</div>

<div class="stat-box reveal reveal-delay-3">
<h2 data-count="<?php echo (int)$jobs; ?>">0+</h2>
<p>Available Jobs</p>
</div>

<div class="stat-box reveal reveal-delay-4">
<h2 data-count="<?php echo (int)$applications; ?>">0+</h2>
<p>Applications Sent</p>
</div>

</div>
</div>
</section>

<!-- ================= CTA ================= -->

<section class="section">
<div class="container">

<div class="cta-panel reveal">
<h2>Ready to start your career journey?</h2>
<p>Join students and companies already using CareerConnect to find the right fit.</p>
<a href="student/register.php" class="btn btn-primary btn-lg">Register Now</a>
</div>

</div>
</section>

<?php include("includes/footer.php"); ?>
