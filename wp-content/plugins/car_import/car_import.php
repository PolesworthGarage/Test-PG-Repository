<?php
/*
Plugin Name: Car Import
Description: Essentially imports the CSV, and organises everything as the car post type.
Version: 1.0
  
*/
require_once( ABSPATH . '/wp-content/themes/poleworth/quoteware2.php');
class CarImport {
	const name = 'Car Import';
	const slug = 'car_import';
	
	function __construct() {
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		add_action( 'admin_menu', array( &$this, 'add_menu' ) ); 
		add_action( 'process_car_csv', array( &$this, 'process_CSV' ), 50 );
	}
	function add_menu(  ) {
		add_options_page( 'Car Import Settings', 'Car Import Settings', 'manage_options', 'car_import', array( &$this, 'plugin_settings_page' ) );
	}
	function admin_init(  ) {
		register_setting( 'car_import-group', 'location' ); 
		register_setting( 'car_import-group', 'time' ); 
		register_setting( 'car_import-new-location', 'new_location' ); 
		register_setting( 'car_import-change', 'change' ); 
		register_setting( 'car_import-change', 'to' ); 
	}
	function admin_tabs( $current = 'used-cars' ) {
		$tabs = array( 
			'used-cars' => 'Used Cars', 
			'filter' => 'Filters' 
		);
		echo '<div id="icon-themes" class="icon32"><br></div>';
		echo '<h2 class="nav-tab-wrapper">';
		foreach( $tabs as $tab => $name ){
			$class = ( $tab == $current ) ? ' nav-tab-active' : '';
			echo "<a class='nav-tab$class' href='?page=car_import&tab=$tab'>$name</a>";
		}
		echo '</h2>';
	}
	function plugin_settings_page(  ) {
		if( !current_user_can( 'manage_options' ) ) { 
			wp_die(__('You do not have sufficient permissions to access this page.')); 
		}
		
		if ( isset ( $_GET['tab'] ) ) $this->admin_tabs($_GET['tab']); else $this->admin_tabs('used-cars');
		if( isset( $_GET['tab'] ) && $_GET['tab'] == 'filter' ) {
			if( isset( $_GET['settings-updated'] ) ) {
				
			}
			include( sprintf( '%s/templates/filter.php', dirname(__FILE__) ) );
			
		}
		if( isset( $_GET['tab'] ) && $_GET['tab'] == 'new-cars' ) {
			if( isset( $_GET['settings-updated'] ) ) {
				$this->process_new_CSV(  );
			}
			include( sprintf( '%s/templates/new-cars.php', dirname(__FILE__) ) );
			
		}
		if( $_GET['tab'] == 'used-cars' || !isset( $_GET['tab'] ) ) {
			if( isset( $_GET['settings-updated'] ) ) {
				if( isset( $_POST['backup'] ) ) {
					$location = get_option( 'location' );
					update_option( 'location', $_POST['backup'] );
					$this->process_CSV(  ); 
					update_option( 'location', $location );
				} else {
					
					//Remove existing jobs first
					wp_clear_scheduled_hook( 'process_car_csv' );
					
					$time = get_option( 'time' );
					$this->process_CSV(  ); //Run it once now, then an event to run it from now on.
					if( time(  ) > strtotime( 'today '. $time ) ) :
						wp_schedule_event( strtotime( 'tomorrow '. $time ), 'daily', 'process_car_csv' );
					else :
						wp_schedule_event( strtotime( 'today ' . $time ), 'daily', 'process_car_csv' );
					endif;
				}
				
			}
			include( sprintf( '%s/templates/settings.php', dirname(__FILE__) ) );
		}
		
	}
  
	function install_car_import() {
		// do not generate any output here
	}

	function csv_to_array($filename='', $delimiter=',') {
		if(!file_exists($filename) || !is_readable($filename))
			return FALSE;
		
		$header = NULL;
		$data = array();
		if (($handle = fopen($filename, 'r')) !== FALSE)
		{
			while (($row = fgetcsv($handle, 5000, $delimiter)) !== FALSE)
			{
				if(!$header):
					$header = $row;
				else:
					foreach($row as $RowItemKey=>$RowItemValue){
						$row[$RowItemKey] = $this->ConvertCSVToUTF8($RowItemValue);
					}
					$data[] = @array_combine($header, $row);
				endif;
			}
			fclose($handle);
		}
		return $data;
	}
	
