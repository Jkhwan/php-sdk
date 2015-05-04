<?php namespace Retsly;

class OpenHouseRequest extends Request {
  function __construct (Client $client, $query=[]) {
    return parent::__construct($client, "get", $client->getURL("openhouse"), $query);
  }
}
