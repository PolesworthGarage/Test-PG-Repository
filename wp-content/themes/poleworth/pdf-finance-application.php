<?php
/*
	Template Name: Finance Application PDF
*/
	ob_end_clean();
$id = get_query_var( 'page' );
if( !$id ) {
	die( 'Nothing to print' );
}
require('includes/fpdf.php');
class PDF extends FPDF {
	function Header() {
		$this->Image('http://www.polesworth-garage.com/wp-content/uploads/2013/06/PDF-Header2.png',0,0,210);
		$this->SetFont( 'Helvetica', '', 12 );
		$this->Cell( 0, 40, 'Here is the finance application form.', 0, 1 );
		$this->Ln( -15 );
		$this->SetFont( 'Helvetica', '', 10 );
		$this->Cell( 0, 0, 'Please enquire on 01827 895125 for more information.', 0, 1 );
		$this->Ln( 5 );
	}
	function Footer(){
		$this->Image('http://www.polesworth-garage.com/wp-content/uploads/2013/06/PDF-Footer2.png',0,255,210);
		$this->SetY( -15 );
		$this->SetFont( 'Helvetica', 'I', 8 );
	}
}
$pdf->Output();
exit;