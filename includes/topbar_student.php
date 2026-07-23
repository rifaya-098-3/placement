<?php

if (!isset($student)) {

    include("../config/database.php");

    if (isset($_SESSION['student_id'])) {

        $student_id = $_SESSION['student_id'];

        $result = mysqli_query(
            $conn,
            "SELECT * FROM students WHERE student_id='$student_id'"
        );

        $student = mysqli_fetch_assoc($result);
    }
}

$current_page = basename($_SERVER['PHP_SELF']);

?>

<div class="topbar">

    <div class="search-box">

        <i class="bi bi-search"></i>

        <input
            type="text"
            placeholder="Search jobs, companies...">

    </div>

    <div class="top-right">

        <a href="notifications.php" class="icon-btn">

    <i class="bi bi-bell-fill"></i>

</a>

        <div class="profile-mini" id="profileBtn">

            <div class="user-avatar">

                <?php

                if(!empty($student['photo']) && file_exists("../uploads/photos/".$student['photo']))
                {

                ?>

                <img src="../uploads/photos/<?php echo $student['photo']; ?>">

                <?php

                }
                else
                {

                ?>

                <i class="bi bi-person-fill"></i>

                <?php } ?>

            </div>

            <div class="profile-info">

                <h5>

                    <?php echo htmlspecialchars($student['full_name']); ?>

                </h5>

                <span>

                    Student

                </span>

            </div>

            <i class="bi bi-chevron-down"></i>

        </div>

        <div class="profile-dropdown" id="profileMenu">

            <a href="profile.php">

                <i class="bi bi-person-circle"></i>

                My Profile

            </a>

            <a href="upload_resume.php">

                <i class="bi bi-file-earmark-arrow-up"></i>

                Resume

            </a>

            <a href="settings.php">

                <i class="bi bi-gear"></i>

                Settings

            </a>

            <hr>

            <a href="logout.php">

                <i class="bi bi-box-arrow-right"></i>

                Logout

            </a>

        </div>

    </div>

</div>

<script>

const profileBtn=document.getElementById("profileBtn");
const profileMenu=document.getElementById("profileMenu");

profileBtn.onclick=function(e){

    e.stopPropagation();

    profileMenu.classList.toggle("show");

}

document.onclick=function(){

    profileMenu.classList.remove("show");

}

</script>