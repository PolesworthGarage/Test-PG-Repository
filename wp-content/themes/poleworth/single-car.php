<?php

if( get_query_var( 'car' ) && !get_query_var( 'make' ) ) {



		$slug = get_page_by_path( get_query_var( 'car' ) );

		$custom = get_post_custom( $slug->ID );

		header( 'Location: /used-cars/' . strtolower( $custom['Make'][0] ) . '/' . get_query_var( 'car' ), true, 301 );



	}

get_header(  );



if ( have_posts(  ) ) :

	while ( have_posts(  ) ) : 

		the_post(  );

		$fields = get_post_custom( $post->ID );

		$pictures = '';

		$images = '';

		if( !empty( $fields['PictureRefs'] ) ) {

			$pictures = explode( ',', $fields['PictureRefs'][0] );

		}



		$images = get_post_meta( $id, 'CarImages' );

		if( is_array( $images ) ) {

			$images = $images[0];

		}

		

		$options = str_replace( ', ,', ',', $fields['Options'][0] );

		$options = explode( ', ', $options );

		if (strlen(the_title('','',FALSE)) > 45) {

			$title_short = substr(the_title('','',FALSE), 0, 45); 

			preg_match('/^(.*)\s/s', $title_short, $matches);

			if ($matches[1]) $title_short = $matches[1];

			$title_short = $title_short.' ...'; 

		} else {

			$title_short = the_title('','',FALSE);

		} 

		echo '<section class="main">';

			echo '<div class="wrapper car-single">';

				$ref = $_SERVER['HTTP_REFERER'];

				if ( strpos( $ref, 'polesworth-garage.com' ) !== FALSE ) :

				endif;

				echo '<div class="single-box">';

					if( !empty( $fields['Reduced'] ) && $fields['Reduced'] != false && $fields['Reduced'][0] != false ) {

						echo '<div class="reduced-container">';

							echo '<div class="reduced-triangle"></div>';

							echo '<div class="reduced-text"><h6>Reduced &pound;' . $fields['Reduced'][0] . '</h6></div>';

						echo '</div>';

					}

					echo '<div id="single-car-image" class="third">';

						if( !empty( $pictures ) && empty( $images ) ) {

							echo '<div class="single-car-image" id="car-slide">';

								echo '<ul id="single-car-bjqs" class="bjqs">';

									foreach( $pictures as $picture ) :

										echo '<li>';

											echo '<a href="' . $picture .'" class="lightbox-cars" rel="cars">';

												echo '<img id="single-car-single-image" src="' . $picture .'" class="full" alt="' . get_the_title(  ) . '" />';

											echo '</a>';

										echo '</li>';

									endforeach;

								echo '</ul>';

							echo '<br/><div class="makes-div"><p><center><a href="' . get_bloginfo( 'wpurl' ) . '/used-cars/' . strtolower( str_replace( ' ', '-', $fields['Make'][0] ) ) . '/" id="similar-vehicles" title="More used ' . $fields['Make'][0] . 's"><strong><span style="color: #c11e1e;" id="makes-link-single" class="makes-link"><h6 id="makes-link-single">View all our Used ' . $fields['Make'][0] . 's</h6></a></span></strong></center></p></div>';

							echo '</div>';

						} else {

							echo '<div id="car-slide">';

								echo '<ul class="bjqs">';

									foreach( $images as $image ) :

										if( !empty( $image['url'] ) ) {

											echo '<li>';

												echo '<a href="' . $image['url'] .'" class="lightbox-cars" rel="cars">';

													echo '<img src="' . $image['url'] .'" class="full" alt="' . $image['alt'] . '" title="' . $image['alt'] . '"/>';

												echo '</a>';

											echo '</li>';

										}

										

									endforeach;

								echo '</ul>';

							echo '<br/><p><center><a href="' . get_bloginfo( 'wpurl' ) . '/used-cars/' . strtolower( str_replace( ' ', '-', $fields['Make'][0] ) ) . '/" class="" id="makes-link-single" title="More used ' . $fields['Make'][0] . 's"><strong><span style="color: #a82826;">View all our Used ' . $fields['Make'][0] . 's</a></span></strong></center></p>';

							echo '</div>';

						}

					echo '</div>';

					echo '<div id="single-car-content" class="two-thirds">';

						echo '<div id="price-box-single" class="price-box">';

							if( $fields['_sold'][0] == true ) {

								echo '<p id="price-single" class="price">SOLD</p>';

							} else {

								if( $fields['Price'][0] == '' ) {

									echo '<p class="price">N/A</p>';

								} else {

									echo '<p id="price-single" class="price">£' . number_format( $fields['Price'][0], '0', '.', ',' ) .'</p>';

								}

								$registrations = get_option( 'pg_finance_registrations', array(  ) );

								if( in_array( $fields['FullRegistration'][0], $registrations ) ) {

								echo '<center><p id="finance-quote-single" class="finance-quote-2">£' . number_format( ($fields['Price'][0]/60), '2', '.', ',' ) . '/m</p></center>';

								} else {

									if( !empty( $fields['_finance_quote'][0] ) && $fields['_finance_quote'][0] != '0' && $fields['_finance_quote'][0] != '0.00' ) {

									echo '<center><p id="finance-quote-single" class="finance-quote-2">£' . $fields['_finance_quote'][0] . ' month</p></center>';

									}

								}

				

							echo '<a href="/car-finance/apply-online/?make=' . $fields['Make'][0] . '&model=' . $fields['Model'][0] . '&fullregistration=' . $fields['FullRegistration'][0] . '" class="" id="financebutton" title="Apply for Car Finance Online"><strong>CAR FINANCE</strong></a></br></br>';

							}

						echo '</div>';

						echo '<a href="' . get_bloginfo( 'wpurl' ) . '/used-cars/' . strtolower( str_replace( ' ', '-', $fields['Make'][0] ) ) . '/' . $post->post_name . '/">';

							echo '<h2 id="car-title-single">' . $title_short . '</h2>';

						echo '</a>';

						echo '<ul id="main-details-single" class="main-details alignleft">';

							$the_fields = '<li> ' . $fields['Bodytype'][0] . '</li>';

							$the_fields .= '<li>' . $fields['Year'][0] . '</li>';

							if( !empty( $fields['Mileage'][0] ) ) {

								$the_fields .= '<li>' . $fields['Mileage'][0] . ' Miles</li>';

							}

							

							if( !empty( $fields['FuelType'][0] ) ) {

								$the_fields .= '<li> ' . $fields['FuelType'][0] . '</li>';

							}

							

							if( !empty( $fields['Transmission'][0] ) ) {

								$the_fields .= '<li>' . $fields['Transmission'][0] . '</li>';

							}

							



							echo $the_fields;

						echo '</ul>';

						echo '<div id="options-box-single" class="options-box">';

							if( $fields['Bodytype'][0] == 'Caravan' ) {

								echo ' This <strong>' . $fields['Colour'][0] . ' ' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Variant'][0] . '</strong>, Caravan was first registered in <strong>' . $fields['Year'][0] . '</strong>.';

							} else {

								echo ' This <strong>' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Variant'][0] . '</strong>, registration number ' . $fields['FullRegistration'][0] . ' was first registered in <strong>' . $fields['Year'][0] . '</strong> and is fitted with a <strong>' . $fields['FuelType'][0] . '</strong> engine and <strong>' . $fields['Transmission'][0] . '</strong> gearbox. It has covered just <strong>' . $fields['Mileage'][0] . ' miles</strong> and is finished in <strong>' .  $fields['Colour'][0] . '</strong>.';

							}

						echo '</div>';

						echo '<div id="options-box-options-single" class="options-box">';

							$the_options = trim( $options[0] . ', ' . $options[1] . ', ' . $options[2] . ', ' . $options[3] . ', ' . $options[4] . ', ' . $options[5] );

							$the_options = str_replace( ' , ', '', $the_options );

							echo $the_options;

						echo '</div>';

						echo '<div class="alignright" id="social-link" style="clear: left; margin: 20px 20px 0px 0px;">';

							echo '<iframe allowtransparency="true" frameborder="0" scrolling="no" src="https://platform.twitter.com/widgets/tweet_button.html?count=none" style="width:70px; height:20px;"></iframe>';

							echo '<iframe src="//www.facebook.com/plugins/like.php?href=' . get_bloginfo( 'wpurl' ) . '/used-cars/' . strtolower( $fields['Make'][0] ) . '/' . $post->post_name . '&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width: 45px; height:20px;" allowTransparency="true"></iframe>';

						echo '</div>';

						echo '<div class="alignright" id="print-link" style="margin: 20px 10px 5px 0px;">';

							echo '<a href="' . get_bloginfo( 'wpurl' ) . '/print/' . $post->ID . '">';

								echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/icons/print.png" alt="Print Car Details" />';

							echo '</a></br>';
							echo '<a href="' . get_bloginfo( 'wpurl' ) . '/print/' . $post->ID . '" class="print-button">PRINT</a>';


						echo '</div>';

					echo '</div>';

						echo '<a id="finance-drop-single" class="finance-drop"><p>Finance Calculator</p></a>';

					echo '<div class="calculator">';

						echo '<form id="finance-calc-single" class="finance-calc" method="post" class="alignleft" style="clear:left">';

							echo '<label for="deposit">Deposit / Part-Ex (&pound;):</label>';

							echo '<select name="deposit">';

								echo '<option value="100">£100.00</option>';

								echo '<option value="300">£300.00</option>';

								echo '<option value="500">£500.00</option>';

								echo '<option value="1000" selected="selected">£1,000.00</option>';

								echo '<option value="1500">£1,500.00</option>';

								echo '<option value="2000">£2,000.00</option>';

								echo '<option value="3000">£3,000.00</option>';

								echo '<option value="4000">£4,000.00</option>';

								echo '<option value="5000">£5,000.00</option>';

								echo '<option value="7500">£7,500.00</option>';

								echo '<option value="10000">£10,000.00</option>';

								echo '<option value="12500">£12,500.00</option>';

								echo '<option value="15000">£15,000.00</option>';

								echo '<option value="20000">£20,000.00</option>';

								echo '<option value="25000">£25,000.00</option>';

								echo '<option value="30000">£30,000.00</option>';

							echo '</select>';

							echo '<label for="term">Term (Months):</label>';

							echo '<select name="term">';

								echo '<option value="6">6 Months</option>';

								echo '<option value="12">12 Months</option>';

								echo '<option value="18">18 Months</option>';

								echo '<option value="24">24 Months</option>';

								echo '<option value="30">30 Months</option>';

								echo '<option value="36">36 Months</option>';

								echo '<option value="42">42 Months</option>';

								echo '<option value="48">48 Months</option>';

								echo '<option value="54">54 Months</option>';

								echo '<option value="60" selected="selected">60 Months</option>';

							echo '</select>';

							echo '<label for="annual_mileage">Annual Mileage:</label>';

							echo '<select name="annual_mileage">';

								echo '<option value="6000">6000 miles</option>';

								echo '<option value="7000">7000 miles</option>';

								echo '<option value="8000">8000 miles</option>';

								echo '<option value="9000">9000 miles</option>';

								echo '<option value="10000">10000 miles</option>';

								echo '<option value="11000">11000 miles</option>';

								echo '<option value="12000" selected="selected">12000 miles</option>';

								echo '<option value="13000">13000 miles</option>';

								echo '<option value="14000">14000 miles</option>';

								echo '<option value="15000">15000 miles</option>';

								echo '<option value="16000">16000 miles</option>';

								echo '<option value="17000">17000 miles</option>';

								echo '<option value="18000">18000 miles</option>';

								echo '<option value="19000">19000 miles</option>';

								echo '<option value="20000">20000 miles</option>';

								echo '<option value="21000">21000 miles</option>';

								echo '<option value="22000">22000 miles</option>';

								echo '<option value="23000">23000 miles</option>';

								echo '<option value="24000">24000 miles</option>';

								echo '<option value="25000">25000 miles</option>';

							echo '</select>';

							echo '<input type="submit" name="submit" value="Calculate" />';

							echo '<input type="hidden" name="price" value="' . $fields['Price'][0] .'" />';

							echo '<input type="hidden" name="year" value="' . $fields['Year'][0] .'" />';

							echo '<input type="hidden" name="mileage" value="' . $fields['Mileage'][0] .'" />';

							echo '<input type="hidden" name="price" value="' . $fields['Price'][0] .'" />';

							echo '<input type="hidden" name="cap" value="' . $fields['Cap_ID'][0] .'" />';

							echo '<input type="hidden" name="registration" value="' . $fields['FullRegistration'][0] .'" />';

						echo '</form>';

						echo '<div id="calc-results-single" class="alignleft calc-results" data-id="' . $post->ID . '"></div>';

						echo '<div id="calc-disclaimer-single" class="alignleft calc-disclaimer">' . '<strong><a class="lbp-inline-link-10" href="#" title="">Finance</a> is subject to status.</strong></br></br>Guarantees and Indemnities may be required. We may be able to offer alternative finance offers other than the one(s) above. We have selected a group of car finance companies who offer finance to a broad range of people in any number of financial positions. We cannot however offer finance from any other providers. With our PCP Finance products any excess mileage charges will apply only if you choose to return the vehicle, if you make the balloon payment this charge will not apply. The above rates are for internet users only and intended purely as a guide. Please contact us to make a finance application.</br><p id="" style="text-align:center"><a href="/car-finance/apply-online/" class="" style="width:98%!important;" id="financebutton" title="Apply for Car Finance Online"><strong>APPLY ONLINE NOW</strong></a></p></br><img style="width:134px;float:right;" src="http://www.polesworthmotorfinance.com/wp-content/uploads/2018/08/Polesworth-Motor-Finance-Logo.png"></img>Terms and conditions apply. Polesworth Garage is authorised and regulated by the Financial Conduct Authority under registration number 684336.
