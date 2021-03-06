<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */
require_once dirname(__FILE__).'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start();
    // include dirname(__FILE__).'/res/example15.php';



    $id = $_GET["id"];
    $archivo = $_GET["archivo"];

    
    if( $archivo == "pageObraAvance"){
        $semana = $_GET["semana"];    

        include dirname(__FILE__).'/production/core/obras/templates/pdfAvances.php';
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8');
    }
    else if($archivo == "pageNomina"){
        $cateem = $_GET["cateem"];    
        $cateco = $_GET["cateco"];    
        $idObra = $_GET["idObra"];
        $width_in_mm = 10 * 25.4; 
        $height_in_mm = 15  * 25.4;
        include dirname(__FILE__).'/production/core/nominas/templates/pdfNominas.php';
        // $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8');
        $html2pdf = new HTML2PDF('L', array($width_in_mm,$height_in_mm), 'es', true, 'UTF-8', array(0, 0, 0, 0));

    }   
    else if($archivo == "pageReporteTotal"){
        $width_in_mm = 10 * 25.4; 
        $height_in_mm = 15  * 25.4;
        include dirname(__FILE__).'/production/core/obras/templates/pdfReporteTotal.php';
        // $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8');
        $html2pdf = new HTML2PDF('L', array($width_in_mm,$height_in_mm), 'es', true, 'UTF-8', array(0, 0, 0, 0));   
    }

    else if($archivo == "pageCompras"){

        $sem = $_GET["semana"];
        $pro = $_GET["producto"];
        $prv = $_GET["proveedor"];
        $ctr = $_GET["contratista"];
        $width_in_mm = 10 * 25.4; 
        $height_in_mm = 15  * 25.4;
        include dirname(__FILE__).'/production/core/compras/templates/pdfCompras.php';
        // $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8');
        $html2pdf = new HTML2PDF('L', array($width_in_mm,$height_in_mm), 'es', true, 'UTF-8', array(0, 0, 0, 0));   
    }
    else if($archivo == "pageInventario"){
        $width_in_mm = 10 * 25.4; 
        $height_in_mm = 15  * 25.4;
        include dirname(__FILE__).'/production/core/inventarios/templates/pdfInventario.php';
        // $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8');
        $html2pdf = new HTML2PDF('L', array($width_in_mm,$height_in_mm), 'es', true, 'UTF-8', array(0, 0, 0, 0));   
    }
    else if($archivo == "pageCotizacion"){
        $width_in_mm = 10 * 25.4; 
        $height_in_mm = 15  * 25.4;
        include dirname(__FILE__).'/production/core/cotizaciones/templates/pdfCotizacion.php';
        // $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8');
        $html2pdf = new HTML2PDF('L', array($width_in_mm,$height_in_mm), 'es', true, 'UTF-8', array(0, 0, 0, 0));   
    }
    else if($archivo == "pageCotizacionCliente"){
        $width_in_mm = 10 * 25.4; 
        $height_in_mm = 15  * 25.4;
        include dirname(__FILE__).'/production/core/cotizaciones/templates/pdfCotizacionCliente.php';
        // $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8');
        $html2pdf = new HTML2PDF('L', array($width_in_mm,$height_in_mm), 'es', true, 'UTF-8', array(0, 0, 0, 0));   
    }
    else if($archivo == "pageReporteAnual"){
        $width_in_mm = 10 * 25.4; 
        $height_in_mm = 15  * 25.4;
        include dirname(__FILE__).'/production/core/obras/templates/pdfReporteAnual.php';
        // $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8');
        $html2pdf = new HTML2PDF('L', array($width_in_mm,$height_in_mm), 'es', true, 'UTF-8', array(0, 0, 0, 0));   
    }
    



    $content = ob_get_clean();

    // $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    

    $html2pdf->writeHTML($content);
    $html2pdf->output('example15.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}


    

