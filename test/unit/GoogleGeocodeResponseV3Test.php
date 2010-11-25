<?php

require_once 'PHPUnit/Framework/TestCase.php';

require_once '../sdk/bootstrap.php';

/**
 * GoogleGeocodeResponseV3 test case.
 */
class GoogleGeocodeResponseV3Test extends PHPUnit_Framework_TestCase
{

  /**
   * @var GoogleGeocodeResponseV3
   */
  private $response;

  private $singleParsed;
  private $multipleParsed;

  private $singleResponse = '{ "status": "OK", "results": [ { "types": [ "street_address" ], "formatted_address": "300 E John Carpenter Fwy, Irving, TX 75062, USA", "address_components": [ { "long_name": "300", "short_name": "300", "types": [ "street_number" ] }, { "long_name": "E John Carpenter Fwy", "short_name": "E John Carpenter Fwy", "types": [ "route" ] }, { "long_name": "Irving", "short_name": "Irving", "types": [ "locality", "political" ] }, { "long_name": "Southwest", "short_name": "Southwest", "types": [ "administrative_area_level_3", "political" ] }, { "long_name": "Dallas", "short_name": "Dallas", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Texas", "short_name": "TX", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] }, { "long_name": "75062", "short_name": "75062", "types": [ "postal_code" ] } ], "geometry": { "location": { "lat": 32.8628110, "lng": -96.9397040 }, "location_type": "ROOFTOP", "viewport": { "southwest": { "lat": 32.8596634, "lng": -96.9428516 }, "northeast": { "lat": 32.8659586, "lng": -96.9365564 } } } } ] } ';
  private $multipleResponse = '{ "status": "OK", "results": [ { "types": [ "locality", "political" ], "formatted_address": "Springfield, MO, USA", "address_components": [ { "long_name": "Springfield", "short_name": "Springfield", "types": [ "locality", "political" ] }, { "long_name": "Greene", "short_name": "Greene", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Missouri", "short_name": "MO", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 37.2153260, "lng": -93.2982436 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 37.1442056, "lng": -93.4263030 }, "northeast": { "lat": 37.2863794, "lng": -93.1701842 } }, "bounds": { "southwest": { "lat": 37.0874020, "lng": -93.4140060 }, "northeast": { "lat": 37.2708071, "lng": -93.1798800 } } } }, { "types": [ "locality", "political" ], "formatted_address": "Springfield, IL, USA", "address_components": [ { "long_name": "Springfield", "short_name": "Springfield", "types": [ "locality", "political" ] }, { "long_name": "Capital", "short_name": "Capital", "types": [ "administrative_area_level_3", "political" ] }, { "long_name": "Sangamon", "short_name": "Sangamon", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Illinois", "short_name": "IL", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 39.7817213, "lng": -89.6501481 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 39.6536259, "lng": -89.7731769 }, "northeast": { "lat": 39.8740490, "lng": -89.5684859 } }, "bounds": { "southwest": { "lat": 39.6536259, "lng": -89.7731769 }, "northeast": { "lat": 39.8740490, "lng": -89.5684859 } } } }, { "types": [ "locality", "political" ], "formatted_address": "Springfield, MA, USA", "address_components": [ { "long_name": "Springfield", "short_name": "Springfield", "types": [ "locality", "political" ] }, { "long_name": "Hampden", "short_name": "Hampden", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Massachusetts", "short_name": "MA", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 42.1014831, "lng": -72.5898110 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 42.0635950, "lng": -72.6215340 }, "northeast": { "lat": 42.1620859, "lng": -72.4711490 } }, "bounds": { "southwest": { "lat": 42.0635950, "lng": -72.6215340 }, "northeast": { "lat": 42.1620859, "lng": -72.4711490 } } } }, { "types": [ "locality", "political" ], "formatted_address": "Springfield, OH, USA", "address_components": [ { "long_name": "Springfield", "short_name": "Springfield", "types": [ "locality", "political" ] }, { "long_name": "Clark", "short_name": "Clark", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Ohio", "short_name": "OH", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 39.9242266, "lng": -83.8088171 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 39.8878549, "lng": -83.8696619 }, "northeast": { "lat": 39.9828569, "lng": -83.7034240 } }, "bounds": { "southwest": { "lat": 39.8878549, "lng": -83.8696619 }, "northeast": { "lat": 39.9828569, "lng": -83.7034240 } } } }, { "types": [ "locality", "political" ], "formatted_address": "Springfield, OR, USA", "address_components": [ { "long_name": "Springfield", "short_name": "Springfield", "types": [ "locality", "political" ] }, { "long_name": "Eugene-Springfield", "short_name": "Eugene-Springfield", "types": [ "administrative_area_level_3", "political" ] }, { "long_name": "Lane", "short_name": "Lane", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Oregon", "short_name": "OR", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 44.0462362, "lng": -123.0220289 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 44.0272439, "lng": -123.0508960 }, "northeast": { "lat": 44.0954590, "lng": -122.8797300 } }, "bounds": { "southwest": { "lat": 44.0272439, "lng": -123.0508960 }, "northeast": { "lat": 44.0954590, "lng": -122.8797300 } } } }, { "types": [ "locality", "political" ], "formatted_address": "Springfield, VA, USA", "address_components": [ { "long_name": "Springfield", "short_name": "Springfield", "types": [ "locality", "political" ] }, { "long_name": "Lee", "short_name": "Lee", "types": [ "administrative_area_level_3", "political" ] }, { "long_name": "Fairfax", "short_name": "Fairfax", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Virginia", "short_name": "VA", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 38.7892801, "lng": -77.1872036 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 38.7380689, "lng": -77.2189470 }, "northeast": { "lat": 38.8153930, "lng": -77.1344910 } }, "bounds": { "southwest": { "lat": 38.7380689, "lng": -77.2189470 }, "northeast": { "lat": 38.8153930, "lng": -77.1344910 } } } }, { "types": [ "locality", "political" ], "formatted_address": "Springfield, AR, USA", "address_components": [ { "long_name": "Springfield", "short_name": "Springfield", "types": [ "locality", "political" ] }, { "long_name": "Union", "short_name": "Union", "types": [ "administrative_area_level_3", "political" ] }, { "long_name": "Conway", "short_name": "Conway", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Arkansas", "short_name": "AR", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 35.2675809, "lng": -92.5576595 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 35.2644333, "lng": -92.5608071 }, "northeast": { "lat": 35.2707285, "lng": -92.5545119 } } } }, { "types": [ "locality", "political" ], "formatted_address": "Springfield, TN, USA", "address_components": [ { "long_name": "Springfield", "short_name": "Springfield", "types": [ "locality", "political" ] }, { "long_name": "Springfield-Greenbrier", "short_name": "Springfield-Greenbrier", "types": [ "administrative_area_level_3", "political" ] }, { "long_name": "Robertson", "short_name": "Robertson", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Tennessee", "short_name": "TN", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 36.5092118, "lng": -86.8849984 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 36.4448900, "lng": -86.9446749 }, "northeast": { "lat": 36.5500560, "lng": -86.8142039 } }, "bounds": { "southwest": { "lat": 36.4448900, "lng": -86.9446749 }, "northeast": { "lat": 36.5500560, "lng": -86.8142039 } } } }, { "types": [ "locality", "political" ], "formatted_address": "Springfield, WV 26763, USA", "address_components": [ { "long_name": "Springfield", "short_name": "Springfield", "types": [ "locality", "political" ] }, { "long_name": "Hampshire", "short_name": "Hampshire", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "West Virginia", "short_name": "WV", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] }, { "long_name": "26763", "short_name": "26763", "types": [ "postal_code" ] } ], "geometry": { "location": { "lat": 39.4500000, "lng": -78.6933330 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 39.4468524, "lng": -78.6964806 }, "northeast": { "lat": 39.4531476, "lng": -78.6901854 } } } }, { "types": [ "locality", "political" ], "formatted_address": "Springfield, PA, USA", "address_components": [ { "long_name": "Springfield", "short_name": "Springfield", "types": [ "locality", "political" ] }, { "long_name": "Delaware", "short_name": "Delaware", "types": [ "administrative_area_level_2", "political" ] }, { "long_name": "Pennsylvania", "short_name": "PA", "types": [ "administrative_area_level_1", "political" ] }, { "long_name": "United States", "short_name": "US", "types": [ "country", "political" ] } ], "geometry": { "location": { "lat": 39.9306677, "lng": -75.3201878 }, "location_type": "APPROXIMATE", "viewport": { "southwest": { "lat": 39.8865119, "lng": -75.3668850 }, "northeast": { "lat": 39.9551109, "lng": -75.3076310 } }, "bounds": { "southwest": { "lat": 39.8865119, "lng": -75.3668850 }, "northeast": { "lat": 39.9551109, "lng": -75.3076310 } } } } ] } ';

