<?php
	/*
	Template Name: Used Cars Filter Template
	*/
	if( isset( $_POST['post_type'] ) ) {
		$_SESSION['wp_current_search'] = $_POST;
		header( 'Location: /' . $pagename, true, 303 );
	}
	if( get_query_var( 'car' ) ) {

		$slug = get_page_by_path( get_query_var( 'car' ) );
		$custom = get_post_custom( $slug->ID );
		header( 'Location: /used-cars/' . $custom['Make'][0] . '/' . get_query_var( 'car' ), true, 301 );

	}
	get_header();
?>
	<section class="main">
		<div class="wrapper">
		<?php
		if(have_posts()) : 
			the_post(  );
			echo '<div class="intro-text">';
			the_content(  );
			echo '<hr />';
			echo '</div>';
			$custom = get_post_custom(  );
			$arr = array(  );
			$arr['min'] = 0;
			$arr['max'] = 1000000;
			$arr['type'] = 'all';
			$arr['make'] = 'all';
			$arr['model'] = 'all';
			$arr['post_type'] = 'car';
			$arr['find-cars'] = 'Search'; 
			$current_page = 1;

			if( is_array( $custom['Bodytype'] ) ) {
				$arr['body'] = $custom['Bodytype'];
				if( in_array( 'VAN', $arr['body'] ) ) {
					$arr['body'][] = 'Pick up';
				}
			}

			if( is_array( $custom['FuelType'] ) ) {
				$arr['fuel'] = $custom['FuelType'][0];
			}

			if( is_array( $custom['Make'] ) ) {
				$the_make = term_exists( $custom['Make'][0], 'make' );
				$arr['make'] = $the_make['term_id'];
			}

			if( is_array( $custom['Model'] ) && !empty( $custom['Model'] ) ) {
				$arr['model'] = $custom['Model'];
			} 

			if( is_array( $custom['Transmission'] ) ) {
				$arr['transmission'] = $custom['Transmission'][0];
			}

			if( is_array( $custom['Price'] ) ) {
				$arr['min'] = 0;
				$arr['max'] = $custom['Price'][0];
			}

			if( is_array( $custom['Year'] ) ) {
				$arr['year'] = $custom['Year'][0];
			}

			$_SESSION['wp_current_search'] = $arr;
			
			include 'filterfull2.php';
			echo '<div id="results" name="results" style="float:right;width:65%;">';
				include_once 'ajax-results.php'; 
			echo '</div>';

		endif;
		wp_reset_postdata();
		?>

		</div>
	</section>
<?php
	get_footer();
?>