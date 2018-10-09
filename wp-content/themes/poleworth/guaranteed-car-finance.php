<?php

/*

	Template Name: Guaranteed Car Finance

*/

	get_header();

	$valid = get_option( 'pg_finance_registrations1', array(  ) );

	$cars = get_posts( array(

		'post_type' => 'car',

		'numberposts' => -1,

		'meta_query' => array(

			array(

				'key' => 'FullRegistration',

				'value' => $valid,

				'compare' => 'IN'

			)

		)

	));

?>

	<section class="main">

		<div class="wrapper">

		<?php

		while ( have_posts(  ) ) : 

			the_post(  );

			the_content('  ');

		endwhile;

		

	echo '<ul id="car-listings" class="car-listings">';

	foreach( $cars as $post ) {

		setup_postdata( $post );

		$permalink = get_permalink(  );

		$title = get_the_title(  );

		the_result( $post->ID, $permalink, $title );

	}

	wp_reset_postdata();

	echo '</ul>';

	?>





		</div>

	</section>

<?php

	get_footer();

?>