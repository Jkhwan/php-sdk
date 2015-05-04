<?php namespace Retsly;

class Client {
  const BASE_URL = "https://rets.io/api/v1";

  /**
   * Retsly API client
   * @param string $token
   * @param string $vendor
   * @return Retsly\Client
   */
  static function create ($token, $vendor="test") {
    return new Client($token, $vendor);
  }

  function __construct ($token, $vendor="test") {
    $this->token = $token;
    $this->vendor = $vendor;
  }

  /**
   * Set the vendor
   * @param string $vendor
   */
  function vendor ($vendor) {
    $this->vendor = $vendor;
    return $this;
  }

  /**
   * Get a listings request
   * @param array $query
   * @return \Retsly\Request
   */
  function listings ($query=[]) {
    return new ListingRequest($this, $query);
  }

  /**
   * Get an agents request
   * @param array $query
   * @return \Retsly\Request
   */
  function agents ($query=[]) {
    return new AgentRequest($this, $query);
  }

  /**
   * Get an offices request
   * @param array $query
   * @return \Retsly\Request
   */
  function offices ($query=[]) {
    return new OfficeRequest($this, $query);
  }

  /**
   * Get an open houses request
   * @param array $query
   * @return \Retsly\Request
   */
  function openHouses ($query=[]) {
    return new OpenHouseRequest($this, $query);
  }

  /**
   * Get a new Request object
   * @param string $method
   * @param string $url
   * @param array $query
   * @return \Retsly\Request
   */
  function getRequest ($method, $url, $query) {
    return new Request($this, $method, $url, $query);
  }

  function getURL ($resource) {
    return self::BASE_URL . "/" . $resource . "/" . $this->vendor . "/";
  }

}
