<?php

include'../../libs/fpdf/fpdf.php';
 

        

        $pdf = new FPDF();
        $pdf->AddPage();
        
        
/* seleccionamos el tipo, estilo y tamaño de la letra a utilizar */
        $pdf->SetFont('Helvetica', 'B', 12);
		$pdf->Image('../global/img/logo_cotizacion.jpg',10,10,190);
		$pdf->Ln();
		$pdf->Ln(15);
		$pdf->Write (7,'');
		$pdf->Ln(); //salto de linea
		$pdf->Cell();
		$pdf->Ln(15);//ahora salta 15 lineas 
		$pdf->SetTextColor('0','0','0'); 	
		$pdf->Ln();	
		$pdf->Write (12,'ORDEN DE ENTRADA DE MATERIAL.');
		$pdf->Ln(); //salto de linea
		$pdf->Write(3,'PROVEEDOR.                         ');
		$pdf->Cell(20,3,$_POST['prov'],0,3,'L');
		$pdf->Ln();
		$pdf->Write(3,'CODIGO DE PROVEEDOR:    ');
		$pdf->Cell(20,3,$_POST['codprov'],0,3,'L');
		$pdf->Ln();
		$pdf->Write(3,'FACTURA N.                           ');
		$pdf->Cell(20,3,$_POST['factura'],0,3,'L');
		$pdf->Ln();
		$pdf->Write(3,'NOMBRE DE OBRA:              ');
		$pdf->Cell(20,3,$_POST['obra'],0,3,'L');
		$pdf->Ln();
		$pdf->Write(3,'CODIGO DE OBRA:                ');
		$pdf->Cell(20,3,$_POST['codobra'],0,3,'L');
		$pdf->Ln();
		$pdf->Write(3,'FECHA N.                               ');
		$pdf->Cell(20,3,$_POST['fecha'],0,3,'L');
		$pdf->Ln();
		$header = array('columna1', 'Columna2', 'Columna3', 'Columna4', 'Columna5');
		$pdf->Ln();
		$pdf->Cell(40,7,'CODIGO MATERIAL',1,3,'C');
		$pdf->Cell(40,7,$_POST['codmat'],1,3,'C');
		$pdf->Ln();
		
		
		
        $pdf->Output("entrada.pdf",'F');
		echo "<script language='javascript'>window.open('entrada.pdf','_self','');</script>";//para ver el archivo pdf generado
		exit;


?>

