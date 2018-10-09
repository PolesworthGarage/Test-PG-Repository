<div class="popup" id="hire-<?php echo $id; ?>">
	<h4><?php echo $title; ?> Car Hire Form</h4>
	We offer simple pricing and easy access to some of the best value hire cars in Tamworth.<br /><br />
	<strong>Fill in the form below.</strong><br /><br />
	<form method="post">
		<input type="hidden" name="hire-class" value="<?php echo $id; ?>" />
		<label for="hire-name">Full Name</label>
		<input type="text" name="hire-name" />
		<label for="hire-address">Address</label>
		<input type="text" name="hire-address" />
		<label for="hire-postcode">Postcode</label>
		<input type="text" name="hire-postcode" />
		<label for="hire-email">Email</label>
		<input type="text" name="hire-email" />
		<label for="hire-tel">Telephone Number</label>
		<input type="text" name="hire-tel" />
		<hr />
		Please use the entry box below to select the days on which you wish to hire the car, the price will be calculated based on the number of days hire and the chosen class of car.<br />
		<label for="hire-from">Pickup</label>
		<input type="text" id="hire-from-<?php echo $id; ?>" data-hire="<?php echo $id; ?>" name="hire-from" class="date-form" />
		<label for="hire-to">Return</label>
		<input type="text" id="hire-to-<?php echo $id; ?>" data-hire="<?php echo $id; ?>" name="hire-to" class="date-form" />
		<hr />
		<strong>Total Price: £<span class="hire-price" id="hire-price-<?php echo $id; ?>" data-price="<?php echo $custom['Price'][0]; ?>">N/A</span></strong> for <strong><?php echo $title; ?></strong> Car Hire.
		<input type="submit" name="hire-submit" value="Hire Car" />
	</form>
</div>