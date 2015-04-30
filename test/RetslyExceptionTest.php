<?php

require_once(__DIR__."/../src/Retsly/RetslyException.php");
use Retsly\RetslyException;

class RetslyExceptionTest extends PHPUnit_Framework_TestCase {
  function testType () {
    $e = new RetslyException();
    $this->assertTrue($e instanceof RetslyException);
    $this->assertTrue($e instanceof Exception);
  }
}
