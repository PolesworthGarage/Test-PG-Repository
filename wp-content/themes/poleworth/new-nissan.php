<?php
/**
*	Template Name: New Nissan
**/
	get_header( 'nissan' );
?>
	<section class="main">
		<div class="wrapper">
		<?php
		while ( have_posts(  ) ) : 
			the_post(  );
			the_content('  ');
		endwhile;
		?>
		</div>
	</section>
<?php
	get_footer();
?>