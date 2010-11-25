<?php
/**
 * Copyright (c) 2010 J. Walter Thompson dba JWT
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 */

/**
 * A service class for contacting Google's Geocoding API (V3)
 *
 * @author Peter Bailey <peter.bailey@jwt.com>
 *
 * @package GoogleGeocoding
 * @subpackage Core
 *
 * @see http://code.google.com/apis/maps/documentation/geocoding/
 */
class GoogleGeocodeServiceV3
{
  const SERVICE_URL = 'http://maps.googleapis.com/maps/api/geocode/';
  const FORMAT_JSON = 'json';
  const FORMAT_XML  = 'xml';

  /**
   * A Google API Key
   *
   * @var string
   */
  protected $apiKey;

  /**
   * How this services will communicate with the API
   *
   * @var GoogleServiceCommunicator
   */
  protected $communicator;

  /**
   * Standard defaults for all requests
   *
   * @var array
   */
  protected $requestDefaults = array(
      'language' => 'en'
    , 'sensor'   => 'false'
  );

  /**
   * Constructor
   *
   * @param GoogleServiceCommunicator $communicator
   * @param string $apiKey API key is only required for Premier accounts
   * @param array $defaults Defaults for all requests
   */
  public function __construct(
      GoogleServiceCommunicator $communicator
    , $apiKey = null
    , array $defaults = array() )
  {
    $this->communicator = $communicator;
    $this->apiKey = $apiKey;
    $this->setRequestDefaults( $defaults );
  }

  /**
   * Set defaults for subsequent requests
   *
   * @param array $defaults
   */
  public function setRequestDefaults( array $defaults )
  {
    $this->requestDefaults = array_merge( $this->requestDefaults, $defaults );
  }

  /**
   * Geocodes the requested location
   *
   * @param string $location Address or location to geocode
   * @param string $format Response format. "json" or "xml"
   *
   * @return GoogleGeocodeResponseV3
   */
  public function geocode( $location, $format=self::FORMAT_JSON )
  {
    return new GoogleGeocodeResponseV3( $this->communicator->requestUrl(
      $this->generateUrl( $location, $format )
    ), $format );
  }

  /**
   * Reverse geocodes the requested coordinate
   *
   * @param float $lat Latitude of desired point
   * @param float $lng Longitude of desired point
   * @param string $format Response format. "json" or "xml"
   *
   * @return GoogleGeocodeResponseV3
   */
  public function reverseGeocode( $lat, $lng, $format = self::FORMAT_JSON )
  {
    return new GoogleGeocodeResponseV3( $this->communicator->requestUrl(
      $this->generateReverseUrl( $lat, $lng, $format )
    ), $format );
  }

  /**
   * Generate a URL representing the REST call to geocode an address
   *
   * @param string $location
   * @param string $format
   *
   * @return string
   */
  public function generateUrl( $location, $format )
  {
    return $this->buildUrl( array_merge( $this->requestDefaults, array(
        'address' => $location
    ) ), $format );
  }

  /**
   * Generate a URL representing the REST call to reverse geocode a coordinate
   *
   * @param float $lat
   * @param float $lng
   * @param string $format
   *
   * @return string
   */
  public function generateReverseUrl( $lat, $lng, $format )
  {
    return $this->buildUrl( array_merge( $this->requestDefaults, array(
        'latlng' => $lat . ',' . $lng
    ) ), $format );
  }

  /**
   * Build a request URL with the given parameters
   *
   * @param array $params
   * @param string $format
   *
   * @return string
   */
  protected function buildUrl( array $params, $format )
  {
    if ( null != $this->apiKey )
    {
      $params['key'] = $this->apiKey;
    }
    return self::SERVICE_URL . $format . '?' . http_build_query( $params, '', '&' );
  }
}