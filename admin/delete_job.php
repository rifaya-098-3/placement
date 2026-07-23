<?php

include("../config/database.php");

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM jobs WHERE job_id='$id'");

header("Location:view_jobs.php");

?>