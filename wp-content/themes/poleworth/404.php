<?php
	get_header(  );
	$make = get_query_var( 'make' );
?>
	<section class="main">
		<div class="wrapper">
			<h2>It would appear that you have a bit of a problem!</h2>
			<p><img class="alignright  wp-image-13648" alt="Page not found" src="/wp-content/uploads/2013/06/404-Error-Page-not-found3.png" width="318" height="180" />The problem being, this is <strong>definitely not</strong> the page you're looking for.</br></br>If you followed a link to a car, and you've landed here, it's likely we've sold the car.<br>However, you can view a full list of the cars we have in stock <a href="/used-cars" title="Used Cars">here</a>.<br><br>Alternatively, you can find your way by using our <a href="/sitemap" title="Our Full Sitemap">Sitemap</a> page or by using the links above or below.</p>
		<?php
		$search_args = array(
			'numberposts' => 3,
			'post_type' => 'car',
			'orderby' => 'rand'
		);
		if( isset( $make ) && !empty( $make ) ):
			$search_args['tax_query'] = array(  );
			$search_args['tax_query'][] = array(
				'taxonomy' => 'make',
				'field' => 'slug',
				'terms' => $make,
			);
		endif;
		$cars = get_posts( $search_args );
		echo '<hr />';
		echo '<h4>Perhaps you were looking for one of these?</h4>';
		echo '<ul class="error-cars">';
		foreach( $cars as $car ) :
			$fields = get_post_custom( $car->ID );
			$pictures = explode( ',', $fields['PictureRefs'][0] );
			if (strlen(get_the_title( $car->ID )) > 45) { //Character length
				$title_short = substr(get_the_title( $car->ID ), 0, 45); // Character length
				preg_match('/^(.*)\s/s', $title_short, $matches);
				if ($matches[1]) $title_short = $matches[1];
				$title_short = $title_short.' ...'; // Ellipsis
			} else {
				$title_short = get_the_title( $car->ID );
			} 
			echo '<li class="third">';
				echo '<a href="' . get_bloginfo( 'wpurl' ) . '/used-cars/' . strtolower( str_replace( ' ', '-', $fields['Make'][0] ) ) . '/' . $car->post_name . '">';
					echo '<img src="' . $pictures[0] .'" width="300" />';
				echo '</a>';
				echo '<h3>';
					echo '<a href="' . get_bloginfo( 'wpurl' ) . '/used-cars/' . strtolower( str_replace( ' ', '-', $fields['Make'][0] ) ) . '/' . $car->post_name . '">';
						echo $title_short;
					echo '</a>';
				echo '</h3>';
				echo '<ul class="main-details alignleft">';
							if( $fields['Bodytype'][0] != '' ):
								echo '<li>' . $fields['Bodytype'][0] . ',</li>';
							endif;
							if( $fields['Year'][0] != '' ):
								echo '<li>' . $fields['Year'][0] . ',</li>';
							endif;
							if( $fields['Mileage'][0] != '' ):
								echo '<li>' . $fields['Mileage'][0] . ' Miles,</li>';
							endif;
							if( $fields['FuelType'][0] != '' ):
							echo '<li> ' . $fields['FuelType'][0] . ',</li>';
							endif;
							if( $fields['Transmission'][0] != '' ):
								echo '<li>' . $fields['Transmission'][0] . '</li>';
							endif;
						echo '</ul>';
			echo '</li>';
		endforeach;
		echo '</ul>';
		?>
		</div>
	</section>
<?php
	get_footer(  );
?>