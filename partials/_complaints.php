<?php
include "_dbconnect.php";
session_start();

$sql = "select * from complaints,users WHERE complaints.user_id=users.user_id AND complaints.complaints_status= 'pending...'";
$result = mysqli_query($conn, $sql) or die("Query is faild");

$output = "";
if (mysqli_num_rows($result) > 0) {



    $output = '<div class="w3-container w3-teal">
                <h1>complaints</h1>
            </div>
            <div class="w3-container">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">FistName</th>
                            <th scope="col">UserName</th>
                            <th scope="col">copmlaint_title</th>
                            <th scope="col">complaint Description</th>
                            <th scope="col">Admin Comments</th>
                            <th scope="col">complaint Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>';
    $sno = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $sno += 1;
        $output .= "<tr>
                                <th scope='row'>" . $sno . "</th>
                                <td>" . $row['firstname'] . "</td>
                                <td>" . $row['username'] . "</td>
                                <td>" . $row['complaint_title'] . "</td>
                                <td>" . substr($row['complaints_desc'], 0, 20) . '...' . "</td>
                                <td> <textarea rows='1' cols='22' id='admincomments' name='admincomments' placeholder='Enter comments...'></textarea> </td>
                               <td>" . date('d-m-Y', strtotime($row['complaints_date'])). "</td>
                                <td> 
                                <button class='edit btn btn-sm btn-primary userView' data-bs-toggle='modal' data-eid='{$row["user_id"]}  '>User-Details</button> 
                                    <button class='edit btn btn-sm btn-primary compaintsView' data-bs-toggle='modal' data-eid='{$row["complaint_id"]}  '>Complaint View</button> 
                                    <button class='edit btn btn-sm btn-success complaintsAccept'  data-eid='{$row["complaint_id"]}  '>Resolved</button> 
                                    
                                    
                                     <button class='edit btn btn-sm btn-danger complaintsReject'    data-eid='{$row["complaint_id"]}  '>Reject</button> 
                                   
                                </td>
                            </tr>";
    }
    

    $output .= "</table>";
    mysqli_close($conn);
    echo $output;
} else {
    echo "<div><div class='w3-container w3-teal'>
        <h1>complaints</h1>
    </div>
    <table class='table' id='myTable'>
        <h3>no record found<h3>
    </table></div>";
}
