<?php 
	$refine = $_SESSION['wp_current_search']; 
?>
<div id="filter">
	<form action="<?php bloginfo('home'); ?>/search/cars" method="post" class="car-search" id="new-search" style="margin-top: 0px!important;">
		<input type="hidden" name="type" value="<?php echo $refine['type']; ?>" />
		<table width="100%">
			<tr>
				<td><label for="make">Make</label></td>
				<td><label for="model">Model</label></td>
				<td><label for="min">Min &pound;</label></td>
				<td></td>
				<td><label for="max">Max &pound;</label></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<select name="make" id="make">
						<option value="all">All Makes</option>
						<?php
							$makes = get_terms( 'make', array( 'parent' => 0 ) );
						?>
						<?php foreach( $makes as $maker ) : ?>
							<option value="<?php echo $maker->term_id; ?>" <?php if( $maker->term_id == $_POST['make'] ) { ?> selected="selected" <?php } ?>><?php echo strtoupper( $maker->name ); ?></option>
						<?php endforeach; ?>
					</select>
				</td>
				<td>
					<select name="model" id="model">
						<option value="all">All Models</option>
					</select>
				</td>
				<td>
					<input type="text" id="min" class="price-submit" name="min" />
				</td>
				<td style="width:200px">
					<div class="priceslider"></div>
				</td>
				<td>
					<input type="text" id="max" class="price-submit" name="max" />
				</td>
				<td>
					<input name="post_type" type="hidden" value="car" />
					<input type="submit" name="find-cars" class="car-submit3" value="Search" />
				</td>
			</tr>
		</table>
		
	</form>

	<form name="refine" id="refine" method="post" action="/search/cars" style="display:none">
		<h4>Refine Results</h4>
		<!--<div class="filter-box">
			<h5>Engine Size</h5>
			<ul>
				<li>
					<input type="checkbox" name="size[]" value="1" /><label for="size">1.0L</label>
				</li>
				<li>
					<input type="checkbox" name="size[]" value="1-1.6" /><label for="size">1.0L - 1.6L</label>
				</li>
				<li>
					<input type="checkbox" name="size[]" value="1.6-2" /><label for="size">1.6L - 2.0L</label>
				</li>
				<li>
					<input type="checkbox" name="size[]" value="2-3" /><label for="size">2.0L - 3.0L</label>
				</li>
				<li>
					<input type="checkbox" name="size[]" value="3" /><label for="size">3.0L and Above</label>
				</li>
			</ul>
		</div>-->

		<div class="filter-box">
			<h5>Fuel Type</h5>
			<ul>
				<li>
					<input type="checkbox" name="fuel[]" value="petrol" <?php if( is_array( $refine['fuel'] ) && in_array( 'petrol', $refine['fuel'] ) ) { ?> checked="checked" <?php } ?> /><label for="fuel">Petrol</label>
				</li>
				<li>
					<input type="checkbox" name="fuel[]" value="diesel" <?php if( is_array( $refine['fuel'] ) && in_array( 'diesel', $refine['fuel'] ) ) { ?> checked="checked" <?php } ?>><label for="fuel">Diesel</label>
				</li>
				<li>
					<input type="checkbox" name="fuel[]" value="LPG" <?php if( is_array( $refine['fuel'] ) && in_array( 'LPG', $refine['fuel'] ) ) { ?> checked="checked" <?php } ?>><label for="fuel">LPG</label>
				</li>
				<li>
					<input type="checkbox" name="fuel[]" value="hybrid" <?php if( is_array( $refine['fuel'] ) && in_array( 'hybrid', $refine['fuel'] ) ) { ?> checked="checked" <?php } ?>><label for="fuel">Electric/Hybrid</label>
				</li>
			</ul>
		</div>

		<div class="filter-box">
			<h5>Number of Doors</h5>
			<ul>
				<li>
					<input type="checkbox" name="doors[]" value="2" <?php if( is_array( $refine['doors'] ) && in_array( '2', $refine['doors'] ) ) { ?> checked="checked" <?php } ?> /><label for="doors">2 Doors</label>
				</li>
				<li>
					<input type="checkbox" name="doors[]" value="3" <?php if( is_array( $refine['doors'] ) && in_array( '3', $refine['doors'] ) ) { ?> checked="checked" <?php } ?> /><label for="doors">3 Doors</label>
				</li>
				<li>
					<input type="checkbox" name="doors[]" value="4" <?php if( is_array( $refine['doors'] ) && in_array( '4', $refine['doors'] ) ) { ?> checked="checked" <?php } ?> /><label for="doors">4 Doors</label>
				</li>
				<li>
					<input type="checkbox" name="doors[]" value="5" <?php if( is_array( $refine['doors'] ) && in_array( '5', $refine['doors'] ) ) { ?> checked="checked" <?php } ?> /><label for="doors">5 Doors</label>
				</li>
			</ul>
		</div>

		<div class="filter-box">
			<h5>Body Style</h5>
			<ul>
				<li>
					<input type="checkbox" name="body[]" value="4x4" <?php if( is_array( $refine['body'] ) && in_array( '4x4', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">4x4</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="cabriolet" <?php if( is_array( $refine['body'] ) && in_array( 'cabriolet', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Cabriolet</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="caravan" <?php if( is_array( $refine['body'] ) && in_array( 'caravan', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Caravan</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="van" <?php if( is_array( $refine['body'] ) && in_array( 'van', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Van</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="convertible" <?php if( is_array( $refine['body'] ) && in_array( 'convertible', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Convertible</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="coupe" <?php if( is_array( $refine['body'] ) && in_array( 'coupe', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Coupe</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="dropside lorry" <?php if( is_array( $refine['body'] ) && in_array( 'dropside lorry', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Dropside Lorry</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="estate" <?php if( is_array( $refine['body'] ) && in_array( 'estate', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Estate</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="hatchback" <?php if( is_array( $refine['body'] ) && in_array( 'hatchback', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Hatchback</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="MPV" <?php if( is_array( $refine['body'] ) && in_array( 'MPV', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">MPV</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="panel van" <?php if( is_array( $refine['body'] ) && in_array( 'panel van', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Panel Van</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="pick up" <?php if( is_array( $refine['body'] ) && in_array( 'pick up', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Pick Up</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="roadster" <?php if( is_array( $refine['body'] ) && in_array( 'roadster', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Roadster</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="saloon" <?php if( is_array( $refine['body'] ) && in_array( 'saloon', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Saloon</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="sports" <?php if( is_array( $refine['body'] ) && in_array( 'sports', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Sports Car</label>
				</li>
			</ul>
		</div>

		<div class="filter-box">
			<h5>Colour</h5>
			<ul>
				<li>
					<input type="checkbox" name="colour[]" value="red" <?php if( is_array( $refine['colour'] ) && in_array( 'red', $refine['colour'] ) ) { ?> checked="checked" <?php } ?> /><label for="colour">Red</label>
				</li>
				<li>
					<input type="checkbox" name="colour[]" value="blue" <?php if( is_array( $refine['colour'] ) && in_array( 'blue', $refine['colour'] ) ) { ?> checked="checked" <?php } ?>/><label for="colour">Blue</label>
				</li>
				<li>
					<input type="checkbox" name="colour[]" value="green" <?php if( is_array( $refine['colour'] ) && in_array( 'green', $refine['colour'] ) ) { ?> checked="checked" <?php } ?>/><label for="colour">Green</label>
				</li>
				<li>
					<input type="checkbox" name="colour[]" value="yellow" <?php if( is_array( $refine['colour'] ) && in_array( 'yellow', $refine['colour'] ) ) { ?> checked="checked" <?php } ?>/><label for="colour">Yellow</label>
				</li>
				<li>
					<input type="checkbox" name="colour[]" value="black" <?php if( is_array( $refine['colour'] ) && in_array( 'black', $refine['colour'] ) ) { ?> checked="checked" <?php } ?>/><label for="colour">Black</label>
				</li>
				<li>
					<input type="checkbox" name="colour[]" value="white" <?php if( is_array( $refine['colour'] ) && in_array( 'white', $refine['colour'] ) ) { ?> checked="checked" <?php } ?>/><label for="colour">White</label>
				</li>
				<li>
					<input type="checkbox" name="colour[]" value="silver" <?php if( is_array( $refine['colour'] ) && in_array( 'silver', $refine['colour'] ) ) { ?> checked="checked" <?php } ?>/><label for="colour">Silver</label>
				</li>
			</ul>
		</div>

		<div class="filter-box">
			<h5>Price Range</h5>
			<div class="range">
				<div class="priceslider"></div>
				<label>
					<input type="text" class="min" name="min" <?php if( $refine['min'] ) { echo 'value="' . $refine['min'] . '"'; } ?> />
					<div>Min £</div>
				</label>
				<label>
					<input type="text" class="max" name="max" <?php if( $refine['max'] &&  $refine['max'] < 260000 ) { echo 'value="' . $refine['max'] . '"'; } ?> />
					<div>Max £</div>
				</label>
			</div>
		</div>

		<div class="filter-box">
			<h5>Keywords</h5>
			<input type="text" id="keywords" name="keywords" />
			<input type="hidden" name="post_type" value="car" />
			<input type="hidden" name="type" value="<?php echo $refine['type']; ?>" />
			<input type="hidden" name="model" value="<?php echo $refine['model']; ?>" id="model-field" />
			<input type="hidden" name="make" value="<?php echo $refine['make']; ?>" />
			<input type="hidden" name="orderby" value="<?php echo $refine['orderby']; ?>" id="order-field" />
			<input type="hidden" name="arrange" value="<?php echo $refine['arrange']; ?>" id="key-field" />
			<?php
			if( is_array( $refine['body'] ) ) {
				foreach( $refine['body'] as $car_body ) {
					echo '<input type="hidden" name="body[]" value="' . $car_body . '" />';
				}
			}
			?>
			<input type="submit" class="button" name="find-cars" value="Refine" />
		</div>
		
	</form>
</div>