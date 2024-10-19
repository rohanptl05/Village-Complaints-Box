<?php 

require('C:/xampp/htdocs/project24/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

// Initialize Dompdf
$obj = new Dompdf();
$conn = mysqli_connect("localhost", "root", "", "satadiya_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set the timezone to India
date_default_timezone_set('Asia/Kolkata');

$sql = "SELECT * FROM complaints INNER JOIN users ON complaints.user_id = users.user_id WHERE 1=1";

// Add conditions based on POST parameters
if (isset($_POST['date1']) && isset($_POST['date2']) && $_POST['date1'] != "" && $_POST['date2'] != "") {
    $min = date('Y-m-d', strtotime($_POST['date1']));
    $max = date('Y-m-d', strtotime($_POST['date2']));
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

$data = <<<EOD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Complaints Report</title>
    <style>
        h1 {
            text-align: center;
            color: #000000;
            background-color: aqua;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            background-color: aliceblue;
        }
        th {
            background-color: #f1e7e7;
        }

        /* Footer style */
        @page {
            margin-bottom: 50px;
        }
        .footer {
            position: fixed;
            left: 0;
            bottom: -30px;
            right: 0;
            text-align: right;
            font-size: 10px;
        }
        
        #con {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 20px;
            background-color: bisque;
        }
        
        #con strong {
            margin: 2px 5px;
            padding: 2px 5px;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <h1>Complaints Report</h1>
    
    <div id="con">
EOD;

if(isset($_POST['search']) && $_POST['search'] != ""){
    $data .= "<strong '>Search:</strong> {$_POST['search']} ,";
}
if (isset($_POST['status']) && $_POST['status'] != "") {   
    $data .= "<strong>Filter:</strong> {$_POST['status']} ,";
}
if (isset($_POST['date1']) && isset($_POST['date2']) && $_POST['date1'] != "" && $_POST['date2'] != "") {
    $min = date('d-m-Y', strtotime($_POST['date1']));
    $max = date('d-m-Y', strtotime($_POST['date2']));
    $data .= "<strong>Date:</strong> From : {$min} to : {$max}";
}

$data .= <<<EOD
    </div>
    
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">User ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Username</th>
                <th scope="col">Complaint Title</th>
                <th scope="col">Complaint Description</th>
                <th scope="col">Complaint Date</th>
                <th scope="col">Complaint Status</th>
                <th scope="col">Admin-Comments</th>
            </tr>
        </thead>
        <tbody>
EOD;

$sno = 0;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $sno += 1;
        $formattedDate = date('d-m-Y h:i A', strtotime($row['complaints_date']));
        
        $data .= <<<EOD
                    <tr>
                        <th scope='row'>{$sno}</th>
                        <td>{$row['user_id']}</td>
                        <td>{$row['firstname']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['complaint_title']}</td>
                        <td>{$row['complaints_desc']}</td>
                        <td>{$formattedDate}</td>
                        <td>{$row['complaints_status']}</td>
                        <td>{$row['admin_comments']}</td>

                    </tr>
        EOD;
    }
}

$currentTimestamp = date('d-m-Y h:i A');

$data .= <<<EOD
        </tbody>
    </table>
    <div class="footer">
        Generated on: {$currentTimestamp}
    </div>
</body>
</html>
EOD;

$obj->loadHtml($data);
$obj->setPaper('A4', 'landscape');
$obj->render();

$pdfOutput = $obj->output();
$pdfFilepath = 'report_' . time() . '.pdf';

file_put_contents($pdfFilepath, $pdfOutput);

echo json_encode(array("status" => "success", "filepath" => $pdfFilepath));

mysqli_close($conn);

?>
