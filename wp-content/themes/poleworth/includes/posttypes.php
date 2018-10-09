<?php
/**
*	Function: register_taxonomy_type(  );
*	Register Type Taxonomy
**/
if( !function_exists( 'register_taxonomy_type' ) ) {
	add_action( 'init', 'register_taxonomy_type' );
	function register_taxonomy_type() {
		$labels = array( 
			'name' => _x( 'Types', 'Type' ),
			'singular_name' => _x( 'Type', 'Type' ),
			'search_items' => _x( 'Search Type', 'Type' ),
			'popular_items' => _x( 'Popular Type', 'Type' ),
			'all_items' => _x( 'All Type', 'Type' ),
			'parent_item' => _x( 'Parent Type', 'Type' ),
			'parent_item_colon' => _x( 'Parent Type:', 'Type' ),
			'edit_item' => _x( 'Edit Type', 'Type' ),
			'update_item' => _x( 'Update Type', 'Type' ),
			'add_new_item' => _x( 'Add New Type', 'Type' ),
			'new_item_name' => _x( 'New Type', 'Type' ),
			'separate_items_with_commas' => _x( 'Separate Type with commas', 'Type' ),
			'add_or_remove_items' => _x( 'Add or remove Type', 'Type' ),
			'choose_from_most_used' => _x( 'Choose from most used Type', 'Type' ),
			'menu_name' => _x( 'Type', 'Type' ),
		);
		$args = array( 
			'labels' => $labels,
			'public' => true,
			'show_in_menu' => false,			
			'show_in_nav_menus' => false,
			'show_ui' => true,
			'show_tagcloud' => false,
			'show_admin_column' => false,
			'hierarchical' => false,
			'rewrite' => true,
			'query_var' => true
		);
		register_taxonomy( 'cartype', array('car'), $args );
	}
}
/**
*	Function: register_taxonomy_make(  );
*	Register Make Taxonomy
**/
if( !function_exists( 'register_taxonomy_make' ) ) {
	add_action( 'init', 'register_taxonomy_make' );
	function register_taxonomy_make() {
		$labels = array( 
			'name' => _x( 'Makes', 'Make' ),
			'singular_name' => _x( 'Make', 'Make' ),
			'search_items' => _x( 'Search Make', 'Make' ),
			'popular_items' => _x( 'Popular Make', 'Make' ),
			'all_items' => _x( 'All Make', 'Make' ),
			'parent_item' => _x( 'Parent Make', 'Make' ),
			'parent_item_colon' => _x( 'Parent Make:', 'Make' ),
			'edit_item' => _x( 'Edit Make', 'Make' ),
			'update_item' => _x( 'Update Make', 'Make' ),
			'add_new_item' => _x( 'Add New Make', 'Make' ),
			'new_item_name' => _x( 'New Make', 'Make' ),
			'separate_items_with_commas' => _x( 'Separate Make with commas', 'Make' ),
			'add_or_remove_items' => _x( 'Add or remove Make', 'Make' ),
			'choose_from_most_used' => _x( 'Choose from most used Make', 'Make' ),
			'menu_name' => _x( 'Make', 'Make' ),
		);
		$args = array( 
			'labels' => $labels,
			'public' => true,
			'show_in_menu' => false,			
			'show_in_nav_menus' => false,
			'show_ui' => false,
			'show_tagcloud' => false,
			'show_admin_column' => false,
			'hierarchical' => true,
			'rewrite' => true,
			'query_var' => true
		);
		register_taxonomy( 'make', array('car'), $args );
	}
}
/**
*	Function: register_cpt_car(  );
*	Adds the cars post type
**/
if( !function_exists( 'register_cpt_car' ) ) {
	add_action( 'init', 'register_cpt_car' );
	function register_cpt_car(  ) {
		$labels = array( 
			'name' => _x( 'Cars', 'car' ),
			'singular_name' => _x( 'Car', 'car' ),
			'add_new' => _x( 'Add New', 'car' ),
			'add_new_item' => _x( 'Add New Car', 'car' ),
			'edit_item' => _x( 'Edit Car', 'car' ),
			'new_item' => _x( 'New Car', 'car' ),
			'view_item' => _x( 'View Car', 'car' ),
			'search_items' => _x( 'Search Cars', 'car' ),
			'not_found' => _x( 'No cars found', 'car' ),
			'not_found_in_trash' => _x( 'No cars found in Trash', 'car' ),
			'parent_item_colon' => _x( 'Parent Car:', 'car' ),
			'menu_name' => _x( 'Cars', 'car' ),
		);
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => 'Car Listings',
			'supports' => array( 'title', 'author', 'thumbnail', 'custom-fields' ),
			'taxonomies' => array( 'type', 'make' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'has_archive' => true,
			'query_var' => 'car',
			'can_export' => true,
			//'rewrite' => array( 'with_front' => false, 'slug' => 'used-cars' ),
			'capability_type' => 'post'
		);
		register_post_type( 'car', $args );
	}
}
/**
*	Function: register_cpt_slides(  );
*	Adds the slides post type
**/
if( !function_exists( 'register_cpt_slides' ) ) {
	add_action( 'init', 'register_cpt_slides' );
	function register_cpt_slides(  ) {
		$labels = array( 
			'name' => _x( 'Slides', 'slides' ),
			'singular_name' => _x( 'Slide', 'slides' ),
			'add_new' => _x( 'Add New', 'slides' ),
			'add_new_item' => _x( 'Add New Slide', 'slides' ),
			'edit_item' => _x( 'Edit Slide', 'slides' ),
			'new_item' => _x( 'New Slide', 'slides' ),
			'view_item' => _x( 'View Slide', 'slides' ),
			'search_items' => _x( 'Search Slides', 'slides' ),
			'not_found' => _x( 'No Slides found', 'slides' ),
			'not_found_in_trash' => _x( 'No Slides found in Trash', 'slides' ),
			'parent_item_colon' => _x( 'Parent Slide:', 'slides' ),
			'menu_name' => _x( 'Slides', 'slides' ),
		);
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => 'Frontpage Slides',
			'supports' => array( 'title', 'author', 'editor', 'thumbnail' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => array( 'hierarchical' => true ),
			'capability_type' => 'post'
		);
		register_post_type( 'slides', $args );
	}
}

