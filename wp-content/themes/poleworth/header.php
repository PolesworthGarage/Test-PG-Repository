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
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
        <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php/* if( check_user_agent( 'mobile' ) === true && !$_COOKIE['desktop'] ) : ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-

scalable=0" />
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
					echo '<meta name="description" content="Used ' . $fields

['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Variant'][0] . '. Only ' . $fields['Mileage'][0] . ' miles, ' . $fields

['Year'][0] . ' model in ' . $fields['Colour'][0] . ' just £' . $fields['Price'][0] . '. Finance available. View Caravan." />';
				} else {
					echo '<meta name="description" content="Used ' . $fields

['Make'][0] . ' ' . $fields['Model'][0] . ' ' . $fields['Variant'][0] . '. ' . $fields['Year'][0] . ' model in ' . $fields['Colour'][0] 

. ' just £' . $fields['Price'][0] . '. Finance available. View Car." />';
				}

				if( !empty( $pictures ) ) {
					foreach( $pictures as $picture ):
						echo '<meta prefix="og: http://ogp.me/ns#" 

property="og:image" content="' . $picture . '">';
					endforeach;
				} else {
					foreach( $images as $picture ):
						echo '<meta prefix="og: http://ogp.me/ns#" 

property="og:image" content="' . $picture['url'] . '">';
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
						echo $name . ' | Used Cars | ' . ucfirst( 

strtolower( $fields['Make'][0] ) ) . ' | ' . $fields['Model'][0] . ' ' . $fields['Variant'][0];
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
			<script src="/nozoom.js"></script>
		<![endif]-->


	<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet;?>/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet;?>/style.css?v=1.1.3" />
        <link rel="shortcut icon" href="/favicon.ico" />
	<?php/* if( check_user_agent( 'mobile' ) === true && !$_COOKIE['desktop'] ) : ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet;?>/mobile.css" />
	<?php endif; */?>
