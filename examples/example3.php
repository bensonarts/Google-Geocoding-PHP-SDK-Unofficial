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
  // Is it a city-level result?
  if ( $response->assertType( GoogleGeocodeResponseV3::ACT_LOCALITY ) )
  {
    // Get the city name
    echo $response->getAddressComponentName(
      GoogleGeocodeResponseV3::ACT_LOCALITY
    );
  }
  $response->next();
}