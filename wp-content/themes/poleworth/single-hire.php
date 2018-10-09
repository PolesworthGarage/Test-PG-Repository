<?php
get_header(  );
$search_args = array(
	'numberposts' => -1,
	'post_type' => 'hire',
);
?>
	<section class="main">
		<div class="wrapper">
			<?php
			$hire = get_posts( $search_args );
			hire_menu( $hire );
			if( isset( $_POST['hire-submit'] ) && strlen( $_POST['hire-name'] ) > 1 && strlen( $_POST['hire-email'] ) > 1 && strlen( $_POST['hire-tel'] ) > 1 && strlen( $_POST['hire-from'] ) > 1 && strlen( $_POST['hire-to'] ) > 1 ) {
				$to = 'pg@safeserps.co.uk';
				$email_table = $wpdb->prefix . 'emails'; 
				//$to = 'mark@flvrs.com';
				$hire_class = get_post( $_POST['hire-class'] );
				$hire_custom = get_post_custom( $hire_class->ID );
				$hire_from = str_replace('/', '-', $_POST['hire-from']);
				$hire_from = strtotime( $hire_from );
				$hire_until = str_replace('/', '-', $_POST['hire-to']);
				$hire_until = strtotime( $hire_until );
				$diff = abs( $hire_until - $hire_from );
				$hire_days = floor( $diff / (60*60*24) );
				$final_price = $hire_days * $hire_custom['Price'][0];

				if( $hire_days >= 3 ) {
					$final_price = $final_price - ( $final_price / 1 );
				}

				$final_price = number_format( $final_price, 2 );

				$headers = 'FROM: Enquiries <no-reply@polesworth-garage.com>' . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset: utf8\r\n";
				$subject = $hire_class->post_title . ' Car Hire';
				$message = '<strong>' . $_POST['hire-name'] . ' has hired a ' . $hire_class->post_title . ' car from the <a href="http://www.polesworth-garage.com" title="visit the website">Polesworth Garage</a> website:</strong><br /><br />';
				$message .= '<b>Name:</b> ' . $_POST['hire-name'] . '<br />';
				$message .= '<b>Address:</b> ' . $_POST['hire-address'] . '<br />';
				$message .= '<b>Postcode:</b> ' . $_POST['hire-postcode'] . '<br />';
				$message .= '<b>Telephone:</b> ' . $_POST['hire-tel'] . '<br />';
				$message .= '<b>E-Mail:</b> ' . $_POST['hire-email'] . '<br />';
				$message .= '---------------------------------------------------------------' . '<br /><br />';
				$message .= '<b>Class:</b> ' . $hire_class->post_title . '<br />';
				$message .= '<b>From:</b> ' . $_POST['hire-from'] . '<br />';
				$message .= '<b>Until:</b> ' . $_POST['hire-to'] . '<br />';
				$message .= '<b>Total Price:</b> £' . $final_price . '<br />';
				$message .= '<br><font color="red"><strong>DO NOT CLICK REPLY TO THIS MESSAGE</font></strong><br><br>';
						
				$wpdb->insert( 
					$email_table,
					array( 
						'name' => $_POST['hire-name'],
						'tel' => $_POST['hire-tel'],
						'sender' => $_POST['hire-email'],
						'message' => $message,
					)
				);

				wp_mail( $to, $subject, $message, $headers );
				require('fpdf.php');
				class PDF extends FPDF {
					function Header() {
						global $hire_class, $final_price, $hire_custom, $hire_from, $hire_until;
						$this->Image('http://www.polesworth-garage.com/wp-content/uploads/2013/06/PDF-Header2.png',0,0,210);
						$this->SetFont( 'Helvetica', 'B', 16 );
						$this->SetTextColor( 174, 40, 38 );
						$this->Cell( 0, 45, 'Car Hire Booking', 0, 1 );
						$this->SetTextColor( 51, 51, 51 );
						$this->SetFont( 'Helvetica', '', 12 );
						$this->Ln( -15 );
						$this->Write( 6, 'Thank you for choosing to book your Car Hire with Polesworth Garage;');
						$this->Ln(10);
						$this->Write( 6, 'Your Vehicle will be available for rental on the date chosen.  If you have any questions regarding your rental then please contact us using the number below.' );
						$this->Ln( 10 );
						$this->SetFont( 'Helvetica', 'B', 16 );
						$this->SetTextColor( 174, 40, 38 );
						$this->Cell( 0, 7, 'Car Hire Booking Confirmation', 0, 1 );
						$this->Ln( 4 );
						$this->SetFont( 'Helvetica', 'B', 12 );
						$this->Cell( 50, 7, 'Name:', 0, 0 );
						$this->SetFont( 'Helvetica', '', 12 );
						$this->SetTextColor( 51, 51, 51 );
						$this->Cell( 50, 7, $_POST['hire-name'], 0, 1, 'R' );
						$this->SetFont( 'Helvetica', 'B', 12 );
						$this->SetTextColor( 174, 40, 38 );
						$this->Cell( 50, 7, 'Vehicle Class:', 0, 0 );
						$this->SetFont( 'Helvetica', '', 12 );
						$this->SetTextColor( 51, 51, 51 );
						$this->Cell( 50, 7, '' . $hire_class->post_title . '', 0, 1, 'R' );
						$this->SetFont( 'Helvetica', 'B', 12 );
						$this->SetTextColor( 174, 40, 38 );
						$this->Cell( 50, 7, 'Pickup:', 0, 0 );
						$this->SetFont( 'Helvetica', '', 12 );
						$this->SetTextColor( 51, 51, 51 );
						$this->Cell( 50, 7, date( 'd/m/y', $hire_from ), 0, 1, 'R' );
						$this->SetFont( 'Helvetica', 'B', 12 );
						$this->SetTextColor( 174, 40, 38 );
						$this->Cell( 50, 7, 'Drop Off:', 0, 0 );
						$this->SetFont( 'Helvetica', '', 12 );
						$this->SetTextColor( 51, 51, 51 );
						$this->Cell( 50, 7, date( 'd/m/y',  $hire_until ) , 0, 1, 'R' );
						$this->Image( $hire_custom['Image'][0], 125, 65, 75 );
						$this->Ln( 7 );

						$this->SetFont( 'Helvetica', 'B', 14 );
						$this->SetTextColor( 174, 40, 38 );
						$this->Cell( 140, 7, 'Total Price:', 0, 0, 'R' );
						$this->SetTextColor( 51, 51, 51 );
						$this->Cell( 0, 7, iconv("UTF-8", "ISO-8859-1", "£") . '' . $final_price . '', 0, 1, 'R' );
						$this->SetFont( 'Helvetica', '', 12 );
						$this->Cell( 0, 7, '** Including VAT', 0, 1, 'R' );

						$this->SetFont( 'Helvetica', 'B', 16 );
						$this->SetTextColor( 174, 40, 38 );
						$this->Cell( 0, 7, 'Collection Address', 0, 1 );

						$this->SetFont( 'Helvetica', '', 11 );
						$this->SetTextColor( 51, 51, 51 );
						$this->Cell( 0, 7, 'The Vehicle will be ready from 9:00am and can be collected from:', 0, 1 );
						$this->SetFont( 'Helvetica', 'B', 11 );
						$this->Cell( 0, 7, 'Polesworth Garage, Grendon Road, Polesworth, B78 1HA', 0, 1, 'C' );
						$this->SetFont( 'Helvetica', '', 11 );
						$this->Cell( 0, 7, 'Please ensure you have the following with you when you collect the Rental Vehicle;', 0, 1 );
						$this->SetFont( 'Helvetica', 'B', 11 );
						$this->Cell( 0, 7, 'Driving Licence (Including the Paper Part)', 0, 1, 'C' );
						$this->Cell( 0, 7, 'Proof of Address (Bank Statement or Utility Bill)', 0, 1, 'C' );
						$this->Cell( 0, 7, 'Credit or Debit Card (For the Deposit and Rental Payment)', 0, 1, 'C' );
						$this->Ln( 4 );
						$this->SetTextColor( 174, 40, 38 );
						$this->Cell( 0, 7, 'Important', 0, 1 );
						$this->SetFont( 'Helvetica', '', 11 );
						$this->SetTextColor( 51, 51, 51 );
						$this->Write( 6, 'We have not charged your credit / debit card.' );
						$this->Ln(10);
						$this->Write( 6, 'The price above includes the daily hire charge, insurance and unlimited mileage. It does not include any optional extras chosen at the time of pickup, for example additional drivers.' );
						$this->Ln(10);
						$this->Write( 6, "The images shown are examples only.  We regard 'or similar' to mean that you may not receive the Vehicle shown.  It may be fitted with a different package of extras than those advertised.  However, although it may be a different car, it will be similar in size, specification and performance to that shown.  The exact vehicle you rent is determined by those vehicles we have in stock at the time of rental." );
						$this->Ln(10);
					}

					function Footer(){
						$this->Image('http://www.polesworth-garage.com/wp-content/uploads/2013/06/PDF-Footer2.png',0,255,210);
						$this->SetY( -15 );
						$this->SetFont( 'Helvetica', 'I', 8 );
					}
				}
				$pdf = new PDF();
				$pdf->AliasNbPages(  );
				$pdf_to = $_POST['hire-email'];
				$pdfdoc = $pdf->Output("", "S");
				$attachment = chunk_split(base64_encode($pdfdoc));
				if( !class_exists( 'PHPMailer' ) ) {
					require_once 'mimemail.php';
				}
				
				$mail = new PHPMailer;
				$mail->IsMail();
				$mail->SetFrom('no-reply@polesworth-garage.com', 'Enquiries');
				$mail->AddAddress($pdf_to, $_POST['hire-name'] );
				$mail->Subject = $hire_class->post_title . ' Car Hire from Polesworth Garage';

				$message = '<strong>Thank you for hiring a car from us!</strong><br /><br />';
				$message .= 'We have attached a PDF with all of the relevant details.  You should be contacted by our staff shortly to confirm your booking.<br />';
				$message .= '<br><font color="red"><strong>DO NOT CLICK REPLY TO THIS MESSAGE</font></strong><br><br>';

				$mail->Body = $message;
				$mail->AddStringAttachment( $pdfdoc, 'Car-Hire.pdf', 'base64', 'application/octet-stream' );
				$mail->IsHTML(true); 
				$mail->Send(  );
				include_once 'MCAPI.php';
				$api_key = '12022340ba889a32c821c6a318ee37d2-us6';
				$general_list = '33451839ae';
				$api = new MCAPI($api_key);
				$name = explode( ' ', $_POST['hire-name'] );
				$merge_vars = array(
					'FNAME' => $name[0], 
					'LNAME' => $name[1], 
				);

				$retval = $api->listSubscribe( $general_list, $_POST['hire-email'], $merge_vars );
			}
			while ( have_posts(  ) ) : 
				the_post(  );
				$custom = get_post_custom(  );
				if( $custom['special'][0] == 'true' ){
					the_content('  ');
				} else {
					echo '<img src="' . $custom['Image'][0] .'" class="alignright" />';
					echo '<h3>' . get_the_title(  ) . ' - ' . $custom['Car'][0] . ' Or Similar*</h3>';
					echo '<strong>' . $custom['Body'][0] . ', ' . $custom['Doors'][0] . ' Doors, ' . $custom['Transmission'][0] . ', ' . $custom['AC'][0] . '</strong><br /><br />';
					echo '<ul>';
						echo '<li>' . $custom['Passengers'][0] . ' Passengers</li>';
						echo '<li>' . $custom['Suitcase'][0] . '</li>';
						echo '<li>' . $custom['Transmission'][0] . ' Gearbox</li>';
						echo '<li>' . $custom['MPG'][0] . ' Miles/Gallon</li>';
						echo '<li>' . $custom['CO2'][0] . '</li>';
						echo '<li><strong>From Only <span style="color: #a71d1d;">£' . $custom['Price'][0] . '</span> per day</strong></li>';
					echo '</ul>';
					echo '<div class="alignleft" style="margin:0px 0px 10px 0px;">';
					echo '<a href="/car-hire/' . $post->post_name . '" class="button" title="Learn More...">Learn More...</a> ';
					echo '<a href="#hire-' . get_the_id(  ) .'" id="hire-button" class="button">Hire Now</a>';
					echo '</div>';
					hire_form( $post->ID, get_the_title(  ), $custom );
					echo '<hr />';
					the_content('  ');
					echo '<hr />';
					?>
					<p><b><span class="vehGuidePopUpDisclaimerText">*Important: </span></b><span class="vehGuidePopUpDisclaimerText">The images shown are examples only.&nbsp;We regard <strong>‘or similar’ </strong>to mean that you may or may not receive the vehicle shown above. It may be fitted with a different package of extras than that advertised.</span><span class="vehGuidePopUpDisclaimerText"> However, although it may be a different car, it will be similar in size, specification and performance to that shown. The exact vehicle you rent is determined by those vehicles we have in stock at the time of rental. </span></p>
			<?php
				}
				
			endwhile;
			?>
			
		</div>
	</section>
<?php
get_footer(  );
