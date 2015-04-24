<?php

require_once(__DIR__."/../Retsly/Client.php");
use Retsly\Request;
use Retsly\Client;

class ClientTest extends PHPUnit_Framework_TestCase {
  function testConstructor() {
    $c = new Client("bogus");
    $this->assertInternalType("string", $c->token);
    $this->assertEquals("test", $c->vendor);
  }

  function testVendor() {
    $c = new Client("bogus");
    $c->vendor("foo");
    $this->assertEquals("foo", $c->vendor);
  }

  function testGetRequest() {
    $c = new Client("bogus");
    $r = $c->getRequest("GET", "http://google.com/", []);
    $this->assertInstanceOf("Retsly\Request", $r);
  }
}
