<?php
// require_once "../extensions/vendor/autoload.php";

// class CustomPdfGenerator extends TCPDF 
// {
//     public function Header() 
//     {
//         $pageWidth = $this->getPageWidth();
//         $textWidth = $this->GetStringWidth('Ticket de Compra');
//         $posX = ($pageWidth - $textWidth) / 2; 
//         $posY = 23;
//         $image_file = '../views/img/template/bersani2.png';
//         $this->Image($image_file, 80, 10, 50, '', 'PNG', '', 'T', false, 800, '', false, false, 0, false, false, false);
//         $posX = 80; 
//         $posY = 23;
//         $this->SetFont('helvetica', 'B', 20);
//         $this->SetXY($posX, $posY);
//         $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
//         $this->Ln();
//         $this->Cell(0, 15, 'Ticket de Compra', 0, false, 'C', 0, '', 0, false, 'M', 'M');
//     }
//     public function Footer() 
//     {
//         $this->SetY(-15);
//         $this->SetFont('helvetica', 'I', 15);
//         $this->Cell(0, 10, 'Gracias Por Tu Compra!', 0, false, 'C', 0, '', 0, false, 'T', 'M');
//     }
//     public function printTable($header, $data)
//     {
//         $this->SetFillColor(255, 255, 255);
//         $this->SetTextColor(192);
//         $this->SetDrawColor(255, 255, 255);
//         $this->SetLineWidth(1);
//         $this->SetFont('Courier', 'B', 14);
//         $w = array(110, 32, 40);
//         $num_headers = count($header);
//         for($i = 0; $i < $num_headers; ++$i) {
//             $this->Cell($w[$i], 7, $header[$i], 1, 0, 'L', 1);
//         }
//         $this->Ln();
//         $this->Ln();
//         // Color and font restoration 
//         $this->SetFillColor(224, 235, 255);
//         $this->SetTextColor(0);
//         $this->SetFont('');
//         // table data 
//         $fill = 0;
//         $total = 0;
//         $Cantidad = 0;
//         foreach($data as $row) {
//             $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
//             $this->Cell($w[1], 6, $row[1], 'LR', 0, 'C', $fill);
//             $this->Cell($w[2], 6, '$'.number_format($row[2]), 'LR', 0, 'C', $fill);
//             $this->Ln();
//             // $fill=!$fill;
//             $Cantidad+=$row[1];
//             $total+=$row[2];
//         }
//         $this->Cell($w[0], 6, '', 'LR', 0, 'L', $fill);
//         $this->Cell($w[1], 6, '', 'LR', 0, 'R', $fill);
//         $this->Cell($w[2], 6, '', 'LR', 0, 'L', $fill);
        
//         $this->Ln();
//         $this->Cell($w[0], 6, 'TOTAL', 'LR', 0, 'L', $fill);
//         $this->Cell($w[1], 6, $Cantidad, 'LR', 0, 'C', $fill);
//         $this->Cell($w[2], 6, '$'.$total, 'LR', 0, 'C', $fill);
//         $this->Ln();
//         $this->Cell(array_sum($w), 0, '', 'T');
//         $style = array(
//             'border' => 2,
//             'vpadding' => 'auto',
//             'hpadding' => 'auto',
//             'fgcolor' => array(0,0,0),
//             'bgcolor' => false, //array(255,255,255)
//             'module_width' => 1, // width of a single module in points
//             'module_height' => 1 // height of a single module in points
//         );
//         $this->write2DBarcode('www.tcpdf.org', 'QRCODE,H', $this->getPageWidth()/3, $this->getY() + 10, 70, 70, $style, 'N');
//     }
// }

