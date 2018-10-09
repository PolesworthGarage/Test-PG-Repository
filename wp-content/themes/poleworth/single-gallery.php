<?php
/*
*	Template Name: Gallery Single Page
*/
get_header(  );
echo '<section class="main">';
	echo '<div class="wrapper gallery">';
	if( have_posts(  ) ) :
		while( have_posts(  ) ) :
			the_post(  );
			echo '<h2>' . get_the_title(  ) . '</h2><br />';
			the_content(  );
			echo '<hr />';
			$args = array(
				'post_type' => 'attachment',
				'numberposts' => -1,
				'post_status' => null,
				'post_parent' => $post->ID
			); 
			$attachments = get_posts( $args );
			if ( $attachments ) :
				echo '<ul>';
				foreach ( $attachments as $attachment ) :
					$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'gallery-thumb' );
					$image_attributes_full = wp_get_attachment_image_src( $attachment->ID, 'full' );
					echo '<li class="third">';
						echo '<a href="' . $image_attributes_full[0] . '" class="lightbox" rel="gallery">';
							echo '<img src="' . $image_attributes[0] . '" alt="' . $attachment->post_title . '" />';
						echo '</a>';
					echo '</li>';
				endforeach;
				echo '</ul>';
			endif;
		endwhile;
	endif;
	echo '</div>';
echo '</section>';
get_footer(  );