You can confirm our registration on the FCAs website (This link will open in a new window) (<a href="http://www.fca.org.uk" target="blank">www.fca.org.uk</a>) or by contacting the FCA on 0800 111 6768. Finance is Subject to Status.' . '</div>';

echo '<div style="display:none">';

echo '<div id="lbp-inline-href-10" style="padding: 10px;background: #fff">';

echo '<h3><strong><span style="color: #a82826;">Hire Purchase (HP)</span></strong></h3>';

echo '<strong><span style="color: #000000;">How it works</span></strong>';

echo '<p style="text-align: justify;"><span style="color: #000000;">You pay a deposit of your choice, which is somewhat dependent on the chosen car. The remainder is repaid over a period which can be a short as 6 months or as long as 5 years, at the end of the term, when you have made the final payment- the car becomes yours.</span></p>';

echo '<p style="text-align: justify;"><span style="color: #000000;">There is a finance calculator on every suitable vehicle page which explains the costs of Hire Purchase.</span></p>';

echo '<hr />';

echo '<h3><strong><span style="color: #a82826;">Personal Contract Purchase (PCP)</span></strong></h3>';

echo '<strong><strong></strong><span style="color: #000000;">How it works</span></strong>';

echo '<p style="text-align: justify;"><span style="color: #000000;">You will agree to hire a vehicle from us for a specified period, which can be from 6 months to 5 years, and you will then make a regular monthly payment to cover the cost of hiring it.</span></p>';