	function finance_quote( $registration, $cap_id, $year, $mileage, $price ) {
		global $class_map;
		
		try {
			if (intval($mileage) <= 0)
 				$mileage = 10;
		} catch (Exception $e) {
		}

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

	function process_CSV(  ) {
		global $wpdb;
		
		$this->CleanUpTerms();
		
		$file = get_option( 'location' );
		if( file_exists( $file ) ) {
			copy( $file, ABSPATH . 'csv-backups/polesworth-garage-' . date( 'd\-m\-y' ) . '.csv' );
			$three = strtotime( '-3 Days' );
			if ( $handle = opendir( ABSPATH . 'csv-backups/' ) ) {
				while ( false !== ( $entry = readdir( $handle ) ) ) {
					if ($entry != "." && $entry != "..") {
						if( $entry == 'polesworth-garage-' . date( 'd\-m\-y', $three ) . '.csv' ){
							unlink( ABSPATH . 'csv-backups/' . $entry );
						}
					}
				}
				closedir( $handle );
			}
			$current_cars = get_posts(
				array(
					'post_type' => 'car', 
					'numberposts' => -1,
					'fields' => 'ids'
				)
			); //Arguments get all cars
			$ids = array();
			foreach( $current_cars as $current ) {
				$temp = get_post_meta( $current, 'Vehicle_ID', true );
				$ids[$temp] = $current;
			}
			$cars_copy = $current_cars; //Make a copy of above
			$csv_array = $this->csv_to_array( $file );
			
			$cars_imported = array();
			$cars_deleted = array();
			$cars_sold = array();

			$this->change = get_option( 'change' );
			$this->to = get_option( 'to' );
			
			//Make backup
			$wpdb->query( "SET AUTOCOMMIT = 0" );
			$wpdb->query( "START TRANSACTION" );
			foreach( $csv_array as $item ) {
				if( !array_key_exists( $item['Vehicle_ID'], $ids ) && !empty( $item['Vehicle_ID']) ) {
					if( $item['New'] == 1 ) {
						$type = 'New';
					} else {
						$type = 'Old';
					}
					if( strtolower( $item['Make'] ) == 'mercedes' ) {
						$item['Make'] = 'MERCEDES-BENZ';
					}
					if( strtolower( $item['Bodytype'] ) == 'car derived van' ) {
						$item['Bodytype'] = 'Van';
					}
					if( strtolower( $item['Bodytype'] ) == 'panel van' ) {
						$item['Bodytype'] = 'Van';
					}
					if( strtolower( $item['Bodytype'] ) == 'box van' ) {
						$item['Bodytype'] = 'Van';
					}
					if( strtolower( $item['Bodytype'] ) == 'dropside' ) {
						$item['Bodytype'] = 'Van';
					}
					if( strtolower( $item['Bodytype'] ) == 'Dropside' ) {
						$item['Bodytype'] = 'Van';
					}
					if( strtolower( $item['Bodytype'] ) == 'motor bike' ) {
						$item['Bodytype'] = 'Motorbike';
					}
					$item['Make'] = ucfirst( strtolower( $item['Make'] ) );
					$item['Model'] = ucfirst( strtolower( $item['Model'] ) );
					$item['Bodytype'] = ucfirst( strtolower( $item['Bodytype'] ) );
					$item['FuelType'] = ucfirst( strtolower( $item['FuelType'] ) );
					$opts = explode( ', ', $item['Options'] );
					$arr = $opts;

					foreach( $opts as $opt => $val ) {
						if( in_array( $val, $this->change ) ) {
							$key = array_search( $val, $this->change );
							$arr[$opt] = $this->to[$key];
						}
					}
					$item['Options'] = implode( ', ', $arr );
					$item_post = array(
						'post_type' => 'car',
						'post_title' => $item['Make'] . ' ' . $item['Model'] . ' ' . $item['Variant'],
						'post_content' => '',
						'post_author' => 1,
						'post_status' => 'publish',
					);
					$post_id = wp_insert_post( $item_post );
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
						$wpdb->query( 
							$wpdb->prepare( 
								'INSERT INTO ' . $wpdb->postmeta . ' (post_id, meta_key, meta_value) VALUES (%d, %s, %s)',
								$post_id,
								$key, 
								$val
							)
						);
					}
					
					//Set Finance details
					$finance = $this->finance_quote( $item['FullRegistration'], $item['Cap_ID'], $item['Year'], $item['Mileage'], $item['Price'] );
					update_post_meta( $post_id, '_finance_quote', $finance );
					$cars_imported[] = $post_id;
					//Get Finance
					unset( $ids[$item['Vehicle_ID']] );
				} else {
					$this->UpdateVechileData($ids[$item['Vehicle_ID']] , $item);
					unset( $ids[$item['Vehicle_ID']] );
				}

			}
			$this->UpdateTermMakes();
			$wpdb->query( "COMMIT" );
			
			//Star Buys
			$starbuy = get_option( 'featured_cars' );
			$buy_fields = get_post_custom( $starbuy );
			$args = array(
				'post_type' => 'car',
				'meta_key' => 'FullRegistration',
				'meta_value' => $buy_fields['FullRegistration'],
				'numberposts' => 1
			);
			$postslist = get_posts( $args );
			foreach( $postslist as $new_post ) {
				update_option( 'featured_cars', $new_post->ID );
			}
			$wpdb->query( "SET AUTOCOMMIT = 0" );
			$wpdb->query( "START TRANSACTION" );
			$del_string = '';
			foreach( $ids as $deleted ) {
				$deleted_meta = get_post_meta( $deleted, '_deleted_date', true );
				$seven_days = strtotime( '-7 days' );
				if( $deleted_meta && !empty( $deleted_meta ) ) {
					if( $deleted_meta <= $seven_days ) {
						$cars_deleted[] = $deleted;
						$del_string .= $deleted . ',';
					} else {
						continue;
					}
				} else {
					$cars_sold[] = $deleted;
					update_post_meta( $deleted, '_deleted_date', time() );
					update_post_meta( $deleted, '_sold', true );
				}
			}
			$del_string = substr_replace( $del_string, '', -1 );
			$wpdb->query( 'DELETE FROM '.$wpdb->postmeta.' WHERE post_id IN ( '.$del_string.' )' );
			$wpdb->query( 'DELETE FROM '.$wpdb->term_relationships.' WHERE object_id IN ( '.$del_string.' )' );
			$wpdb->query( 'DELETE FROM '.$wpdb->posts.' WHERE ID IN ( '.$del_string.' )' );
			$wpdb->query( "COMMIT" );

			$sSQL = 'SELECT wp_posts.ID FROM wp_posts INNER JOIN wp_postmeta AS PM1 ON ( wp_posts.ID = PM1.post_id ) ';
			$sSQL .= 'INNER JOIN wp_postmeta AS PM2 ON ( wp_posts.ID = PM2.post_id ) ';
			$sSQL .= 'WHERE (PM1.meta_key = "Make") AND (PM2.meta_key = "Model") ORDER BY PM1.meta_value ASC,PM2.meta_value ASC';
			
			$objCarIDs = array();
			$objSortedCarIDs = $wpdb->get_results($sSQL);
			
			foreach ($objSortedCarIDs as $objCarID){
				$objCarIDs[] = $objCarID->ID;
			}
			
			unset($objSortedCarIDs);
			//Send out daily email with stock in and out.
			$objLastAllIDs = get_option( "amj_cars_imported_ids_after_email"); 
			if( $objLastAllIDs == false){
				$objNewIDs = $cars_imported;
			} else {
				$objNewIDs = array();
				foreach( $objCarIDs as $nCurrentID ){
					if(!in_array($nCurrentID,$objLastAllIDs)){
						$objNewIDs[] = $nCurrentID;
					}
				}
			}
			
			//$this->generate_email( $cars_imported, $cars_sold, $cars_deleted, $objCarIDs );
			$this->generate_email( $objNewIDs, $cars_sold, $cars_deleted, $objCarIDs );
			
			update_option( "amj_cars_imported_ids_after_email", $objCarIDs ); 
			
			//Generate Sitemap
			$this->process_sitemap();
			//Other cleanup things
		}
	}
	
