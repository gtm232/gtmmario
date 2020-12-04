<?php
require_once 'public/dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$print='ok';


$dompdf->loadHtml($print);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

?>