echo '<p style="text-align: justify;"><span style="color: #000000;">Once you reach the end of the term, you have the option of purchasing the car for a pre-agreed price. (This is known as a balloon payment)</span></p>';

echo '<p style="text-align: justify;"><span style="color: #000000;">If you decide you do not wish to buy the car, you can hand it back at the end of the term without any further payment,  assuming the vehicle is returned in the condition agreed at the start of the term. We offer a Personal Contact Hire calculator on every suitable vehicle page which explains all costs in detail.</span></p>';

echo '<hr />';

echo '<h3><strong><span style="color: #a82826;">Balloon Hire Purchase (LP)</span></strong></h3>';

echo '<strong><strong></strong><span style="color: #000000;">How it works</span></strong>';

echo '<p style="text-align: justify;"><span style="color: #000000;">As with normal Hire Purchase, you choose how much deposit you would like to pay, based on the vehicle you choose and your own affordability. You can then select how long the period of repayment will last, from 12 months to 5 years.</span></p>';

echo '<p style="text-align: justify;"><span style="color: #000000;">The finance company will work out the likely value of the vehicle at the end of the term and this will become the "balloon payment". Your deposit and the balloon payment figure are deducted from the price of your chosen vehicle, then you make regular monthly payments to pay off the remaining financed figure over the agreed term.</span></p>';

