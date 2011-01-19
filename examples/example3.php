<?php

/**
 * This example shows
 *
 * - How to perform a reverse geocode
 * - How to determine the city of the location
 */

require( '../sdk/bootstrap.php' );
require( '../sdk/communicator/CurlCommunicator.php' );

$service = new GoogleGeocodeServiceV3( new CurlCommunicator() );

// Geographic center of US ZIP code 90210
$response = $service->reverseGeocode( 34.1346702, -118.4389877 );

while ( $response->valid() )
{
  // Address component type we're checking for
  $component = GoogleGeocodeResponseV3::ACT_LOCALITY;

  // Is it a city-level result?
  if ( $response->assertType( $component ) )
  {
    // Get the city name
    echo $response->getAddressComponentName( $component );
    break;
  }
  $response->next();
}

echo '<hr>', highlight_file( __FILE__, 1 );