/**
*	Function: register_cpt_hire(  );
*	Adds the hire cars post type
**/
if( !function_exists( 'register_cpt_hire' ) ) {
	add_action( 'init', 'register_cpt_hire' );
	function register_cpt_hire(  ) {
		$labels = array( 
			'name' => _x( 'Hire Cars', 'hire' ),
			'singular_name' => _x( 'Hire Car', 'hire' ),
			'add_new' => _x( 'Add New Class', 'hire' ),
			'add_new_item' => _x( 'Add New Class', 'hire' ),
			'edit_item' => _x( 'Edit Class', 'hire' ),
			'new_item' => _x( 'New Class', 'hire' ),
			'view_item' => _x( 'View Class', 'hire' ),
			'search_items' => _x( 'Search Classes', 'hire' ),
			'not_found' => _x( 'No hire cars found', 'hire' ),
			'not_found_in_trash' => _x( 'No hires cars found in Trash', 'hire' ),
			'parent_item_colon' => _x( 'Parent Hire Car:', 'hire' ),
			'menu_name' => _x( 'Hire Cars', 'hire' ),
		);
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'description' => 'Car Listings',
			'supports' => array( 'title', 'author', 'thumbnail', 'custom-fields', 'editor' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'has_archive' => true,
			'query_var' => 'hire',
			'can_export' => true,
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'car-hire' ),
		);
		register_post_type( 'hire', $args );
	}
}

