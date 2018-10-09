<?php

	/**

	*	Template Name: Used Car Finance Form

	**/

	get_header();

?>

	<section class="main">

		<div class="wrapper">

		<?php

		while ( have_posts(  ) ) : 

			the_post(  );

			the_content( '  ' );

			echo '<div id="car-finance">';

				echo '<form method="post">';

					if( isset( $_POST['finance-submit'] ) ) {

						$to = 'pg@safeserps.co.uk';

						$email_table = $wpdb->prefix . 'emails'; 

						//$to = 'tony.shemmans@safeserps.co.uk';

						$headers = 'FROM: Enquiries <no-reply@polesworth-garage.com>' . "\r\n";

						$headers .= "MIME-Version: 1.0\r\n";

						$headers .= "Content-type: text/html; charset: utf8\r\n";

						$subject = 'Used Car Finance Enquire from ' . $_POST['finance-name'];

						$message = '<strong>You have had a new enquiry from the <a href="http://www.polesworth-garage.com" title="visit the website">Polesworth Garage</a> website:</strong><br><br><strong> ' . $_POST['finance-name'] . ' </strong> would like some financing<br /><br />';

						$message .= '<b>Name:</b> ' . $_POST['finance-name'] . '<br />';

						$message .= '<b>DOB:</b> ' . $_POST['finance-dob'] . '<br />';

						$message .= '<b>Address 1:</b> ' . $_POST['finance-address'] . '<br />';

						$message .= '<b>Address 2:</b> ' . $_POST['finance-address2'] . '<br />';

						$message .= '<b>Town:</b> ' . $_POST['finance-town'] . '<br />';

						$message .= '<b>Postcode:</b> ' . $_POST['finance-postcode'] . '<br /><br />';

						$message .= '<b>Employed:</b> ' . $_POST['finance-employment'] . '<br />';

						$message .= '<b>Monthly Budget:</b> ' . $_POST['finance-budget'] . '<br />';

						$message .= '<b>Deposit:</b> ' . $_POST['finance-deposit'] . '<br /><br />';

						$message .= '<b>Part Exchange Registration:</b> ' . $_POST['finance-make'] . '<br />';

						$message .= '<b>Part Exchange Mileage:</b> ' . $_POST['finance-mileage'] . '<br />';

						$message .= '---------------------------------------------------------------' . '<br /><br />';

						$message .= '<b>Their name:</b> ' . $_POST['finance-name'] . '<br />';

						$message .= '<b>Their telephone number:</b> ' . $_POST['finance-tel'] . '<br />';

						$message .= '<b>Their E-Mail:</b> ' . $_POST['finance-email'] . '<br><font color="red"><strong>DO NOT CLICK REPLY TO THIS MESSAGE</font></strong><br><br>';

						

						$wpdb->insert( 

							$email_table,

							array( 

								'name' => $_POST['finance-name'],

								'tel' => $_POST['finance-tel'],

								'sender' => $_POST['finance-email'],

								'message' => $message,

							)

						);

						include_once 'MCAPI.php';

						$api_key = '12022340ba889a32c821c6a318ee37d2-us6';

						$general_list = '33451839ae';

						$api = new MCAPI($api_key);

						$name = explode( ' ', $_POST['finance-name'] );

						$merge_vars = array(

							'FNAME' => $name[0], 

							'LNAME' => $name[1], 

						);

						$retval = $api->listSubscribe( $general_list, $_POST['finance-email'], $merge_vars );

						wp_mail( $to, $subject, $message, $headers );

						echo '<br />';

						echo '<h4>Thanks, we\'ll contact you shortly</h4>';

						echo '<br />';

						?>

						<script type="text/javascript">

							var _gaq = _gaq || [];

							_gaq.push(['_trackEvent', 'Emails', 'Used Car Finance Enquiry', '<?php echo $_POST['finance-name']; ?>' ]);

						</script>

						<?php

					} else {

						echo '<div id="enquiry-zero" style="background-color:#F9F9F9;height:145px;width:780px;float:left;">';

						echo '<p style="font-size:28px;font-weight:700;color:#c11e1e;">Finance Approval.</p>';

						echo '<p style="font-size:20px;font-weight:500;">Please complete the simple form below and as long as you ';

						echo 'can afford the repayments we would be happy to to discuss financing your next quality used car.</p>';

						echo '<hr />';

						echo '</div>';

						echo '<div id="enquiry-one" style="background-color:#F9F9F9;height:300px;width:380px;float:left;">';

						echo '<label class="fin-title" name="finance-name">Full Name:</label>';

						echo '<input type="text" class="fin-input" name="finance-name" />';

						echo '<label class="fin-title" name="finance-tel">Telephone Number:</label>';

						echo '<input type="text" class="fin-input" name="finance-tel" />';

						echo '<label class="fin-title" name="finance-email">E-Mail Address:</label>';

						echo '<input type="text" class="fin-input" name="finance-email" />';

						echo '<label class="fin-title" name="finance-dob">Date Of Birth:</label>';

						echo '<input type="text" class="fin-input" name="finance-dob" />';

						echo '</div>';

						echo '<div id="enquiry-two" style="background-color:#F9F9F9;height:300px;width:380px;padding-right:10px;float:right;">';

						echo '<label class="fin-title" name="finance-address">Address Line 1:</label>';

						echo '<input type="text" class="fin-input" name="finance-address" />';

						echo '<label class="fin-title" name="finance-address2">Address Line 2:</label>';

						echo '<input type="text" class="fin-input" name="finance-address2" />';

						echo '<label class="fin-title" name="finance-town">Address Town:</label>';

						echo '<input type="text" class="fin-input" name="finance-town" />';

						echo '<label class="fin-title" name="finance-postcode">Address Postcode:</label>';

						echo '<input type="text" class="fin-input" name="finance-postcode" />';

						echo '</div>';

						echo '<div id="enquiry-three" style="background-color:#F9F9F9;padding-top:0px;clear:both;text-align:left;">';

						echo '<p style="font-size:20px;font-weight:500;">We need to know you can afford the repayments you need to make. As part of that process we need ';

						echo 'to learn about your income. Please choose the from the following employment choices.</p>';

						echo '</div>';

                                                echo '<div id="enquiry-four" style="background-color:#F9F9F9;padding-bottom:0px;height:160px;width:220px;float:left;">';

                                                echo '<label class="fin-title" name="finance-budget">Max Monthly Payment:</label>';

						echo '<input type="text" class="fin-input" name="finance-budget" />';

						echo '<label class="fin-title" name="finance-deposit">Your Deposit:</label>';

						echo '<input type="text" class="fin-input" name="finance-deposit" />';

						echo '</div>';

						echo '<div id="enquiry-five" style="background-color:#F9F9F9;height:160px;padding-right:85px;width:305px;float:right;">';

						echo '<label class="fin-title2" name="finance-employment">Your Employment Status:</label>';

						echo '<select name="finance-employment">';

							echo '<option name="full-time" value="Full Time">Full Time Employee</option>';

							echo '<option name="part-time" value="Part Time">Part Time Employee</option>';

							echo '<option name="self-employed" value="Self Employed">Self Employed</option>';

							echo '<option name="unemployed-housewife" value="Unemployed">Housewife or Husband</option>';

							echo '<option name="unemployed-pensioner" value="Unemployed">Pensioner</option>';

							echo '<option name="unemployed" value="Unemployed">Unemployed</option>';

							echo '<option name="student" value="Student">Student</option>';

						echo '</select>';

						echo '</div>';

						echo '<hr />';

						echo '<div id="enquiry-six" style="background-color:#F9F9F9;clear:both;text-align:left;">';

						echo '<p style="font-size:20px;font-weight:500;">If you have a vehicle to part exchange, please enter the vehicle registration number, otherwise leave blank.</p>';

						echo '</div>';

                                                echo '<div id="enquiry-seven" style="background-color:#F9F9F9;padding-bottom:0px;height:55px;width:140px;float:left;">';

						echo '<label class="fin-title" name="finance-make">Registration No.:</label>';

						echo '<input type="text" class="fin-input" name="finance-make" />';

						echo '</div>';

                                                echo '<div id="enquiry-sevena" style="background-color:#F9F9F9;padding-bottom:0px;margin-left:180px;height:55px;width:140px;float:left;">';

						echo '<label class="fin-title" name="finance-mileage">Mileage:</label>';

						echo '<input type="text" class="fin-input" name="finance-mileage" />';

						echo '</div>';

						echo '<hr />';

						echo '<div id="enquiry-eight" style="background-color:#F9F9F9;height:50px;padding-right:0px;margin-top:20px;width:180px;float:left;">';

						echo '<input type="submit" class="car-submit3" name="finance-submit" value="Get Approved" />';

						echo '</div>';

						echo '<hr />';

                                                echo '<div id="enquiry-nine" style="background-color:#F9F9F9;padding-top:0px;clear:both;text-align:right;">';

						echo 'Polesworth Garage is authorised and regulated by the Financial Conduct Authority</br>';

						echo 'under registration number 684336.</br>';

 						echo 'You can confirm our reigstration on the FCA website (this link will open in a new tab)</br>';

						echo '(<a href="http://www.fca.org.uk" target="blank">www.fca.org.uk</a>) or by contacting the FCA on 0800 111 6768.';
						
						echo 'Finance is subject to status.';

						echo '</div>';

					}

					

				echo '</form>';

			echo '</div>';

		endwhile;

		?>

		</div>

	</section>

<?php

	get_footer();

?>