<div class="wrap">
	<?php if( $submit ) {
		 echo '<div class="updated settings-error">' . $submit . '</div>';
	}?>
	<?php screen_icon(  ); ?>
	<h2>Upload Tamworth Herald Advertisement</h2>
	<form method="post">
		<table class="form-table">
			<tr valign="top">
				<th>
					<strong>Left Page</strong>
				</th>
				<td>
					<input type="file" name="left-page" />
				</td>
				<td>
					<strong>Right Page</strong>
				</td>
				<td>
					<input type="file" name="right-page" />
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<?php submit_button(  ); ?>
				</td>
			</tr>
		</table>
	</form>
</div>