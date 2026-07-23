<?php

include("../config/database.php");

$id=$_GET['id'];

mysqli_query($conn,"DELETE FROM companies WHERE company_id='$id'");

header("Location:companies.php");

?>