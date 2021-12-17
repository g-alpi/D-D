<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$html= file_get_contents_curl("http://localhost/github/D-D/dashboard.php");
$pdf= new Dompdf();

/*Pemmittir imagenes */
// $options= $pdf-> getOptions();
// $options->set(array("isRemoteEnabled"=> true)) ;
// $pdf->setOptions($options);

// $pdf->setPaper('A4','landscape');
$pdf -> loadHtml(utf8_decode($html));
$pdf -> render();
$pdf -> stream('dashoard.pdf',array("Attachment"=>true));


function file_get_contents_curl($url){
    $crl= curl_init();
    $timeout= 5;
    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($crl, CURLOPT_CONNECTTIMEOUT,$timeout);
    $ret= curl_exec($crl);
    curl_close($crl);
    return $ret;
}

?>