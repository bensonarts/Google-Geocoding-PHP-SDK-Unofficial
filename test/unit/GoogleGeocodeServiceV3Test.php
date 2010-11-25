<?php

require_once 'PHPUnit/Framework/TestCase.php';

require_once '../sdk/bootstrap.php';
require_once '../sdk/communicator/MockCommunicator.php';

/**
 * GoogleGeocodeServiceV3 test case.
 */
class GoogleGeocodeServiceV3Test extends PHPUnit_Framework_TestCase
{
  const ADDR_JWT_OFFICE = '300 E John Carpenter Fwy Irving TX';
  const RESPONSE_JWT_OFFICE = '{ "status": "OK", "results": [ { "types": [ "street_address" ], "formatted_address": "300 E John Carpenter Fwy, Irving, TX 75062, USA", "address_components": [ { "long_name": "300", "short_name": "300", "types": [ "street_number" ] }, { "long_name": "E John Carpenter Fwy", "short_name": "E John Carpenter Fwy", "types": [ "route" ] }, { "long_name": "Irving", "short_name": "Irving", "types": [ "locality", "political" ] }, { "long_name": "Southwest", "short_name": "Southwest", "types": [ "administrative_area_level_3", "political" ] }, { "long_name": "Dallas", "short_name": "Dallas", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Texas", "short_name": "TX", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] }, { "long_name": "75062", "short_name": "75062", "types": [ "postal_code" ] } ], "geometry": { "location": { "lat": 32.8628110, "lng": -96.9397040 }, "location_type": "ROOFTOP", "viewport": { "southwest": { "lat": 32.8596634, "lng": -96.9428516 }, "northeast": { "lat": 32.8659586, "lng": -96.9365564 } } } } ] } ';
  const RESPONSE_JWT_OFFICE_REVERSE = '{ "status": "OK", "results": [ { "types": [ "street_address" ], "formatted_address": "300 E John Carpenter Fwy, Irving, TX 75062, USA", "address_components": [ { "long_name": "300", "short_name": "300", "types": [ "street_number" ] }, { "long_name": "E John Carpenter Fwy", "short_name": "E John Carpenter Fwy", "types": [ "route" ] }, { "long_name": "Irving", "short_name": "Irving", "types": [ "locality", "political" ] }, { "long_name": "Southwest", "short_name": "Southwest", "types": [ "administrative_area_level_3", "political" ] }, { "long_name": "Dallas", "short_name": "Dallas", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Texas", "short_name": "TX", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] }, { "long_name": "75062", "short_name": "75062", "types": [ "postal_code" ] } ], "geometry": { "location": { "lat": 32.8628110, "lng": -96.9397040 }, "location_type": "ROOFTOP", "viewport": { "southwest": { "lat": 32.8596634, "lng": -96.9428516 }, "northeast": { "lat": 32.8659586, "lng": -96.9365564 } } } }, { "types": [ "postal_code" ], "formatted_address": "Irving, TX 75062, USA", "address_components": [ { "long_name": "75062", "short_name": "75062", "types": [ "postal_code" ] }, { "long_name": "Irving", "short_name": "Irving", "types": [ "locality", "political" ] }, { "long_name": "Texas", "short_name": "TX", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 32.8337516, "lng": -97.0261802 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 32.8294060, "lng": -97.0469890 }, "northeast": { "lat": 32.8694480, "lng": -96.8887819 } }, "bounds": { "southwest": { "lat": 32.8294060, "lng": -97.0469890 }, "northeast": { "lat": 32.8694480, "lng": -96.8887819 } } } }, { "types": [ "locality", "political" ], "formatted_address": "Irving, TX, USA", "address_components": [ { "long_name": "Irving", "short_name": "Irving", "types": [ "locality", "political" ] }, { "long_name": "Southwest", "short_name": "Southwest", "types": [ "administrative_area_level_3", "political" ] }, { "long_name": "Dallas", "short_name": "Dallas", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Texas", "short_name": "TX", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 32.8140177, "lng": -96.9488945 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 32.7717860, "lng": -97.0340849 }, "northeast": { "lat": 32.9539660, "lng": -96.8887819 } }, "bounds": { "southwest": { "lat": 32.7717860, "lng": -97.0340849 }, "northeast": { "lat": 32.9539660, "lng": -96.8887819 } } } }, { "types": [ "administrative_area_level_3", "political" ], "formatted_address": "Southwest, TX, USA", "address_components": [ { "long_name": "Southwest", "short_name": "Southwest", "types": [ "administrative_area_level_3", "political" ] }, { "long_name": "Dallas", "short_name": "Dallas", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Texas", "short_name": "TX", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 32.6652654, "lng": -96.8779926 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 32.5452820, "lng": -97.0383849 }, "northeast": { "lat": 32.9893280, "lng": -96.5299869 } }, "bounds": { "southwest": { "lat": 32.5452820, "lng": -97.0383849 }, "northeast": { "lat": 32.9893280, "lng": -96.5299869 } } } }, { "types": [ "administrative_area_level_2", "political" ], "formatted_address": "Dallas, Texas, USA", "address_components": [ { "long_name": "Dallas", "short_name": "Dallas", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Texas", "short_name": "TX", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 32.8024682, "lng": -96.8350999 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 32.5452140, "lng": -97.0383849 }, "northeast": { "lat": 32.9893280, "lng": -96.5168659 } }, "bounds": { "southwest": { "lat": 32.5452140, "lng": -97.0383849 }, "northeast": { "lat": 32.9893280, "lng": -96.5168659 } } } }, { "types": [ "administrative_area_level_1", "political" ], "formatted_address": "Texas, USA", "address_components": [ { "long_name": "Texas", "short_name": "TX", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 31.9685988, "lng": -99.9018131 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 25.8371639, "lng": -106.6456460 }, "northeast": { "lat": 36.5007040, "lng": -93.5080390 } }, "bounds": { "southwest": { "lat": 25.8371639, "lng": -106.6456460 }, "northeast": { "lat": 36.5007040, "lng": -93.5080390 } } } }, { "types": [ "country", "political" ], "formatted_address": "United States", "address_components": [ { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 37.0902400, "lng": -95.7128910 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 18.7763000, "lng": 170.5957000 }, "northeast": { "lat": 71.5388000, "lng": -66.8850749 } }, "bounds": { "southwest": { "lat": 18.7763000, "lng": 170.5957000 }, "northeast": { "lat": 71.5388000, "lng": -66.8850749 } } } } ] } ';

