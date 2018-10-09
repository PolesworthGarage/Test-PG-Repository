<?php
if (!function_exists('StringToken')) {
	function StringToken($string, $start, $end,$nOffset=0, &$nEndPos=0){
		if (is_numeric($nOffset)==false)
			$nOffset = 0;
		$nStart = stripos($string,$start,$nOffset);
		if ($nStart === false){
			 $nEndPos = false;
			 return "";
		}
		$nStart += strlen($start);
		$len = stripos($string,$end,$nStart);
		$nEndPos = $len + strlen($end);
		$len -= $nStart;
		return substr($string,$nStart,$len);
	}
}

	if( $_POST['post_type'] ) {
		$size = $_POST['size'];
		$fuel = $_POST['fuel'];
		$doors = $_POST['doors'];
		$body = $_POST['body'];
		$keywords = $_POST['keywords'];
		$make = $_POST['make'];
		$model = $_POST['model'];
		$type = $_POST['type'];
		$min = $_POST['min'];
		$max = $_POST['max'];
		$colour = $_POST['colour'];
		$year = $_POST['year'];
		$transmission = $_POST['transmission'];
		$arrange = $_POST['arrange'];
		$orderby = $_POST['orderby'];
	} else {
		$use = $_SESSION['wp_current_search'];
		$size = $use['size'];
		$fuel = $use['fuel'];
		$doors = $use['doors'];
		$body = $use['body'];
		$keywords = $use['keywords'];
		$make = $use['make'];
		$model = $use['model'];
		$type = $use['type'];
		$min = $use['min'];
		$max = $use['max'];
		$colour = $use['colour'];
		$year = $use['year'];
		$transmission = $use['transmission'];
		$arrange = $use['arrange'];
		$orderby = $use['orderby'];
	} 

	if( isset( $_POST['offset'] ) ) {
		$offset = $_POST['offset'];
	} else if( isset( $_SESSION['wp_current_search']['offset'] ) ){
		$offset = $_SESSION['wp_current_search']['offset'];
	} else {
		if( $current_page == 1 ) {
			$offset = 0;
		} else {
			$offset = ($current_page*10) - 10;
		}
	}
	
	$search_args = array(
		'numberposts' => 10,
		'post_type' => 'car',
		'offset' => $offset,
		'orderby' => 'meta_value_num', 
		'meta_key' => $arrange,
		'order' => trim( $orderby )
	);
	$search_args['meta_query'] = array(  );
	$search_args['tax_query'] = array( 'relation' => 'AND' );
	
	if( $transmission ) {

		if( is_array( $transmission) ) {
			$arr = array( );
			foreach( $transmission as $t ) {
				$arr[] = $t;
			}
		$search_args['meta_query'][] = array( 
			'key' => 'Transmission',
			'value' => $transmission,
			'compare' => 'IN'
		);
	} else {
		$search_args['meta_query'][] = array( 
			'key' => 'Transmission',
			'value' => $transmission,
			'compare' => 'LIKE'
		);
		}
	}
	
	if( $year ) {
		$search_args['meta_query'][] = array( 
			'key' => 'Year',
			'value' => array( date( 'Y' ) - $year, date( 'Y' ) ),
			'compare' => 'BETWEEN'
		);
	}
	
	if( $keywords ) {
		$search_args['meta_query'][] = array( 
			'key' => 'Options',
			'value' => $keywords,
			'compare' => 'LIKE'
		);
	}
	
	if( $fuel ) {
		if( is_array( $fuel ) ) {
			$arr = array( );
			foreach( $fuel as $f ) {
				$arr[] = $f;
			}
			$search_args['meta_query'][] = array( 
				'key' => 'FuelType',
				'value' => $arr,
				'compare' => 'IN'
			);
		} else {
			$search_args['meta_query'][] = array( 
				'key' => 'FuelType',
				'value' => $fuel,
				'compare' => 'LIKE'
			);
		}
	} 
	
	if( $colour ) {
		if( is_array( $colour ) ) {
			$arr = array( );
			foreach( $colour as $c ) {
				$arr[] = $c;
			}
			$search_args['meta_query'][] = array( 
				'key' => 'Colour',
				'value' => $arr,
				'compare' => 'IN'
			);
		}
	}
	
	if( $doors ) {
		if( is_array( $doors ) ) {
			$arr = array( );
			foreach( $doors as $d ) {
				$arr[] = $d;
			}
			$search_args['meta_query'][] = array( 
				'key' => 'Doors',
				'value' => $arr,
				'compare' => 'IN',
			);
		}
	}
	
	if( $body ) {
		if( is_array( $body ) ) {
			$arr = array( );
			foreach( $body as $b ) {
				$arr[] = $b;
			}
			$search_args['meta_query'][] = array( 
				'key' => 'Bodytype',
				'value' => $arr,
				'compare' => 'IN'
			);
		} else {
			$search_args['meta_query'][] = array( 
				'key' => 'Bodytype',
				'value' => $body,
				'compare' => 'LIKE'
			);
		}
	} 
	
	if( isset( $make ) && $make != 'all' ){
		$search_args['tax_query'][] = array(
			'taxonomy' => 'make',
			'field' => 'id',
			'terms' => $make,
		);
	}
	
	if( isset( $model ) && $model != 'all' ){
		
		//need to resolve the correct model slug here
		$model = GetModelSlugFromMake($make,$model);
		
		$search_args['tax_query'][] = array(
			'taxonomy' => 'make',
			'field' => 'slug',
			'terms' => $model,
			'type' => 'CHAR',
			'compare' => 'LIKE',
		);
	}

	$search_args['meta_query'][] = array(
		'key' => 'Price',
		'value' => array( $min, $max ),
		'type' => 'numeric',
		'compare' => 'BETWEEN'
	);
	
	$search_args['meta_query']['relation'] = 'AND';
	
	$search_args_CarVersion = $search_args;

	if( $type ) {
		if( $type == 'van' || $type == 'new-van' ) {
			$search_args['meta_query'][] = array( 
				'key' => 'Bodytype',
				'value' => 'van',
				'compare' => 'LIKE',
				//'amj_search' => 'merge_ids'
			);
			$search_args['meta_query'][] = array( 
				'key' => 'Bodytype',
				'value' => 'Pick up',
				'compare' => 'LIKE',
				'amj_search' => 'merge_ids'
			);
			$search_args_CarVersion['meta_query'][] = array( 
				'key' => 'Bodytype',
				'value' => 'van',
				'compare' => 'NOT LIKE'
			);
		} 

		if( $type == 'car' || $type == 'new-car' ) {
			$search_args['meta_query'][] = array( 
				'key' => 'Bodytype',
				'value' => 'van',
				'compare' => 'NOT LIKE'
			);
			unset($search_args_CarVersion);
		}
		
		if( $type == 'new-car' || $type == 'new-van' ) {
			$search_args['tax_query'][] = array(
				'taxonomy' => 'cartype',
				'field' => 'id',
				'terms' => 'new',
			);
		} else {
			if( $type != 'all' ) {
				$search_args['tax_query'][] = array(
					'taxonomy' => 'cartype',
					'field' => 'slug',
					'terms' => array( 'Old', 'old' )
				);
			}
		}
	}

	$nTotalNumberOfPosts = 0;
	
	function GetModelSlugFromMake($make,$model){
		$sLCmodel = strtolower($model);
		$objTerms = get_term_children((integer)$make,"make");
		foreach($objTerms as $objTerm){
			$objTerm = get_term_by( 'id', $objTerm, "make" );
		if ( strtolower($objTerm->name) == $sLCmodel ){
				return $objTerm->slug;
			}
		}
		return $model;
	}
	
	$cars = SearchForVehicles($search_args);
	if( count( $cars ) <= 0 ){
		if (isset($search_args_CarVersion)){
			$cars = SearchForVehicles($search_args_CarVersion);
		}
	}

	function GetIDsFromSQL($sSQL){
		global $wpdb;
		$SortedIDs = array();
		$results = $wpdb->get_results($sSQL);
		foreach( $results as $result )
			$SortedIDs[] = $result->ID;
		return $SortedIDs;
	}
	
	function BuildOrderBySQL($sColumn){
		switch ($sColumn) {
			case "Price":
				return "CAST(wp_postmeta.meta_value AS SIGNED)";
			case "Year":
				return "CAST(wp_postmeta.meta_value AS SIGNED)";
			default:
				return "wp_postmeta.meta_value";
		}
	}
	
	function SearchForVehicles($search_args){
		global $wpdb,$orderby,$arrange,$nTotalNumberOfPosts,$offset;
		
		$nTotalNumberOfPosts = 0;
		
		$SortedIDs = GetIDsFromSQL("SELECT ID FROM wp_posts WHERE wp_posts.post_type = 'car' AND (wp_posts.post_status = 'publish')");
		
		foreach($search_args["meta_query"] as $MetaFilter){
			if (is_array($MetaFilter)){
				SearchForVehicles_FilterUsingMeta($SortedIDs,$MetaFilter);
			}
		}
		
		foreach($search_args["tax_query"] as $TaxFilter){
			if (is_array($TaxFilter)){
				SearchForVehicles_FilterUsingTax($SortedIDs,$TaxFilter);
			}
		}
		
		if (isset($orderby) ){
			if ($orderby != ""){
				$sSortingSQL = "SELECT wp_posts.ID FROM wp_posts ";
				$sSortingSQL .= "INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) WHERE " . BuildPostIDInSQL($SortedIDs) . " AND ";
				$sSortingSQL .= "wp_postmeta.meta_key = '" . $arrange . "'";
				$sSortingSQL .= "ORDER BY " . BuildOrderBySQL($arrange) .  " " . $orderby;
				$SortedIDs = GetIDsFromSQL($sSortingSQL);
			}
		}

		$nTotalNumberOfPosts = count($SortedIDs);
		
		if ($nTotalNumberOfPosts <=0)
			return;
		
		$sSortedIDs10 = array();
		for ($nIndex = $offset; $nIndex < ($offset+10); $nIndex++){
			if (isset($SortedIDs[$nIndex]) )
				$sSortedIDs10[] = $SortedIDs[$nIndex];
			else break;
		}
		
		$args = array(
			'post__in' => $sSortedIDs10,
			'post_type' => 'car',
			'orderby' => 'post__in', 
			'posts_per_page' => count($sSortedIDs10), 
		);
		
		return get_posts( $args );
	}
	
	function BuildPostIDInSQL($SortedIDs){
		$sSQL = "( wp_posts.ID IN (";
		$sIDs = "";
		foreach($SortedIDs as $id){
			if ($sIDs != "")
				$sIDs .= ",";
			$sIDs .= $id;
		}
		$sSQL .= $sIDs . "))";
		return $sSQL;
	}
	
	function BuildCompareSQL($key, $value, $type, $compare){
		$sSQL = "wp_postmeta.meta_key = '" . $key . "' ";
		
		if ( $compare != "IN" ){
			switch( $type ){
				case "numeric":
					$sSQL .= "AND ";
					$sSQL .= "CAST(wp_postmeta.meta_value AS SIGNED) ";
					break;
				default:
					break;
			}
		}
		
		switch( $compare ){
			case "BETWEEN":
				$sSQL .= "BETWEEN '" . $value[0] . "' AND '" . $value[1] . "'";
				break;
			case "IN":
				$sSQL .= "AND ";
				$sSQL .= "CAST(wp_postmeta.meta_value AS CHAR) ";
				$sSQL .= "IN ('" . implode("','",$value) . "')";
				break;
			case "NOT LIKE":
				$sSQL .= "AND ";
				$sSQL .= "LOWER(CAST(wp_postmeta.meta_value AS CHAR)) ";
				$sSQL .= "NOT LIKE '%" . strtolower($value) . "%'";
				break;
			case "LIKE":
				$sSQL .= "AND ";
				$sSQL .= "LOWER(CAST(wp_postmeta.meta_value AS CHAR)) ";
				$sSQL .= "LIKE '%" . strtolower($value) . "%'";
				break;
			default:
				break;
		}
		return $sSQL;
	}
	
	function SearchForVehicles_GetTaxIDs($TaxFilter){
		$sTaxonomy = $TaxFilter["taxonomy"];
		$sField = $TaxFilter["field"];
		$terms = $TaxFilter["terms"];
		
		$nTaxIDs = array();
		
		switch($sField){
			case "slug":
				if (is_array($terms)){
					foreach ($terms as $termvalue){
						$objTermData = get_term_by( $sField, $termvalue, $sTaxonomy);
						$nTaxIDs[] = $objTermData->term_taxonomy_id;
					}
				} else {
					$objTermData = get_term_by( $sField, $terms, $sTaxonomy);
					$nTaxIDs[] = $objTermData->term_taxonomy_id;
				}
				break;
			case "id":
				$nTaxIDs[] = $terms;
				break;
			default:
				break;
		}
		return $nTaxIDs;
	}
	
	function SearchForVehicles_FilterUsingTax(&$SortedIDs,$TaxFilter){
		if (!isset($SortedIDs))
			return;
		if (count($SortedIDs) <= 0)
			return;
			
		$nTaxIDs = SearchForVehicles_GetTaxIDs($TaxFilter);
		if (!isset($nTaxIDs))
			return;

		if (count($nTaxIDs) <= 0)
			return;

		$sPostIDInSQL = BuildPostIDInSQL($SortedIDs);

		$sSQL = "SELECT wp_posts.ID FROM wp_posts INNER JOIN wp_term_relationships ON (wp_posts.ID = wp_term_relationships.object_id) WHERE " . $sPostIDInSQL . " AND ";
		$sSQL .= " wp_term_relationships.term_taxonomy_id IN (" . implode ( "," , $nTaxIDs ) . ")";
		$sSQL .= " GROUP BY wp_posts.ID";
		
		$SortedIDs = GetIDsFromSQL($sSQL);
	}
	
	function SearchForVehicles_FilterUsingMeta(&$SortedIDs,$MetaFilter){
		if (!isset($SortedIDs))
			return;
		if (count($SortedIDs) <= 0)
			return;
			
		//'amj_search' => 'merge_ids'
		$fMergeIDs = false;
		if (isset($MetaFilter["amj_search"]) && ((string)$MetaFilter["amj_search"]) == "merge_ids" ){
			$fMergeIDs = true;
			$objIDsToKeep = $SortedIDs;
		}

		try {
			if ($MetaFilter["key"] == "Price" && $MetaFilter["compare"] == "BETWEEN"){
				if ($MetaFilter["value"][0] == 0 && $MetaFilter["value"][1] == 100000 )
					return; // no point searching for this
			}
		} catch (Exception $e) {/* ignore error */}
		
		$sPostIDInSQL = BuildPostIDInSQL($SortedIDs);
		
		$sSQL = "SELECT wp_posts.ID FROM wp_posts INNER JOIN wp_postmeta ON ( wp_posts.ID = wp_postmeta.post_id ) WHERE " . $sPostIDInSQL . " AND ";
		$sSQL .= " (" . BuildCompareSQL( $MetaFilter["key"], $MetaFilter["value"], $MetaFilter["type"], $MetaFilter["compare"] ) . ")";
		$sSQL .= " GROUP BY wp_posts.ID";
		$SortedIDs = GetIDsFromSQL($sSQL);
		
		if ($fMergeIDs == true){
			if (is_array($objIDsToKeep)){
				if ( is_array($SortedIDs) )
					$SortedIDs = $SortedIDs + $objIDsToKeep;
				else
					$SortedIDs = $objIDsToKeep;
			}
		}
		
	}
	
	if( count( $cars ) > 0 ) {
		 global $wp_query; 

		$search_args['numberposts'] = -1;
		$search_args['fields'] = 'ids';

		if (!isset($nTotalNumberOfPosts) || intval($nTotalNumberOfPosts) <=0 )
			$count = count( get_posts( $search_args ) );
		else
			$count = $nTotalNumberOfPosts;
		
		/*if( $type == 'van' || $body[0] == 'VAN') {
			echo '<h4 class="underline">' . $count . ' Used Vans for Sale</h4>';
		} else {
			echo '<h4 class="underline">' . $count . ' Used Cars for Sale</h4>';
		}*/
		if( $type == 'van' || $body == 'VAN' ) {
			echo '<h4 class="underline">' . $count . ' Vans Found</h4>';
		} else {
			echo '<h4 class="underline">' . $count . ' Cars Found</h4>';
		}
	?>

<div id="filter">
<form name="refine" class='<?php echo $refine_class; ?>' id="refine" method="post" action="<?php 
	
	$sURLToSave = (string)parse_url(current_page_url(),PHP_URL_PATH); 
	/*if ($sURLToSave != ""){
		//if(endswith($sURLToSave,"/") == false)
		//	$sURLToSave .= "/";
		//$sURLToSave =  $sURLToSave;
	}*/
	
	//echo "<pre style='display:none;' id='findthis'>". $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . "</pre>";
	
	$sURLToUse = "/search/cars";

	echo $sURLToUse;
	?>">
	
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
			if( !function_exists( 'AMJ_FirstValue' ) ) {
				function AMJ_FirstValue($objData) { 
					if (is_array($objData)){			
						//return in_array(strtolower($needle), array_map('strtolower', $haystack)); 
						foreach($objData as $objDataItem){
							if (is_string($objDataItem) && trim($objDataItem) != "" )
								return $objDataItem;
						}
						return "";
					} else {
						return (string)$objData;
					}
				} 
			}
		?>

		<div class="filter-box">
			<ul>
				<li>
					<input type="checkbox" name="transmission[]" value="manual" <?php if( AMJ_InValue( 'manual', $refine['transmission'] ) ) { ?> checked="checked" <?php } ?> /><label for="transmission">Manual</label>
				</li>
				<li>
					<input type="checkbox" name="transmission[]" value="automatic" <?php if( AMJ_InValue( 'automatic', $refine['transmission'] ) ) { ?> checked="checked" <?php } ?>><label for="transmission">Automatic</label>
				</li>
				<li>
					<input type="checkbox" name="fuel[]" value="petrol" <?php if( AMJ_InValue( 'petrol', $refine['fuel'] ) ) { ?> checked="checked" <?php } ?> /><label for="fuel">Petrol</label>
				</li>
				<li>
					<input type="checkbox" name="fuel[]" value="diesel" <?php if( AMJ_InValue( 'diesel', $refine['fuel'] ) ) { ?> checked="checked" <?php } ?>><label for="fuel">Diesel</label>
				</li>
			</ul>

			<input type="hidden" name="post_type" value="car" />
			<input type="hidden" name="type" value="<?php echo AMJ_FirstValue($refine['type']); ?>" />
			<input type="hidden" name="model" value="<?php echo AMJ_FirstValue($refine['model']); ?>" id="model-field" />
			<input type="hidden" name="make" value="<?php echo AMJ_FirstValue($refine['make']); ?>" />
			<input type="hidden" name="orderby" value="<?php echo AMJ_FirstValue($refine['orderby']); ?>" id="order-field" />
			<input type="hidden" name="arrange" value="<?php echo AMJ_FirstValue($refine['arrange']); ?>" id="key-field" />
            <input type="hidden" name="urltosave" value="<?php echo $sURLToSave; ?>" />
            <input type="hidden" id="pagenumberbuttonclick" name="pagenumberbuttonclick" value="" />
			<?php
			if( is_array( $refine['body'] ) ) {
				foreach( $refine['body'] as $car_body ) {
					echo '<input type="hidden" name="body[]" value="' . $car_body . '" />';
				}
			}
			?>
			<input type="submit" class="button" name="find-cars" value="Refine" style="float:right;width:25%;margin-right:2%;margin-left:2%;margin-top:0px;"/>
		</div>

	</form>
</div>	
		<form id="order-results">
			<select id="results-choices" name="order-results">
				<option value="order" selected="selected">Order Results</option>
				<option value="Price-ASC">Price Lowest to Highest</option>
				<option value="Price-DESC">Price Highest to Lowest</option>
				<option value="Year-ASC">Age Oldest to Newest</option>
				<option value="Year-DESC">Age Newest to Oldest</option>
			</select>
		</form>



		<!--<div class="alignleft pagination" style="margin: 5px 0px 0px 0px"></div>-->


	<?php

		$big = 999999999; // need an unlikely integer

		echo '<div class="alignleft pagination" style="margin: 5px 0px 0px 0px">' 
		. paginate_links( array(
			'base' => str_replace( $big, '%#%', '/search/cars/%#%' ),
			'format' => '/%#%',
			'current' => max( 1, $current_page ),
			'total' => ceil( $count / 10 ),
			'prev_text' => 'Prev',
			'next_text' => 'Next', 
			'mid_size' => 1
		) )
		. '</div>';
		echo '<ul id="car-listings" class="car-listings">';
		
		foreach( $cars as $post ) {
			setup_postdata( $post );
			$permalink = get_permalink(  );
			$title = get_the_title(  );

			the_result( $post->ID, $permalink, $title );
		}
		
		wp_reset_postdata();
		
		echo '</ul>';
		echo '<div class="alignleft pagination" style="margin: 5px 0px 0px 0px">' 
		. paginate_links( array(
			'base' => str_replace( $big, '%#%', '/search/cars/%#%' ),
			'format' => '/%#%',
			'current' => max( 1, $current_page ),
			'total' => ceil( $count / 10 ),
			'prev_text' => 'Prev',
			'next_text' => 'Next', 
			'mid_size' => 1
		) )
		. '</div>';
	} else {
?>
    <h2>Whoops...</h2>
	<p>We could not find any cars that match your criteria.</p>
	<p>You could try amending your search criteria to be less specific in the form above.</p>
<?php
	}