	function CleanUpTerms(){
		//correct all bad names
		$objMakes = get_terms( 'make', 'orderby=count&hide_empty=0' );
		foreach($objMakes as $objMake){
			$sCurrentName = $objMake->name;
			$sCorrectName = ucfirst( strtolower( $sCurrentName ) );
			if($sCorrectName != $sCurrentName){
				wp_update_term( $objMake->term_id , 'make', array('name' => $sCorrectName));
			}
		}
	}
	
	function UpdateTermMakes(){
		global $wpdb;
		
		$this->CleanUpTerms();
		
		//add any missing Makes or Models in the WordPress Taxonomy
		
		$sSQL = "SELECT DISTINCTROW Make,Model From ( SELECT pm1.meta_value AS Make, pm2.meta_value AS Model FROM wp_posts INNER JOIN wp_postmeta AS pm1 ON ( wp_posts.ID = pm1.post_id ) INNER JOIN wp_postmeta AS pm2 ON ( wp_posts.ID = pm2.post_id ) WHERE (pm1.meta_key = 'Make') AND (pm2.meta_key = 'Model') GROUP BY wp_posts.ID) As MakeModel
ORDER BY `MakeModel`.`Make` ASC";
		
		$objVehicleDBMakesModels = array();
		$objMakeModelData = $wpdb->get_results($sSQL);
		$objMakeData = array();
		
		$objMakeToTermID = array();
		
		$sLastMake = "SHOULD NOT EXIST";
		$nCurrentTermID = 0;
		
		foreach ($objMakeModelData as $objMakeModelDataItem){
			if ($objMakeModelDataItem->Make != $sLastMake){
				if ( count($objMakeData) > 0 ){
					$objVehicleDBMakesModels[$sLastMake] = $objMakeData;
				}
				
				$sLastMake = $objMakeModelDataItem->Make;
				
				$objMakeToTermID[$sLastMake] = term_exists( $sLastMake, 'make',0);
				if (!is_array($objMakeToTermID[$sLastMake])){
					$objMakeToTermID[$sLastMake] = wp_insert_term( $sLastMake, 'make' );
				}
				$nCurrentTermID = $objMakeToTermID[$sLastMake]["term_id"];
				$objMakeData = array();
			}
			$objMakeData[] = $objMakeModelDataItem->Model;
			$objModelExistsData = term_exists( $objMakeModelDataItem->Model, 'make',$nCurrentTermID);
			if (!is_array($objModelExistsData)){
				$objModelExistsData = wp_insert_term( $objMakeModelDataItem->Model, 'make', array( 'parent' => $nCurrentTermID )  );
			}
			$objMakeToTermID[$sLastMake . ", " . $objMakeModelDataItem->Model] = array($nCurrentTermID, $objModelExistsData["term_id"]);
			
		}
		$objVehicleDBMakesModels[$sLastMake] = $objMakeData;
		$objMakeToTermID[$sLastMake] = term_exists( $sLastMake, 'make',0 );
		
		// Make sure each post has the correct taxonomy setup
		
		$sSQL = "SELECT ID FROM `wp_posts` where post_type='car'";
		$objAllIDs = $wpdb->get_results($sSQL);
		
		foreach ($objAllIDs as $objPostIDRow){
			$nPostID = $objPostIDRow->ID;
			
			wp_delete_object_term_relationships( $nPostID, 'make' );
			
			$objTermData = wp_get_post_terms($nPostID, 'make', array("fields" => "all"));
			$sCurrentTermData = "";
			$sParentTerm = "";
			$sChildTerm = "";
			foreach($objTermData as $objTermDataItem){
				if ($objTermDataItem->parent == 0 )
					$sParentTerm = ucfirst( strtolower( $objTermDataItem->name ) );
				else
					$sChildTerm = ucfirst( strtolower( $objTermDataItem->name ) );
			}
			
			$sCurrentTermData = $sParentTerm . ", " . $sChildTerm;
			$sShouldBeMake = get_post_meta( $nPostID, $key = 'Make', true );
			$sShouldBeModel = get_post_meta( $nPostID, $key = 'Model', true );
			$sShouldBe = $sShouldBeMake . ", " . $sShouldBeModel; 
			if ($sShouldBe != $sCurrentTermData){
				//wp_remove_object_terms($nPostID,array());
				wp_delete_object_term_relationships( $nPostID, 'make' );
				$objTermsToSet = $objMakeToTermID[$sShouldBe];
				wp_set_post_terms($nPostID, $objTermsToSet,'make',false);

				$objTermData = wp_get_post_terms($nPostID, 'make', array("fields" => "all"));
				$sCurrentTermData = "";
				$sParentTerm = "";
				$sChildTerm = "";
				foreach($objTermData as $objTermDataItem){
					if ($objTermDataItem->parent == 0 )
						$sParentTerm = ucfirst( strtolower( $objTermDataItem->name ) );
					else
						$sChildTerm = ucfirst( strtolower( $objTermDataItem->name ) );
				}
				$sCurrentTermData = $sParentTerm . ", " . $sChildTerm;

			}
		} 

	}
	
