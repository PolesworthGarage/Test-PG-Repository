<?php global $wpdb; ?>
<div class="wrap">
	<h2>All Cars in Stock</h2>
	<table class="wp-list-table widefat fixed posts" id="cartable" cellspacing="0">
		<thead>
			<tr>
				<th scope="col" class="manage-column column-reg" style="">Reg</th>
				<th scope="col" class="manage-column column-year" style="">Year</th>
				<th scope="col" class="manage-column column-make" style="">Make</th>
				<th scope="col" class="manage-column column-model" style="">Model</th>
				<th scope="col" class="manage-column column-variant" style="">Variant</th>
				<th scope="col" class="manage-column column-colour" style="">Colour</th>
				<th scope="col" class="manage-column column-price" style="">Price / Status</th>
				<th scope="col" class="manage-column column-sold" style="">Mark Sold</th>
				<th scope="col" class="manage-column column-del" style="">Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query = 'SELECT * FROM ' . $wpdb->posts . " WHERE `post_type` = 'car'";
				$items = $wpdb->get_results( $query );
				$i = 1;
				foreach( $items as $item ) {
					$custom = get_post_custom( $item->ID );
					if( $custom['FullRegistration'][0] == '' || empty( $custom['FullRegistration'][0] ) ) {
						$custom['FullRegistration'][0] = 'N/A';
					}

					if( empty( $custom['Make'] ) && empty( $custom['Model'] ) ) {
						continue;
					}

					if( $i % 2 ) { 
						echo '<tr valign="top" class="alternate">';
					} else {
						echo '<tr valign="top">';
					}

					echo '<td><a href="admin.php?page=edit_car&amp;car_id=' . $item->ID . '">' . $custom['FullRegistration'][0] . '</a></td>';
					echo '<td>' . $custom['Year'][0] . '</td>';
					echo '<td>' . $custom['Make'][0] . '</td>';
					echo '<td>' . $custom['Model'][0] . '</td>';
					echo '<td>' . $custom['Variant'][0] . '</td>';
					echo '<td>' . $custom['Colour'][0] . '</td>';
					$price = (float)$custom['Price'][0];
					$option = get_option( $post->ID, '_sold' );
					if( $option === true ) {
						echo '<td>SOLD</td>';
					} else {
						echo '<td>£' . number_format( $price, 0, '.', ',') . '</td>';
					}
					
					if( $option === true ) {
						echo '<td><a href="admin.php?page=cars&amp;car_id=' . $item->ID . '&amp;action=unsold" style="color:#009900;font-weight:bold;">MARK UNSOLD</a>';
					} else {
						echo '<td><a href="admin.php?page=cars&amp;car_id=' . $item->ID . '&amp;action=sold" style="color:#ff0000;font-weight:bold;">MARK SOLD</a>';
					}
					echo '<td><a href="admin.php?page=cars&amp;car_id=' . $item->ID . '&amp;action=delete">x</a></td>';
					echo '</tr>';
					$i++;
				}
			?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) 
    { 
        $("#cartable").tablesorter(); 
    } 
); 
</script>