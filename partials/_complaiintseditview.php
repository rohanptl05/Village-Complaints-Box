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
        $output .= " <div class='form-group'>
                <label for='exampleInputEmail1'>Complaints Title</label>
                <input type='text' class='form-control' id='updatetitle' name='updatetitle' value=\"" . $row['complaint_title'] . "\" aria-describedby='emailHelp'>
                <input type='text' class='form-control' id='updateid' hidden name='updateid' value=\"" . $row['complaint_id'] . "\" aria-describedby='emailHelp'>
               
            </div>
            
            <div class='form-group'>
                <label for='exampleFormControlTextarea1'>Description of complaints</label>
                <textarea class='form-control' id='updatedesc' name='updatedesc' rows='3'>" . $row['complaints_desc'] . "</textarea>
            </div>
            <td></td>
                    <td><input type='submit' class='form-control btn-success btn btn-sm' id='comupdate-submit' value='update'></td>";
    }

    mysqli_close($conn);
    echo $output;
} else {
    echo "No record found";
}
?>
<style>
input#comupdate-submit {
    margin-top: 10px;
}
</style>

