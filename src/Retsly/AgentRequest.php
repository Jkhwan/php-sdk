<?php namespace Retsly;

class AgentRequest extends Request {
  function __construct (Client $client, $query=[]) {
    return parent::__construct($client, "get", $client->getURL("agent"), $query);
  }
}
