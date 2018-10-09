<?php
/*
	Template Name: Print PDF
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
		$this->Cell( 0, 40, 'The vehicle details you requested are shown below.', 0, 1 );
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
$post = get_post( $id );
$fields = get_post_custom( $post->ID );
$pictures = explode( ',', $fields['PictureRefs'][0] );
$options = explode( ',', $fields['Options'][0]);
$pdf = new PDF();
$pdf->AliasNbPages(  );
$pdf->AddPage( 'P', 'A4' );
$pdf->SetFont( 'Helvetica', 'B', 12 );
$pdf->SetTextColor( 174, 40, 38 );
$pdf->Cell( 45, 7, $fields['FullRegistration'][0] . ' - ' . $fields['Year'][0] . ' ' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Variant'][0], 0, 0 );
$pdf->Image( $pictures[0], 10, 48, 140 );
$pdf->Image( $pictures[1], 154, 48, 40 );
$pdf->Image( $pictures[4], 154, 85, 40 );
$pdf->Image( $pictures[3], 154, 123, 40 );
$pdf->Ln( 115 );
$pdf->SetFont( 'Helvetica', '', 10 );
$pdf->SetFont( '', 'B' );
$pdf->SetTextColor( 0, 0, 0);
$pdf->Cell( 35, 7, 'Make:', 0, 0 );
$pdf->SetFont( '' );
$pdf->Cell( 55, 7, $fields['Make'][0], 0, 0 );
$pdf->SetFont( '', 'B' );
$pdf->Cell( 20, 7, 'Model:', 0, 0 );
$pdf->SetFont( '' );
$pdf->Cell( 35, 7, $fields['Model'][0], 0, 1 );
$pdf->SetFont( '', 'B' );
$pdf->Cell( 35, 7, 'Variant:', 0, 0 );
$pdf->SetFont( '' );
$pdf->Cell( 55, 7, $fields['Variant'][0], 0, 0 );
$pdf->SetFont( '', 'B' );
$pdf->Cell( 20, 7, 'Year:', 0, 0 );
$pdf->SetFont( '' );
$pdf->Cell( 35, 7, $fields['Year'][0], 0, 1 );
$pdf->SetFont( '', 'B' );
$pdf->Cell( 35, 7, 'Colour:', 0, 0 );
$pdf->SetFont( '' );
$pdf->Cell( 55, 7, $fields['Colour'][0], 0, 0 );
$pdf->SetFont( '', 'B' );
$pdf->Cell( 20, 7, 'Miles:', 0, 0 );
$pdf->SetFont( '' );
$pdf->Cell( 35, 7, $fields['Mileage'][0], 0, 1 );
$pdf->SetFont( '', 'B' );
$pdf->Cell( 35, 7, 'Body:', 0, 0 );
$pdf->SetFont( '' );
$pdf->Cell( 55, 7, $fields['Bodytype'][0], 0, 0 );
$pdf->SetFont( '', 'B' );
$pdf->Cell( 20, 7, 'Fuel:', 0, 0 );
$pdf->SetFont( '' );
$pdf->Cell( 35, 7, $fields['FuelType'][0], 0, 1 );
$pdf->SetFont( '', 'B' );
$pdf->Cell( 35, 7, 'Transmission:', 0, 0 );
$pdf->SetFont( '' );
$pdf->Cell( 55, 7, $fields['Transmission'][0], 0, 0 );
$pdf->SetFont( '', 'B' );
$pdf->Cell( 20, 7, 'Doors:', 0, 0 );
$pdf->SetFont( '' );
$pdf->Cell( 35, 7, $fields['Doors'][0], 0, 1 );
$pdf->Ln( -12 );
$pdf->SetFont( '', 'B', 22 );
$pdf->Cell( 162, 7, '', 0, 0, 'R' );
$pdf->SetFont( '' );
$pdf->SetTextColor( 174, 40, 38 );
$pdf->Cell( 25, 7, iconv("UTF-8", "ISO-8859-1", "£") . $fields['Price'][0], 0, 0, 'R' );
$pdf->SetFont( '', '', 10 );
$pdf->SetTextColor( 0, 0, 0);
$pdf->Ln( 6 );
$pdf->Cell( 186, 7, '(Part Exchange & Finance Available)', 0, 1, 'R' );
$pdf->Ln( -10 );
$pdf->SetFont( '', 'B', 10 );
$pdf->Cell( 35, 10, Null, 0, 1 );
$pdf->Cell( 35, 7, 'Fitted options:', 0, 1 );
$pdf->SetFont( '', '', 10 );
$pdf->Cell( 35, 7, $pdf->Write( 7, $fields['Options'][0] ), 0, 1 );
$pdf->Cell( 90, 10, null, 0, 1 );
$pdf->Output();
exit;