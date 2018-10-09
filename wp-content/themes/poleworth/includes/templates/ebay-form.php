<div class="wrap">
	<?php 
	if( $submit ) {
		 echo '<div class="updated settings-error">' . $submit . '</div>';
	}
	?>
	<h2>Add A Car To Ebay</h2>
	<form method="post">
	<table>
		<tr>
			<td>Car Registration</td>
			<td><input type="text" class="big-text" name="registration" /></td>
			<td><?php submit_button(  ); ?>
		</tr>
	</table>
	</form>
</div>