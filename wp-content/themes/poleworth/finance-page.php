<?php

	/**

	*	Template Name: Finance Form

	**/

	get_header();

$valid = get_option( 'pg_guaranteed_finance_registrations', array(  ) );

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

			the_content( '  ' );
			
		endwhile;

		?>

		</div>

	</section>

	<section class="gcf">

		<div class="wrapper">

		<?php	

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



<div style="margin-left:2%!important;margin-right:4%!important;margin-top:3%!important;"><strong>**Finance is subject to status.</strong>



<p>Guarantees and Indemnities may be required. We may be able to offer alternative finance offers other than the one(s) above. We have selected a group of car finance companies who offer finance to a broad range of people in any number of financial positions.</p>
<p>We cannot however offer finance from any other providers. With our PCP Finance products any excess mileage charges will apply only if you choose to return the vehicle, if you make the balloon payment this charge will not apply. The above rates are for internet users only and intended purely as a guide. Please contact us to make a finance application.</p>

Terms and conditions apply. Polesworth Garage is authorised and regulated by the Financial Conduct Authority (FCA).
</div>

<div id="car-finance-p"><p style="text-align: center;"><a title="Guaranteed Car Finance" href="/car-finance/guaranteed-car-finance/"><span style="color: #a82826;"><strong>Guaranteed Car Finance</strong></span></a> <span style="color: #a82826;"><span style="color: #000000;">-</span></span> <span style="color: #a82826;"><strong><a title="Bad Credit Car Finance" href="/car-finance/bad-credit-car-finance/">Bad Credit Car Finance</a> <span style="color: #000000;">-</span> Personal Leasing </strong></span> <span style="color: #a82826;"><span style="color: #000000;">-</span></span> <span style="color: #a82826;"><strong>Business Leasing</strong><span style="color: #000000;"> - </span><strong> <a title="Nissan Contract Hire" href="/car-finance/nissan-contract-hire/">Contract Hire</a></strong></span></p></div>

		</div>

	</section>

<?php

	get_footer();

?>