	function ConvertCSVToUTF8($sText){
		
		$objByte = unpack('C*', $sText);
		$objConvertData = array();
		foreach($objByte as $nByte){
			if ($nByte > 127)
				$objConvertData[chr($nByte)] = "&#" . $nByte . ";";
		}
		
		if (count($objConvertData) <= 0)
			return $sText;
			
		foreach($objConvertData as $sConvertFrom => $sConvertTo){
			$sText = str_replace($sConvertFrom,$sConvertTo,$sText);
		}
		
		return utf8_encode($sText);
	}
	
	function CleanupCSVData(&$objVechileData){
		if( strtolower( $objVechileData['Make'] ) == 'mercedes' ) {
			$objVechileData['Make'] = 'MERCEDES-BENZ';
		}
		if( strtolower( $objVechileData['Bodytype'] ) == 'car derived van' ) {
			$objVechileData['Bodytype'] = 'Van';
		}
		if( strtolower( $objVechileData['Bodytype'] ) == 'panel van' ) {
			$objVechileData['Bodytype'] = 'Van';
		}
		if( strtolower( $objVechileData['Bodytype'] ) == 'box van' ) {
			$objVechileData['Bodytype'] = 'Van';
		}
		if( strtolower( $objVechileData['Bodytype'] ) == 'motor bike' ) {
			$objVechileData['Bodytype'] = 'Motorbike';
		}
		$objVechileData['Make'] = ucfirst( strtolower( $objVechileData['Make'] ) );
		$objVechileData['Model'] = ucfirst( strtolower( $objVechileData['Model'] ) );
		$objVechileData['Bodytype'] = ucfirst( strtolower( $objVechileData['Bodytype'] ) );
		$objVechileData['FuelType'] = ucfirst( strtolower( $objVechileData['FuelType'] ) );
		$opts = explode( ', ', $objVechileData['Options'] );
		$arr = $opts;
	
		foreach( $opts as $opt => $val ) {
			if( in_array( $val, $this->change ) ) {
				$key = array_search( $val, $this->change );
				$arr[$opt] = $this->to[$key];
			}
		}
		$objVechileData['Options'] = implode( ', ', $arr );
	}
	
