<?php namespace com\rocketchat;

use lang\IllegalStateException;

class Channels {
  private $api;

  public function __construct($api) {
    $this->api= $api;
  }

  public function named($name) {
    $list= $this->api->resource('channels.list?query={0}', ['{"name":"'.$name.'"}'])->get()->data();
    switch ($list['count']) {
      case 0: return null;
      case 1: return $list['channels'][0];
      default: throw new IllegalStateException('More than 1 result');
    }
  }

  public function historyOf($channel) {
    $latest= null;
    $params= ['roomId' => is_array($channel) ? $channel['_id'] : $channel, 'latest' => &$latest];
    do {
      $result= $this->api->resource('channels.history')->get($params)->data();
      foreach ($result['messages'] as $message) {
        yield $message;
        $latest= $message['ts'];
      }
    } while ($result['messages']);
  }
}