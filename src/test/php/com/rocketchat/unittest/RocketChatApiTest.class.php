<?php namespace com\rocketchat\unittest;

use com\rocketchat\RocketChatApi;

class RocketChatApiTest extends \unittest\TestCase {

  #[@test]
  public function can_create() {
    new RocketChatApi('https://chat.example.com/');
  }
}