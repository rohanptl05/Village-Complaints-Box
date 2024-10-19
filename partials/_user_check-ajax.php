<?php
include_once "_dbconnect.php";

$myusername = $_POST['username'];
$sql = "SELECT * FROM users WHERE username= $myusernameid";
$result = mysqli_query($conn, $sql) or die("Query failed");
if (mysqli_num_rows($result) == 1) {
    echo 1;
}else{
    echo 0;
}

?>