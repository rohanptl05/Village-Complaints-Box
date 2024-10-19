<?php
Include "TCPDF library";
require_once ('TCPDF/tcpdf.php');
require_once ("_dbconnect.php");

try {

    if(isset($_POST['pdf_id'])){
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

        // Start HTML content
        $html = <<<EOD
        <style>
            
            table {
                width: 100%;
                border-collapse: collapse;
                font-size: 12pt;
            }
            th, td {
                padding: 8px;
                border: 1px solid #ccc;
                text-align: left;
            }
            th {
                background-color: #FAEBD7;
            }
            tbody tr:nth-child(even) {
                background-color: #f2f2f2;
            }
        </style>
        <h1 style="text-align: center; color: aqua; font-size: 18pt;
                margin-bottom: 20px;" >Complaints Report</h1>
        <table cellspacing="0" cellpadding="4">
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
                </tr>
            </thead>
            <tbody>
        EOD;
   
        if (mysqli_num_rows($result) > 0) {

            // Create new PDF document
            $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', true);

            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Rohan Patel');
            $pdf->SetTitle('Complaints Report');
            $pdf->SetSubject('users details');

            // Set font
            $pdf->SetFont('times', '', 12);

            // Add page
            $pdf->AddPage();

            // Data rows
            $sno = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $sno += 1;

                $html .= <<<EOD
                    <tr>
                        <th scope='row'>{$sno}</th>
                        <td>{$row['user_id']}</td>
                        <td>{$row['firstname']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['complaint_title']}</td>
                        <td>{$row['complaints_desc']}</td>
                        <td>{$row['complaints_date']}</td>
                        <td>{$row['complaints_status']}</td>
                    </tr>
                EOD;
            }

            $html .= <<<EOD
            </tbody>
        </table>
        EOD;

            // Add HTML content to PDF
            $pdf->writeHTML($html, true, false, true, false, '');

            // Define the file path
            $pdfFilePath = __DIR__.'/download/complaints_report.pdf';

            // Output PDF document
            $pdf->Output($pdfFilePath, 'F');

            // Return success message with file path
            header('Content-Type: application/json');
            echo json_encode(array("status"=>"success", "filepath"=>basename($pdfFilePath)));

        } else {
            // Return error message if no records found
            header('Content-Type: application/json');
            echo json_encode(array("status"=>"error", "message"=>"No complaints found"));
        }
    }
  $conn = null;  
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