echo '<p style="text-align: justify;"><span style="color: #000000;">When you reach the end of the term you then make the balloon payment and the vehicle is yours.</span></p>';

echo '<strong><span style="color: #000000;">Visit us today and speak to one of our friendly staff, who will make sure you are guided through every stage of the process.</span></strong>';

echo '<hr />';

echo '<p style="text-align: center;"><a title="Guaranteed Car Finance" href="/car-finance/guaranteed-car-finance/"><span style="color: #a82826;"><strong>Guaranteed Car Finance</strong></span></a>  <span style="color: #a82826;"><span style="color: #000000;">-</span></span>  <span style="color: #a82826;"><strong>Personal Leasing </strong></span> <span style="color: #a82826;"><span style="color: #000000;">-</span></span>  <span style="color: #a82826;"><strong>Business Leasing</strong><span style="color: #000000;">  -  </span><strong> <a title="Nissan Contract Hire" href="/car-finance/nissan-contract-hire/">Contract Hire</a></strong></span></p>';

echo '</div>';

echo '</div>';

					echo '</div>';

					echo '</div>';

echo '<div class="hide-on-mobile"><a class="lbp-inline-link-11" href="#test-drive"><img src="/wp-content/uploads/2015/10/book-a-test-drive.png" style="float:left;margin:0px 5px;"></a><img src="/wp-content/uploads/2015/10/part-exchange-your-car.png" style="float:left;margin:0px 5px;" title="Top prices paid on part exchange" alt="Top prices paid on part exchange"><a class="lbp-inline-link-13" href="#apply-for-car-finance"><img src="/wp-content/uploads/2015/10/apply-for-car-finance-image.png" style="float:left;margin:0px 5px;" title="Apply online for low rate car finance" alt="Apply online for low rate car finance"></a><a href="/used-cars/" title="Over 200 approved used cars in stock"><img src="/wp-content/uploads/2015/11/Approved-used-cars-new.png" style="float:left;margin:0px 5px;" title="Over 300 approved used cars in stock" alt="Over 300 approved used cars in stock"></a></div>';
echo '		<div style="display:none">';
echo '			<div id="lbp-inline-href-11" style="padding: 10px;background: #fff">';
echo '				<div class="used-car-test-drive">';
echo ' 					<h3>book a test drive</h3>';
echo ' 					<p>To book a test drive in this';
echo ' 					<strong>' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Variant'][0] . '</strong>';
echo '					please fill out the short form below and we will reply within 24 hours.</p>';
echo 					do_shortcode('[contact-form-7 id="112222" title="Book a test drive"]');
echo '				</div>';
echo '			</div>';
echo '		</div>';
echo '		<div style="display:none">';
echo '			<div id="lbp-inline-href-13" style="padding: 10px;background: #fff">';
echo '				<div class="applypopup">';
echo ' 					<h3>Apply for car finance</h3>';
echo ' 					<p class="intro">Please fill out the information below to apply for car finance on this';
echo ' 					<strong>' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Variant'][0] . '</strong>';
echo '					</p>';
echo 					do_shortcode('[contact-form-7 id="116439" title="Apply for Finance 1/2 - July"]');
echo '				</div>';
echo '			</div>';
echo '		</div>';
echo '&nbsp;';

