<?php namespace Retsly;

class ListingRequest extends Request {
  function __construct (Client $client, $query=[]) {
    return parent::__construct($client, "get", $client->getURL("listing"), $query);
  }
}
