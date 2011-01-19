<?php

/**
 * This example shows
 *
 * - How to bootstrop the service and a communicator
 * - How to determine if the response is good or not
 * - How to retrieve the address of the result
 */

require( '../sdk/bootstrap.php' );
require( '../sdk/communicator/CurlCommunicator.php' );

$service = new GoogleGeocodeServiceV3( new CurlCommunicator() );

$response = $service->geocode( 'Paris, France' );

// Make sure we have a good result
if ( $response->isValid() && $response->hasResults() )
{
  echo $response->getFormattedAddress();
} else {
  echo 'Invalid Response';
}

echo '<hr>', highlight_file( __FILE__, 1 );