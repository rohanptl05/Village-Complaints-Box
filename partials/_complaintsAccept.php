<?php
include "_dbconnect.php";

$sid = $_POST['id'];
$commnt=$_POST['comments'];
$status='solved';


// SQL query to update user information
$sql = "UPDATE complaints SET complaints_status = '$status',resolved_date=NOW(),admin_comments='$commnt'  WHERE complaint_id = '$sid'";

$result = mysqli_query($conn, $sql);


if ($result) {
   echo 1;
} else {
   echo 0;
}


?>