if( !function_exists( 'register_cpt_gallery' ) ) {
	function register_cpt_gallery(  ) {

		$labels = array(
			'name'                => _x( 'Galleries', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Gallery', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Gallery', 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Galleries:', 'text_domain' ),
			'all_items'           => __( 'All Galleries', 'text_domain' ),
			'view_item'           => __( 'View Gallery', 'text_domain' ),
			'add_new_item'        => __( 'Add New Gallery', 'text_domain' ),
			'add_new'             => __( 'New Gallery', 'text_domain' ),
			'edit_item'           => __( 'Edit Gallery', 'text_domain' ),
			'update_item'         => __( 'Update Gallery', 'text_domain' ),
			'search_items'        => __( 'Search Galleries', 'text_domain' ),
			'not_found'           => __( 'No galleries found', 'text_domain' ),
			'not_found_in_trash'  => __( 'No galleries found in Trash', 'text_domain' ),
		);
		$rewrite = array(
			'slug'                => 'galleries',
			'with_front'          => false,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'gallery', 'text_domain' ),
			'description'         => __( 'Polesworth Galleries', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'author', 'revisions', ),
			'taxonomies'          => array( 'category', 'post_tag' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'query_var' 		  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);
		register_post_type( 'gallery', $args );

	}

	add_action( 'init', 'register_cpt_gallery', 0 );
}
if( !function_exists( 'add_car_menu_pages' ) ) {
	function add_car_menu_pages(  ) {
		add_menu_page( 'Manage Cars', 'Manage Cars', 'manage_options', 'cars', 'car_list', 'dashicons-marker', '2.1' );
		add_submenu_page( 'cars', 'View Cars', 'View Cars', 'manage_options', 'cars', 'car_list' );
	}
	add_action( 'admin_menu', 'add_car_menu_pages' );
}

if( !function_exists( 'car_list' ) ) {
	function car_list(  ) {
		global $wpdb;
		if( strtoupper( $_SERVER['REQUEST_METHOD'] ) === 'POST' ){
			//Get all the fields together and lets get to this
			$item = array();
			$item['New'] = 1;
			$item['Make'] = ucwords( strtolower( $_POST['make'] ) );
			$item['Model'] = ucwords( strtolower( $_POST['model'] ) );
			$item['Variant'] = ucwords( strtolower( $_POST['type'] ) );
			$item['FullRegistration'] = $_POST['registration_number'];
			$item['Year'] = $_POST['year'];
			$item['Bodytype'] = ucwords( strtolower( $_POST['bodystyle'] ) );
			$item['Colour'] = ucwords( strtolower( $_POST['colour'] ) );
			$item['FuelType'] = ucwords( strtolower( $_POST['fuel'] ) );
			$item['Transmission'] = ucwords( strtolower( $_POST['gearbox'] ) );
			$item['Mileage'] = $_POST['mileage'];
			$item['Doors'] = $_POST['doors'];
			$item['Seats'] = $_POST['seats'];
			$item['EngineSize'] = $_POST['enginesize'];
			$item['Cap_ID'] = $_POST['capid'];
			$item['Options'] = $_POST['options'];
			$item['Price'] = $_POST['price'];
			$item['CarImages'] = array();

			$item['CarImages'][] = array( 
				'url' => $_POST['drivers-side-front'],
				'field' => 'drivers-side-front',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Drivers Side Front'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['front'],
				'field' => 'front',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Front'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['passenger-side'],
				'field' => 'passenger-side',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Passenger Side'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['passenger-side-front'],
				'field' => 'passenger-side-front',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Passenger Side Front'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['passenger-side-rear'],
				'field' => 'passenger-side-rear',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Passenger Side Rear'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['rear'],
				'field' => 'rear',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Rear'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['drivers-side-rear'],
				'field' => 'drivers-side-rear',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Drivers Side Rear'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['drivers-side'],
				'field' => 'drivers-side',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Drivers Side'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['boot'],
				'field' => 'boot',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Boot'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['engine-bay'],
				'field' => 'engine-bay',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Engine Bay'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['wheels'],
				'field' => 'wheels',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Wheels'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['interior-front'],
				'field' => 'interior-front',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Interior Front'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['interior-rear'],
				'field' => 'interior-rear',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Interior Rear'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['drivers-seat-area'],
				'field' => 'drivers-seat-area',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Drivers Seat Area'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['passenger-seat-area'],
				'field' => 'passenger-seat-area',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Passenger Seat Area'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['centre-console'],
				'field' => 'centre-console',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Centre Console'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['instrument-cluster'],
				'field' => 'instrument-cluster',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Instrument Cluster'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['additional-1'],
				'field' => 'additional-1',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Additional Image #1'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['additional-2'],
				'field' => 'additional-2',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Additional Image #2'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['additional-3'],
				'field' => 'additional-3',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Additional Image #3'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['additional-4'],
				'field' => 'additional-4',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Additional Image #4'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['additional-5'],
				'field' => 'additional-5',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Additional Image #5'
			);

			foreach( $item['CarImages'] as $k => $image_data ) {
				$filename = str_replace( ' ', '-', $image_data['alt'] );
				$filename = str_replace( '/', '-', $filename ) . '.jpg';
				$filename = str_replace( '---', '-', $filename );
				$filename = str_replace( '--', '-', $filename );
				$filename = str_replace( '#', '', $filename );
				if( !empty( $image_data['url'] ) ) {
					if( @copy( $image_data['url'], ABSPATH . '/vehicle-images/' . strtolower( $filename ) ) ) {
						$item['CarImages'][$k]['url'] = 'http://www.polesworth-garage.com/vehicle-images/' . strtolower( $filename );
					} else {
						$item['CarImages'][$k]['url'] = 'http://www.polesworth-garage.com/vehicle-images/' . strtolower( $filename );
					}
				} else {
					unset( $item['CarImages'][$k] );
				}
			}


			$item_post = array(
				'post_type' => 'car',
				'post_title' => $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'],
				'post_content' => '',
				'post_author' => 1,
				'post_status' => 'publish',
			);

			$post_id = wp_insert_post( $item_post );
			$type = 'Old';

			if( !term_exists( $type, 'cartype' ) ){
				wp_insert_term( $type, 'cartype' );
			}

			wp_set_post_terms( $post_id, array( $type ), 'cartype' );

			if( !empty( $item['Make'] ) && !empty( $item['Model'] ) ) {
				$make = term_exists( $item['Make'], 'make' );
				if( !is_array( $make ) ){
					$make = wp_insert_term( $item['Make'], 'make' );
				}

				$model = term_exists( $item['Model'], 'make' );
				if( !is_array( $model ) ) {
					$model = wp_insert_term( $item['Model'], 'make', array( 'parent' => $make['term_id'] )  );
				}
			}
					
			wp_set_post_terms( $post_id, array( $make['term_id'], $model['term_id'] ), 'make' );
			foreach( $item as $key => $val ) {
				update_post_meta( $post_id, $key, $val );
			}

			$finance = car_finance_lookup( $item['FullRegistration'], $item['Cap_ID'], $item['Year'], $item['Mileage'], $item['Price'] );
			update_post_meta( $post_id, '_finance_quote', $finance );

		}
		if( isset( $_GET['action'] ) && $_GET['action'] == 'delete' ) {
			$car_id = $_GET['car_id'];
			wp_delete_post( $car_id, true );
		}

		if( isset( $_GET['action'] ) && $_GET['action'] == 'sold' ) {
			$car_id = $_GET['car_id'];
			update_post_meta( $car_id, '_sold', true );
		}

		if( isset( $_GET['action'] ) && $_GET['action'] == 'unsold' ) {
			$car_id = $_GET['car_id'];
			update_post_meta( $car_id, '_sold', false );
		}

		include get_stylesheet_directory() . '/templates/car-list.php';
	}
}

if( !function_exists( 'car_add' ) ) {
	function car_add(  ) {
		global $wpdb;

		include get_stylesheet_directory() . '/templates/car-add.php';
	}
}

if( !function_exists( 'car_edit' ) ) {
	function car_edit(  ) {
		if( strtoupper( $_SERVER['REQUEST_METHOD'] ) === 'POST' ) {
			$item = array();
			$item['New'] = 1;
			$item['Make'] = ucwords( strtolower( $_POST['make'] ) );
			$item['Model'] = ucwords( strtolower( $_POST['model'] ) );
			$item['Variant'] = ucwords( strtolower( $_POST['type'] ) );
			$item['FullRegistration'] = $_POST['registration_number'];
			$item['Year'] = $_POST['year'];
			$item['Bodytype'] = ucwords( strtolower( $_POST['bodystyle'] ) );
			$item['Colour'] = ucwords( strtolower( $_POST['colour'] ) );
			$item['FuelType'] = ucwords( strtolower( $_POST['fuel'] ) );
			$item['Transmission'] = ucwords( strtolower( $_POST['gearbox'] ) );
			$item['Mileage'] = $_POST['mileage'];
			$item['Doors'] = $_POST['doors'];
			$item['Seats'] = $_POST['seats'];
			$item['EngineSize'] = $_POST['enginesize'];
			$item['Cap_ID'] = $_POST['capid'];
			$item['Options'] = $_POST['options'];
			$item['Price'] = $_POST['price'];
			$item['CarImages'] = array();

			$item['CarImages'][] = array( 
				'url' => $_POST['drivers-side-front'],
				'field' => 'drivers-side-front',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Drivers Side Front'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['front'],
				'field' => 'front',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Front'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['passenger-side'],
				'field' => 'passenger-side',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Passenger Side'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['passenger-side-front'],
				'field' => 'passenger-side-front',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Passenger Side Front'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['passenger-side-rear'],
				'field' => 'passenger-side-rear',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Passenger Side Rear'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['rear'],
				'field' => 'rear',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Rear'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['drivers-side-rear'],
				'field' => 'drivers-side-rear',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Drivers Side Rear'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['drivers-side'],
				'field' => 'drivers-side',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Drivers Side'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['boot'],
				'field' => 'boot',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Boot'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['engine-bay'],
				'field' => 'engine-bay',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Engine Bay'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['wheels'],
				'field' => 'wheels',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Wheels'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['interior-front'],
				'field' => 'interior-front',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Interior Front'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['interior-rear'],
				'field' => 'interior-rear',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Interior Rear'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['drivers-seat-area'],
				'field' => 'drivers-seat-area',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Drivers Seat Area'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['passenger-seat-area'],
				'field' => 'passenger-seat-area',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Passenger Seat Area'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['centre-console'],
				'field' => 'centre-console',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Centre Console'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['instrument-cluster'],
				'field' => 'instrument-cluster',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Instrument Cluster'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['additional-1'],
				'field' => 'additional-1',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Additional Image #1'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['additional-2'],
				'field' => 'additional-2',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Additional Image #2'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['additional-3'],
				'field' => 'additional-3',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Additional Image #3'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['additional-4'],
				'field' => 'additional-4',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Additional Image #4'
			);
			$item['CarImages'][] = array( 
				'url' => $_POST['additional-5'],
				'field' => 'additional-5',
				'alt' => $item['Year'] . ' ' . $item['Colour'] . ' ' . $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'] . ' ' . $item['FullRegistration'] . ' Additional Image #5'
			);

			foreach( $item['CarImages'] as $k => $image_data ) {
				$filename = str_replace( ' ', '-', $image_data['alt'] );
				$filename = str_replace( '/', '-', $filename ) . '.jpg';
				$filename = str_replace( '---', '-', $filename );
				$filename = str_replace( '--', '-', $filename );
				$filename = str_replace( '#', '', $filename );
				if( !empty( $image_data['url'] ) ) {
					if( @copy( $image_data['url'], ABSPATH . '/vehicle-images/' . strtolower( $filename ) ) ) {
						$item['CarImages'][$k]['url'] = 'http://www.polesworth-garage.com/vehicle-images/' . strtolower( $filename );
					} else {
						$item['CarImages'][$k]['url'] = 'http://www.polesworth-garage.com/vehicle-images/' . strtolower( $filename );
					}
				} else {
					unset( $item['CarImages'][$k] );
				}
			}			

			$post_id = $_GET['car_id'];
			$type = 'Old';

			if( !term_exists( $type, 'cartype' ) ){
				wp_insert_term( $type, 'cartype' );
			}

			wp_set_post_terms( $post_id, array( $type ), 'cartype' );

			if( !empty( $item['Make'] ) && !empty( $item['Model'] ) ) {
				$make = term_exists( $item['Make'], 'make' );
				if( !is_array( $make ) ){
					$make = wp_insert_term( $item['Make'], 'make' );
				}

				$model = term_exists( $item['Model'], 'make' );
				if( !is_array( $model ) ) {
					$model = wp_insert_term( $item['Model'], 'make', array( 'parent' => $make['term_id'] )  );
				}
			}
			wp_set_post_terms( $post_id, array( $make['term_id'], $model['term_id'] ), 'make' );

			$car_price = get_post_meta( $post_id, 'Price', true );
			if( $item['Price'] < $car_price ) {
				//Set Reduced 
				$item['Reduced'] = $car_price - $item['Price'];
			} else {
				$item['Reduced'] = False;
			}

			foreach( $item as $key => $val ) {
				update_post_meta( $post_id, $key, $val );
			}

			$finance = car_finance_lookup( $item['FullRegistration'], $item['Cap_ID'], $item['Year'], $item['Mileage'], $item['Price'] );
			update_post_meta( $post_id, '_finance_quote', $finance );

		}
		include get_stylesheet_directory() . '/templates/car-edit.php';
	}
}

if( !function_exists( 'car_lookup_callback' ) ) {
	function car_lookup_callback(  ) {
		$url = 'http://www.autonect.net/vehiclefinder/cbvf.php';
		$strUserName = 'Autonect';
		$strPassword = 'jc54682eh';           
		$strClientRef = 'live';                  
		$strClientDescription = 'lookup';
		$strKey1 = '1325fhst';
		$strVRM = str_replace( ' ', '', $_REQUEST['reg_number'] );
		$strVersion = '0.31.1';

		$combined_url = "strUserName=" . $strUserName . "&strPassword=" . $strPassword . "&strClientRef=" . $strClientRef . "&strClientDescription=" . $strClientDescription . "&strKey1=" . $strKey1 . "&strVRM=" . $strVRM . "&strVersion=" . $strVersion;

		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 7);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $combined_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);

		$xml = new SimpleXMLElement( $result );

		$option = get_option( 'carweb-' . date( 'F-Y' ), 0 );
		if( $option == 0 ) {
			$option = 1;
		} else { 
			$option = $option+1;
		}
		update_option( 'carweb-' . date( 'F-Y' ), $option );

		$return = array();

		$return['make'] = ucwords( strtolower( $xml->DataArea->Vehicles->Vehicle[0]->Combined_Make ) );
		$return['model'] = ucwords( strtolower( $xml->DataArea->Vehicles->Vehicle[0]->ModelRangeDescription ) );
		$return['registration_number'] = $xml->DataArea->Vehicles->Vehicle[0]->VRM_Curr;
		$return['year'] = $xml->DataArea->Vehicles->Vehicle[0]->DVLAYearOfManufacture;
		$return['bodystyle'] = ucwords( strtolower( $xml->DataArea->Vehicles->Vehicle[0]->BodyStyleDescription ) );
		$return['fuel'] = ucwords( strtolower( $xml->DataArea->Vehicles->Vehicle[0]->Combined_FuelType ) );
		$return['gearbox'] = ucwords( strtolower( $xml->DataArea->Vehicles->Vehicle[0]->Combined_Transmission ) );
		$return['doors'] = $xml->DataArea->Vehicles->Vehicle[0]->NumberOfDoors;
		$return['seats'] = $xml->DataArea->Vehicles->Vehicle[0]->Seats;
		$return['enginesize'] = $xml->DataArea->Vehicles->Vehicle[0]->Combined_EngineCapacity;
		$return['colour'] = ucwords( strtolower( $xml->DataArea->Vehicles->Vehicle[0]->ColourCurrent ) );
		$return['type'] = ucwords( strtolower( $xml->DataArea->Vehicles->Vehicle[0]->ModelVariantDescription ) );
		$return['spec'] = array();
		
		if( isset( $xml->DataArea->Vehicles->Vehicle[0]->SpecOptions->SpecOption[0] ) ) {
			$iterator = $xml->DataArea->Vehicles->Vehicle[0]->SpecOptions->SpecOption[0];
			foreach( $iterator->children(  ) as $k => $v ) {
				if( $k == 'SpecItem' ) {
					$return['spec'][] = $v->Description;
				}
			}
		}
		
		$final = json_encode( $return );
		echo $final;
		die;
	}

	add_action( 'wp_ajax_car_lookup', 'car_lookup_callback' );
}

