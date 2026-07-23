<?php

include("../config/database.php");
include("../config/session.php");

if(!isset($_SESSION['student_id']))
{
    header("Location:login.php");
    exit();
}

$student_id=$_SESSION['student_id'];

if(isset($_POST['upload']))
{

$file=$_FILES['resume'];

$extension=strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));

if($extension!="pdf")
{

echo "<script>

alert('Only PDF files are allowed.');

window.history.back();

</script>";

exit();

}

if($file['size']>5242880)
{

echo "<script>

alert('Maximum file size is 5 MB.');

window.history.back();

</script>";

exit();

}

$filename=time()."_".basename($file['name']);

move_uploaded_file(

$file['tmp_name'],

"../uploads/resumes/".$filename

);

$check=mysqli_query(

$conn,

"SELECT * FROM resumes WHERE student_id='$student_id'"

);

if(mysqli_num_rows($check)>0)
{

mysqli_query(

$conn,

"UPDATE resumes
SET resume_file='$filename'
WHERE student_id='$student_id'"

);

}
else
{

mysqli_query(

$conn,

"INSERT INTO resumes(student_id,resume_file)

VALUES('$student_id','$filename')"

);

}

echo "<script>

alert('Resume Uploaded Successfully.');

window.location='resume.php';

</script>";

}

?>