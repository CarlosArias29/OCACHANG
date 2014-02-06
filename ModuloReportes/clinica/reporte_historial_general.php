<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
	
function Header()
{
	$this->SetFont('Arial','B',12);
$this->SetTextColor('121','105','24');	
$this->Text(160,35,'Fecha Emision:',1,'C', 0); 
$this->SetTextColor('121','105','24');	
$this->Text(80,55,'Orden de Compra General:',1,'C', 0); 
$this->Text(160,40,date("Y/m/d")); 	
	
	$this->Ln(60);

	
	
	
	
}

//Pie de página
function Footer()
{
$this->SetY(-10);
$this->SetFont('Arial','I',8);
$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','',9);
//Aquí escribimos lo que deseamos mostrar
mysql_connect("localhost","root","");
mysql_select_db("bdsi215");


$fecha1=$_REQUEST['nlotes'];
$fecha2=$_REQUEST['prodxlote'];


/*
$consulta = mysql_query("SELECT* FROM ordendecompra where estado='$param1'");*/

$consulta = mysql_query("SELECT * from ordendecompra where FECHA BETWEEN '$fecha1' AND '$fecha2'");
$pdf->Image('images/oca_chang3.jpg',10,36,60,60);	 
		$pdf->Ln(20);
		
	
	
	
	$pdf->SetFont('Arial','B',6);	
	$pdf->SetTextColor('255','255','255');		
	$pdf->Cell(15,5,'Orden',1,0,'C',true); 
	$pdf->SetFillColor(38 , 68,52);
		
$pdf->Cell(18,5,'Producto',1,0,'C',true); 
$pdf->Cell(18,5,'Proveedor',1,0,'C',true); 
$pdf->Cell(10,5,'Usuario',1,0,'C',true); 
$pdf->Cell(18,5,'Cantidadlotes',1,0,'C',true);
$pdf->Cell(15,5,'CostoLotes',1,0,'C',true);
$pdf->Cell(10,5,'Estado',1,0,'C',true); 
$pdf->Cell(18,5,'CostoUnitario',1,0,'C',true);
$pdf->Cell(13,5,'ProdxLote',1,0,'C',true); 
$pdf->Cell(20,5,'Fecha',1,0,'C',true); 
 $pdf->Cell(20,5,'Ult.Mod',1,0,'C',true); 
 $pdf->Ln(10);
		
while($resultado = mysql_fetch_array($consulta)){
$pdf->SetTextColor('0','0','0');
	 
$pdf->Cell(15,5,$resultado['IDORDEN'],0,0,'C'); 
$pdf->Cell(18,5,$resultado['IDPRODUCTO'],0,0,'C'); 
$pdf->Cell(18,5,$resultado['IDPROVEEDOR'],0,0,'C'); 
$pdf->Cell(10,5,$resultado['IDUSUARIO'],0,0,'C'); 
$pdf->Cell(18,5,$resultado['CANTIDADLOTES'],0,0,'C');$pdf->Cell(15,5,$resultado['COSTOPORLOTE'],0,0,'C');
$pdf->Cell(10,5,$resultado['ESTADO'],0,0,'C'); 
$pdf->Cell(18,5,$resultado['COSTOUNITARIO'],0,0,'C');
$pdf->Cell(13,5,$resultado['PRODUCTOSXLOTE'],0,0,'C'); $pdf->Cell(20,5,$resultado['FECHA'],0,0,'C'); 
 $pdf->Cell(20,5,$resultado['FECHAULTIMAMODIFICACION'],0,0,'C'); 
$pdf->Ln(); 
}  
 
$pdf->Output();
 
?>