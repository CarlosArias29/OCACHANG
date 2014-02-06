<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
	
function Header()
{
	$this->SetFont('Arial','B',12);
$this->SetTextColor('121','105','24');	
$this->Text(160,35,'Fecha Emision: '.date("d/m/Y"),1,'C', 0); 
$this->SetTextColor('121','105','24');	
$this->Text(80,55,'Orden de Compra por Estado:',1,'C', 0); 
	
	$this->Ln(60);

	
	
	
	
}

//Pie de página
function Footer()
{
$this->SetY(-10);
$this->SetFont('Arial','I',8);
$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
}
//Creación del objeto de la clase heredada
$pdf=new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Times','',9);
//Aquí escribimos lo que deseamos mostrar
mysql_connect("localhost","root","");
mysql_select_db("bdsi215");

$param1=$_REQUEST['RadioGroup1'];
$fecha1=$_REQUEST['nlotes'];
$fecha2=$_REQUEST['prodxlote'];


/*
$consulta = mysql_query("SELECT* FROM ordendecompra where estado='$param1'");*/

$consulta = mysql_query("SELECT * from ORDENDECOMPRA where ESTADO = '$param1' and FECHA BETWEEN '$fecha1' AND '$fecha2'");
$pdf->Image('images/oca_chang3.jpg',10,36,60,60);	 
		$pdf->Ln(20);
		
	
	
	
	$pdf->SetFont('Arial','B',8);	
	$pdf->SetTextColor('255','255','255');		
	$pdf->Cell(15,5,'Orden',1,0,'C',true); 
	$pdf->SetFillColor(38 , 68,52);
		
$pdf->Cell(25,5,'Producto',1,0,'C',true); 
$pdf->Cell(45,5,'Proveedor',1,0,'C',true); 
$pdf->Cell(30,5,'Usuario',1,0,'C',true); 
$pdf->Cell(20,5,'Cantidad lotes',1,0,'C',true);
$pdf->Cell(20,5,'Costo Lotes',1,0,'C',true);
//$pdf->Cell(10,5,'Estado',1,0,'C',true); 
$pdf->Cell(25,5,'Costo Unitario',1,0,'C',true);
$pdf->Cell(30,5,'Productos por lote',1,0,'C',true); 
$pdf->Cell(20,5,'Fecha',1,0,'C',true); 
 $pdf->Cell(35,5,'Ultima Modificacion',1,0,'C',true);
 $pdf->Ln(10);


$pdf->SetFont('Arial','',8);			
while($resultado = mysql_fetch_array($consulta)){
$pdf->SetTextColor('0','0','0');
	 
$pdf->Cell(15,5,$resultado['IDORDEN'],0,0,'C'); 

$Auxiliar = mysql_query("SELECT NOMBREPRODUCTO from PRODUCTOS where IDPRODUCTO = '".$resultado['IDPRODUCTO']."' ");
$Aux= mysql_fetch_array($Auxiliar);
$pdf->Cell(25,5,$Aux[0],0,0,'C'); 

//$pdf->Cell(18,5,$resultado['IDPROVEEDOR'],0,0,'C'); 
$Auxiliar = mysql_query("SELECT NOMBREEMPRESA from PROVEEDOR where IDPROVEEDOR = '".$resultado['IDPROVEEDOR']."' ");
$Aux= mysql_fetch_array($Auxiliar);
$pdf->Cell(45,5,$Aux[0],0,0,'C'); 

//$pdf->Cell(10,5,$resultado['IDUSUARIO'],0,0,'C'); 
$Auxiliar = mysql_query("SELECT NOMBRE, APELLIDO from USUARIO where IDUSUARIO = '".$resultado['IDUSUARIO']."' ");
$Aux= mysql_fetch_array($Auxiliar);
$pdf->Cell(30,5,$Aux[0].' '.$Aux[1],0,0,'C'); 

$pdf->Cell(20,5,$resultado['CANTIDADLOTES'],0,0,'C');
$pdf->Cell(20,5,$resultado['COSTOPORLOTE'],0,0,'C');
//$pdf->Cell(10,5,$resultado['ESTADO'],0,0,'C'); 
$pdf->Cell(25,5,$resultado['COSTOUNITARIO'],0,0,'C');
$pdf->Cell(30,5,$resultado['PRODUCTOSXLOTE'],0,0,'C'); 
$pdf->Cell(20,5,$resultado['FECHA'],0,0,'C'); 
$pdf->Cell(35,5,$resultado['FECHAULTIMAMODIFICACION'],0,0,'C'); 
$pdf->Ln(); 
}  
 
$pdf->Output('ReporteOrdeCompraEstado.pdf', 'D');
 
?>