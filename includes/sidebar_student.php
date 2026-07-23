<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">

    <div class="logo">

        <i class="bi bi-mortarboard-fill"></i>

        <div>
            <h2>Career<span>Connect</span></h2>
            <small>Student Portal</small>
        </div>

    </div>

    <nav class="sidebar-menu">

        <a href="dashboard.php"
           class="<?= ($current_page=="dashboard.php") ? "active" : "" ?>">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>

        <a href="view_jobs.php"
           class="<?= ($current_page=="view_jobs.php") ? "active" : "" ?>">
            <i class="bi bi-briefcase-fill"></i>
            <span>Browse Jobs</span>
        </a>

        <a href="applications.php"
           class="<?= ($current_page=="applications.php") ? "active" : "" ?>">
            <i class="bi bi-send-check-fill"></i>
            <span>Applications</span>
        </a>

        <a href="saved_job.php"
           class="<?= ($current_page=="saved_job.php") ? "active" : "" ?>">
            <i class="bi bi-bookmark-fill"></i>
            <span>Saved Jobs</span>
        </a>

        <a href="upload_resume.php"
           class="<?= ($current_page=="upload_resume.php") ? "active" : "" ?>">
            <i class="bi bi-file-earmark-arrow-up-fill"></i>
            <span>Resume</span>
        </a>

        <a href="notifications.php"
           class="<?= ($current_page=="notifications.php") ? "active" : "" ?>">
            <i class="bi bi-bell-fill"></i>
            <span>Notifications</span>
        </a>

        <a href="profile.php"
           class="<?= ($current_page=="profile.php") ? "active" : "" ?>">
            <i class="bi bi-person-circle"></i>
            <span>My Profile</span>
        </a>

        <a href="settings.php"
           class="<?= ($current_page=="settings.php") ? "active" : "" ?>">
            <i class="bi bi-gear-fill"></i>
            <span>Settings</span>
        </a>

    </nav>

    <div class="sidebar-footer">

        <a href="logout.php" class="btn btn-secondary logout-btn">

            <i class="bi bi-box-arrow-right"></i>

            <span>Logout</span>

        </a>

    </div>

</div>