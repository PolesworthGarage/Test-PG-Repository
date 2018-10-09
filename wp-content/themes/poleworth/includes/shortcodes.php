<?php
/**
*	Function: iframe_func(  );
*	iframe shortcode
**/
if( !function_exists( 'iframe_func' ) ) {
	function iframe_func($atts) {
		extract(shortcode_atts(array(
			'src' => 'default'
		), $atts));
		return '<iframe src="' . $src . '" width="400" height="222" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	}
	add_shortcode('iframe', 'iframe_func');
}
/**
*	Function: stock_func(  );
*	Stock shortcode
**/
if( !function_exists( 'stock_func' ) ) {
	function stock_func($atts) {
		extract(shortcode_atts(array(
			'body' => null,
			'make' => null
		), $atts));
		$search_args = array(
			'numberposts' => -1,
			'post_type' => 'car',
		);
		$search_args['meta_query'] = array(  );
		$search_args['tax_query'] = array(  );
		if( $body != null ) {
			$search_args['meta_query'][] = array( 
				'key' => 'Bodytype',
				'value' => $body,
				'compare' => 'LIKE'
			);
		}
		if( $make != null ) {
			$term_id = term_exists( $make, 'make' );
			$search_args['tax_query'][] = array(
				'taxonomy' => 'make',
				'field' => 'id',
				'terms' => $term_id,
			);
		}
		$count = count( get_posts( $search_args ) );
		return $count;
	}
	add_shortcode('stock', 'stock_func');
}

if( !function_exists( 'mot_shortcode' ) ) {
	function mot_shortcode(  ) {
		global $wpdb;
		if( check_user_agent( '' ) === true && !$_COOKIE['desktop'] ) :
			$return = '<a href="mailto:pg@safeserps.co.uk" class="button">Book MOT</a>';
		else :
			$return =  '<a href="#mot" class="button" id="mot-button">Book an MOT</a>';
			$return .= '<div id="mot" class="popup">';
			if( isset( $_POST['mot-submit'] ) && strlen( $_POST['mot-name'] ) > 1 && strlen( $_POST['mot-tel'] ) > 1 && strlen( $_POST['mot-email'] ) > 1 && strlen( $_POST['mot-date'] ) > 1) {
				$to = 'pg@safeserps.co.uk';
				$email_table = $wpdb->prefix . 'emails'; 
				$headers = 'FROM: Enquiries <no-reply@polesworth-garage.com>' . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset: utf8\r\n";
				$subject = $_POST['mot-name'] . ' would like an MOT';
				$message = '<strong>' . $_POST['mot-name'] . ' has requested an MOT from the <a href="http://www.polesworth-garage.com" title="visit the website">Polesworth Garage</a> website:</strong><br /><br />';
				$message .= '<b>Name:</b> ' . $_POST['mot-name'] . '<br />';
				$message .= '<b>Address:</b> ' . $_POST['mot-address'] . '<br />';
				$message .= '<b>Postcode:</b> ' . $_POST['mot-postcode'] . '<br />';
				$message .= '<b>Telephone:</b> ' . $_POST['mot-tel'] . '<br />';
				$message .= '<b>E-Mail:</b> ' . $_POST['mot-email'] . '<br />';
				$message .= '---------------------------------------------------------------' . '<br /><br />';
				$message .= '<b>Car Class:</b> ' . $_POST['mot-class'] . '<br />';
				$message .= '<b>Car Registration:</b> ' . $_POST['mot-reg'] . '<br />';
				$message .= '<b>Car Make:</b> ' . $_POST['mot-make'] . '<br />';
				$message .= '<b>Car Model:</b> ' . $_POST['mot-model'] . '<br />';
				$message .= '<b>Preferred Date:</b> ' . $_POST['mot-date'] . '<br />';
				$message .= '<br><font color="red"><strong>DO NOT CLICK REPLY TO THIS MESSAGE</font></strong><br><br>';
				$wpdb->insert( 
					$email_table,
					array( 
						'name' => $_POST['mot-name'],
						'tel' => $_POST['mot-tel'],
						'sender' => $_POST['mot-email'],
						'message' => $message,
					)
				);
				include_once 'MCAPI.php';
				$api_key = '12022340ba889a32c821c6a318ee37d2-us6';
				$general_list = '33451839ae';
				$api = new MCAPI($api_key);
				$name = explode( ' ', $_POST['mot-name'] );
				$merge_vars = array(
					'FNAME' => $name[0], 
					'LNAME' => $name[1], 
				);

				$retval = $api->listSubscribe( $general_list, $_POST['mot-email'], $merge_vars );
				wp_mail( $to, $subject, $message, $headers );
				$headers = 'FROM: Enquiries <no-reply@polesworth-garage.com>' . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset: utf8\r\n";
				$subject = 'Polesworth Garage MOT';
				$message = '<strong>You have ordered and MOT from the <a href="http://www.polesworth-garage.com" title="visit the website">Polesworth Garage</a> website:</strong><br /><br />';
				$message .= '<strong>You will be contacted regarding the MOT shortly.</strong><br /><br />';
				$message .= '<b>Name:</b> ' . $_POST['mot-name'] . '<br />';
				$message .= '<b>Address:</b> ' . $_POST['mot-address'] . '<br />';
				$message .= '<b>Postcode:</b> ' . $_POST['mot-postcode'] . '<br />';
				$message .= '<b>Telephone:</b> ' . $_POST['mot-tel'] . '<br />';
				$message .= '<b>E-Mail:</b> ' . $_POST['mot-email'] . '<br />';
				$message .= '---------------------------------------------------------------' . '<br /><br />';
				$message .= '<b>Car Class:</b> ' . $_POST['mot-class'] . '<br />';
				$message .= '<b>Car Registration:</b> ' . $_POST['mot-reg'] . '<br />';
				$message .= '<b>Car Make:</b> ' . $_POST['mot-make'] . '<br />';
				$message .= '<b>Car Model:</b> ' . $_POST['mot-model'] . '<br />';
				$message .= '<b>Preferred Date:</b> ' . $_POST['mot-date'] . '<br />';
				$message .= '<br><font color="red"><strong>DO NOT CLICK REPLY TO THIS MESSAGE</font></strong><br><br>';
				wp_mail( $_POST['mot-email'], $subject, $message, $headers );
				$return .= '<br /><h4>Booking Received</h4><br />';
				$return .= '<script type="text/javascript">';
					$return .= 'var _gaq = _gaq || [];';
					$return .= "_gaq.push(['_trackEvent', 'MOT', 'MOT', '" . $_POST['mot-class'] . " MOT Booked']);";
				$return .= '</script>';
			} else {
				ob_start(  );
				include 'templates/mot-form.php';
				$return .= ob_get_contents(  );
				ob_end_clean(  );
			}
			$return .= '</div>';
		endif;
		return $return;
	}
	add_shortcode( 'mot', 'mot_shortcode' );
}
if( !function_exists( 'nissan_service_shortcode' ) ) {
	function nissan_service_shortcode(  ) {
		global $wpdb;
		if( check_user_agent( '' ) === true && !$_COOKIE['desktop'] ) :
			$return =  '<a href="mailto:pg@safeserps.co.uk" class="button">Book Nissan Care Service</a>';
		else :
			$return =  '<a href="#nissan_service" class="button" id="nissan-service-button">Book Nissan Care Service</a>';
			$return .= '<div id="nissan_service" class="popup">';
			if( isset( $_POST['nissan-submit'] ) && strlen( $_POST['nissan-name'] ) > 1 && strlen( $_POST['nissan-tel'] ) > 1 && strlen( $_POST['nissan-email'] ) > 1 && strlen( $_POST['nissan-date'] ) > 1) {
				$to = 'pg@safeserps.co.uk';
				$email_table = $wpdb->prefix . 'emails'; 
				$headers = 'FROM: Enquiries <no-reply@polesworth-garage.com>' . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset: utf8\r\n";
				$subject = $_POST['nissan-name'] . ' would like a Nissan Care Service';
				$message = '<strong>' . $_POST['nissan-name'] . ' has requested a Nissan Care Service from the <a href="http://www.polesworth-garage.com" title="visit the website">Polesworth Garage</a> website:</strong><br /><br />';
				$message .= '<b>Name:</b> ' . $_POST['nissan-name'] . '<br />';
				$message .= '<b>Address:</b> ' . $_POST['nissan-address'] . '<br />';
				$message .= '<b>Postcode:</b> ' . $_POST['nissan-postcode'] . '<br />';
				$message .= '<b>Telephone:</b> ' . $_POST['nissan-tel'] . '<br />';
				$message .= '<b>E-Mail:</b> ' . $_POST['nissan-email'] . '<br />';
				$message .= '---------------------------------------------------------------' . '<br /><br />';
				$message .= '<b>Car Class:</b> ' . $_POST['nissan-class'] . '<br />';
				$message .= '<b>Fuel:</b> ' . $_POST['nissan-fuel'] . '<br />';
				$message .= '<b>Car Registration:</b> ' . $_POST['nissan-reg'] . '<br />';
				$message .= '<b>Car Model:</b> ' . $_POST['nissan-model'] . '<br />';
				$message .= '<b>Preferred Date:</b> ' . $_POST['nissan-date'] . '<br />';
				$message .= '<br><font color="red"><strong>DO NOT CLICK REPLY TO THIS MESSAGE</font></strong><br><br>';
				$wpdb->insert( 
					$email_table,
					array( 
						'name' => $_POST['nissan-name'],
						'tel' => $_POST['nissan-tel'],
						'sender' => $_POST['nissan-email'],
						'message' => $message,
					)
				);
				include_once 'MCAPI.php';
				$api_key = '12022340ba889a32c821c6a318ee37d2-us6';
				$general_list = '33451839ae';
				$api = new MCAPI($api_key);
				$name = explode( ' ', $_POST['nissan-name'] );
				$merge_vars = array(
					'FNAME' => $name[0], 
					'LNAME' => $name[1], 
				);

				$retval = $api->listSubscribe( $general_list, $_POST['nissan-email'], $merge_vars );
				wp_mail( $to, $subject, $message, $headers );
				$headers = 'FROM: Enquiries <no-reply@polesworth-garage.com>' . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset: utf8\r\n";
				$subject = 'Polesworth Garage Nissan Care Service';
				$message = '<strong>You have ordered a Service from the <a href="http://www.polesworth-garage.com" title="visit the website">Polesworth Garage</a> website:</strong><br /><br />';
				$message .= '<strong>You will be contacted regarding the Service shortly.</strong><br /><br />';
				$message .= '<b>Name:</b> ' . $_POST['nissan-name'] . '<br />';
				$message .= '<b>Address:</b> ' . $_POST['nissan-address'] . '<br />';
				$message .= '<b>Postcode:</b> ' . $_POST['nissan-postcode'] . '<br />';
				$message .= '<b>Telephone:</b> ' . $_POST['nissan-tel'] . '<br />';
				$message .= '<b>E-Mail:</b> ' . $_POST['nissan-email'] . '<br />';
				$message .= '---------------------------------------------------------------' . '<br /><br />';
				$message .= '<b>Car Class:</b> ' . $_POST['nissan-class'] . '<br />';
				$message .= '<b>Fuel:</b> ' . $_POST['nissan-fuel'] . '<br />';
				$message .= '<b>Car Registration:</b> ' . $_POST['nissan-reg'] . '<br />';
				$message .= '<b>Car Model:</b> ' . $_POST['nissan-model'] . '<br />';
				$message .= '<b>Preferred Date:</b> ' . $_POST['nissan-date'] . '<br />';
				$message .= '<br><font color="red"><strong>DO NOT CLICK REPLY TO THIS MESSAGE</font></strong><br><br>';
				wp_mail( $_POST['nissan-email'], $subject, $message, $headers );
				$return .= '<br /><h4>Booking Received</h4><br />';
				$return .= '<script type="text/javascript">';
					$return .= 'var _gaq = _gaq || [];';
					$return .= "_gaq.push(['_trackEvent', 'Service', 'Service', '" . $_POST['nissan-class'] . " Service Booked']);";
				$return .= '</script>';
			} else {
				ob_start(  );
				include 'templates/nissan-care-form.php';
				$return .= ob_get_contents(  );
				ob_end_clean(  );
			}
			$return .= '</div>';
		endif;
		return $return;
	}
	add_shortcode( 'nissan_service', 'nissan_service_shortcode' );
}
if( !function_exists( 'service_shortcode' ) ) {
	function service_shortcode(  ) {
		global $wpdb;
		if( check_user_agent( '' ) === true && !$_COOKIE['desktop'] ) :
			$return = '<a href="mailto:pg@safeserps.co.uk" class="button">Book a Service</a>';
		else :
			$return =  '<a href="#service" class="button" id="service-button">Book a Service</a>';
			$return .= '<div id="service" class="popup">';
			if( isset( $_POST['service-submit'] ) && strlen( $_POST['service-name'] ) > 1 && strlen( $_POST['service-tel'] ) > 1 && strlen( $_POST['service-email'] ) > 1 && strlen( $_POST['service-date'] ) > 1) {
				$to = 'pg@safeserps.co.uk';
				$email_table = $wpdb->prefix . 'emails'; 
				$headers = 'FROM: Enquiries <no-reply@polesworth-garage.com>' . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset: utf8\r\n";
				$subject = $_POST['service-name'] . ' would like a Service';
				$message = '<strong>' . $_POST['service-name'] . ' has requested a Service from the <a href="http://www.polesworth-garage.com" title="visit the website">Polesworth Garage</a> website:</strong><br /><br />';
				$message .= '<b>Name:</b> ' . $_POST['service-name'] . '<br />';
				$message .= '<b>Address:</b> ' . $_POST['service-address'] . '<br />';
				$message .= '<b>Postcode:</b> ' . $_POST['service-postcode'] . '<br />';
				$message .= '<b>Telephone:</b> ' . $_POST['service-tel'] . '<br />';
				$message .= '<b>E-Mail:</b> ' . $_POST['service-email'] . '<br />';
				$message .= '---------------------------------------------------------------' . '<br /><br />';
				$message .= '<b>Service Class:</b> ' . $_POST['service-class'] . '<br />';
				$message .= '<b>Fuel:</b> ' . $_POST['service-fuel'] . '<br />';
				$message .= '<b>Car Registration:</b> ' . $_POST['service-reg'] . '<br />';
				$message .= '<b>Car Make:</b> ' . $_POST['service-make'] . '<br />';
				$message .= '<b>Car Model:</b> ' . $_POST['service-model'] . '<br />';
				$message .= '<b>Car Engine Size:</b> ' . $_POST['service-size'] . '<br />';
				$message .= '<b>Preferred Date:</b> ' . $_POST['service-date'] . '<br />';
				$message .= '<br><font color="red"><strong>DO NOT CLICK REPLY TO THIS MESSAGE</font></strong><br><br>';
				$wpdb->insert( 
					$email_table,
					array( 
						'name' => $_POST['service-name'],
						'tel' => $_POST['service-tel'],
						'sender' => $_POST['service-email'],
						'message' => $message,
					)
				);
				include_once 'MCAPI.php';
				$api_key = '12022340ba889a32c821c6a318ee37d2-us6';
				$general_list = '33451839ae';
				$api = new MCAPI($api_key);
				$name = explode( ' ', $_POST['service-name'] );
				$merge_vars = array(
					'FNAME' => $name[0], 
					'LNAME' => $name[1], 
				);

				$retval = $api->listSubscribe( $general_list, $_POST['service-email'], $merge_vars );
				wp_mail( $to, $subject, $message, $headers );
				$headers = 'FROM: Enquiries <no-reply@polesworth-garage.com>' . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset: utf8\r\n";
				$subject = 'Polesworth Garage Nissan Care Service';
				$message = '<strong>You have ordered a Service from the <a href="http://www.polesworth-garage.com" title="visit the website">Polesworth Garage</a> website:</strong><br /><br />';
				$message .= '<strong>You will be contacted regarding the Service shortly.</strong><br /><br />';
				$message .= '<b>Name:</b> ' . $_POST['service-name'] . '<br />';
				$message .= '<b>Address:</b> ' . $_POST['service-address'] . '<br />';
				$message .= '<b>Postcode:</b> ' . $_POST['service-postcode'] . '<br />';
				$message .= '<b>Telephone:</b> ' . $_POST['service-tel'] . '<br />';
				$message .= '<b>E-Mail:</b> ' . $_POST['service-email'] . '<br />';
				$message .= '---------------------------------------------------------------' . '<br /><br />';
				$message .= '<b>Service Class:</b> ' . $_POST['service-class'] . '<br />';
				$message .= '<b>Fuel:</b> ' . $_POST['service-fuel'] . '<br />';
				$message .= '<b>Car Registration:</b> ' . $_POST['service-reg'] . '<br />';
				$message .= '<b>Car Make:</b> ' . $_POST['service-make'] . '<br />';
				$message .= '<b>Car Model:</b> ' . $_POST['service-model'] . '<br />';
				$message .= '<b>Car Engine Size:</b> ' . $_POST['service-size'] . '<br />';
				$message .= '<b>Preferred Date:</b> ' . $_POST['service-date'] . '<br />';
				$message .= '<br><font color="red"><strong>DO NOT CLICK REPLY TO THIS MESSAGE</font></strong><br><br>';
				wp_mail( $_POST['service-email'], $subject, $message, $headers );
				$return .= '<br /><h4>Booking Received</h4><br />';
				$return .= '<script type="text/javascript">';
					$return .= 'var _gaq = _gaq || [];';
					$return .= "_gaq.push(['_trackEvent', 'Service', 'Service', '" . $_POST['service-class'] . " Service Booked']);";
				$return .= '</script>';
			} else {
				ob_start(  );
				include 'templates/service-form.php';
				$return .= ob_get_contents(  );
				ob_end_clean(  );
			}
			$return .= '</div>';
		endif;
		return $return;
	}
	add_shortcode( 'service', 'service_shortcode' );
}