	function UpdateVechileData($nPostID , $objVechileData){
		global $wpdb;

		$this->CleanupCSVData($objVechileData);
		$fAnythingDifferent = false;
		$sDifferentKeys = array();
		
		foreach( $objVechileData as $key => $val ) {
			try {
				$sTermData = (string)get_post_meta( $nPostID, $key, true );
				$sCSVData = (string)$val;
				if (strtolower($sCSVData) == "unknown")
					$sCSVData = "";
					
				if ($sCSVData != ""){
					if ((string)$sTermData != (string)$val){
						
						$sTermDataNoReduced =  str_ireplace("REDUCED","",str_replace(array(" ","-","+"), "", $sTermData));
						$sCSVDataNoSpaces =  str_replace(array(" ","-","+"), "", $sCSVData);
						
						if ($sCSVDataNoSpaces == $sTermDataNoReduced)
							continue;
							
						$sDifferentKeys[] = $key;
							
						$fAnythingDifferent = true;
					}
				}
			} catch (Exception $e) {
				
			}			
		}
		
		if ($fAnythingDifferent == false)
			return;
			
		if ( in_array("Make" , $sDifferentKeys) || in_array("Model" , $sDifferentKeys) || in_array("Variant" , $sDifferentKeys)  ){
			$item_post = array(
				'ID' => $nPostID,
				'post_title' => $objVechileData['Make'] . ' ' . $objVechileData['Model'] . ' ' . $objVechileData['Variant'],
			);
			wp_update_post($item_post);
		}

		foreach( $objVechileData as $key => $val ) {
			if (in_array($key,$sDifferentKeys)){
				
				$sDatabaseBefore = get_post_meta( $nPostID, $key ,true);
				
				$NewVal = (string)$val;
				
				if ($key == "Price"){
					$ReducedAmount = floatval($sDatabaseBefore) - floatval($NewVal);
					if ($ReducedAmount > 0){
						add_post_meta($nPostID, "Reduced", $ReducedAmount, true);
					} else {
						delete_post_meta($nPostID, "Reduced");
					}
				}
				
				$fResult = update_post_meta( $nPostID, $key, $NewVal );
			}
		}
	}

