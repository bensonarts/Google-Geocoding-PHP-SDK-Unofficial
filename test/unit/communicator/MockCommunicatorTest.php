<?php

require_once '../sdk/bootstrap.php';
require_once '../sdk/communicator/MockCommunicator.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * MockCommunicator test case.
 */
class MockCommunicatorTest extends PHPUnit_Framework_TestCase
{

  /**
   * @var MockCommunicator
   */
  private $MockCommunicator;

  /**
   * Prepares the environment before running a test.
   */
  protected function setUp()
  {
    parent::setUp();

    $this->MockCommunicator = new MockCommunicator();
  }

  /**
   * Cleans up the environment after running a test.
   */
  protected function tearDown()
  {
    $this->MockCommunicator = null;

    parent::tearDown();
  }

  /**
   * Tests MockCommunicator->requestUrl()
   */
  public function testRequestUrl()
  {
    $testUrl = 'http://maps.googleapis.com/maps/api/geocode/json?address=Dallas, TX&language=en&sensor=false';
    $testResponse = '{ "status": "OK", "results": [ { "types": [ "locality", "political" ], "formatted_address": "Dallas, TX, USA", "address_components": [ { "long_name": "Dallas", "short_name": "Dallas", "types": [ "locality", "political" ] }, { "long_name": "Northeast", "short_name": "Northeast", "types": [ "administrative_area_level_3", "political" ] }, { "long_name": "Dallas", "short_name": "Dallas", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Texas", "short_name": "TX", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 32.8029550, "lng": -96.7699230 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 32.6527689, "lng": -97.0260418 }, "northeast": { "lat": 32.9528878, "lng": -96.5138042 } }, "bounds": { "southwest": { "lat": 32.6175370, "lng": -96.9993470 }, "northeast": { "lat": 33.0237920, "lng": -96.4637379 } } } } ] } ';

    $this->MockCommunicator->seed(
        $testUrl
      , $testResponse
    );

    $response = $this->MockCommunicator->requestUrl( $testUrl );

    $this->assertEquals(
      $testResponse, $response, 'Response was not the same.'
    );
  }
}

