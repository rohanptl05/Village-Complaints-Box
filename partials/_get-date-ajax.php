<?php
include "_dbconnect.php";

if (isset($_POST['date1']) && isset($_POST['date2'])) {
    $min = date('Y-m-d', strtotime($_POST['date1']));
    $max = date('Y-m-d', strtotime($_POST['date2']));

    $sql = "SELECT * FROM users, complaints WHERE complaints_date BETWEEN '{$min}' AND '{$max}' AND users.user_id = complaints.user_id";
} else {
    $sql = "SELECT * FROM users, complaints WHERE complaints.user_id = users.user_id
    ORDER BY  complaints_date ASC";
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
                             <button class='edit btn btn-sm btn-primary compaintsView' data-bs-toggle='modal' data-eid='{$row["complaint_id"]}  '>complaitVies</button> 
                        </td>
                    </tr>";
    }
    echo $output;
} else {
    echo "<h2>No Record Found.</h2>";
}
?>