// $pdf = new CustomPdfGenerator(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// $pdf->setFontSubsetting(true);
// $pdf->SetFont('Times', '', 12, '', true);
// // start a new page 
// $pdf->AddPage();
// // date and invoice no 
// // $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
// // $pdf->writeHTML("<b>DATE:</b> 01/01/2021");
// // $pdf->writeHTML("<b>INVOICE#</b>12");
// // $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
// // address 
// // $pdf->writeHTML("84 Norton Street,");
// // $pdf->writeHTML("NORMANHURST,");
// // $pdf->writeHTML("New South Wales, 2076");
// // $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
// // bill to 
// $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
// $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
// $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
// $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
// $pdf->writeHTML("<b>Nombre:</b> Juan", true, false, false, false, 'R');
// $pdf->writeHTML("<b>Contacto:</b> 5577673644", true, false, false, false, 'R');
// $pdf->writeHTML("<b>Estacion:</b> Pantitlan", true, false, false, false, 'R');
// $pdf->writeHTML("<b>Fecha y Hora:</b> 16/02/2024, 1:00", true, false, false, false, 'R');
// $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
// // invoice table starts here 
// $header = array('Producto', 'Cantidad', 'Sub-total');
// $data = array(
//    array('Abrigo de lana acolchado','1','900'),
//    array('Abrigo Trinde Lujo','2','1600'),
//    array('Bandolera','3','1200')
// );
// $pdf->printTable($header, $data);
// // $pdf->Ln();
// // comments 

// $pdf->SetFont('', '', 12);
// $pdf->writeHTML("<b>Hecho en México por</b>", true, false, false, false, 'C');
// $pdf->writeHTML("<i>Altitex Services SA de CV</i>", true, false, false, false, 'C');
// $pdf->writeHTML("5564115039", true, false, false, false, 'C');
// $pdf->writeHTML("bersani.mx@gmail.com", true, false, false, false, 'C');
// $pdf->writeHTML("https://www.facebook.com/Bersani.shop", true, false, false, false, 'C');
// $pdf->writeHTML("https://instagram.com/bersani.shop", true, false, false, false, 'C');
// $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
// $pdf->writeHTML("Si se requiere un cambio contactar con vendedor o repartidor", true, false, false, false, 'C');
// $pdf->writeHTML("Se requerira el ticket", true, false, false, false, 'C');
// // save pdf file 
// $pdf->Output(__DIR__ . '/invoice#12.pdf', 'F');

require_once "../controllers/curlController.php";
require_once "../controllers/templateController.php";
require_once "../extensions/vendor/autoload.php";
session_start();
class CustomPdfGenerator extends TCPDF 
{
    public function Header() 
    {
        $pageWidth = $this->getPageWidth();
        $textWidth = $this->GetStringWidth('Ticket de Compra');
        $posX = ($pageWidth - $textWidth) / 2; 
        $posY = 23;
        $image_file = '../views/img/template/bersani2.png';
        $this->Image($image_file, 80, 10, 50, '', 'PNG', '', 'T', false, 800, '', false, false, 0, false, false, false);
        $posX = 80; 
        $posY = 23;
        $this->SetFont('helvetica', 'B', 20);
        $this->SetXY($posX, $posY);
        $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 15, 'Ticket de Compra', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
    public function Footer() 
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 15);
        $this->Cell(0, 10, 'Gracias Por Tu Compra!', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
    public function printTable($header, $data)
    {
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(192);
        $this->SetDrawColor(255, 255, 255);
        $this->SetLineWidth(1);
        $this->SetFont('Courier', 'B', 14);
        $w = array(110, 32, 40);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'L', 1);
        }
        $this->Ln();
        $this->Ln();
        // Color and font restoration 
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // table data 
        $fill = 0;
        $total = 0;
        $Cantidad = 0;
        foreach($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, '$'.number_format($row[2]), 'LR', 0, 'C', $fill);
            $this->Ln();
            // $fill=!$fill;
            $Cantidad+=$row[1];
            $total+=$row[2];
        }
        $this->Cell($w[0], 6, '', 'LR', 0, 'L', $fill);
        $this->Cell($w[1], 6, '', 'LR', 0, 'R', $fill);
        $this->Cell($w[2], 6, '', 'LR', 0, 'L', $fill);
        
        $this->Ln();
        $this->Cell($w[0], 6, 'TOTAL', 'LR', 0, 'L', $fill);
        $this->Cell($w[1], 6, $Cantidad, 'LR', 0, 'C', $fill);
        $this->Cell($w[2], 6, '$'.$total, 'LR', 0, 'C', $fill);
        $this->Ln();
        $this->Cell(array_sum($w), 0, '', 'T');
        $style = array(
            'border' => 2,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );
        $this->write2DBarcode('www.tcpdf.org', 'QRCODE,H', $this->getPageWidth()/3, $this->getY() + 10, 70, 70, $style, 'N');
    }
}
class ControllerPDFCreate{
    public $nombreProduct;
    public $cantidad;
    public $subtotal;

