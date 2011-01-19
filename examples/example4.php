<?php

/**
 * This example shows
 *
 * - How to bias a response towards a region
 * - How to bias a response towards a viewport
 */

require( '../sdk/bootstrap.php' );
require( '../sdk/communicator/CurlCommunicator.php' );

$service = new GoogleGeocodeServiceV3( new CurlCommunicator() );

// Show that the API assumes "Portland, OR" for "Portland USA"
echo $service->geocode( 'Portland USA' )->getFormattedAddress(), '<br>';

// Now geocode the state of Maine and bias results to its viewport
$maine = $service->geocode( 'Maine, USA' );
$service->biasViewportByBoundsObject( $maine->getViewport() );

// Re-geocode "Portland USA"
echo $service->geocode( 'Portland USA' )->getFormattedAddress(), '<br>';


// Establish an ambiguous location
$location = 'Toledo';

// Bias for the USA
$service->biasRegion( 'com' );
echo $service->geocode( $location )->getFormattedAddress(), '<br>';

// Bias for Spain
$service->biasRegion( 'es' );
echo $service->geocode( $location )->getFormattedAddress(), '<br>';


echo '<hr>', highlight_file( __FILE__, 1 );