	function generate_email( $cars_imported, $cars_sold, $cars_deleted, $cars ) {
		
		include 'mimemail.php';
		require('fpdf-table.php');
		$pdf = new PDF_MC_Table();
		$pdf->AddPage();
		$pdf->SetFont('Helvetica','',14);
		$pdf->SetWidths( array( 33, 44, 44, 38, 32 ) );
		$pdf->SetFont( 'Helvetica', 'B', 14 );
		$pdf->Row( array( 'Registration', 'Make', 'Model', 'Colour', 'Price' ) );
		$pdf->SetFont( 'Helvetica', '', 11 );
		foreach( $cars as $id ) :
			$single = array();
			$single['FullRegistration'] = get_post_meta( $id, 'FullRegistration', true );
			$single['Make'] = get_post_meta( $id, 'Make', true );
			$single['Model'] = get_post_meta( $id, 'Model', true );
			$single['Colour'] = get_post_meta( $id, 'Colour', true );
			$single['Price'] = get_post_meta( $id, 'Price', true );

			$price = $single['Price'];
			if( empty( $price ) ) :
				$price = 'N/A';
			else :
				$price = number_format( $price, 0 );
			endif;
			$pdf->Row( array( $single['FullRegistration'], $single['Make'], $single['Model'], $single['Colour'], iconv("UTF-8", "ISO-8859-1", "£") . $price ) );
		endforeach;
		$pdfdoc = $pdf->Output( '', 'S' );
		
		$mail = new PHPMailer;
		$mail->CharSet = 'UTF-8';
		$mail->IsMail();
		
		$mail->SetFrom('no-reply@polesworth-garage.com', 'Enquiries');
		$mail->AddAddress('tony.shemmans@safeserps.co.uk', 'Stock Email');
		$mail->AddAddress('emma.marven@polesworth-garage.com', 'Stock Email');

		//$mail->SetFrom('no-reply@polesworth-garage.com', 'Enquiries');
		//$mail->AddAddress('tony.shemmans@safeserps.co.uk', 'Stock Email');
		
		$mail->Subject = 'Daily Stock Change Email';
		$message .= '<strong>Changed Stock</strong><br /><br />';
		if( !empty( $cars_imported ) ) :
			$message .= '<strong>--New Stock Imported to Site--</strong><br />';
			//$message = print_r( $cars_imported, true );
			foreach( $cars_imported as $car ) :
				$diff = array();
				$diff['FullRegistration'] = get_post_meta( $car, 'FullRegistration', true );
				$diff['Make'] = get_post_meta( $car, 'Make', true );
				$diff['Model'] = get_post_meta( $car, 'Model', true );
				$diff['Colour'] = get_post_meta( $car, 'Colour', true );
				$diff['Price'] = get_post_meta( $car, 'Price', true );
				$message .= $diff['FullRegistration'] . ' - ' . $diff['Make'] . ' - ' . $diff['Model'] . ' - ' . $diff['Colour'] . ' - £ ' . number_format( $diff['Price'], 2 ) . '<br />';
			endforeach;
			$message .= '<br />';
		else :
			$message .= 'No new stock imported<br />';
		endif;
		
		if( !empty( $cars_sold ) ) :
			$message .= '<strong>--Stock Marked as Sold--</strong><br />';
			foreach( $cars_sold as $car ) :
				$diff = array();
				$diff['FullRegistration'] = get_post_meta( $car, 'FullRegistration', true );
				$diff['Make'] = get_post_meta( $car, 'Make', true );
				$diff['Model'] = get_post_meta( $car, 'Model', true );
				$diff['Colour'] = get_post_meta( $car, 'Colour', true );
				$diff['Price'] = get_post_meta( $car, 'Price', true );
				$message .= $diff['FullRegistration'] . ' - ' . $diff['Make'] . ' - ' . $diff['Model'] . ' - ' . $diff['Colour'] . ' - £' . number_format( $diff['Price'], 2 ) . '<br />';
			endforeach;
			$message .= '<br />';
		else :
			$message .= 'No cars marked as sold<br />';
		endif;
		
		if( !empty( $cars_deleted ) ) :
			$message .= '<strong>--Stock Removed--</strong><br />';
			foreach( $cars_deleted as $car ) :
				$diff = array();
				$diff['FullRegistration'] = get_post_meta( $car, 'FullRegistration', true );
				$diff['Make'] = get_post_meta( $car, 'Make', true );
				$diff['Model'] = get_post_meta( $car, 'Model', true );
				$diff['Colour'] = get_post_meta( $car, 'Colour', true );
				$diff['Price'] = get_post_meta( $car, 'Price', true );
				$message .= $diff['FullRegistration'] . ' - ' . $diff['Make'] . ' - ' . $diff['Model'] . ' - ' . $diff['Colour'] . ' - £' . number_format( $diff['Price'], 2 ) . '<br />';
			endforeach;
			$message .= '<br />';
		else :
			$message .= 'No cars removed from site<br />';
		endif;
		
		$message .= '<strong>Full stock list in attachment.</strong><br /><br />';
		
		$mail->Body = $message;
		$mail->AddStringAttachment( $pdfdoc, 'cars-in-stock.pdf', 'base64', 'application/octet-stream' );
		$mail->IsHTML(true); 
		$mail->Send(  );
}

