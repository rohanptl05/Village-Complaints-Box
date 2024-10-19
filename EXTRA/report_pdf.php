<?php
// Include TCPDF library
require_once ('TCPDF/tcpdf.php');
require_once ("_dbconnect.php");

try {

    if(isset($_POST['pdf_id'])){
        $query = "SELECT 
        app.*, 
        jt.title_name, 
        per.First_name, 
        per.Last_name, 
        per_int.First_name as int_fname, 
        per_int.Last_name as int_lname
    FROM 
        application app
    JOIN 
        job_opportunity jo ON app.job_id = jo.job_id
    JOIN 
        job_title jt ON jo.title_id = jt.title_id
    JOIN 
        person per ON per.Person_id = app.person_id
    LEFT JOIN 
        person per_int ON app.Interviewer_id = per_int.Person_id
    ORDER BY 
        app.person_id, jt.title_name";

    $stmt = $conn->query($query);

    $html = <<<EOD
     
    <table cellspacing="0" cellpadding="4" border="1">
                    <thead>
                        <tr style="background-color: #FAEBD7;">
                            <th>Sr. No.</th>
                            <th>Person Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Position</th>
                            <th>Date of application</th>
                            <th>Status</th>
                            <th>Interviewer Name</th>
                            <th>Interviewer Date</th>
                        </tr>
                    </thead>
                    <tbody> 
    EOD;
    
    if ($stmt->rowCount() > 0) {
        // Create new PDF document
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', true);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Jinay Tandel');
        $pdf->SetTitle('Candidate Report');
        $pdf->SetSubject('Candidate details');

        // Set font
        $pdf->SetFont('times', '', 12);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $num = 1;
        $pdf->AddPage();
        foreach ($rows as $index => $row) {
            
            $person_id = $row['person_id'];
            $First_name = $row['First_name'];
            $Last_name = $row['Last_name'];
            $a_date = new DateTime($row['date_of_application']);
            $date_of_application = $a_date->format("d-m-Y");
            $status = $row['status'];
            $i_date = new DateTime($row['interview_date']);
            $interview_date = $a_date->format("d-m-Y");
            $position = $row['title_name'];
            $int_fname = $row['int_fname'];
            $int_lname = $row['int_lname'];

            $html .= <<<EOD
                            <tr>
                            <td style="text-align:center">$num</td>
                            <td style="text-align:center">$person_id</td>
                            <td>$First_name</td>
                            <td>$Last_name</td>
                            <td>$position</td>
                            <td>$date_of_application</td>
                            <td>$status</td>
                            <td>$int_fname $int_lname</td>
                            <td>$interview_date</td>
                        </tr>
            EOD;
                    
            $num++;
        }
        $html .= <<<EOD
            </tbody>
                </table>
                </body>
                </html>
        EOD;
         // Add HTML content to PDF
         $pdf->writeHTML($html, true, false, true, false, '');
         $pdfFilePath = __DIR__.'/download/Candidate_report.pdf';
         // Output PDF document
         $pdf->Output($pdfFilePath, 'F');
         header('Content-Type: application/json');
         echo json_encode(array("status"=>"success", "filepath"=>basename($pdfFilePath)));

    } else {
        header('Content-Type: application/json');
        echo json_encode(array("status"=>"error", "message"=>"No Candidate found"));
    }
    }
  $conn = null;  
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
