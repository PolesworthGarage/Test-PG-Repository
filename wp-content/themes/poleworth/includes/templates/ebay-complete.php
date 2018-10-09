<?php
	$makes = array(  );
	$models = array(  );
	$row = 0;
	$file = ABSPATH . 'wp-content/themes/poleworth/includes/templates/ebay-models.csv';
	if ( ( $handle = fopen( $file, 'r' ) ) !== FALSE ) {
		while ( ( $data = fgetcsv( $handle, 0, "," ) ) !== FALSE ) {
			if( $row != 1 ) {
				$makes[ $data[4] ] = $data[0];
				$models[ $data[3] ] = $data[1];
			}
			$row++;
		}
		fclose( $handle );
	}
	echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
?>
<empro xmlns="urn:de:mobile:emp:inventory:xml:uk:car" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:de:mobile:emp:inventory:xml:uk:car http://www.ebaymotorspro.co.uk/schema/empro-car-uk.xsd">
	<affiliateId></affiliateId>
	<complete>
		<?php foreach( $cars as $car ): ?>
			<?php $fields = get_post_custom( $car->ID ); ?>
			<?php $options = explode( ', ', $fields['Options'][0] ); ?>
		<ad>
			<title><?php echo $car->post_title; ?></title>
			<vehicleDescription><?php echo ' This ' . $fields['Make'][0] . ' ' . $fields['Model'][0] . ', registration number ' . $fields['FullRegistration'][0] . ' was first registered in  ' . $fields['Year'][0] . ' and is fitted with a ' . $fields['FuelType'][0] . ' engine and ' . $fields['Transmission'][0] . ' gearbox. It has covered just ' . $fields['Mileage'][0] . ' miles and is finished in ' .  $fields['Colour'][0] . '.'; ?></vehicleDescription>
			<internalNumber><?php echo $fields['Vehicle_ID'][0]; ?></internalNumber>
			<reserved>false</reserved>
			<?php foreach( explode( ',', $fields['PictureRefs'][0] ) as $picture ): ?>
			<selfHostedPicture><?php echo $picture; ?></selfHostedPicture>
			<?php endforeach; ?>
			<car>
				<make><?php echo $makes[$fields['Make'][0]]; ?></make>
				<?php if( array_key_exists( $fields['Model'][0], $models ) ) : ?>
				<model><?php echo $models[$fields['Model'][0]]; ?></model>
				<?php else: ?>
				<model>Other</model>
				<customModelName><?php echo $fields['Model'][0]; ?></customModelName>
				<?php endif; ?>
				<?php 
					$type = $fields['Type'][0];
					$type = strtoupper( $type );
					if( $type != ( 'STANDARD' || 'CONVERTIBLE' || 'COUPE' || 'ESTATE' || 'MPV' || 'PICKUP' || 'SUV' || 'VAN' ) ) :
						$type = 'OTHER';
					endif;
				?>
				<type><?php echo $type; ?></type>
				<doors><?php echo $fields['Doors'][0]; ?></doors>
				<?php
					$color = $fields['Colour'][0];
					$color = strtoupper( $color );
					$colors = array (
						'BEIGE', 
						'BLACK', 
						'BLUE', 
						'BROWN', 
						'MAROON', 
						'CREAM', 
						'GOLD',
						'GREY', 
						'GREEN', 
						'ORANGE', 
						'PURPLE', 
						'RED', 
						'SILVER', 
						'TURQUOISE', 
						'WHITE', 
						'YELLOW'
					);
					if( !in_array( $color, $colors ) ) :
						$color = 'OTHER';
					endif;
				?>
				<color><?php echo $color; ?></color>
				<modelYear><?php echo $fields['Year'][0]; ?></modelYear>
				<mileage><?php echo $fields['Mileage'][0]; ?></mileage>
				<engineSize><?php echo $fields['EngineSize'][0]; ?></engineSize>
				<?php
					$transmission = $fields['Transmission'][0];
					$transmission = strtoupper( $transmission );
					if( $transmission == 'AUTO' ):
						$transmission = 'AUTOMATIC';
					endif;
				?>
				<transmission><?php echo $transmission; ?></transmission>
				<fuel><?php echo strtoupper( $fields['FuelType'][0] ); ?></fuel>
				<condition>USED</condition>
				<wheel>RIGHT_HAND_SIDE</wheel>
				<consumerPrice><?php echo $fields['Price'][0]; ?></consumerPrice>
				<features>
					<?php if( in_array( 'ABS', $options ) ) : ?>
					<abs>true</abs>
					<?php endif; ?>
					<?php if( in_array( 'Drivers Airbag', $options ) ) : ?>
					<airbagDriver>true</airbagDriver>
					<?php endif; ?>
					<?php if( in_array( 'Passenger Airbag', $options ) ) : ?>
					<airbagPassenger>true</airbagPassenger>
					<?php endif; ?>
					<?php if( in_array( 'Side Airbags', $options ) ) : ?>
					<airbagSide>true</airbagSide>
					<?php endif; ?>
					<?php if( in_array( 'A/C', $options ) ) : ?>
					<airConditioning>true</airConditioning>
					<?php endif; ?>
					<?php if( in_array( 'Alarm', $options ) ) : ?>
					<alarm>true</alarm>
					<?php endif; ?>
					<?php if( in_array( 'Alloy Wheels', $options ) ) : ?>
					<alloyWheels>true</alloyWheels>
					<?php endif; ?>
					<?php if( in_array( 'Radio/Cassette', $options ) ) : ?>
					<cassettePlayer>true</cassettePlayer>
					<?php endif; ?>
					<?php if( in_array( 'Radio/CD', $options ) ) : ?>
					<cdPlayer>true</cdPlayer>
					<?php endif; ?>
					<?php if( in_array( 'Radio/CD Multichanger', $options ) ) : ?>
					<cdMultichanger>true</cdMultichanger>
					<?php endif; ?>
					<?php if( in_array( 'Remote Central Locking', $options ) ) : ?>
					<centralLocking>true</centralLocking>
					<?php endif; ?>
					<?php if( in_array( 'Climate Control', $options ) ) : ?>
					<climateControl>true</climateControl>
					<?php endif; ?>
					<?php if( in_array( 'Cruise Control', $options ) ) : ?>
					<cruiseControl>true</cruiseControl>
					<?php endif; ?>
					<?php if( in_array( 'Elec Adjustable Drivers Seat', $options ) ) : ?>
					<electricAdjustableSeats>true</electricAdjustableSeats>
					<?php endif; ?>
					<?php if( in_array( 'Heated Front Seat', $options ) ) : ?>
					<electricHeatedSeats>true</electricHeatedSeats>
					<?php endif; ?>
					<?php if( in_array( array( 'Front Electric Windows', 'Rear Electric Windows' ), $options ) ) : ?>
					<electricWindows>true</electricWindows>
					<?php endif; ?>
					<?php if( $fields['FourWheelDrive'][0] == 1 ) : ?>
					<fourWheelDrive>true</fourWheelDrive>
					<?php endif; ?>
					<?php if( in_array( 'Immobiliser', $options ) ) : ?>
					<immobilizer>true</immobilizer>
					<?php endif; ?>
					<?php if( $fields['Origin'][0] == 'Import' ) : ?>
					<importedVehicle>true</importedVehicle>
					<?php endif; ?>
					<?php if( in_array( 'Leather Seats', $options ) ) : ?>
					<leatherSeats>true</leatherSeats>
					<?php endif; ?>
					<?php if( in_array( 'Satellite Navigation', $options ) ) : ?>
					<navigationSystem>true</navigationSystem>
					<?php endif; ?>
					<?php if( in_array( 'Reverse Parking Aid', $options ) ) : ?>
					<parkingSensors>true</parkingSensors>
					<?php endif; ?>
					<?php if( in_array( 'Power Steering', $options ) ) : ?>
					<powerAssistedSteering>true</powerAssistedSteering>
					<?php endif; ?>
					<?php if( in_array( array( 'Radio', 'Radio/CD', 'Radio/Cassette', 'Radio/CD Multichanger' ), $options ) ) : ?>
					<radio>true</radio>
					<?php endif; ?>
					<?php if( in_array( array( 'Sunroof', 'Electric Sunroof' ), $options ) ) : ?>
					<sunroof>true</sunroof>
					<?php endif; ?>
					<?php if( in_array( 'Steering Reach Adjustment', $options ) ) : ?>
					<tiltSteeringWheel>true</tiltSteeringWheel>
					<?php endif; ?>
					<?php if( $fields['Origin'][0] == 1 ) : ?>
					<v5RegistrationDocument>true</v5RegistrationDocument>
					<?php endif; ?>
				</features>
				<vrm><?php echo $fields['FullRegistration'][0]; ?></vrm>
			</car>
		</ad>
		<?php endforeach; ?>
	</complete>
</empro>