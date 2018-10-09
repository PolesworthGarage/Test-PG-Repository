<?php 
/*
	Template Name: Front Page
*/
get_header(  ); ?>
	<section class="promise-area">
        <div class="promise-div">
        <a href="/you-plus-nissan-customer-promise/"> YOU + NISSAN CUSTOMER PROMISE</a>
        </div>
        </section>
	<section id="slide-area">
		<div class="wrapper">
			<div class="half" id="car-finder-mobile">
				<div class="car-finder" id="car-finder-mobile">
					<h2>QUALITY USED CARS</h2>
					<form action="<?php bloginfo('home'); ?>/search/cars" class="car-search" method="post">
						<label for="show">Show</label>
						<select name="type">
							<option value="car">Used Cars</option>
							<option value="van">Used Vans</option>
							<option value="caravan">Caravans and Motorhomes</option>
							<option value="bike">Motorbikes</option>
							<option value="under5">Under £5000</option>
							<option value="under10">Under £10000</option>
							<option value="diesel">Diesels</option>
							<option value="automatic">Automatic Cars</option>
							<option value="low">Low Emission Vehicles</option>
							<option value="commercial">Commercials</option>
						</select>
						<label for="make">Make</label>
						<select name="make" id="make">
							<option value="all">All Makes</option>
							<?php
								$makes = get_terms( 'make', array( 'parent' => 0, 'hide_empty' => true, ) );
							?>
							<?php foreach( $makes as $make ) : ?>
								<option value="<?php echo $make->term_id; ?>"><?php echo strtoupper( $make->name ); ?></option>
							<?php endforeach; ?>
						</select>
						<label for="model">Model</label>
						<select name="model" id="model">
							<option value="all">All Models</option>
						</select>
						<label for="priceslider">Price</label>
						<div class="range">
							<div class="priceslider"></div>
							<div id="price-left"><label for="min">
								<input class="price-left-label" type="text" id="min" name="min" />
								<div id="price-left-pound">Min £</div>
							</label></div>
							<div id="price-right"><label for="max">
								<input class="price-right-label" type="text" id="max" name="max" />
								<div id="price-right-pound">Max £</div>
							</label></div>
						</div>
						<input name="post_type" type="hidden" value="car" />
						<input type="submit" name="find-cars" class="car-submit2" value="Search" />
					</form>
				</div>
			</div>
			<div class="half slide-container">
				<ul class="slider">
					<?php
						$slides = get_posts( array(
							'numberposts' => '4',
							'post_type' => 'slides',
							'orderby' => 'post_date'
						) );
						foreach( $slides as $post ) :
							setup_postdata( $post );
							$args = array(
								'post_type' => 'attachment',
								'numberposts' => '4',
								'post_status' => 'publish',
								'orderby' => 'post_date',
								'order' => 'ASC',
								'post_parent' => $post->ID
							); 
						$attachments = get_posts( $args );
					?>
						<li data-background="/wp-content/uploads/2018/01/background14.png">
							<?php the_content(  ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>
	<section class="main">
		<div class="wrapper">
			<div class="home-widgets">
				<ul class="home-top">
					<?php dynamic_sidebar( 'homepage-first-row' ); ?>
				</ul>
				<ul class="home-bottom">
					<?php dynamic_sidebar( 'homepage-second-row' ); ?>
				</ul>
			</div>
		<?php
		while( have_posts(  ) ) :
			the_post(  );
			the_content(  );
			echo '<div id="car-finance">';
				echo '<form method="post">';
					if( isset( $_POST['finance-submit'] ) ) {
						$to = 'pg@safeserps.co.uk';
						$email_table = $wpdb->prefix . 'emails'; 
						//$to = 'tony.shemmans@safeserps.co.uk';
						$headers = 'FROM: Enquiries <no-reply@polesworth-garage.com>' . "\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset: utf8\r\n";
						$subject = 'New Launch Enquiry from ' . $_POST['finance-name'];
						$message = '<strong>You have had an invitation request from the <a href="http://www.polesworth-garage.com" title="visit the website">Polesworth Garage</a> website:</strong><br><br><strong> ' . $_POST['finance-name'] . ' </strong> would like to attend the Nissan Qashqai Launch.<br /><br />';
						$message .= '<b>Name:</b> ' . $_POST['finance-name'] . '<br />';
						$message .= '<b>Address 1:</b> ' . $_POST['finance-address'] . '<br />';
						$message .= '<b>Address 2:</b> ' . $_POST['finance-address2'] . '<br />';
						$message .= '<b>Town:</b> ' . $_POST['finance-town'] . '<br />';
						$message .= '<b>Postcode:</b> ' . $_POST['finance-postcode'] . '<br /><br />';
						$message .= '---------------------------------------------------------------' . '<br /><br /><strong>Please Send them an Invitation.<br><br>DO NOT CLICK REPLY TO THIS MESSAGE</font></strong><br><br>';
						
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
						echo '<h4>Thanks, you\'ll receive your invitation shortly.</h4>';
						echo '<br />';
						?>
						<script type="text/javascript">
							var _gaq = _gaq || [];
							_gaq.push(['_trackEvent', 'Emails', 'Qashqai Invite', '<?php echo $_POST['finance-name']; ?>' ]);
						</script>
						<?php
					} else {
						echo '<div id="enquiry-zero" style="background-color:#F9F9F9;height:320px;width:470px;float:left;">';
                                                echo '<h4>New Launch Event.</h4>';
                                                echo '<br>';
                                                echo '<img class="size-medium wp-image-65720 alignright" alt="1026x640_00" src="http://www.polesworth-garage.com/wp-content/uploads/2014/01/New-Qashqai-Launch-Image1.png" width="468" height="154" />';
						echo '<hr />';
                                              	echo 'Please complete the simple form below and we will send you ';
						echo 'a personalised invitation to the Launch Event.';
						echo '<hr />';
						echo '</div>';
						echo '<div id="enquiry-one" style="background-color:#F9F9F9;font-size:14px;height:230px;width:180px;float:left;">';
						echo '<label name="finance-name">Full Name:</label>';
						echo '<input type="text" name="finance-name" />';
						echo '<label name="finance-tel">Telephone Number:</label>';
						echo '<input type="text" name="finance-tel" />';
						echo '<label name="finance-email">E-Mail Address:</label>';
						echo '<input type="text" name="finance-email" />';
						echo '</div>';
						echo '<div id="enquiry-two" style="background-color:#F9F9F9;font-size:14px;height:220px;width:180px;padding-right:50px;float:right;">';
						echo '<label name="finance-address">Address Line 1:</label>';
						echo '<input type="text" name="finance-address" />';
						echo '<label name="finance-address2">Address Line 2:</label>';
						echo '<input type="text" name="finance-address2" />';
						echo '<label name="finance-town">Address Town:</label>';
						echo '<input type="text" name="finance-town" />';
						echo '<label name="finance-postcode">Address Postcode:</label>';
						echo '<input type="text" name="finance-postcode" />';
						echo '</div>';
						echo '<hr />';
						echo '<div id="enquiry-eight" style="background-color:#F9F9F9;height:50px;padding-right:0px;padding-top:20px;width:180px;float:right;">';
						echo '</div>';
						echo '</div>';
					}
					
				echo '</form>';
			echo '</div>';
		endwhile;
		?>
		</div>
	</section>
<?php get_footer(); ?>