  /**
   * Prepares the environment before running a test.
   */
  protected function setUp()
  {
    $this->singleParsed   = json_decode( $this->singleResponse );
    $this->multipleParsed = json_decode( $this->multipleResponse );

    parent::setUp();
  }

  /**
   * Cleans up the environment after running a test.
   */
  protected function tearDown()
  {
    $this->response = null;

    parent::tearDown();
  }

  public function testSingleResult()
  {
    $this->_singleResult();
    $this->_validAssertions();

    $this->assertEquals(
        GoogleGeocodeResponseV3::STATUS_OK
      , $this->response->getStatus()
      , 'Status is not ' . GoogleGeocodeResponseV3::STATUS_OK
    );

    // Test Countable interface
    $this->assertEquals(
        1
      , count( $this->response )
      , 'Should be exactly 1 result'
    );

    // Tests Iterator interface
    $this->assertEquals(
        $this->singleParsed->results[0]
      , $this->response->current()
      , 'Result not properly returned'
    );

    $this->_commonResultAssertions( $this->singleParsed->results[0] );
  }

  public function testMultipleResults()
  {
    $this->_multipleResults();
    $this->_validAssertions();

    $this->assertTrue(
        $this->response->hasResults()
      , 'Did not have a result'
    );

    // Test Countable interface
    $this->assertGreaterThan(
        1
      , count( $this->response )
      , 'Should be more than 1 result'
    );

    $i = 0;
    while ( $this->response->valid() )
    {
      $this->assertEquals(
          $i
        , $this->response->key()
        , 'Key is not advancing'
      );

      // Test Iterator Interface
      $this->assertEquals(
          $this->multipleParsed->results[$i]
        , $this->response->current()
        , 'Result objects do not match'
      );

      // Test ArrayAccess Interface
      $this->assertEquals(
          $this->multipleParsed->results[$i]
        , $this->response[$i]
        , 'Result objects do not match'
      );

      $this->_commonResultAssertions( $this->multipleParsed->results[$i] );

      $this->response->next();
      $i++;
    }
  }

