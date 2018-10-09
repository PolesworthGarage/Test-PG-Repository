<?php
/*
*	Template Name: Galleries
*/
get_header(  );
if( have_posts(  ) ):
	while( have_posts(  ) ):
		the_post(  );
		echo '<section class="main">';
			echo '<div class="wrapper gallery">';
			$args = array(
				'post_type' => 'gallery',
				'numberposts' => -1,
			); 
			$galleries = get_posts( $args );
				echo '<ul>';
				foreach ( $galleries as $gallery ) :
					echo '<li class="third">';
						echo '<a href="' . get_permalink( $gallery->ID ) . '">';
							$args = array(
								'post_type' => 'attachment',
								'numberposts' => 1,
								'post_status' => null,
								'post_parent' => $gallery->ID
							); 
							$attachments = get_posts( $args );
							foreach( $attachments as $attachment ) :
								$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'medium' );
								echo '<img src="' . $image_attributes[0] . '" alt="' . $attachment->post_title . '" />';
							endforeach;
							echo '<h3>' . $gallery->post_title . '</h3>';
						echo '</a>';
					echo '</li>';
				endforeach;
				echo '</ul>';
			echo '</div>';
		echo '</section>';
	endwhile;
endif;
get_footer(  );