<?php

require_once(__DIR__."/../src/Retsly/Request.php");
use Retsly\Request;

class RequestTest extends PHPUnit_Framework_TestCase {
  function testConstructor() {
    $q = ["foo" => 42];
    $r = new Request("GET", "http://google.com/", $q, "token");
    $this->assertEquals("GET", $r->method);
    $this->assertEquals("http://google.com/", $r->url);
    $this->assertEquals($q, $r->query);
    $this->assertEquals("token", $r->token);
  }

  function testQuery() {
    $r = new Request("GET", "http://google.com/", [], "token");
    $r->query(["limit" => 10]);
    $this->assertEquals(10, $r->query["limit"]);
  }

  function testWhere() {
    $r = new Request("GET", "http://google.com/", [], "token");

    $r->where("baths", "gte", 1)
      ->where("baths < 6")
      ->where("bedrooms", 4);

    $this->assertEquals(["gte" => 1, "lt" => 6], $r->query["baths"]);
    $this->assertEquals(4, $r->query["bedrooms"]);
  }
}
