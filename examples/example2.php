<?php

/**
 * This example shows
 *
 * - How the results can be counted
 * - How to iterate over a response with multiple results
 * - How to pull a specific address component name from a result
 */

require( '../sdk/bootstrap.php' );
require( '../sdk/communicator/CurlCommunicator.php' );

$service = new GoogleGeocodeServiceV3( new CurlCommunicator() );

// Deliberately geocode an address that will yield multiple results
$response = $service->geocode( 'Springfield' );

// Remember, GoogleGeocodeResponseV3 implements the Countable interface
if ( count( $response ) > 1 )
{
  echo "The city of Springfield found in: <br>";
  while ( $response->valid() )
  {
    // Get the State name
    echo $response->getAddressComponentName(
        GoogleGeocodeResponseV3::ACT_ADMINISTRATIVE_AREA_LEVEL_1
    ), '<br>';

    $response->next();
  }
} else {
  echo "Only one or no results";
}