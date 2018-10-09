<?php
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
		$search_args['meta_query'][] = array( 
			'key' => 'Transmission',
			'value' => $transmission,
			'compare' => 'LIKE'
		);
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

	/*if( $size ) {
		if( is_array( $size ) ) {
			$arr = array(  );
			foreach( $size as $s ) {
				if( $s != 1 || $s != 3 ) {
					
				} else {
					$arr[] = $s*1000;
				}
				$arr[] =
			}
			$search_args['meta_query'][] = array( 
				'key' => 'EngineSize',
				'value' => $size,
				'compare' => 'BETWEEN',
				'type' => 'NUMERIC'
			);
		}
	}*/

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

	if( $type ) {
		if( $type == 'van' || $type == 'new-van' ) {
			$search_args['meta_query'][] = array( 
				'key' => 'Bodytype',
				'value' => 'van',
				'compare' => 'LIKE'
			);
			$search_args['meta_query'][] = array( 
				'key' => 'Bodytype',
				'value' => 'Pick up',
				'compare' => 'LIKE'
			);
		} 

		if( $type == 'car' || $type == 'new-car' ) {
			$search_args['meta_query'][] = array( 
				'key' => 'Bodytype',
				'value' => 'van',
				'compare' => 'NOT LIKE'
			);
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

	if( isset( $make ) && $make != 'all' ){
		$search_args['tax_query'][] = array(
			'taxonomy' => 'make',
			'field' => 'id',
			'terms' => $make,
		);
	}

	if( isset( $model ) && $model != 'all' ){
		$search_args['tax_query'][] = array(
			'taxonomy' => 'make',
			'field' => 'slug',
			'terms' => $model,
			'type' => 'CHAR',
			'compare' => 'LIKE'
		);
	}
	$search_args['meta_query'][] = array(
		'key' => 'Price',
		'value' => array( $min, $max ),
		'type' => 'numeric',
		'compare' => 'BETWEEN'
	);

	$search_args['meta_query']['relation'] = 'AND';
	$cars = get_posts( $search_args );
	if( count( $cars ) > 0 ) {
		$search_args['numberposts'] = -1;
		$count = count( get_posts( $search_args ) );
		if( $type == 'van' || $body == 'VAN' ) {
			echo '<h4 class="underline">' . $count . ' Vans Found</h4>';
		} else {
			echo '<h4 class="underline">' . $count . ' Cars Found</h4>';
		}
		
	?>
		<form id="order-results">
			<select name="order-results">
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
			'prev_text' => '&larr; Prev',
			'next_text' => 'Next &rarr;', 
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
		echo '<div class="pagination">' 
		. paginate_links( array(
			'base' => str_replace( $big, '%#%', '/search/cars/%#%' ),
			'format' => '/%#%',
			'current' => max( 1, $current_page ),
			'total' => ceil( $count / 10 ),
			'prev_text' => '&larr; Prev',
			'next_text' => 'Next &rarr;', 
			'mid_size' => 1
		) )
		. '</div>';
		//echo '<div class="pagination"></div>';
	} else {
?>

	<h2>Whoops...</h2>
	<p>We could not find any cars that match your criteria.</p>
	<p>You could try amending your search criteria to be less specific in the form above.</p>
<?php
	}