	function delete_cars(  ) {
		ignore_user_abort( true );
		set_time_limit( 0 );
		global $wpdb;
		/*
		DELETE FROM wp_postmeta WHERE post_id IN ( <post ID:s selected in 1)> )
		DELETE FROM wp_term_relationships WHERE object_id IN ( <post ID:s selected in 1)> )
		DELETE FROM wp_posts WHERE ID IN ( <post ID:s selected in 1)> )*/
	
		$posts = '';
		$args = array( 'post_type' => 'car', 'numberposts' => -1 );
		$args['tax_query'] = array( 'relation' => 'AND' );
		$args['tax_query'][] = array(
			'taxonomy' => 'cartype',
			'field' => 'slug',
			'terms' => array( 'Old', 'old' )
		);
		$mycustomposts = get_posts( $args );
		foreach( $mycustomposts as $mypost ) {
			$posts .= $mypost->ID . ',';
		}
		$posts = substr_replace( $posts, '', -1 );
		
		$wpdb->query( 'DELETE FROM '.$wpdb->postmeta.' WHERE post_id IN ( '.$posts.' )' );
		$wpdb->query( 'DELETE FROM '.$wpdb->term_relationships.' WHERE object_id IN ( '.$posts.' )' );
		$wpdb->query( 'DELETE FROM '.$wpdb->posts.' WHERE ID IN ( '.$posts.' )' );
	}

