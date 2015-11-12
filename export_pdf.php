<?php
include('includes/config.php');
include('lib/TinyPie.php');
require('lib/phplot-6.1.0/phplot.php');
require('lib/fpdf17/fpdf.php');

$size=470;
$colores = array("4572A7","80699B","3D96AE", "AA4643", "89A54E","3D96AE","FF8C00", "5F9EA0", "808000", "D2691E". "C0C0C0", "EEE8AA", "8B0000", "87CEEB", "48D1CC", "8FBC8F", "8B008B", "BDB76B");

$total=100;

//quejas por marca 
$g1 = new TinyPie($size);

$c=0;
$q=0;
for ($i = 1; $i <= 10; $i++) {
	//math
	$num=$i/$total;
	$num=$num*100;
	$num=round($num);
	$txt1=array();
	
	if($num!=0) {
		array_push($txt1,$i);
		$g1->AddValue($num, $colores[$c]);
	}
	$c++;
}
$g1->SaveToFile("images/tmp/img1.png");
$img1="images/tmp/img1.png";
//End quejas por marca

//status con la marca
$g2 = new TinyPie($size);
//math
$num=30/$total;
$num=$num*100;
$num=round($num);
if($num!=0) {
	$g2->AddValue($num, $colores[0]);
}
$num1=$num;

$num=20/$total;
$num=$num*100;
$num=round($num);
if($num!=0) {
	$g2->AddValue($num, $colores[1]);
}
$num2=$num;

$num=15/$total;
$num=$num*100;
$num=round($num);
if($num!=0) {
	$g2->AddValue($num, $colores[2]);
}
$num3=$num;

$g2->SaveToFile("images/tmp/img2.png");
$img2="images/tmp/img2.png";

//bars
$data1=array();
$c=0;
$key=0;
for ($i = 1; $i <= 10; $i++) {
	//math
	$quejas=0;
	$num=$i;
	$texto = $i;
	
	$data1[$key] = array($texto, $num);
	$key++;
	$c++;
}
$plot = new PHPlot();
$plot->SetPlotType('bars');
$plot->SetDataType('text-data');
$plot->SetShading(0);
$plot->SetDataValues($data1);
$plot->SetFileFormat('png');
$plot->SetIsInline(true); 
$plot->PHPlot(1200,550,"images/tmp/img7.png"); 
$plot->DrawGraph();
$img7="images/tmp/img7.png";
//en consesionario


/** PDF **/
$pdf = new FPDF('L','mm','Letter');
$title = 'Incidencias Generales';
$pdf->SetTitle($title);
$pdf->SetAuthor('Loop Media');

$pdf->AddPage();
//bg
$pdf->Image('images/pdf_bg.jpg', 0, 0, $pdf->w, $pdf->h);
//tittulo
$pdf->SetFont('Times','',42);
$pdf->SetTextColor(250,250,250);
$pdf->SetY(15);
$pdf->Cell(0,10,utf8_decode('Reporte de Incidencias'),0);
//subtitulo
$pdf->SetFont('Times','',32);
$pdf->SetTextColor(76,76,76);
$pdf->SetY(28);
$pdf->Cell(0,10,utf8_decode('Estadísticas Generales'),0);

$pdf->AddPage();
//head
$pdf->Image('images/pdf_head.jpg', 0, 0, $pdf->w);

//tittulo
$pdf->SetFont('Times','',30);
$pdf->SetTextColor(90,90,90);
$pdf->SetY(35);
$pdf->Cell(0,10,utf8_decode('Reporte de Incidencias general'),0);
//subtittulo
$pdf->SetFont('Times','',24);
$pdf->SetTextColor(90,90,90);
$pdf->SetY(45);
$pdf->Cell(0,10,utf8_decode('Total de incidencias:').$total,0);

//Datos 1
//quejas por marca
$pdf->SetFont('Times','',18);
$pdf->SetTextColor(90,90,90);
$pdf->SetY(65);
$pdf->Cell(0,10,utf8_decode('Marca con más quejas:'),0);
$pdf->SetY(70);
$pdf->SetFont('Times','',12);
$y=70;
$c=0;
for ($i = 1; $i <= 10; $i++) {
	//math
	$num=$i/$total;
	$num=$num*100;
	$num=round($num);
	
	if($num!=0) {
		$y=$y+5;
		$pdf->SetY($y);
		$color=$colores[$c];
		$r = hexdec(substr($color,0,2));
		$g = hexdec(substr($color,2,2));
		$b = hexdec(substr($color,4,2));
		$pdf->SetTextColor($r,$g,$b);
		$pdf->Cell(0,10,$i.": ".$qst." (".$num."%)",0);
	}
	$c++;
};
$y=$y+20;
$pdf->Image($img1, 10, $y, 70);
//End quejas por marca


//Status con la marca
$pdf->SetFont('Times','',18);
$pdf->SetTextColor(90,90,90);
$pdf->SetY(65);
$pdf->SetX(105);
$pdf->Cell(0,10,utf8_decode('Status con la marca:'),0);
$pdf->SetY(70);
$pdf->SetFont('Times','',12);
$y=70;
	//clientes
	$y=$y+5;
	$pdf->SetY($y);
	$pdf->SetX(105);
	$color=$colores[0];
	$r = hexdec(substr($color,0,2));
	$g = hexdec(substr($color,2,2));
	$b = hexdec(substr($color,4,2));
	$pdf->SetTextColor($r,$g,$b);
	$pdf->Cell(0,10,"Cliente: 30 (".$num1."%)",0);
	//prospectos
	$y=$y+5;
	$pdf->SetY($y);
	$pdf->SetX(105);
	$color=$colores[1];
	$r = hexdec(substr($color,0,2));
	$g = hexdec(substr($color,2,2));
	$b = hexdec(substr($color,4,2));
	$pdf->SetTextColor($r,$g,$b);
	$pdf->Cell(0,10,"Prospecto: 20 (".$num2."%)",0);
	//Ninguno
	$y=$y+5;
	$pdf->SetY($y);
	$pdf->SetX(105);
	$color=$colores[2];
	$r = hexdec(substr($color,0,2));
	$g = hexdec(substr($color,2,2));
	$b = hexdec(substr($color,4,2));
	$pdf->SetTextColor($r,$g,$b);
	$pdf->Cell(0,10,"Ninguno: 15 (".$num3."%)",0);
$y=$y+15;
$pdf->Image($img2, 105, $y, 70);
//End status con la marca


$pdf->AddPage();
//head
$pdf->Image('images/pdf_head.jpg', 0, 0, $pdf->w);
$pdf->SetFont('Times','',18);
$pdf->SetTextColor(90,90,90);
$pdf->SetY(25);
$pdf->SetX(10);
$pdf->Cell(0,10,utf8_decode('Concesionarios implicados:'),0);
$pdf->SetFont('Times','',12);
$y=40;
$pdf->Image($img7, 10, $y, 263);

$pdf->Output();  
?>