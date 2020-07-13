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
        include dirname(__FILE__).'/production/core/obras/templates/pdfAvances.php';
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8');
    }
    else if($archivo == "pageNomina"){
        $width_in_mm = 10 * 25.4; 
        $height_in_mm = 15  * 25.4;
        include dirname(__FILE__).'/production/core/nominas/templates/pdfNominas.php';
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


    

