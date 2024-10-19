<?php
include "_dbconnect.php";

$sid = $_POST['id'];



// SQL query to update user information
$sql = "DELETE FROM complaints WHERE complaint_id ='$sid'";

$result = mysqli_query($conn, $sql);

if ($result) {
   echo 1;
} else {
   echo 0;
}


?>