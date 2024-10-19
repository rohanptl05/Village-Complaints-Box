<?php
include "_dbconnect.php";
$updatetitle=$_POST['updatetitle'];
$updatedesc=$_POST['updatedesc'];
$updateid=$_POST['updateid'];

// SQL query to update user information
$sql = "UPDATE complaints SET complaint_title = '$updatetitle', complaints_desc= '$updatedesc'  WHERE complaint_id = $updateid";
$result = mysqli_query($conn, $sql) or die("Query is faild");
if ($result) {
    echo 1;
}else{
    echo 0;
}

?>