echo '<div id="used-car-shoutout-single" class="used-car-shoutout">';

echo '<p>Polesworth Garage has been a family business for nearly 50 years. You can be assured that with our cars you will never be off the road. Our promise is your guarantee!</p>';

echo '</div>';

				echo '<hr />';

				echo '<div class="single-box">';

					echo '<div style="display: block; clear: both; overflow: hidden;">';

						echo '<div id="third-single" class="third" id="thumbnails">';

							if( !empty( $pictures ) && empty( $images ) ) {

								$count = count( $pictures );

								for( $i = 1; $i < $count; $i++ ) {

									echo '<a href="' . $pictures[$i] .'" class="lightbox-cars" rel="cars">';

										echo '<img src="' . $pictures[$i] .'" class="thumbnail" alt="' . get_the_title(  ) . '" />';

									echo '</a>';

								}

							} else {

								foreach( $images as $image ) {

									if( !empty( $image['url'] ) ) {

										echo '<a href="' . $image['url']  .'" class="lightbox-cars" rel="cars">';

											echo '<img src="' . $image['url'] .'" alt="' . $image['alt'] . '" title="' . $image['alt'] . '" class="thumbnail" />';

										echo '</a>';

									}

								}

							}

							

						echo '</div>';

						echo '<div id="two-thirds-single" class="two-thirds-lower">';

							echo '<h3>Included Options</h3>';

							$length = ceil( count( $options ) / 3 );

							$length_2 = $length*2;

							echo '<ul id="car-details-single" class="car-details alignleft">';

								foreach( array_slice( $options, 0, $length, true ) as $option ) :

									echo '<li>' . $option . '</li>';

								endforeach;

							echo '</ul>';

							echo '<ul id="car-details-single" class="car-details alignleft">';

								foreach( array_slice( $options, $length, $length, true ) as $option ) :

									echo '<li>' . $option . '</li>';

								endforeach;

							echo '</ul>';

							echo '<ul id="car-details-single" class="car-details alignleft">';

								foreach( array_slice( $options, $length_2, $length, true ) as $option ) :

									echo '<li>' . $option . '</li>';

								endforeach;

							echo '</ul>';

						echo '</div>';

					echo '</div>';

				echo '</div>';

				echo '<hr/>';

				echo '<div id="search-results-div-single"><strong><a id="search-results-single" style="font-size:18px" href="' . $ref . '">Back to search results</a></strong><br /><br /></div>';

				/*echo '<div id="enquire">';

				global $wpdb;

				$email_table = $wpdb->prefix . 'emails'; 

				/*$sql = "CREATE TABLE IF NOT EXISTS $email_table (

					id mediumint(9) NOT NULL AUTO_INCREMENT,

					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,

					name tinytext NOT NULL,

					sender tinytext NOT NULL,

					message text NOT NULL,

					tel tinytext NOT NULL,

					UNIQUE KEY id (id)

				);";

				$wpdb->query( $sql );

				

					if( isset( $_POST['enquire'] ) && strlen( $_POST['enquire-name'] ) > 1 && strlen( $_POST['enquire-tel'] ) > 1 ) {

						$to = 'pg@safeserps.co.uk';

						//$to = 'tony.shemmans@safeserps.co.uk';

						$headers = 'FROM: Enquiries <no-reply@polesworth-garage.com>' . "\r\n";

						$headers .= "MIME-Version: 1.0\r\n";

						$headers .= "Content-type: text/html; charset: utf8\r\n";

						$subject = 'Enquiry About: ' . $fields['FullRegistration'][0] . ' ' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Price'][0];

						$message = '<strong>You have had a new enquiry from the <a href="http://www.polesworth-garage.com" title="visit the website">Polesworth Garage</a> website:</strong><br><br><strong> ' . $_POST['enquire-name'] . ' </strong> has looked at ' . $fields['FullRegistration'][0] . '. It is a ' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ' that you have on the website.<br>He then clicked the enquire button on the vehicle page which has sent you this email.<br><br>Below you will find the full vehicle details along with contact details for the customer.<br><br>';

						$message .= '<b>Make & Model:</b> ' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Variant'][0] . '<br />';

						$message .= '<b>Registration:</b> ' . $fields['FullRegistration'][0] . '<br />';

						$message .= '<b>Year:</b> ' . $fields['Year'][0] . '<br><br>';

						$message .= '<b>View the car here:</b> <a href="' . get_bloginfo( 'wpurl' ) . '/used-cars/' . strtolower( str_replace( ' ', '-', $fields['Make'][0] ) ) . '/' . $post->post_name . '">' . $fields['FullRegistration'][0] . '</a>' . '<br /><br />';

						$message .= '---------------------------------------------------------------' . '<br /><br />';

						$message .= '<b>Their name:</b> ' . $_POST['enquire-name'] . '<br />';

						$message .= '<b>Their telephone number:</b> ' . $_POST['enquire-tel'] . '<br />';

						$message .= '<b>Their E-Mail:</b> ' . $_POST['enquire-email'] . '<br><font color="red"><strong>DO NOT CLICK REPLY TO THIS MESSAGE</font></strong><br><br>';

						$message .= '<b>They also wrote:</b> ' . '<br />'  . $_POST['enquire-comment'] . '<br />';



						

						$wpdb->insert( 

							$email_table,

							array( 

								'name' => $_POST['enquire-name'],

								'tel' => $_POST['enquire-tel'],

								'sender' => $_POST['enquire-email'],

								'message' => $message,

							)

						);



						wp_mail( $to, $subject, $message, $headers );



						echo '<h3>Email Message Sent</h3>';

						?>

						<script type="text/javascript">

							var _gaq = _gaq || [];

							_gaq.push(['_trackEvent', 'Emails', 'Enquiry', '<?php echo $fields['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Variant'][0]; ?>']);

						</script>

						<?php

					} else {

						echo '<h4>Buy it Now Form</h4>';

						echo '</br>Vehicle:</br></br>';

						echo '<strong>' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Variant'][0] . ' - <span style="color: #a71d1d;">' . $fields['FullRegistration'][0] . '</span></strong>.</br></br>';

						echo 'Please fill in your details below and click send.';

						echo '<form method="post">';

							echo '<label for="enquire-name">Your Name:</label>';

							echo '<input type="text" name="enquire-name">';

							echo '<label for="enquire-tel">Telephone Number:</label>';

							echo '<input type="text" name="enquire-tel">';

							echo '<label for="enquire-email">Your E-Mail:</label>';

							echo '<input type="text" name="enquire-email">';

							echo '<label for="enquire-comment">I would like to collect the car on (Date):</label>';

							

							echo '<textarea name="enquire-comment"></textarea>';

							echo '<input type="submit" name="enquire" value="Send" />';

						echo '</form>';

					}

				echo '</div>';*/

