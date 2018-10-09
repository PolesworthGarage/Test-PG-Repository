<div class="wrap">
	<h2>Ebay Cars</h2>
	<table class="form-table">
		<tr>
			<th>Picture</th>
			<th>#</th>
			<th>ID</th>
			<th>Make</th>
			<th>Model</th>
			<th>Registration</th>
			<th>Colour</th>
			<th>Transmission</th>
			<th>Fuel Type</th>
			<th>Delete</th>
		</tr>
		<?php if( $cars != False ) : ?>
			<?php $i = 1; ?>
			<?php foreach( $cars as $car ) : ?>
				<?php $fields = get_post_custom( $car->ID ); ?>
				<?php $pictures = explode( ',', $fields['PictureRefs'][0] ); ?>
			<tr>
				<td><img src="<?php echo $pictures[0]; ?>" width="100px" /></td>
				<td><?php echo '#' . $i; ?></td>
				<td><?php echo $car->ID; ?></td>
				<td><?php echo $fields['Make'][0]; ?></td>
				<td><?php echo $fields['Model'][0]; ?></td>
				<td><?php echo $fields['FullRegistration'][0]; ?></td>
				<td><?php echo $fields['Colour'][0]; ?></td>
				<td><?php echo $fields['Transmission'][0]; ?></td>
				<td><?php echo $fields['FuelType'][0]; ?></td>
				<td><a href="?page=ebay&amp;delete=<?php echo $car->ID;?>">Delete</a></td>
			</tr>
			<?php $i++; ?>
			<?php endforeach; ?>
		<?php else : ?>
			<tr>
				<td colspan="4">No Cars Added</td>
			</tr>
		<?php endif; ?>
	</table>
</div>