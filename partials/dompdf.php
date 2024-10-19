<?php 

include('C:/xampp/htdocs/project24/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

// Initialize Dompdf
$obj = new Dompdf();

// Fetch the content of the `domtest.php` file
ob_start();
include('domtest.php');
$data = ob_get_clean();

// Load the HTML content into Dompdf
$obj->loadHtml($data);

// Set paper size and orientation
$obj->setPaper('A4', 'landscape'); // 'landscape' or 'portrait'

// Render the PDF
$obj->render();

// Output the generated PDF to the browser
$obj->stream('report.pdf', array('Attachment' => 0)); // Use 'Attachment' => 1 to force download

?>
