<?php

require_once(__DIR__."/../src/Retsly/Request.php");
use Retsly\Request;

class RequestTest extends PHPUnit_Framework_TestCase {
  function getClient() {
    return $this
      ->getMockBuilder("Retsly\Client")
      ->setConstructorArgs(["foo"])
      ->getMock();
  }

  function getRequest($query=[]) {
    $c = $this->getClient();
    return new Request($c, "get", "https://google.com/", $query);
  }

  function testConstructor() {
    $q = ["ok" => 12];
    $r = $this->getRequest($q);
    $this->assertEquals("get", $r->method);
    $this->assertEquals("https://google.com/", $r->url);
    $this->assertEquals($q, $r->query);
  }

  function testQuery() {
    $r = $this->getRequest();
    $r->query(["limit" => 10]);
    $this->assertEquals(10, $r->query["limit"]);
  }

  function testWhere() {
    $r = $this->getRequest();
    $r->where("baths", "gte", 1)
      ->where("baths < 6")
      ->where("bedrooms", 4);

    $this->assertEquals(["gte" => 1, "lt" => 6], $r->query["baths"]);
    $this->assertEquals(4, $r->query["bedrooms"]);
  }

  function testLimit() {
    $r = $this->getRequest();
    $r->limit(10);
    $this->assertEquals($r->query["limit"], 10);
  }

  function testOffset() {
    $r = $this->getRequest();
    $r->offset(10);
    $this->assertEquals($r->query["offset"], 10);
  }

  function testNextPage() {
    $r = $this->getRequest();
    $r->limit(10)
      ->nextPage()
      ->nextPage();
    $this->assertEquals(20, $r->query["offset"]);
  }

  function testPrevPage() {
    $r = $this->getRequest();
    $r->limit(10)
      ->offset(40)
      ->prevPage();
    $this->assertEquals(30, $r->query["offset"]);
  }

  function testPrevPageStopsAtZero() {
    $r = $this->getRequest();
    $r->limit(10)
      ->offset(0)
      ->prevPage();
    $this->assertEquals(0, $r->query["offset"]);
  }
}
