<?php
include "_dbconnect.php";

session_start();
$cid = $_POST['id'];
$uid = $_SESSION['sno'];

$sql = "SELECT * FROM complaints WHERE complaint_id = '$cid'";
$result = mysqli_query($conn, $sql) or die("Query failed");

$output = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "
            <div class='form-group'>
                <label for='exampleInputEmail1'>Complaints Title</label>
                <input type='text' class='form-control' id='title' name='title' value=\"" . htmlspecialchars($row['complaint_title']) . "\" aria-describedby='emailHelp'>
            </div>
            <input type='hidden' name='sno' value='" . htmlspecialchars($_SESSION['sno']) . "'>
            <div class='form-group'>
                <label for='exampleFormControlTextarea1'>Description of complaints</label>
                <textarea class='form-control' id='desc' name='desc' rows='3'>" . htmlspecialchars($row['complaints_desc']) . "</textarea>
            </div>";

        // Only include admin comments if they exist
        if ($row['admin_comments']) {
            $output .= "
            <div class='form-group'>
                <label for='adminComments'>Admin Comments</label>
                <textarea class='form-control' id='adminComments' name='adminComments' rows='3'>" . htmlspecialchars($row['admin_comments']) . "</textarea>
            </div>";
        }

        $output .= "<td></td><td></td>";
    }

    mysqli_close($conn);
    echo $output;
} else {
    echo "No record found";
}
?>