  /**
   * @var GoogleGeocodeServiceV3
   */
  private $service;

  /**
   *
   * @var MockCommunicator
   */
  private $communicator;

  /**
   * Prepares the environment before running a test.
   */
  protected function setUp()
  {
    parent::setUp();

    $this->communicator = new MockCommunicator();

    $this->service = new GoogleGeocodeServiceV3(
      $this->communicator
    );
  }

  /**
   * Cleans up the environment after running a test.
   */
  protected function tearDown()
  {
    // TODO Auto-generated GoogleGeocodeServiceV3Test::tearDown()


    $this->service = null;

    parent::tearDown();
  }

  /**
   * Constructs the test case.
   */
  public function __construct()
  {  // TODO Auto-generated constructor
  }

  public function testHappy()
  {
    // Geocode
    $this->communicator->seed(
        $this->service->generateUrl( self::ADDR_JWT_OFFICE, 'json' )
      , self::RESPONSE_JWT_OFFICE
    );

    $response = $this->service->geocode( self::ADDR_JWT_OFFICE );

    $this->assertType( 'GoogleGeocodeResponseV3', $response, 'Was not a GoogleGeocodeResponseV3' );

    // Reverse Geocode
    $this->communicator->seed(
        $this->service->generateReverseUrl( 32.862811, -96.939704, 'json' )
      , self::RESPONSE_JWT_OFFICE_REVERSE
    );

    $response = $this->service->reverseGeocode( 32.862811, -96.939704 );

    $this->assertType( 'GoogleGeocodeResponseV3', $response, 'Was not a GoogleGeocodeResponseV3' );
  }

  public function testUnHappy()
  {
    // Geocode
    $this->communicator->seed(
        $this->service->generateUrl( self::ADDR_JWT_OFFICE, 'xml' )
      , self::RESPONSE_JWT_OFFICE
    );

    try {
      $response = $this->service->geocode( self::ADDR_JWT_OFFICE, 'xml' );
      $this->fail( 'GoogleGeocodeException expected' );
    }
    catch ( GoogleGeocodeException $e )
    {
      $this->assertEquals(
          'XML parsing is not yet supported'
        , $e->getMessage()
        , 'Expected error message not received'
      );
    }
  }

  public function testGeocodeException()
  {
    // Setup the communicator to fail
    $this->communicator->seed(
        $this->service->generateUrl( self::ADDR_JWT_OFFICE, 'json' )
      , false
    );

    try {
      $this->service->geocode( self::ADDR_JWT_OFFICE );
      $this->fail( 'GoogleGeocodeCommunicatorException expected' );
    }
    catch ( GoogleGeocodeCommunicatorException $e )
    {
      // Expected
    }
  }

  public function testUrlGeneration()
  {
    // Test normal URL generation
    $defaults = array(
        'language' => 'en'
      , 'sensor'   => 'false'
    );
    $format = 'json';
    $location = 'Dallas, TX';
    $params = array_merge( $defaults, array( 'address' => $location ) );

    $this->assertEquals(
        "http://maps.googleapis.com/maps/api/geocode/$format?" . http_build_query( $params, '', '&' )
      , $this->service->generateUrl( $location, $format )
      , 'URLs did not match'
    );

    // Test with explicitly set defaults
    $defaults['language'] = 'fr';
    $this->service->setRequestDefaults( array( 'language' => 'fr' ) );
    $params = array_merge( $defaults, array( 'address' => $location ) );

    $this->assertEquals(
        "http://maps.googleapis.com/maps/api/geocode/$format?" . http_build_query( $params, '', '&' )
      , $this->service->generateUrl( $location, $format )
      , 'URLs did not match'
    );

    // Test reverse geocode generation
    $lat = 32.862811;
    $lng = -96.939704;
    $params = array_merge( $defaults, array( 'latlng' => "$lat,$lng" ) );
    $this->assertEquals(
        "http://maps.googleapis.com/maps/api/geocode/$format?" . http_build_query( $params, '', '&' )
      , $this->service->generateReverseUrl( $lat, $lng, $format )
      , 'URLs did not match'
    );
  }
}