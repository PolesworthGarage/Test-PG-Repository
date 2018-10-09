<?php
	$change = get_option( 'change', array() );
	$to = get_option( 'to', array() );
?>
<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Import Used Cars</h2> 
	<form method="post" action="options.php"> 
		<?php settings_fields( 'car_import-change' ); ?> 
		<?php do_settings_fields( 'car_import-change', 'car-settings' ); ?> 
		<table class="form-table"> 
			<tr valign="top"> 
				<th>
					<strong>Change</strong>
				</th>
				<td>
					<strong>To</strong>
				</td>
			</tr>
			<?php
				foreach( $change as $key => $val ) :
					if( $val == '' ):
						unset( $change[$key] );
						unset( $to[$key] );
					else:
			?>
			<tr>
				<td>
					<input type="text" name="change[]" value="<?php echo $val; ?>" class="regular-text" />
				</td>
				<td>
					<input type="text" name="to[]" value="<?php echo $to[$key]; ?>" class="regular-text" />
				</td>
			</tr>
			<?php 
					endif;
				endforeach;
			?>
			<tr>
				<td>
					<input type="text" name="change[]" class="regular-text" />
				</td>
				<td>
					<input type="text" name="to[]" class="regular-text" />
				</td>
			</tr>

			<tr>
				<td><?php submit_button(); ?></td>
				<td></td>
			</tr>
			
		</table> 
		
	</form> 
</div>