echo '<div id="car-finance">';

				echo '<form method="post">';

					if( isset( $_POST['finance-submit'] ) ) {

						$to = 'pg@safeserps.co.uk';

						$email_table = $wpdb->prefix . 'emails'; 

						//$to = 'tony.shemmans@safeserps.co.uk';

						$headers = 'FROM: Enquiries <no-reply@polesworth-garage.com>' . "\r\n";

						$headers .= "MIME-Version: 1.0\r\n";

						$headers .= "Content-type: text/html; charset: utf8\r\n";

						$subject = 'Used Car Finance Enquiry from ' . $_POST['finance-name'];

						$message = '<strong>You have had a "Good Credit" Car Finance enquiry from the <a href="http://www.polesworth-garage.com" title="visit the website">Polesworth Garage</a> website:</strong><br><br><strong> ' . $_POST['finance-name'] . ' </strong> would like some financing on your ' . $title_short . '<br /><br />';

						$message .= '<b>Vehice Registration:</b> ' . $fields['FullRegistration'][0] . '<br />';

						$message .= '<b>Name:</b> ' . $_POST['finance-name'] . '<br />';

						$message .= '<b>DOB:</b> ' . $_POST['finance-dob'] . '<br />';

						$message .= '<b>Address 1:</b> ' . $_POST['finance-address'] . '<br />';

						$message .= '<b>Address 2:</b> ' . $_POST['finance-address2'] . '<br />';

						$message .= '<b>Town:</b> ' . $_POST['finance-town'] . '<br />';

						$message .= '<b>Postcode:</b> ' . $_POST['finance-postcode'] . '<br /><br />';

						$message .= '<b>Employed:</b> ' . $_POST['finance-employment'] . '<br />';

						$message .= '<b>Monthly Budget:</b> ' . $_POST['finance-budget'] . '<br />';

						$message .= '<b>Deposit:</b> ' . $_POST['finance-deposit'] . '<br /><br />';

						$message .= '<b>Part-Ex Registration:</b> ' . $_POST['finance-make'] . '<br />';

						$message .= '<b>Part-Ex Mileage:</b> ' . $_POST['finance-mileage'] . '<br />';

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

						include_once TEMPLATEPATH . '/includes/recaptcha.php';

						$privatekey = "6Le1-PcSAAAAAEmMuDjy3vdB5mjCocpKNZhew_gS";

						$cap = new ReCaptcha();

  						$resp = $cap->check_answer (

  							$privatekey,

                            $_SERVER["REMOTE_ADDR"],

                            $_POST["recaptcha_challenge_field"],

                            $_POST["recaptcha_response_field"]

                        );

                        if (!$resp->is_valid) {

						    echo '<br />';

						    echo '<h4>Uh oh... The recaptcha was entered incorrectly</h4>';

						    echo '<p>Please refresh the page to try again.</p>';



						} else {

							$retval = $api->listSubscribe( $general_list, $_POST['finance-email'], $merge_vars );

							wp_mail( $to, $subject, $message, $headers );

							echo '<br />';

							echo '<h4>Thanks, we\'ll contact you shortly</h4>';

							echo '<br />';

						}

						

						?>

						<script type="text/javascript">

							var _gaq = _gaq || [];

							_gaq.push(['_trackEvent', 'Emails', 'Used Car Finance Enquiry', '<?php echo $_POST['finance-name']; ?>' ]);

						</script>

						<?php

					} else {

						echo '<div id="enquiry-zero" style="background-color:#F9F9F9;height:130px;width:720px;float:left;">';

						echo '<p style="font-size:28px;font-weight:700;color:#c11e1e;">BUY ON FINANCE</p>';

						echo '<p style="font-size:20px;font-weight:500;">Please complete the simple form below and as long as you ';

						echo 'can afford the repayments we would be happy to to discuss financing this:</ br></br><strong> ' . $fields['Make'][0] . ' ' . $fields['Model'][0] . '</strong>.</p>';

						echo '</div>';

						echo '<hr />';

						echo do_shortcode( '[contact-form-7 id="113109" title="Apply for Finance (June 2016)"]' );

						echo '<hr />';

						echo '<div id="enquiry-recaptcha" style="background-color:#F9F9F9;height:150px;padding-right:0px;padding-top:20px;clear:both;">';

						echo '<div id="recaptcha_div"></div>';

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

						echo '<input type="submit" class="car-submit3" name="finance-submit" value="GET APPROVED" />';

						echo '</div>';

						echo '<hr />';

                                                echo '<div id="enquiry-nine" style="background-color:#F9F9F9;padding-top:0px;clear:both;text-align:right;">';

						echo 'Polesworth Garage is authorised and regulated by the</br>';

						echo 'Financial Conduct Authority under registration number 684336.</br>';
						
						echo '</br>';

 						echo 'You can confirm our reigstration on the FCA website (this link will open in a new tab)</br>';

						echo '(<a href="http://www.fca.org.uk" target="blank">www.fca.org.uk</a>) or by contacting the FCA on 0800 111 6768.</br>';
						
						echo '</br>';
						
						echo 'Finance is subject to status.';

						echo '</div>';

					}

					

				echo '</form>';

			echo '</div>';

		echo '</section>';

	endwhile;

endif;

?>

<style type="text/css">

#recaptcha_area, #recaptcha_table { line-height: 0!important; }

#recaptcha_privacy { display:none!important;}
.wpcf7-form.sent {display:none;}
.wpcf7-response-output {display:block!important;}
.wpcf7-display-none {display:block!important;}
.wpcf7-mail-sent-ok {display:block!important;}
</style>

<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>

<script type="text/javascript">

           Recaptcha.create("6Le1-PcSAAAAAOXsDfgSggtgec4B2brdSVD3vZ3e", 'recaptcha_div', {

             theme: "red",

             callback: Recaptcha.focus_response_field});

      </script>

<?php

get_footer(  );