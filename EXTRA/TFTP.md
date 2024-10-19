///step1 - Download the TCPDF library from TCPDF official website or install it using Composer:
composer require tecnickcom/tcpdf

step2 - Include the TCPDF library in your PHP file.
require_once('tcpdf_include.php');

step 3 - Generate PDF


<?php
require_once('tcpdf_include.php');
include "_dbconnect.php";
session_start();

// Fetch data as you have already done
$sql = "SELECT * FROM complaints, users WHERE complaints.user_id = users.user_id";
$result = mysqli_query($conn, $sql) or die("Query failed");

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Complaint Report');
$pdf->SetSubject('Generated PDF Report');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Complaint Report', 'Generated on: ' . date('d-m-Y h:i:sa'));

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Write the table header
$html = '<h2>Complaint Report</h2>
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Username</th>
                    <th>Complaint Title</th>
                    <th>Complaint Description</th>
                    <th>Complaint Date</th>
                    <th>Complaint Status</th>
                </tr>
            </thead>
            <tbody>';

$sno = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $sno += 1;
    $html .= "<tr>
                <td>{$sno}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['firstname']}</td>
                <td>{$row['username']}</td>
                <td>" . substr($row['complaint_title'], 0, 10) . '...' . "</td>
                <td>" . substr($row['complaints_desc'], 0, 20) . '...' . "</td>
                <td>" . date('d-m-Y h:i:sa', strtotime($row['complaints_date'])) . "</td>
                <td>{$row['complaints_status']}</td>
            </tr>";
}

$html .= '</tbody></table>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('complaint_report.pdf', 'I');

mysqli_close($conn);



///step 4 Integrating PDF Download Button

<a href="generate_report.php" target="_blank" class="btn btn-primary">Download PDF Report</a>
