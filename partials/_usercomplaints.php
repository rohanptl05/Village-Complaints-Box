<?php
include "_dbconnect.php";
session_start();
$id = $_SESSION['sno'];


$sql = "SELECT * FROM complaints WHERE user_id='$id' ORDER BY complaints_date DESC";
$result = mysqli_query($conn, $sql) or die("Query is faild");

$output = "";
if (mysqli_num_rows($result) > 0) {



    $output = '<div><div class="w3-container w3-teal">
                <h1>Complaints Box</h1>
            </div>
            <div class="w3-container">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Complaints title</th>
                            <th scope="col">Complaints Desc.</th>
                            <th scope="col">Date</th>
                            <th scope="col">Admin commet</th>
                            <th scope="col">Status</th> 
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>';
    $sno = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $sno += 1;
        $output .= "<tr>
                                <th scope='row'>" . $sno . "</th>
                                 <td>" . substr($row['complaint_title'], 0, 10) . '...' . "</td>
                                 <td>" . substr($row['complaints_desc'], 0, 20) . '...' . "</td>
                                <td>" . date('d-m-Y h:i:sa', strtotime($row['complaints_date'])) . "</td>
                                <td>" . substr($row['admin_comments'], 0, 20) . '...' . "</td>
                                 <td>" . $row['complaints_status'] . "</td>
                              
                               ";
                                if($row['complaints_status']=="solved" ){
                                    $output .= " <td><button class='edit btn btn-sm btn-primary compaintsView' data-bs-toggle='modal' data-eid='{$row["complaint_id"]}  '>Complaint View</button></td>
                                ";

                                }else{
                                    $output .=   " <td> <button class='btn btn-sm btn-primary usercomplaintseditmodel' data-bs-toggle='modal' data-eid='{$row["complaint_id"]}  '>Edit</button> 
                                  <button class='btn btn-sm btn-danger userdeletecomp'    data-eid='{$row["complaint_id"]}  '>Delete</button> 
                                </td>
                            </tr>";}
    }

    $output .= "</table>
   
   
    <div class='container container-discussion'>
        <h1 class='py-2'>Start a Discussion</h1> 
        <form action=''  method='post' id='insertcomplaint'>
            <div class='form-group'>
                <label for='exampleInputEmail1'>Complaints Title</label>
                <input type='text' class='form-control' id='comptitle' aria-describedby='emailHelp'>
                <small id='emailHelp' class='form-text text-muted'></small>
            </div>
            
            <div class='form-group'>
                <label for='exampleFormControlTextarea1'>description of complaints</label>
                <textarea class='form-control' id='compdesc'  rows='3'></textarea>
            </div>
            <input type='submit' class='btn btn-success mt-1 complaitssubmit' id='complait-submit'></input>
        </form>
    </div></div>";

    // mysqli_close($conn);
    echo $output;
} else {
    echo "<div><div class='w3-container w3-teal'>
        <h1>Complaints Box</h1>
    </div>
    <table class='table' id='myTable'>
        <h3>no record found<h3>
    </table>
   
        <div class='container container-discussion'>
            <h1 class='py-2'>Start a Discussion</h1> 
            <form action=''  method='post' id='insertcomplaint'>
                <div class='form-group'>
                    <label for='exampleInputEmail1'>Complaints Title</label>
                    <input type='text' class='form-control' id='comptitle' aria-describedby='emailHelp'>
                    <small id='emailHelp' class='form-text text-muted'></small>
                </div>
                
                <div class='form-group'>
                    <label for='exampleFormControlTextarea1'>description of complaints</label>
                    <textarea class='form-control' id='compdesc'  rows='3'></textarea>
                </div>
                <input type='submit' class='btn btn-success mt-1 complaitssubmit' id='complait-submit'></input>
            </form>
        </div></div>";
}

?>
<style>

</style>