<?php
	get_header();
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