<?php 
if (!function_exists("current_page_url")){
	function current_page_url() {
		$pageURL = 'http';
		if( isset($_SERVER["HTTPS"]) ) {
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}
if (!function_exists("endswith")){
	function endswith($string, $test) {
		$strlen = strlen($string);
		$testlen = strlen($test);
		if ($testlen > $strlen) return false;
		return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
	}
}
	$refine = $_SESSION['wp_current_search']; 
?>
<div id="filter">
	<form action="<?php bloginfo('home'); ?>/car-finder/" method="post" class="car-search" id="new-search" style="margin-top: 0px!important;">
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
							<option value="<?php echo $maker->term_id; ?>" <?php if( $maker->term_id == $refine['make'] ) { ?> selected="selected" <?php } ?>><?php echo strtoupper( $maker->name ); ?></option>
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

	<form name="refine" id="refine" method="post" action="<?php 
	
	/*$sURLToUse = (string)parse_url(current_page_url(),PHP_URL_PATH); 
	if ($sURLToUse == "")
		$sURLToUse = "/car-finder/";
	else{
		if(endswith($sURLToUse,"/") == false)
			$sURLToUse .= "/";
		$sURLToUse = "/search" . $sURLToUse;
	}*/
	
	//echo "<pre style='display:none;' id='findthis'>". $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . "</pre>";
	
	$sURLToUse = "/search/cars/";

	echo $sURLToUse;
	?>" style="display:block;float:left;width:33%;">
		<h4>Refine Results</h4>
		<div class="filter-box">
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
		</div>
        
        <?php 
			if( !function_exists( 'AMJ_InValue' ) ) {
				function AMJ_InValue($needle, $haystack) { 
					if (is_array($haystack)){			
						return in_array(strtolower($needle), array_map('strtolower', $haystack)); 
					} else {
						return strcasecmp(trim($needle),trim($haystack)) == 0;
					}
				} 
			}
		?>

		<div class="filter-box">
			<h5>Fuel Type</h5>
			<ul>
				<li>
					<input type="checkbox" name="fuel[]" value="petrol" <?php if( AMJ_InValue( 'petrol', $refine['fuel'] ) ) { ?> checked="checked" <?php } ?> /><label for="fuel">Petrol</label>
				</li>
				<li>
					<input type="checkbox" name="fuel[]" value="diesel" <?php if( AMJ_InValue( 'diesel', $refine['fuel'] ) ) { ?> checked="checked" <?php } ?>><label for="fuel">Diesel</label>
				</li>
				<li>
					<input type="checkbox" name="fuel[]" value="LPG" <?php if( AMJ_InValue( 'LPG', $refine['fuel'] ) ) { ?> checked="checked" <?php } ?>><label for="fuel">LPG</label>
				</li>
				<li>
					<input type="checkbox" name="fuel[]" value="hybrid" <?php if( AMJ_InValue( 'hybrid', $refine['fuel'] ) ) { ?> checked="checked" <?php } ?>><label for="fuel">Electric/Hybrid</label>
				</li>
			</ul>
		</div>

                <div class="filter-box">
			<h5>Transmission</h5>
			<ul>
				<li>
					<input type="checkbox" name="transmission[]" value="automatic" <?php if( AMJ_InValue( 'automatic', $refine['transmission'] ) ) { ?> checked="checked" <?php } ?> /><label for="transmission">Automatic</label>
				</li>
				<li>
					<input type="checkbox" name="transmission[]" value="manual" <?php if( AMJ_InValue( 'manual', $refine['transmission'] ) ) { ?> checked="checked" <?php } ?>><label for="transmission">Manual</label>
				</li>
			</ul>
		</div>

		<div class="filter-box">
			<h5>Number of Doors</h5>
			<ul>
				<li>
					<input type="checkbox" name="doors[]" value="2" <?php if( AMJ_InValue( '2', $refine['doors'] ) ) { ?> checked="checked" <?php } ?> /><label for="doors">2 Doors</label>
				</li>
				<li>
					<input type="checkbox" name="doors[]" value="3" <?php if( AMJ_InValue( '3', $refine['doors'] ) ) { ?> checked="checked" <?php } ?> /><label for="doors">3 Doors</label>
				</li>
				<li>
					<input type="checkbox" name="doors[]" value="4" <?php if( AMJ_InValue( '4', $refine['doors'] ) ) { ?> checked="checked" <?php } ?> /><label for="doors">4 Doors</label>
				</li>
				<li>
					<input type="checkbox" name="doors[]" value="5" <?php if( AMJ_InValue( '5', $refine['doors'] ) ) { ?> checked="checked" <?php } ?> /><label for="doors">5 Doors</label>
				</li>
			</ul>
		</div>

		<div class="filter-box">
			<h5>Body Style</h5>
			<ul>
				<li>
					<input type="checkbox" name="body[]" value="4x4" <?php if( AMJ_InValue( '4x4', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">4x4</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="cabriolet" <?php if( AMJ_InValue( 'cabriolet', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Cabriolet</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="caravan" <?php if( AMJ_InValue( 'caravan', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Caravan</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="van" <?php if( AMJ_InValue( 'van', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Van</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="convertible" <?php if( AMJ_InValue( 'convertible', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Convertible</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="coupe" <?php if( AMJ_InValue( 'coupe', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Coupe</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="dropside lorry" <?php if( AMJ_InValue( 'dropside lorry', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Dropside Lorry</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="estate" <?php if( AMJ_InValue( 'estate', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Estate</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="hatchback" <?php if( AMJ_InValue( 'hatchback', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Hatchback</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="MPV" <?php if( AMJ_InValue( 'MPV', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">MPV</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="panel van" <?php if( AMJ_InValue( 'panel van', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Panel Van</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="pick up" <?php if( AMJ_InValue( 'pick up', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Pick Up</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="roadster" <?php if( AMJ_InValue( 'roadster', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Roadster</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="saloon" <?php if( AMJ_InValue( 'saloon', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Saloon</label>
				</li>
				<li>
					<input type="checkbox" name="body[]" value="sports" <?php if( AMJ_InValue( 'sports', $refine['body'] ) ) { ?> checked="checked" <?php } ?> /><label for="body">Sports Car</label>
				</li>
			</ul>
		</div>

		<div class="filter-box">
			<h5>Colour</h5>
			<ul>
				<li>
					<input type="checkbox" name="colour[]" value="red" <?php if( AMJ_InValue( 'red', $refine['colour'] ) ) { ?> checked="checked" <?php } ?> /><label for="colour">Red</label>
				</li>
				<li>
					<input type="checkbox" name="colour[]" value="blue" <?php if( AMJ_InValue( 'blue', $refine['colour'] ) ) { ?> checked="checked" <?php } ?>/><label for="colour">Blue</label>
				</li>
				<li>
					<input type="checkbox" name="colour[]" value="green" <?php if( AMJ_InValue( 'green', $refine['colour'] ) ) { ?> checked="checked" <?php } ?>/><label for="colour">Green</label>
				</li>
				<li>
					<input type="checkbox" name="colour[]" value="yellow" <?php if( AMJ_InValue( 'yellow', $refine['colour'] ) ) { ?> checked="checked" <?php } ?>/><label for="colour">Yellow</label>
				</li>
				<li>
					<input type="checkbox" name="colour[]" value="black" <?php if( AMJ_InValue( 'black', $refine['colour'] ) ) { ?> checked="checked" <?php } ?>/><label for="colour">Black</label>
				</li>
				<li>
					<input type="checkbox" name="colour[]" value="white" <?php if( AMJ_InValue( 'white', $refine['colour'] ) ) { ?> checked="checked" <?php } ?>/><label for="colour">White</label>
				</li>
				<li>
					<input type="checkbox" name="colour[]" value="silver" <?php if( AMJ_InValue( 'silver', $refine['colour'] ) ) { ?> checked="checked" <?php } ?>/><label for="colour">Silver</label>
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