<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>*|MC:SUBJECT|*</title>
</head>
<body>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td>
		<img src="http://www.polesworth-garage.com/wp-content/themes/poleworth/images/email-header.jpg" alt="Polesworth Garage - Contact us on 01827 895125" border="0" height="105" width="600" style="display:block">
	</td>
</tr>
<tr>
	<td>
		<img src="http://www.polesworth-garage.com/wp-content/themes/poleworth/images/s.gif" alt="" border="0" height="20" width="600" style="display:block">
	</td>
</tr>
<tr>
	<td style="color:#333333; font-family:Helvetica, Arial, sans-serif;">
		*|FNAME|*,<br /><br />
		<div mc:edit="content">
			<?php echo stripslashes( $email_content ); ?>
		</div>
	</td>
</tr>
<tr>
	<td>
		<img src="http://www.polesworth-garage.com/wp-content/themes/poleworth/images/s.gif" alt="" border="0" height="10" width="600" style="display:block">
	</td>
</tr>
<tr>
	<td bgcolor="#DDDDDD">
		<img src="http://www.polesworth-garage.com/wp-content/themes/poleworth/images/s.gif" alt="" border="0" height="1" width="600" style="display:block">
	</td>
</tr>
<tr>
	<td>
		<img src="http://www.polesworth-garage.com/wp-content/themes/poleworth/images/s.gif" alt="" border="0" height="10" width="600" style="display:block">
	</td>
</tr>
<?php
	foreach( $cars as $car ) :
		$fields = get_post_custom( $car->ID );
		$pictures = explode( ',', $fields['PictureRefs'][0] );
		if ( strlen( $car->post_title ) > 30) {
			$car_name = substr($car->post_title, 0, 30); 
			preg_match('/^(.*)\s/s', $car_name, $matches);
			if ($matches[1]) $car_name = $matches[1];
			$car_name = $car_name.' ...'; 
		} else {
			$car_name = $car->post_title;
		} 
		
		$car_desc = 'This ' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ', registration number ' . $fields['FullRegistration'][0] . ' was first registered in  ' . $fields['Year'][0] . ' and is fitted with a ' . $fields['FuelType'][0] . ' engine and ' . $fields['Transmission'][0] . ' gearbox. It has covered just ' . $fields['Mileage'][0] . ' miles and is finished in ' .  $fields['Colour'][0] . '.';
		$car_price = $fields['Price'][0];
		$image_url = $pictures[0];
?>
<tr>
	<td>
		<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td>
					<img src="<?php echo $image_url; ?>" alt="<?php echo $car_name; ?>" style="display: block; border: 2px solid #c11e1e;" width="150" />
				</td>
				<td>
					<img src="http://www.polesworth-garage.com/wp-content/themes/poleworth/images/s.gif" alt="" border="0" height="0" width="20" style="display:block">
				</td>
				<td style="color:#C11E1E; font-family:Helvetica, Arial, sans-serif; font-size:16px; line-height:150%">
					<strong>
						<a href="<?php echo  get_bloginfo( 'wpurl' ) . '/used-cars/' . strtolower( str_replace( ' ', '-', $fields['Make'][0] ) ) . '/' . $car->post_name; ?>">
							<font style="color:#C11E1E; font-family:Helvetica, Arial, sans-serif; font-size:16px; line-height:150%">
								<?php echo $car_name; ?>
							</font>
						</a>
					</strong><br />
					<font style="color:#999999; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:150%">
						<?php echo $fields['Bodytype'][0]; ?>,
						<?php echo $fields['Year'][0]; ?>
						<?php echo $fields['Mileage'][0]; ?>
						<?php echo $fields['FuelType'][0]; ?>
						<?php echo $fields['Transmission'][0]; ?>
					</font><br />
					<font style="color:#333333; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:150%">
						<?php echo $car_desc; ?>
					</font>
				</td>
				<td>
					<img src="http://www.polesworth-garage.com/wp-content/themes/poleworth/images/s.gif" alt="" border="0" height="0" width="20" style="display:block">
				</td>
				<td style="color:#C11E1E; font-family:Helvetica, Arial, sans-serif; font-size:16px; line-height:150%; text-align: center;">
					<strong>
						<a href="<?php echo  get_bloginfo( 'wpurl' ) . '/used-cars/' . strtolower( str_replace( ' ', '-', $fields['Make'][0] ) ) . '/' . $car->post_name; ?>">
							<font style="color:#C11E1E; font-family:Helvetica, Arial, sans-serif; font-size:18px; line-height:150%; text-decoration: none;">
								£<?php echo number_format( $car_price, 2 ); ?>
							</font>
						</a>
						<br />
						<a href="<?php echo  get_bloginfo( 'wpurl' ) . '/used-cars/' . strtolower( str_replace( ' ', '-', $fields['Make'][0] ) ) . '/' . $car->post_name; ?>">
							<img src="http://www.polesworth-garage.com/wp-content/themes/poleworth/images/button.jpg" border="0" width="124" height="43" style="display:block;" />
						</a>
					</strong>
				</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<img src="http://www.polesworth-garage.com/wp-content/themes/poleworth/images/s.gif" alt="" border="0" height="10" width="600" style="display:block">
	</td>
</tr>
<tr>
	<td bgcolor="#DDDDDD">
		<img src="http://www.polesworth-garage.com/wp-content/themes/poleworth/images/s.gif" alt="" border="0" height="1" width="600" style="display:block">
	</td>
</tr>
<tr>
	<td>
		<img src="http://www.polesworth-garage.com/wp-content/themes/poleworth/images/s.gif" alt="" border="0" height="10" width="600" style="display:block">
	</td>
</tr>
<?php
	endforeach;
?>
<tr>
	<td align="center" valign="top" style="background: #333333; color:#c4c4c4; font-family:Helvetica, Arial, sans-serif; font-size:11px; line-height:150%; padding-right:20px; padding-bottom:20px; padding-top:20px; padding-left:20px; text-align:center;">
		This email was sent to <a href="*|EMAIL|*" target="_blank" style="color:#c4c4c4 !important;">*|EMAIL|*</a>
		<br>
		<a href="*|ABOUT_LIST|*" target="_blank" style="color:#c4c4c4!important;"><em>why did I get this?</em></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="*|UNSUB|*" style="color:#c4c4c4 !important;">unsubscribe from this list</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="*|UPDATE_PROFILE|*" style="color:#c4c4c4 !important;">update subscription preferences</a>
		<br>
		*|LIST:ADDRESSLINE|*
		<br>
		<br>
		*|REWARDS|*
	</td>
</tr>
</table>           
</body></html>