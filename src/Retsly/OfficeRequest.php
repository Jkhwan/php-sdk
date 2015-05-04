<?php namespace Retsly;

class OfficeRequest extends Request {
  function __construct (Client $client, $query=[]) {
    return parent::__construct($client, "get", $client->getURL("office"), $query);
  }
}