	function process_sitemap(  ) {
		global $wpdb;
		$xml = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">';
			$xml .= '<url>';
				$xml .= '<loc>http://www.polesworth-garage.com/</loc>';
				$xml .= '<changefreq>daily</changefreq>';
				$xml .= '<priority>0.9</priority>';
			$xml .= '</url>';
				$pages = get_pages(  );
				foreach( $pages as $page ) :
					$location = get_permalink( $page->ID );
					$change = get_post_meta( $page->ID, 'select', true );
					$priority = get_post_meta( $page->ID, 'priority', true );
					if( empty( $priority ) ) :
						$priority = '0.5';
					endif;
					$xml .= '<url>';
						$xml .= '<loc>' . $location . '</loc>';
						$xml .= '<changefreq>' . 'daily' . '</changefreq>';
						$xml .= '<priority>' . $priority . '</priority>';
					$xml .= '</url>';
				endforeach;
				$cars = get_posts( 
					array(
						'post_type' => 'car',
						'numberposts' => -1
					)
				);
				$single_select = get_option( 'single_select' );
				$single_priority = get_option( 'single_priority' );
				if( empty( $single_priority ) ) :
					$single_priority = '0.5';
				endif;
				foreach( $cars as $car ) :
					$fields = get_post_custom( $car->ID );
					$location = 'http://www.polesworth-garage.com/used-cars/' . strtolower( str_replace( ' ', '-', $fields['Make'][0] ) ) . '/' . $car->post_name;
					$xml .= '<url>';
						$xml .= '<loc>' . $location . '</loc>';
						$xml .= '<changefreq>' . $single_select . '</changefreq>';
						$xml .= '<priority>' . $single_priority . '</priority>';
					$xml .= '</url>';
				endforeach;
				$posts = get_posts( 
					array(
						'post_type' => 'post',
						'numberposts' => -1
					)
				);
				$news_select = get_option( 'news_select' );
				$news_priority = get_option( 'news_priority' );
				if( empty( $news_priority ) ) :
					$news_priority = '0.5';
				endif;
				foreach( $posts as $post ) :
					$location = get_permalink( $post->ID );
					$xml .= '<url>';
						$xml .= '<loc>' . $location . '</loc>';
						$xml .= '<changefreq>' . $news_select . '</changefreq>';
						$xml .= '<priority>' . $news_priority . '</priority>';
					$xml .= '</url>';
				endforeach;

				$galleries = get_posts( 
					array(
						'post_type' => 'gallery',
						'numberposts' => -1
					)
				);
				$gallery_select = get_option( 'gallery_select' );
				$gallery_priority = get_option( 'gallery_priority' );
				if( empty( $gallery_priority ) ) :
					$gallery_priority = '0.5';
				endif;
				foreach( $galleries as $gallery ) :
					$location = get_permalink( $gallery->ID );
					$xml .= '<url>';
						$xml .= '<loc>' . $location . '</loc>';
						$xml .= '<changefreq>' . $gallery_select . '</changefreq>';
						$xml .= '<priority>' . $gallery_priority . '</priority>';
					$xml .= '</url>';
				endforeach;
		$xml .= '</urlset>';
		unlink( ABSPATH . 'sitemap.xml' );
		file_put_contents( ABSPATH . 'sitemap.xml', $xml );
		$this->sitemap_ping( 'http://www.polesworth-garage.com/sitemap.xml' );
	}

	function sitemap_ping( $sitemap_url ){
		$curl_req = array();
		$urls = array();
		$urls[] = "http://www.google.com/webmasters/tools/ping?sitemap=" . urlencode( $sitemap_url );
		$urls[] = "http://www.bing.com/webmaster/ping.aspx?siteMap=" . urlencode( $sitemap_url );
		$urls[] = "http://search.yahooapis.com/SiteExplorerService/V1/updateNotification?appid=YahooDemo&url=" . urlencode( $sitemap_url );
		$urls[] = "http://submissions.ask.com/ping?sitemap=" . urlencode( $sitemap_url );
		 
		foreach ( $urls as $url ) {
			$curl = curl_init(  );
			curl_setopt( $curl, CURLOPT_URL, $url );
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $curl, CURL_HTTP_VERSION_1_1, 1 );
			$curl_req[] = $curl;
		}
		$multiHandle = curl_multi_init(  );
		 
		foreach( $curl_req as $key => $curl ) {
			curl_multi_add_handle( $multiHandle, $curl );
		}
		$isactive = null;
		do {
			$multi_curl = curl_multi_exec( $multiHandle, $isactive );
		} while ( $isactive || $multi_curl == CURLM_CALL_MULTI_PERFORM );
		 
		$success = true;
		foreach( $curl_req as $curlO ) {
			if( curl_errno( $curlO ) != CURLE_OK ) {
				$success = false;
			}
		}
		curl_multi_close( $multiHandle );
		return $success;
	}
}

new CarImport();