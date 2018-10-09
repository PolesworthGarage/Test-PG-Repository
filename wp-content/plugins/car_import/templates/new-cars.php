<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Import New Cars</h2> 
	<form method="post" action="options.php"> 
		<?php settings_fields( 'car_import-new-location' ); ?> 
		<?php do_settings_fields( 'car_import-new-location', 'car-settings' ); ?> 
		<table class="form-table"> 
			<tr valign="top"> 
				<th scope="row">
					<label for="new_location">File Location</label>
				</th>
				<td>
					<?php
						$location = get_option( 'new_location' );
						if( $location == FALSE ) {
							$location = ABSPATH . 'PolesworthGarage.csv';
						}
					?>
					<input type="text" name="new_location" id="new_location" value="<?php echo $location; ?>" class="regular-text" />
				</td>
			</tr>
		</table> 
		<?php submit_button(); ?> 
	</form> 
</div>