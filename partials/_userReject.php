<?php
include "_dbconnect.php";

$sid = $_POST['id'];
$status='reject';


// SQL query to update user information
$sql = "UPDATE users SET user_status = '$status' WHERE user_id = '$sid'";

$result = mysqli_query($conn, $sql);


if ($result) {
   echo 1;
} else {
   echo 0;
}


?>