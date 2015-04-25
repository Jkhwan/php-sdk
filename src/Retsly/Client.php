<?php namespace Retsly;

require_once(__DIR__.'/Request.php');

class Client {
  const BASE_URL = "https://rets.io/api/v1";

  /**
   * Retsly API client
   * @param string $token
   * @param string $vendor
   */
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
    $url = $this->getURL("listing", $this->vendor);
    return $this->getRequest("get", $url, $query);
  }

  /**
   * Get an agents request
   * @param array $query
   * @return \Retsly\Request
   */
  function agents ($query=[]) {
    $url = $this->getURL("agent", $this->vendor);
    return $this->getRequest("get", $url, $query);
  }

  /**
   * Get an offices request
   * @param array $query
   * @return \Retsly\Request
   */
  function offices ($query=[]) {
    $url = $this->getURL("office", $this->vendor);
    return $this->getRequest("get", $url, $query);
  }

  /**
   * Get an open houses request
   * @param array $query
   * @return \Retsly\Request
   */
  function openHouses ($query=[]) {
    $url = $this->getURL("openhouse", $this->vendor);
    return $this->getRequest("get", $url, $query);
  }

  /**
   * Get a new Request object
   * @param string $method
   * @param string $url
   * @param array $query
   * @return \Retsly\Request
   */
  function getRequest ($method, $url, $query) {
    return new Request($method, $url, $query, $this->token);
  }

  private function getURL ($resource, $vendor, $id="") {
    return self::BASE_URL . "/" . $resource . "/" . $vendor . "/" . $id;
  }

}
