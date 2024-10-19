<?php
include "_dbconnect.php";

// Initialize query
$sql = "SELECT * FROM complaints INNER JOIN users ON complaints.user_id = users.user_id WHERE 1=1";

// Add conditions based on POST parameters
if (isset($_POST['date1']) && isset($_POST['date2']) && $_POST['date1'] != "" && $_POST['date2'] != "") {
    $min = $_POST['date1'];
    $max = $_POST['date2'];
    $sql .= " AND complaints.complaints_date BETWEEN '{$min}' AND '{$max}'";
}

if (isset($_POST['search']) && $_POST['search'] != "") {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql .= " AND (users.firstname LIKE '%$search%' OR users.lastname LIKE '%$search%' OR users.phone LIKE '%$search%' OR users.username LIKE '%$search%' OR users.gender LIKE '%$search%')";
}

if (isset($_POST['status']) && $_POST['status'] != "") {
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $sql .= " AND complaints.complaints_status='$status'";
}

$result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
$output = "";
$sno = 0;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $sno += 1;
        $output .= "<tr>
                        <th scope='row'>" . $sno . "</th>
                        <td>" . htmlspecialchars($row['user_id']) . "</td>
                        <td>" . htmlspecialchars($row['firstname']) . "</td>
                        <td>" . htmlspecialchars($row['username']) . "</td>
                        <td>" . htmlspecialchars(substr($row['complaint_title'], 0, 10)) . "...</td>
                        <td>" . htmlspecialchars(substr($row['complaints_desc'], 0, 20)) . "...</td>
                        <td>" . date('d-m-Y h:i:sa', strtotime($row['complaints_date'])) . "</td>
                        <td>" . htmlspecialchars($row['complaints_status']) . "</td>
                        <td>
                            <button class='edit btn btn-sm btn-primary userView' data-bs-toggle='modal' data-eid='{$row["user_id"]}'>User Details</button>
                            <button class='edit btn btn-sm btn-primary complaintsView' data-bs-toggle='modal' data-eid='{$row["complaint_id"]}'>Complaint View</button>
                        </td>
                    </tr>";
    }
    echo $output;
} else {
    echo "<h2>No Record Found.</h2>";
}

mysqli_close($conn);
?>
