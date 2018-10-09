<?php

function AMJ_UpdatePageNumber($sURL){
	global $current_page;
	
	$nPageNumberToUse = 0;
	if (isset($_POST['pagenumberbuttonclick']))
		$nPageNumberToUse = intval($_POST['pagenumberbuttonclick']);
	
	$objPageData = explode("/",$sURL);
	
	if ( is_numeric($objPageData[count($objPageData)-1] ) )
		unset($objPageData[count($objPageData)-1]);
	
	$sNewURL = implode("/",$objPageData);
	
	//AMJ_MainDebug("AMJ_UpdatePageNumber: nPageNumberToUse = " . $nPageNumberToUse);
	
	if ($nPageNumberToUse > 0){
		$_POST['offset'] = ($nPageNumberToUse - 1) * 10;
		$current_page = $nPageNumberToUse;
		$_POST['nPageNumberToUse'] = $nPageNumberToUse;
	}
	
	return $sURL;	
}

if( isset( $_POST['urltosave'] ) ) {
	//if ($_POST['urltosave'] != "/used-cars"){
		$sLocationToUse = AMJ_UpdatePageNumber($_POST['urltosave']);
		$_SESSION['wp_current_search'] = $_POST;
		$_SESSION['wp_current_search_urltosave'] = $_POST;
		header( 'Location: ' . $sLocationToUse, true, 303 );
		exit;
	//}
}

unset($_SESSION['wp_current_search_urltosave']);

if( $_SERVER['REQUEST_METHOD'] != 'POST' && !isset( $_SESSION['wp_current_search'] ) ) {
	header( 'Location: /used-cars', true, 303 );
	exit;
}

if( isset( $_POST['post_type'] ) ) {
	if( $_POST['type'] == 'caravan' ) {
		header( 'Location: /caravans-motorhomes/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'automatic' ) {
		header( 'Location: /used-cars/automatics/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'diesel' ) {
		header( 'Location: /used-cars/diesel-cars/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'under5' ) {
		header( 'Location: /used-cars/cheap-cars/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'low' ) {
		header( 'Location: /low-emission-vehicles/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'commercial' ) {
		header( 'Location: /used-vans/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'bike' ) {
		header( 'Location: /motorbikes/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'under10' && $_POST['make'] == 'all' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/under-10k/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'under10' && $_POST['make'] == 'all' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 10000 ) {
		header( 'Location: /used-cars/under-10k/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == 'all' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '29' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/alfa-romeo/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '317' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/aston-martin/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '121' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/audi/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '132' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/bentley/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '69' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/bmw/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '46' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/chevrolet/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '11' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/chrsyler/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '38' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/citroen/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '527' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/dacia/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '211' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/daewoo/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '467' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/ferarri/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '75' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/fiat/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '5' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/ford/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '56' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/honda/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '23' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/hyundai/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '432' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/isuzu/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '9' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/jaguar/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '7' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/jeep/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '78' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/kia/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '80' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/land-rover/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '15' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/lexus/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '66' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/mazda/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '49' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/mercedes-benz/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '52' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/mg/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '62' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/mini/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '191' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/mitsubishi/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '21' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/nissan/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '17' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/peugeot/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '19' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/porsche/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '418' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/range-rover/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '13' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/renault/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '40' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/rover/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '25' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/saab/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '73' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/seat/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '158' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/skoda/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '93' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/subaru/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '240' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/suzuki/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '32' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/toyota/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '34' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/vauxhall/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '82' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/volkswagen/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'car' && $_POST['make'] == '58' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/volvo/', true, 303 );
		exit;
	} elseif ( $_POST['type'] == 'van' && $_POST['make'] == 'all' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ){
		header( 'Location: /used-vans/', true, 303 );
		exit;
	} elseif ( $_POST['type'] == 'van' && $_POST['make'] == 'NISSAN' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ){
		header( 'Location: /used-vans/nissan/', true, 303 );
		exit;
        } elseif( $_POST['type'] == 'all' && $_POST['make'] == 'all' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '29' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/alfa-romeo/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '317' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/aston-martin/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '121' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/audi/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '132' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/bentley/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '69' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/bmw/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '46' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/chevrolet/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '11' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/chrsyler/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '38' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/citroen/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '527' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/dacia/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '211' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/daewoo/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '467' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/ferarri/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '75' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/fiat/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '5' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/ford/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '56' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/honda/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '23' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/hyundai/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '432' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/isuzu/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '9' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/jaguar/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '7' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/jeep/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '78' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/kia/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '80' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/land-rover/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '15' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/lexus/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '66' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/mazda/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '49' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/mercedes-benz/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '52' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/mg/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '62' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/mini/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '191' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/mitsubishi/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '21' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/nissan/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '17' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/peugeot/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '19' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/porsche/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '418' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/range-rover/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '13' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/renault/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '40' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/rover/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '25' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/saab/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '73' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/seat/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '158' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/skoda/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '93' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/subaru/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '240' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/suzuki/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '32' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/toyota/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '34' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/vauxhall/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '82' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/volkswagen/', true, 303 );
		exit;
	} elseif( $_POST['type'] == 'all' && $_POST['make'] == '58' && $_POST['model'] == 'all' && $_POST['min'] == 0 && $_POST['max'] == 260000 ) {
		header( 'Location: /used-cars/volvo/', true, 303 );
		exit;
	} else {
		$_SESSION['wp_current_search'] = $_POST;
		header( 'Location: /search/cars', true, 303 );
		exit;
	}
}

//AMJ_MainDebug("AMJ_UpdatePageNumber: using normal search");

	get_header();

	$search_refer = get_query_var( 's' );
	$search_refer = explode( '/', $search_refer );
	$current_page = 1;
	if( isset( $search_refer[1] ) ) {
		$current_page = $search_refer[1];
	}
	
	$search_query = $search_refer[0];
	
	if ( $search_query == 'cars' ) { 
?>

<section class="main">
	<div class="wrapper">
		<?php include 'filter.php'; ?>
			<div id="results" name="results">
				<?php include_once 'ajax-results-custom.php'; ?>
			</div>
		</div>
	</section>
<?php
	}
	get_footer(  );
?>