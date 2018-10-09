<?php
	get_header();
?>
	<section class="main">
		<div class="wrapper">
			<div class="two-thirds">
			<?php global $more; $more = 0; ?>

			<?php
			$page = get_page_by_title( 'News' );
			$test = get_page( $page->ID );
			//echo $test->post_content;
			while ( have_posts(  ) ) : 
				the_post(  );
			
				$id = get_the_id(  );
				$format = get_post_format(  );
				$permalink = get_permalink(  );
				$title = get_the_title(  );
				echo '<h2>';
					echo '<a href="' . $permalink . '">';
						echo $title;
					echo '</a>';
				echo '</h2>';
				echo '<time datetime="' . get_the_time( 'Y\-m\-d', $id ) . '">';
					echo get_the_time( 'jS F Y', $id ); 
				echo '</time>';
				echo '<hr />'; ?>
				<?php the_content(__('(more...)'));
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