<?php
session_start();
include "_dbconnect.php";
$sid = $_SESSION['sno'];

$comptitle = $_POST["comptitle"];
$compdesc = $_POST["compdesc"];

// Prepared statement to avoid SQL injection
$stmt = $conn->prepare("INSERT INTO complaints (user_id, complaint_title, complaints_desc, complaints_date) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iss", $sid, $comptitle, $compdesc);

if ($stmt->execute()) {
    echo 1;
} else {
    echo 0;
}

$stmt->close();
$conn->close();
?>
