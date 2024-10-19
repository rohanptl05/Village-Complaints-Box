<?php
include "_dbconnect.php";

$sid = $_POST['upid'];
$fname = $_POST["upfname"];
$lastname = $_POST["uplname"];
$gender = $_POST["gender"];
// $email = $_POST["upemail"];
$dob = $_POST["updob"];
$mbl = $_POST["upmbl"];
$username = $_POST["upusername"];

// SQL query to update user information
$sql = "UPDATE users SET firstname = '$fname', lastname = '$lastname', phone = '$mbl', dob = '$dob', gender = '$gender', username = '$username',profileupdate = NOW() WHERE user_id = '$sid'";

$result = mysqli_query($conn, $sql);


$response = array();

if($result){
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = mysqli_error($conn);
}

echo json_encode($response);

?>