  public function testZeroResults()
  {
    $this->_noResults();

    $this->assertEquals(
        GoogleGeocodeResponseV3::STATUS_ZERO_RESULTS
      , $this->response->getStatus()
      , 'Status is not ' . GoogleGeocodeResponseV3::STATUS_ZERO_RESULTS
    );

    $this->assertFalse(
        $this->response->hasResults()
      , 'Had results but should not'
    );

    // Test Countable interface
    $this->assertEquals(
        0
      , count( $this->response )
      , 'Should be 0 results'
    );

    $this->assertNull(
        $this->response->current()
      , 'Result should be NULL'
    );
  }

  public function testInvalidResponses()
  {
    // Invalid Request status
    $this->_invalidRequest();
    $this->_invalidAssertions();
    $this->assertEquals(
        GoogleGeocodeResponseV3::STATUS_INVALID_REQUEST
      , $this->response->getStatus()
      , 'Status is not ' . GoogleGeocodeResponseV3::STATUS_INVALID_REQUEST
    );

    // Request denied Status
    $this->_requestDenied();
    $this->_invalidAssertions();
    $this->assertEquals(
        GoogleGeocodeResponseV3::STATUS_REQUEST_DENIED
      , $this->response->getStatus()
      , 'Status is not ' . GoogleGeocodeResponseV3::STATUS_REQUEST_DENIED
    );

    // Over Query Limit status
    $this->_overQueryLimit();
    $this->_invalidAssertions();
    $this->assertEquals(
        GoogleGeocodeResponseV3::STATUS_OVER_QUERY_LIMIT
      , $this->response->getStatus()
      , 'Status is not ' . GoogleGeocodeResponseV3::STATUS_OVER_QUERY_LIMIT
    );
  }

  protected function _validAssertions()
  {
    $this->assertTrue(
        $this->response->isValid()
      , 'Should be valid but is not'
    );

    $this->assertFalse(
        $this->response->isInvalid()
      , 'Should be valid but is not'
    );
  }

  protected function _invalidAssertions()
  {
    $this->assertTrue(
        $this->response->isInvalid()
      , 'Should be invalid but is valid'
    );

    $this->assertFalse(
        $this->response->isValid()
      , 'Should be invalid but is valid'
    );

    $this->assertNull(
        $this->response->current()
      , 'Result should be NULL'
    );
  }

