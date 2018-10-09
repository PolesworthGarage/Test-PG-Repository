<?php
	if( isset( $_GET['desktop'] ) && $_GET['desktop'] == true ) {
		setcookie( 'desktop', true, time(  )+3600 );
	}
	
	$name = get_bloginfo( 'name' );
	$description = get_bloginfo( 'description' );
	$url = get_bloginfo( 'wpurl' );
	$stylesheet = get_bloginfo( 'stylesheet_directory' );
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
	<?php/* if( check_user_agent( 'mobile' ) === true && !$_COOKIE['desktop'] ) : ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<?php endif; */?>
	<?php
	if ( is_single(  ) || is_404(  ) ) :
		if(have_posts()) : the_post(); 
			if( get_post_type( $post ) == 'car' ) :
				$fields = get_post_custom(  );
				if( !empty( $fields['PictureRefs'] ) ) {
					$pictures = explode( ',', $fields['PictureRefs'][0] );
				} else {
					$images = get_post_meta( get_the_ID(  ), 'CarImages' );
					$images = $images[0];
				}
				if( $fields['Bodytype'][0] == 'Caravan' ) {
					echo '<meta name="description" content="Used ' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Variant'][0] . ' for sale. Only ' . $fields['Mileage'][0] . ' miles, ' . $fields['Year'][0] . ' model in ' . $fields['Colour'][0] . ' just £' . $fields['Price'][0] . '. Finance available, discover more." />';
				} else {
					echo '<meta name="description" content="Used ' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Variant'][0] . ' for sale. ' . $fields['Year'][0] . ' model in ' . $fields['Colour'][0] . ' just £' . $fields['Price'][0] . '. Finance available, discover more." />';
				}

				if( !empty( $pictures ) ) {
					foreach( $pictures as $picture ):
						echo '<meta prefix="og: http://ogp.me/ns#" property="og:image" content="' . $picture . '">';
					endforeach;
				} else {
					foreach( $images as $picture ):
						echo '<meta prefix="og: http://ogp.me/ns#" property="og:image" content="' . $picture['url'] . '">';
					endforeach;
				}
				
			else:
				echo '<meta name="description" content="' . $description . '" />';
			endif;
			rewind_posts();
		endif;
	endif;
	?>
	
	<?php 
		if ( is_search(  ) ) :
			echo '<meta name="robots" content="noindex, nofollow" />';
		endif;
		wp_head(  ); 
	?>
	<title>
	<?php
		
			if ( is_single(  ) ) :
				if(have_posts()) : the_post(); 
					if( get_post_type( $post ) == 'car' ) :
						$fields = get_post_custom(  );
						echo $name . ' | Used Cars | ' . ucfirst( strtolower( $fields['Make'][0] ) ) . ' | ' . $fields['Model'][0] . ' ' . $fields['Variant'][0];
					else:
						echo $name;
						wp_title( '|', true );
					endif;
					unset( $fields );
					rewind_posts();
				endif;
			elseif( is_search(  ) ) :
				$search_refer = get_query_var( 's' );
				$search_refer = explode( '/', $search_refer );
				$current_page = 1;
				if( isset( $search_refer[1] ) ) {
					$current_page = $search_refer[1];
					echo $name . ' | Search Results | Page ' . $current_page;
				} else {
					echo $name . ' | Search Results';
				}
				
			elseif( is_404(  ) ) :
				echo $name . ' | 404 Page Not Found';
			elseif( is_post_type_archive( 'gallery' ) ) :
				echo $name . ' | Galleries';
			else :
				if(have_posts()) : the_post(); 
				$fields = get_post_custom(  );
					echo $fields['_su_title'][0];
				endif;
				rewind_posts();
			endif;
		?>
		</title>
		<!--[if lt IE 9]>
			<script src="<?php echo $stylesheet; ?>/javascript/html5shiv.js"></script>
		<![endif]-->
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700" />
	<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet;?>/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet;?>/style2.css" />
	<?php/* if( check_user_agent( 'mobile' ) === true && !$_COOKIE['desktop'] ) : ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet;?>/mobile.css" />
	<?php endif; */?>
</head>
<body>

<?php/* if( check_user_agent( 'mobile' ) === true && !$_COOKIE['desktop'] ) : ?>
	<section id="sub-nav">
		<span>01827 780 467</span>
	</section>
	<header>
		<h1>
			<a href="<?php echo $url; ?>">
				<img src="<?php echo $stylesheet; ?>/images/mobile-logo.jpg" alt="Polesworth Garage" />
			</a>
		</h1>
	</header>
	<?php if( is_front_page(  ) ) : ?>
		<nav class="mobile">
			<ul>
				<li>
					<a href="/used-cars">Used Cars</a>
				</li>
				<li>
					<a href="/used-vans">Used Vans</a>
				</li>
				<li>
					<a href="/car-hire">Car Hire</a>
				</li>
				<li>
					<a href="/van-hire">Van Hire</a>
				</li>
				<li>
					<a href="/garage-services">Servicing</a>
				</li>
				<li>
					<a href="/garage-services">MOT</a>
				</li>
				<li class="span-two">
					<a href="/contact-us">Contact Us</a>
				</li>
			</ul>
		</nav>

		<footer>
			<div class="copyright">
				<nav>
					<ul>
						<li><a href="/?desktop=true">Desktop Site</a></li>
					</ul>
				</nav>
				&copy; Polesworth Garage Ltd
			</div>
		</footer>
		</body>
		</html>
		<?php die; ?>
	<?php endif; ?>
<?php else :*/ ?>
	<section id="sub-nav" role="navigation">
		<nav class="wrapper">
			<?php
			wp_nav_menu( 
				array( 
					'container'      	=> '', 
					'container_class'	=> '',
					'container_id'   	=> '',
					'fallback_cb'    	=> 'navigation_main',
					'theme_location' 	=> 'Sub_Navigation',
				) 
			); 
			?>
		</nav>
	</section>
	<header>
		<div class="wrapper">
			<h1><a href="<?php echo $url; ?>"><img src="http://www.polesworthgarage-nissan.co.uk/images/logoLarge.gif" alt="Nissan">" title="Polesworth Garage" alt="Polesworth Garage" /></a></h1>
			<nav>
				<?php
				wp_nav_menu( 
					array( 
						'container'      	=> '', 
						'container_class'	=> '',
						'container_id'   	=> '',
						'fallback_cb'    	=> 'navigation_main',
						'theme_location' 	=> 'Main_Navigation',
					) 
				); 
				?>
			</nav>
		</div>
	</header>
<?php /*endif;*/ ?>