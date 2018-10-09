<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Import Used Cars</h2> 
	<form method="post" action="options.php"> 
		<?php settings_fields( 'car_import-group' ); ?> 
		<?php do_settings_fields( 'car_import-group', 'car-settings' ); ?> 
		<table class="form-table"> 
			<tr valign="top"> 
				<th scope="row">
					<label for="location">File Location</label>
				</th>
				<td>
					<?php
						$location = get_option( 'location' );
						if( $location == FALSE ) {
							$location = ABSPATH . 'PolesworthGarage.csv';
						}
					?>
					<input type="text" name="location" id="location" value="<?php echo $location; ?>" class="regular-text" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="time">Time to Import</label>
				</th>
				<td>
					<select name="time" id="time">
						<?php
						$time = get_option('time');
							for( $i=0; $i<24; $i++ ) {
								if( $i < 10 ) {
									$val = '0' . $i . ':00';
								} else {
									$val = $i . ':00';
								}
						?>
								<option value="<?php echo $val; ?>" <?php if( $val == $time ) { ?> selected="selected"<?php } ?>><?php echo $val; ?></option>
								<?php
							}
						?>
					</select>
				</td>
			</tr> 
		</table> 
		<?php submit_button(); ?> 
	</form>
	<hr />
	<form method="post" action="options.php"> 
		<table class="form-table"> 
			<tr valign="top"> 
				<th scope="row">
					<label for="backup">Restore from Backup</label>
				</th>
				<td>
					<select name="backup">
					<?php
						if ( $handle = opendir( ABSPATH . 'csv-backups/' ) ) {
							while ( false !== ( $entry = readdir( $handle ) ) ) {
								if ($entry != "." && $entry != "..") {
									echo '<option value="' . $entry . '">' . $entry . '</option>';
								}
							}

							closedir($handle);
						}
					?>
					</select>
				</td>
			</tr>
		</table> 
		<?php submit_button(); ?> 
	</form>
</div>