if( !function_exists( 'car_finance_lookup' ) ) {
	function car_finance_lookup( $registration, $cap_id, $year, $mileage, $price ) {
		global $class_map;
		require_once( ABSPATH . '/wp-content/themes/poleworth/quoteware2.php');
		$term = 60;
		$annual_mileage = 10000;
		$deposit = 1000;
		try
		{
			
			$soap_wsdl = "http://quoteware2.webzation.ws/Quoteware2.svc?wsdl";
			$soap_options = array(
								"trace"    => 1, 
								"classmap" => $class_map,
								"style"    => SOAP_DOCUMENT,
	                            "use"      => SOAP_LITERAL,
								"features" => SOAP_SINGLE_ELEMENT_ARRAYS,
								"soap_version"	=> SOAP_1_1,
								"encoding"    		=> "UTF-8"
								);
			
			$QWv2Client = new SoapClient($soap_wsdl, $soap_options);
		
			$objGetQuotes = new GetQuotes();
			$GetQuotes->Credentials = new Credentials;
			
			$GetQuotes->Credentials->Username = "www.polesworthgarageltd.com";
			$GetQuotes->Credentials->Password = "p0l35w0rthg4r4g3";
			
			$quote_request_number = 1;
			for($count=0; $count<$quote_request_number; $count++)
			{
				$arrQuoteRequests[$count] = new QuoteRequest;
				$arrQuoteRequests[$count]->GlobalRequestParameters = new RequestParameters;
				$arrQuoteRequests[$count]->GlobalRequestParameters->ComputationPath = "Default";
				$arrQuoteRequests[$count]->GlobalRequestParameters->Term = $term;
				$arrQuoteRequests[$count]->GlobalRequestParameters->TermUnit = "Months";
				$request_number = 1;
				
				for($count2=0; $count2<$request_number; $count2++)
				{			
				 	$arrRequests[$count2] = new Request;
				 	$arrRequests[$count2]->Figures = new RequestFigures;
				 	$arrRequests[$count2]->Figures->CashPrice = $price;
				 	$arrRequests[$count2]->Figures->CashDeposit = $deposit;
	                $arrRequests[$count2]->Figures->Asset = new RequestFiguresAssetMotorVehicle;
					$arrRequests[$count2]->Figures->Asset->AnnualDistance = $annual_mileage;
					$arrRequests[$count2]->Figures->Asset->OutstandingSettlement = 0;
					$arrRequests[$count2]->Figures->Asset->PartExchange = 0;
					$arrRequests[$count2]->Asset = new RequestAssetMotorVehicle;
					$arrRequests[$count2]->Asset->Class = "Car";
					$arrRequests[$count2]->Asset->Condition = "Used";
					$arrRequests[$count2]->Asset->CurrentOdometerReading = $mileage;
					$arrRequests[$count2]->Asset->Identity = $cap_id;
					$arrRequests[$count2]->Asset->IdentityType = "RVC";	
					$arrRequests[$count2]->Asset->RegistrationDate = date_create($year.'-01-01')->format("Y-m-d\TH:i:s"); 
					$arrRequests[$count2]->Asset->StockIdentity = $registration;
					$arrRequests[$count2]->Asset->Source = "RegionCurrent";
					$arrRequests[$count2]->Asset->StockLocation = "12345";
					
				}
				$objArrayOfRequest = new ArrayOfRequest;
				$objArrayOfRequest->Request = $arrRequests;
				$arrQuoteRequests[$count]->Requests = $objArrayOfRequest;			//Add all Requests to QuoteRequest
				
			}
			
			$objArrayOfQuoteRequest = new ArrayOfQuoteRequest;
			$objArrayOfQuoteRequest->QuoteRequest = $arrQuoteRequests;
			$GetQuotes->QuoteRequests = $objArrayOfQuoteRequest;						//Add all QuoteRequests 
			
			//Call Quoteware2 GetQuotes with built objects
			$objGetQuotesResponse = $QWv2Client->GetQuotes($GetQuotes);
			
			//Process Response
			//var_dump($objGetQuotesResponse);
			$objQuoteResponse = $objGetQuotesResponse->GetQuotesResult;
			
		
			if ($objQuoteResponse->hasQuoteResults)
			{
				
				foreach ($objQuoteResponse->QuoteResults->QuoteResult as $objQuoteResult)
				{
				}
				if ($objQuoteResult->hasResults)
				{ 
					foreach ($objQuoteResult->Results->Result as $objResult)////->Result
					{
					
						if ($objResult->hasProductGroup)
						{
							foreach ($objResult->ProductGroups->ProductGroup as $objProductGroup)
							{
								if ($objProductGroup->hasProductQuote)
								{
									$i = 0;
									foreach ($objProductGroup->ProductQuotes->ProductQuote as $objProductQuote)
									{
										
										if (!$objProductQuote->hasErrors)
										{       //No Quote Errors or Warnings
											$i++;
											return number_format( $objProductQuote->Figures->RegularPayment, '2', '.', ',' );
				 			 			}
				 			 		}
				 			 	}
				 			}										
				 		}
				 	}
				}				
			}
			else
			{
				return 0;
			}

			
		
		}
		catch (Exception $e)
		{
			return 0;
		}
	}
}

function car_enqueue_scripts() {
    wp_register_script( 'add-car-upload', get_template_directory_uri() .'/javascript/add-car.js', array('jquery','media-upload','thickbox') );
    wp_register_script( 'table-sorter', get_template_directory_uri() .'/javascript/table-sorter.js', array('jquery','media-upload','thickbox') );
 
    if ( 'add_car' == $_GET['page'] || 'edit_car' == $_GET['page'] || 'cars' == $_GET['page'] ) {
        wp_enqueue_script('jquery');
 
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
 
        wp_enqueue_script('media-upload');
        wp_enqueue_script('add-car-upload');
         wp_enqueue_script('table-sorter');
 
    }
 
}
add_action('admin_enqueue_scripts', 'car_enqueue_scripts');