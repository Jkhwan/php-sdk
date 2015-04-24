<?php namespace Retsly;

class Request {

  /**
   * A request to the Retsly API
   * @param string $method
   * @param string $url
   * @param array $query
   * @param string $token
   */
  function __construct ($method, $url, $query=[], $token) {
    $this->method = $method;
    $this->url = $url;
    $this->query = $query;
    $this->token = $token;
  }

  /**
   * Add $query to querystring array
   * @param array $query
   */
  function query (array $query) {
    $this->query = array_merge_recursive($this->query, $query);
    return $this;
  }

  /**
   * Add a constraint to the querystring
   * @param string $field
   * @param string $op
   * @param mixed value
   */
  function where ($field, $op=null, $value=null) {
    // first arg can be an array
    if (is_array($field)) return $this->query($field);
    // fancy string splitting
    if (null == $value && null == $op) {
      $arr = explode(" ", $field, 3);
      // TODO get mad if length is not 3
      $field = $arr[0]; $op = $arr[1]; $value = $arr[2];
    }
    // assume eq if only two args
    if (null == $value) {
      $value = $op;
      $op = "eq";
    }
    // shorthand operators
    if ($op == "<")  $op = "lt";
    if ($op == ">")  $op = "gt";
    if ($op == "<=") $op = "lte";
    if ($op == ">=") $op = "gte";
    if ($op == "!=") $op = "ne";
    if ($op == "=")  $op = "eq";

    return $this->query([$field => [$op => $value]]);
  }

  /**
  * Limit the response to $val documents
   * @param int $val
   */
  function limit ($val) {
    return $this->query(["limit" => $val]);
  }

  /**
  * Offset (skip) the response by $val documents
   * @param int $val
   */
  function offset ($val) {
    return $this->query(["offset" => $val]);
  }

  /**
   * Starts a GET request for a single document by $id
   * @param string $id
   * @return object
   */
  function get ($id) {
    $this->method = "get";
    $this->key = $id;
    return $this->end();
  }

  /**
   * Starts a GET request for an array of documents
   * @param array $query
   * @return array
   */

  function getAll ($query = null) {
    $this->method = "get";
    if ($query) $this->query($query);
    return $this->end();
  }

  /**
   * Send the request and return the result
   * @return object|array
   */

  function end () {
    $str = curl_exec($this->getCurlSession());
    // if no str, throw
    $res = json_decode($str, false);
    // TODO if error
    if (false == $res->success) return false;
    // TODO return an array-like Collection
    return $res->bundle;
  }

  private function getHeader () {
    return [
      strtoupper($this->method) . " " . $this->url . " HTTP/1.1",
      "Content-Type: application/json",
      "Authorization: Bearer " . $this->token
    ];
  }

  private function getPath () {
    $q = "?" . http_build_query($this->query);
    return $this->url . ($this->key ? "/" . $this->key : $q);
  }

  private function getCurlSession () {
    $req = curl_init();
    curl_setopt($req, CURLOPT_URL, $this->getPath());
    curl_setopt($req, CURLOPT_HTTPHEADER, $this->getHeader());
    curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($req, CURLOPT_HEADER, false);
    curl_setopt($req, CURLOPT_TIMEOUT, 100);
    return $req;
  }
}
