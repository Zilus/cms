<?php
session_start();
require('lib/PHPExcel.php'); 
include('includes/globals.php');
include('includes/functions.php');

$creator="Loop Media";
$title="Exportacion a XLS";
$campaign="Filename";
$filename=$campaign.".xls";



$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator($creator)
							 ->setLastModifiedBy($creator)
							 ->setTitle($title)
							 ->setSubject($campaign)
							 ->setDescription("Exportacion de xxx")
							 ->setKeywords("office")
							 ->setCategory("Loop");
 


// Data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', "ID")
            ->setCellValue('B1', "Col2")
            ->setCellValue('C1', "Col3")
			->setCellValue('D1', 'Ultima');
			
$i=2;
for ($x = 1; $x <= 10; $x++) {
			 
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$x, $x)
            ->setCellValue('B'.$x, $x)
            ->setCellValue('C'.$x, utf8_decode($x))
			->setCellValue('D'.$x, utf8_decode($x));
            $i++;
            
} 
$objPHPExcel->getActiveSheet()->setTitle('Registros');
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>