    // public function AgregarAlStock(){        
    //     if (!isset($_SESSION['user'])) {
    //         echo '500';
    //         return;
    //     }else{
    //         $time= time();
    //         if($_SESSION["user"]->token_exp_user < $time){
    //             echo '500';
    //             return;
    //         }else{
    //             if($_SESSION["user"]->token_user !== "NULL" && $_SESSION["user"]->token_user !== ""){
    //                 $dataStore = "stock_out_order=1";
    //                 $url = CurlController::api()."orders?id=". $this->id."&nameId=id_order&token=".$_SESSION["user"]->token_user;
    //                 $method = "PUT";
    //                 $fields = $dataStore;
    //                 $header = array(
    //                 "Content-Type" => "application/x-www-form-urlencoded"
    //                 );
    //                 $updateOrder = CurlController::request($url,$method,$fields,$header);
    //                 if($updateOrder->status == "200"){
    //                     echo '200';
    //                 }else{
    //                     echo '400'; 
    //                 }
    //             }else{
    //                 echo '500';
    //             }
    //         }
    //     }
    // }
    // public function CancelarOrderDentroDeRegisters(){        
    //     if (!isset($_SESSION['user'])) {
    //         echo '500';
    //         return;
    //     }else{
    //         $time= time();
    //         if($_SESSION["user"]->token_exp_user < $time){
    //             echo '500';
    //             return;
    //         }else{
    //             if($_SESSION["user"]->token_user !== "NULL" && $_SESSION["user"]->token_user !== ""){
    //                 $dataStore = "status_order=Cancelado";
    //                 $url = CurlController::api()."orders?id=". $this->id."&nameId=id_order&token=".$_SESSION["user"]->token_user;
    //                 $method = "PUT";
    //                 $fields = $dataStore;
    //                 $header = array(
    //                 "Content-Type" => "application/x-www-form-urlencoded"
    //                 );
    //                 $updateOrder = CurlController::request($url,$method,$fields,$header);
    //                 if($updateOrder->status == "200"){
    //                     if($_POST["outStockOrder"] == 1){
    //                         $dataStore = "number_stock=". $_POST["numStock"]+1 ;
    //                         $url = CurlController::api()."stocks?id=". $this->idStock."&nameId=id_stock&token=".$_SESSION["user"]->token_user;
    //                         $method = "PUT";
    //                         $fields = $dataStore;
    //                         $header = array(
    //                         "Content-Type" => "application/x-www-form-urlencoded"
    //                         );
    //                         $updateStock = CurlController::request($url,$method,$fields,$header);
    //                         if($updateStock->status == "200"){
    //                             echo '200';    
    //                         }else{
    //                             $dataStore = "status_order=Pendiente";
    //                             $url = CurlController::api()."orders?id=". $this->id."&nameId=id_order&token=".$_SESSION["user"]->token_user;
    //                             $method = "PUT";
    //                             $fields = $dataStore;
    //                             $header = array(
    //                             "Content-Type" => "application/x-www-form-urlencoded"
    //                             );
    //                             $updateOrder = CurlController::request($url,$method,$fields,$header);
    //                             if($updateOrder->status == "200"){
    //                                 echo '400';
    //                             }
    //                         }
    //                     }else if($_POST["outStockOrder"] == 0){
    //                         echo '200';
    //                     }
    //                 }else{
    //                     echo '400'; 
    //                 }
    //             }else{
    //                 echo '500';
    //             }
    //         }
    //     }
    // }
    // public function confirmarFinalizarOrder(){        
    //     if (!isset($_SESSION['user'])) {
    //         echo '500';
    //         return;
    //     }else{
    //         $time= time();
    //         if($_SESSION["user"]->token_exp_user < $time){
    //             echo '500';
    //             return;
    //         }else{
    //             if($_SESSION["user"]->token_user !== "NULL" && $_SESSION["user"]->token_user !== ""){
    //                 if( $this-> comment == "" ){
    //                     $this-> comment = NULL;
    //                 }
    //                 if( $this-> gastos == "" ){
    //                     $this-> gastos = NULL;
    //                 }
    //                 $dataStore = "status_order=". $this->statusOrder . "&comment_order=" . $this-> comment . "&bills_order=" . $this-> gastos;
    //                 $url = CurlController::api()."orders?id=". $this->id."&nameId=id_order&token=".$_SESSION["user"]->token_user;
    //                 $method = "PUT";
    //                 $fields = $dataStore;
    //                 $header = array(
    //                 "Content-Type" => "application/x-www-form-urlencoded"
    //                 );
    //                 $updateOrder = CurlController::request($url,$method,$fields,$header);
    //                 if($updateOrder->status == "200"){
    //                     echo '200';
    //                 }else{
    //                     echo '400'; 
    //                 }
    //             }else{
    //                 echo '500';
    //             }
    //         }
    //     }
    // }
    public function CrearTicketPDF(){
        $pdf = new CustomPdfGenerator(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('Times', '', 12, '', true);
        // start a new page 
        $pdf->AddPage();
        // date and invoice no 
        // $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
        // $pdf->writeHTML("<b>DATE:</b> 01/01/2021");
        // $pdf->writeHTML("<b>INVOICE#</b>12");
        // $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
        // address 
        // $pdf->writeHTML("84 Norton Street,");
        // $pdf->writeHTML("NORMANHURST,");
        // $pdf->writeHTML("New South Wales, 2076");
        // $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
        // bill to 
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
        $pdf->writeHTML("<b>Nombre:</b> Juan", true, false, false, false, 'R');
        $pdf->writeHTML("<b>Contacto:</b> 5577673644", true, false, false, false, 'R');
        $pdf->writeHTML("<b>Estacion:</b> Pantitlan", true, false, false, false, 'R');
        $pdf->writeHTML("<b>Fecha y Hora:</b> 16/02/2024, 1:00", true, false, false, false, 'R');
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
        // invoice table starts here 
        $header = array('Producto', 'Cantidad', 'Sub-total');
        $data = array(
        array('Abrigo de lana acolchado','1','900'),
        array('Abrigo Trinde Lujo','2','1600'),
        array('Bandolera','3','1200')
        );
        $pdf->printTable($header, $data);
        // $pdf->Ln();
        // comments 

        $pdf->SetFont('', '', 12);
        $pdf->writeHTML("<b>Hecho en México por</b>", true, false, false, false, 'C');
        $pdf->writeHTML("<i>Altitex Services SA de CV</i>", true, false, false, false, 'C');
        $pdf->writeHTML("5564115039", true, false, false, false, 'C');
        $pdf->writeHTML("bersani.mx@gmail.com", true, false, false, false, 'C');
        $pdf->writeHTML("https://www.facebook.com/Bersani.shop", true, false, false, false, 'C');
        $pdf->writeHTML("https://instagram.com/bersani.shop", true, false, false, false, 'C');
        $pdf->Write(0, "\n", '', 0, 'C', true, 0, false, false, 0);
        $pdf->writeHTML("Si se requiere un cambio contactar con vendedor o repartidor", true, false, false, false, 'C');
        $pdf->writeHTML("Se requerira el ticket", true, false, false, false, 'C');
        // save pdf file 
        $pdf->Output(__DIR__ . '/bersanipdf.pdf', 'F');
    }
}
// if(isset($_POST["nombreProduct"]) && isset($_POST["cantidad"]) && isset($_POST["subtotal"])){
    $pdfCreate = new ControllerPDFCreate();
    // $pdfCreate ->  nombreProduct = $_POST["nombreProduct"];
    // $pdfCreate ->  cantidad = $_POST["cantidad"];
    // $pdfCreate ->  subtotal = $_POST["subtotal"];
    $pdfCreate -> CrearTicketPDF();
// }