  protected function _commonResultAssertions( $result )
  {
    $this->assertEquals(
        $result->types
      , $this->response->getTypes()
      , 'Address types do not match'
    );

    foreach ( $result->types as $type )
    {
      $this->assertTrue(
          $this->response->assertType( $type )
        , 'Address type was not asserted'
      );
    }

    $this->assertEquals(
        $result->formatted_address
      , $this->response->getFormattedAddress()
      , 'Formatted addresses do not match'
    );

    foreach ( $result->address_components as $component )
    {
      $this->assertEquals(
          $component->long_name
        , $this->response->getAddressComponentName( $component->types[0] )
        , 'Component long name did not match'
      );

      $this->assertEquals(
          $component->short_name
        , $this->response->getAddressComponentName( $component->types[0], GoogleGeocodeResponseV3::NAME_SHORT )
        , 'Component short name did not match'
      );
    }

    $this->assertEquals(
        $result->geometry->location
      , $this->response->getLocation()
      , 'Locations do not match'
    );

    $this->assertEquals(
        $result->geometry->location_type
      , $this->response->getLocationType()
      , 'Location typess do not match'
    );

    $this->assertEquals(
        $result->geometry->viewport
      , $this->response->getViewport()
      , 'Viewports do not match'
    );

    $this->assertEquals(
        isset( $result->geometry->bounds )
      , $this->response->hasBounds()
      , 'Bounds detection failed'
    );

    // Bounds property is optionally returned by the API
    if ( $this->response->hasBounds() )
    {
      $this->assertEquals(
          $result->geometry->bounds
        , $this->response->getBounds()
        , 'Bounds do not match'
      );
    } else {
      $this->assertNull(
          $this->response->getBounds()
        , 'Bounds should be null'
      );
    }

    $this->_assertPoint( $this->response->getLocation(), 'Location' );
    $this->_assertBound( $this->response->getViewport(), 'Viewport' );

    if ( $this->response->hasBounds() )
    {
      $this->_assertBound( $this->response->getBounds(), 'Bounds' );
    }
  }

  protected function _assertPoint( $point, $label )
  {
    $this->assertObjectHasAttribute(
        'lat'
      , $point
      , $label . ' should have a "lat" property'
    );

    $this->assertObjectHasAttribute(
        'lng'
      , $point
      , $label . ' should have a "lng" property'
    );
  }

  protected function _assertBound( $bound, $label )
  {
    $this->assertObjectHasAttribute(
        'southwest'
      , $bound
      , $label . ' should have a "southwest" property'
    );

    $this->assertObjectHasAttribute(
        'northeast'
      , $bound
      , $label . ' should have a "northeast" property'
    );

    $this->_assertPoint( $bound->southwest, "$label southwest" );
    $this->_assertPoint( $bound->northeast, "$label northeast" );
  }

  protected function _singleResult()
  {
    $this->response = new GoogleGeocodeResponseV3(
        $this->singleResponse
      , GoogleGeocodeServiceV3::FORMAT_JSON
    );
  }

  protected function _multipleResults()
  {
    $this->response = new GoogleGeocodeResponseV3(
        $this->multipleResponse
      , GoogleGeocodeServiceV3::FORMAT_JSON
    );
  }

  protected function _noResults()
  {
    $this->response = new GoogleGeocodeResponseV3(
        '{ "status": "ZERO_RESULTS", "results": [ ] } '
      , GoogleGeocodeServiceV3::FORMAT_JSON
    );
  }

  protected function _invalidRequest()
  {
    $this->response = new GoogleGeocodeResponseV3(
        '{ "status": "INVALID_REQUEST", "results": [ ] } '
      , GoogleGeocodeServiceV3::FORMAT_JSON
    );
  }

  protected function _requestDenied()
  {
    $this->response = new GoogleGeocodeResponseV3(
        '{ "status": "REQUEST_DENIED", "results": [ ] } '
      , GoogleGeocodeServiceV3::FORMAT_JSON
    );
  }

  protected function _overQueryLimit()
  {
    $this->response = new GoogleGeocodeResponseV3(
        '{ "status": "OVER_QUERY_LIMIT", "results": [ ] } '
      , GoogleGeocodeServiceV3::FORMAT_JSON
    );
  }
}

