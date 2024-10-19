<?php
include "_dbconnect.php";
session_start();
$sid = $_POST['id'];

$sql = "SELECT * FROM users WHERE user_id = $sid";
$result = mysqli_query($conn, $sql) or die("Query failed");

$output = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dob = date('d-m-Y', strtotime($row['dob']));
        $output .= " <h2 >User Details</h2><br>
        <table>
            <tr>
                <th style='padding-right: 10px; text-align: left;'>First Name :</th>
                <td style='text-align: left;'><input type='text' disabled  value='" . $row['firstname'] . "'></td>
            </tr>
            <tr>
                <th style='padding-right: 10px; text-align: left;'>Last Name :</th>
                <td style='text-align: left;'><input type='text' disabled  value='" . $row['lastname'] . "'></td>
            </tr>
            <tr>
                <th style='padding-right: 10px; text-align: left;'>Gender :</th>
                <td style='text-align: left;'><input type='text' disabled  value='" . $row['gender'] . "'></td>
            </tr>
            <tr>
                <th style='padding-right: 10px; text-align: left;'>Date of Birth :</th>
                <td style='text-align: left;'><input type='text' disabled  value='" . $dob . "'></td>
            </tr>
            <tr>
                <th style='padding-right: 10px; text-align: left;'>Phone :</th>
                <td style='text-align: left;'><input type='text' disabled  value='" . $row['phone'] . "'></td>
            </tr>
            <tr>
                <th style='padding-right: 10px; text-align: left;'>Email :</th>
                <td style='text-align: left;'><input type='text' disabled  value='" . $row['email'] . "'></td>
            </tr>
            <tr>
                <th style='padding-right: 10px; text-align: left;'>UserName :</th>
                <td style='text-align: left;'><input type='text' disabled  value='" . $row['username'] . "'></td>
            </tr>
            
        </table>";
    }
    mysqli_close($conn);
    echo $output;
} else {
    echo "No record found";
}
?>
