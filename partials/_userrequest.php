<?php
include "_dbconnect.php";
session_start();

$sql = "SELECT * FROM `users` WHERE user_status IS NULL";
$result = mysqli_query($conn, $sql) or die("Query is faild");

$output = "";
if (mysqli_num_rows($result) > 0) {



    $output = '<div class="w3-container w3-teal">
                <h1>Users Request</h1>
            </div>
            <div class="w3-container">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">UserName</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
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
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['phone'] . "</td>
                              
                                <td> 
                                     <button class='edit btn btn-sm btn-primary userView' data-eid='{$row["user_id"]}  '>View</button> 
                                     <button class='edit btn btn-sm btn-success userAccept'  data-eid='{$row["user_id"]}  '>Accept</button> 
                                     <button class='edit btn btn-sm btn-danger userReject'    data-eid='{$row["user_id"]}  '>Reject</button> 
                                   
                                </td>
                            </tr>";
    }

    $output .= "</table>";
    mysqli_close($conn);
    echo $output;
} else {
    echo "<div><div class='w3-container w3-teal'>
        <h1>Users Request</h1>
    </div>
    <table class='table' id='myTable'>
        <h3>no record found<h3>
    </table></div>";
}
?>
