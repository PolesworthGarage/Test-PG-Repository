<?php
/**
*	Template Name: Add Car
**/
get_header(  ); ?>
<?php global $wpdb; ?>
<section class="main">
	<div class="wrapper">
	<h2>Add New Car</h2>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder">
			<div id="post-body-content">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">
						<h3><span>Get Car Information</span></h3>
						<div class="inside">
							<p>Enter the car registration here to find the required vehicle data.</p>
							<p>The data will prefill the form fields. <strong>Make sure</strong> to check through it and ensure it's accurate.</p>
							<p>Since the 1st of <strong><?php echo date( 'F Y' ); ?></strong> there have been <strong><?php echo get_option( 'carweb-' . date( 'F\-Y' ), 0 ); ?></strong> queries to the Vehicle Search API</p>
							<form action="/admin.php?page=cars" method="POST" id="carweb">
								<table class="widefat" cellspacing="0">
									<tr>
										<td>Registration Number</td>
										<td>
											<input type="text" name="reg_number" class="regular-text" id="reg_number" style="margin-right: 20px;" />
											<input type="submit" name="submit" value="Lookup Car" id="lookup" class="button-primary" />
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>
					<div class="postbox" style="clear: both; overflow: hidden;">
						<h3><span>Car Details</span></h3>
						<div class="inside car-editor">
							<form action="admin.php?page=cars" method="POST" id="cardetails">
								<table cellspacing="0" style="width:35%; float: left;">
									<tr>
										<td colspan="2">
											<h3><span>Car Info</span></h3>
										</td>
									</tr>
									<tr>
										<td>
											<label for="registration_number"><strong>Registration Number</strong></label>
										</td>
										<td>
											<input type="text" name="registration_number" id="registration_number" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="type"><strong>Variant</strong></label>
										</td>
										<td>
											<input type="text" name="type" id="type" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="make"><strong>Make</strong></label>
										</td>
										<td>
											<input type="text" name="make" id="make" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="model"><strong>Model</strong></label>
										</td>
										<td>
											<input type="text" name="model" id="model" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="year"><strong>Year</strong></label>
										</td>
										<td>
											<input type="text" name="year" id="year" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="colour"><strong>Colour</strong></label>
										</td>
										<td>
											<input type="text" name="colour" id="colour" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="bodystyle"><strong>Body Style</strong></label>
										</td>
										<td>
											<input type="text" name="bodystyle" id="bodystyle" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="fuel"><strong>Fuel Type</strong></label>
										</td>
										<td>
											<input type="text" name="fuel" id="fuel" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="gearbox"><strong>Automatic or Manual</strong></label>
										</td>
										<td>
											<input type="text" name="gearbox" id="gearbox" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="mileage"><strong>Mileage</strong></label>
										</td>
										<td>
											<input type="text" name="mileage" id="mileage" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="doors"><strong>Doors</strong></label>
										</td>
										<td>
											<input type="text" name="doors" id="doors" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="seats"><strong>Seats</strong></label>
										</td>
										<td>
											<input type="text" name="seats" id="seats" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="enginesize"><strong>Engine Size</strong></label>
										</td>
										<td>
											<input type="text" name="enginesize" id="enginesize" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="capid"><strong>CAP ID</strong></label>
										</td>
										<td>
											<input type="text" name="capid" id="capid" class="regular-text" />
										</td>
									</tr>
									<tr>
										<td>
											<label for="options"><strong>Included Options</strong></label>
											<p>Comma seperated list.</p>
										</td>
										<td>
											<textarea cols="40" rows="8" name="options" id="options"></textarea>
										</td>
									</tr>
									<tr>
										<td>
											<label for="price"><strong>Price</strong></label>
										</td>
										<td>
											<input type="text" name="price" id="price" class="regular-text" />
										</td>
									</tr>
									</table>
									<table style="width:40%; float:left; margin-top: -2px;">
									<tr>
										<td colspan="2">
											<h3><span>Car Images - Exterior</span></h3>
										</td>
									</tr>
									<tr>
										<td><label for="drivers-side-front">Drivers Side Front</label></td>
										<td>
											<div class="display-image" id="drivers-side-front-display"></div>
											<input type="hidden" class="regular-text" name="drivers-side-front" id="drivers-side-front" />
											<input type="button" value="Select Drivers Side Front Image" data-id="drivers-side-front" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="front">Front</label></td>
										<td>
											<div class="display-image" id="front-display"></div>
											<input type="hidden" class="regular-text" name="front" id="front" />
											<input type="button" value="Select Front Image" data-id="front" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="passenger-side">Passenger Side</label></td>
										<td>
											<div class="display-image" id="passenger-side-display"></div>
											<input type="hidden" class="regular-text" name="passenger-side" id="passenger-side" />
											<input type="button" value="Select Passenger Side Image" data-id="passenger-side" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="passenger-side-front">Passenger Side Front</label></td>
										<td>
											<div class="display-image" id="passenger-side-front-display"></div>
											<input type="hidden" class="regular-text" name="passenger-side-front" id="passenger-side-front" />
											<input type="button" value="Select Passenger Side Front Image" data-id="passenger-side-front" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="passenger-side-rear">Passenger Side Rear</label></td>
										<td>
											<div class="display-image" id="passenger-side-rear-display"></div>
											<input type="hidden" class="regular-text" name="passenger-side-rear" id="passenger-side-rear" />
											<input type="button" value="Select Passenger Side Rear Image" data-id="passenger-side-rear" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="rear">Rear</label></td>
										<td>
											<div class="display-image" id="rear-display"></div>
											<input type="hidden" class="regular-text" name="rear" id="rear" />
											<input type="button" value="Select Rear Image" data-id="rear" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="drivers-side-rear">Drivers Side Rear</label></td>
										<td>
											<div class="display-image" id="drivers-side-rear-display"></div>
											<input type="hidden" class="regular-text" name="drivers-side-rear" id="drivers-side-rear" />
											<input type="button" value="Select Drivers Side Rear" data-id="drivers-side-rear" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="drivers-side">Drivers Side</label></td>
										<td>
											<div class="display-image" id="drivers-side-display"></div>
											<input type="hidden" class="regular-text" name="drivers-side" id="drivers-side" />
											<input type="button" value="Select Drivers Side Image" data-id="drivers-side" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<h3><span>Car Images - Interior</span></h3>
										</td>
									</tr>
									<tr>
										<td><label for="boot">Boot</label></td>
										<td>
											<div class="display-image" id="boot-display"></div>
											<input type="hidden" class="regular-text" name="boot" id="boot" />
											<input type="button" value="Select Boot Image" data-id="boot" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="engine-bay">Engine Bay</label></td>
										<td>
											<div class="display-image" id="engine-bay-display"></div>
											<input type="hidden" class="regular-text" name="engine-bay" id="engine-bay" />
											<input type="button" value="Select Engine Bay Image" data-id="engine-bay" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="wheels">Wheels</label></td>
										<td>
											<div class="display-image" id="wheels-display"></div>
											<input type="hidden" class="regular-text" name="wheels" id="wheels" />
											<input type="button" value="Select Wheels Image" data-id="wheels" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="interior-front">Interior Front</label></td>
										<td>
											<div class="display-image" id="interior-front-display"></div>
											<input type="hidden" class="regular-text" name="interior-front" id="interior-front" />
											<input type="button" value="Select Interior Front Image" data-id="interior-front" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="interior-rear">Interior Rear</label></td>
										<td>
											<div class="display-image" id="interior-rear-display"></div>
											<input type="hidden" class="regular-text" name="interior-rear" id="interior-rear" />
											<input type="button" value="Select Interior Rear Image" data-id="interior-rear" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="drivers-seat-area">Drivers Seat Area</label></td>
										<td>
											<div class="display-image" id="drivers-seat-area-display"></div>
											<input type="hidden" class="regular-text" name="drivers-seat-area" id="drivers-seat-area" />
											<input type="button" value="Select Drivers Seat Area Image" data-id="drivers-seat-area" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="passenger-seat-area">Passenger Seat Area</label></td>
										<td>
											<div class="display-image" id="passenger-seat-area-display"></div>
											<input type="hidden" class="regular-text" name="passenger-seat-area" id="passenger-seat-area" />
											<input type="button" value="Select Passenger Seat Area Image" data-id="passenger-seat-area" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="centre-console">Centre Console</label></td>
										<td>
											<div class="display-image" id="centre-console-display"></div>
											<input type="hidden" class="regular-text" name="centre-console" id="centre-console" />
											<input type="button" value="Select Centre Console Image" data-id="centre-console" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="instrument-cluster">Instrument Cluster</label></td>
										<td>
											<div class="display-image" id="instrument-cluster-display"></div>
											<input type="hidden" class="regular-text" name="instrument-cluster" id="instrument-cluster" />
											<input type="button" value="Select Instrument Cluster Image" data-id="instrument-cluster" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<h3><span>Car Images - Additional</span></h3>
										</td>
									</tr>
									<tr>
										<td><label for="additional-1">Additional #1</label></td>
										<td>
											<div class="display-image" id="additional-1-display"></div>
											<input type="hidden" class="regular-text" name="additional-1" id="additional-1" />
											<input type="button" value="Select Additional Image #1" data-id="additional-1" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="additional-2">Additional #2</label></td>
										<td>
											<div class="display-image" id="additional-2-display"></div>
											<input type="hidden" class="regular-text" name="additional-2" id="additional-2" />
											<input type="button" value="Select Additional Image #2" data-id="additional-2" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="additional-3">Additional #3</label></td>
										<td>
											<div class="display-image" id="additional-3-display"></div>
											<input type="hidden" class="regular-text" name="additional-3" id="additional-3" />
											<input type="button" value="Select Additional Image #3" data-id="additional-3" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="additional-4">Additional #4</label></td>
										<td>
											<div class="display-image" id="additional-4-display"></div>
											<input type="hidden" class="regular-text" name="additional-4" id="additional-4" />
											<input type="button" value="Select Additional Image #4" data-id="additional-4" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td><label for="additional-5">Additional #5</label></td>
										<td>
											<div class="display-image" id="additional-5-display"></div>
											<input type="hidden" class="regular-text" name="additional-5" id="additional-5" />
											<input type="button" value="Select Additional Image #5" data-id="additional-5" class="button upload-car-image" />
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<input type="submit" name="submit" value="Add Car" style="float:left" class="button-primary" />
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		</div>
	</section>
<style type="text/css">
	.car-editor table {

	}

	.car-editor tr {
	}

	.car-editor td {
		padding: 5px 0px;
		width: 25%;
	}

</style>