<meta name="google-site-verification" content="q1aA8sbV8WtGdy21IBtO93D27yjpD0UX1U5S6eFPES4" />
<!-- Start of LiveChat (www.livechatinc.com) code -->
<script type="text/javascript">
window.__lc = window.__lc || {};
window.__lc.license = 10047548;
(function() {
  var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
  lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>
<noscript>
<a href="https://www.livechatinc.com/chat-with/10047548/">Chat with us</a>,
powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener" target="_blank">LiveChat</a>
</noscript>
<!-- End of LiveChat code -->
<!-- Top Navigation Menu -->
<div class="topnav">
 <a href="/" class="active" style="font-weight:700;padding-left:3%;background-color:#c11e1e;"><img src="/wp-content/uploads/2018/10/Home-Icon.png" style="width:42px;height:42px;margin-top:-0.8%;margin-right:2%;float:left;"> Polesworth Garage</a>
 <div id="myLinks">
   <a class="dropdown-btn" style="float: right;padding-right: 4%;margin-left:60%;">Used Cars <i class="fa fa-caret-down"></i></a>
     <div class="dropdown-container">
     <a href="/used-cars/" style="float: right;padding-right: 10%;margin-left:40%;">Used Car Search</a>
     <a href="/used-cars/cheap-cars/" style="float: right;padding-right: 10%;margin-left:50%;">Under £5000</a>
     <a href="/used-cars/automatic-cars/" style="float: right;padding-right: 10%;margin-left:50%;">Automatics</a>
     <a href="/used-cars/estate-cars/" style="float: right;padding-right: 10%;margin-left:50%;">Estate Cars</a>
     <a href="/used-cars/diesel-cars/" style="float: right;padding-right: 10%;margin-left:50%;">Diesels</a>
     <a href="/used-cars/mpv-7-seater-cars/" style="float: right;padding-right: 10%;margin-left:30%;">MPV's and 7 Seaters</a>
     <a href="/used-cars/convertibles/" style="float: right;padding-right: 10%;margin-left:20%;">Cabriolets and Convertibles</a>
     <a href="/used-cars/part-exchange-bargains/" style="float: right;padding-right: 10%;margin-left:25%;">Part Exchange Bargains</a>
     </div>
     <a href="/used-vans/" style="float: right;padding-right: 4%;margin-left:40%;">Used Vans</a>
     <a class="dropdown-btn" style="float: right;padding-right: 4%;margin-left:60%;">New Cars <i class="fa fa-caret-down"></i></a>
     <div class="dropdown-container">
     <a href="/new-cars/" style="float: right;padding-right: 10%;margin-left:40%;">Full Nissan Range</a>
     <a href="/new-cars/nissan-micra/" style="float: right;padding-right: 10%;margin-left:50%;">Nissan Micra</a>
     <a href="/new-cars/nissan-pulsar/" style="float: right;padding-right: 10%;margin-left:50%;">Nissan Pulsar</a>
     <a href="/new-cars/nissan-juke/" style="float: right;padding-right: 10%;margin-left:50%;">Nissan Juke</a>
     <a href="/new-cars/nissan-qashqai/" style="float: right;padding-right: 10%;margin-left:50%;">Nissan Qashqai</a>
     <a href="/new-cars/nissan-x-trail/" style="float: right;padding-right: 10%;margin-left:50%;">Nissan X-Trail</a>
     <a href="/new-cars/nissan-370z/" style="float: right;padding-right: 10%;margin-left:50%;">Nissan 370Z</a>
     <a href="/new-cars/nissan-navara/" style="float: right;padding-right: 10%;margin-left:50%;">Nissan Navara</a>
     <a href="/new-cars/nissan-leaf-2/" style="float: right;padding-right: 10%;margin-left:50%;">Nissan Leaf</a>
     </div>
   <a class="dropdown-btn" style="float: right;padding-right: 4%;margin-left:60%;">Car Finance <i class="fa fa-caret-down"></i></a>
     <div class="dropdown-container">
     <a href="/car-finance/" style="float: right;padding-right: 10%;margin-left:40%;">Our Car Finance</a>
     <a href="/car-finance/apply-online/" style="float: right;padding-right: 10%;margin-left:50%;">Apply Online</a>
     <a href="/car-finance/guaranteed-car-finance/" style="float: right;padding-right: 10%;margin-left:30%;">Guaranteed Car Finance</a>
     <a href="/car-finance/bad-credit-car-finance/" style="float: right;padding-right: 10%;margin-left:30%;">Bad Credit Car Finance</a>
     </div>
   <a class="dropdown-btn" style="float: right;padding-right: 4%;margin-left:40%;">Garage Services <i class="fa fa-caret-down"></i></a>
     <div class="dropdown-container">
     <a href="/garage-services/" style="float: right;padding-right: 10%;margin-left:40%;">Garage Services</a>
     <a href="/garage-services/car-servicing/" style="float: right;padding-right: 10%;margin-left:50%;">Car Servicing</a>
     <a href="/garage-services/mot-testing/" style="float: right;padding-right: 10%;margin-left:50%;">MOT Testing</a>
     <a href="/garage-services/mot-testing/book-mot/" style="float: right;padding-right: 10%;margin-left:50%;">Book an MOT</a>
     <a href="/garage-services/tyres/" style="float: right;padding-right: 10%;margin-left:50%;">Tyres</a>
     <a href="/garage-services/brakes/" style="float: right;padding-right: 10%;margin-left:50%;">Brakes</a>
     <a href="/garage-services/exhausts/" style="float: right;padding-right: 10%;margin-left:50%;">Exhausts</a>
     <a href="/garage-services/air-conditioning/" style="float: right;padding-right: 10%;margin-left:50%;">Air conditioning</a>
     <a href="/garage-services/bodyshop/" style="float: right;padding-right: 10%;margin-left:50%;">Bodyshop</a>
     </div>
   <a href="/personalised-registrations/" style="float: right;padding-right: 4%;margin-left:30%;">Personalised Registrations</a>
   <a href="/contact-us/" style="float: right;padding-right: 4%;margin-left:60%;">Contact Us</a>
<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; width:100%;}
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="header_embed_signup" style="border-bottom:1px solid #c11e1e;">
<form action="https://polesworth-garage.us14.list-manage.com/subscribe/post?u=da0a75c27a04a8a6ac915b407&amp;id=ace6365141" method="post" id="header-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="header_embed_signup_scroll">
        
	<label for="header-EMAIL"><p style="color: #fff;font-size: 2.8em;line-height: 1.4em;margin-top: 1%;margin-bottom: 2%;float: left;margin-left: 2%;text-align: center;border-top: 1px solid #fff;border-bottom: 1px solid #fff;margin-right:2%;">SIGN-UP BELOW TO RECEIVE OUR WEEKLY NEW ARRIVALS EMAIL</p></label>
	<input type="email" value="" name="EMAIL" class="email" id="header-EMAIL" placeholder="your email address" required>
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_da0a75c27a04a8a6ac915b407_ace6365141" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="header-embedded-subscribe" class="button" onClick="ga('send', 'event', { eventCategory: 'header-embedded-subscribe', eventAction: 'signup', eventLabel: 'Newsletter Conversion', eventValue: 1});"></div>
    </div>
</form>
</div>

 </div>
 <a href="javascript:void(0);" class="icon" onclick="myFunction1()">
 <i class="fa fa-bars"></i>
 </a>
</div>
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
			<h1 id="polesworth-logo" class="mobilegone"><a href="<?php echo $url; ?>"><img src="/wp-content/uploads/2014/03/Polesworth-Garage-Logo.png" title="Polesworth Garage" alt="Polesworth Garage" 

/></a></h1>
			                <div id="mobile-contact-link" class="mobile-contact"><a href="/contact-us/" title="Contact Us">CONTACT US - 01827 895125</a></div>
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