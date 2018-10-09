<?php
/*
Template Name: Sidebar Page
*/
	get_header();
?>
	<section class="main">
		<div class="wrapper">
			<div class="two-thirds">
				<?php
					while ( have_posts(  ) ) : 
						the_post(  ); ?>
						the_content('  ');

					endwhile;
				?>
			</div>
			<?php
				get_sidebar(  );
			?>
		</div>
	</section>
<?php
	get_footer();
?>