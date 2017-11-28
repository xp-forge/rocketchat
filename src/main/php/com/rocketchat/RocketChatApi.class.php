<?php namespace com\rocketchat;

use webservices\rest\Endpoint;
use util\Secret;

class RocketChatApi {
  private $api;

  /** @type com.rocketchat.Channels */
  public $channels;

  /**
   * Creates a new instance
   *
   * @param  webservices.rest.Endpoint|string $base
   */
  public function __construct($base) {
    if ($base instanceof Endpoint) {
      $this->api= $base;
    } else {
      $this->api= new Endpoint(rtrim($base, '/').'/api/v1/');
    }
    $this->channels= new Channels($this->api);
  }

  /**
   * Login user
   *
   * @param  string $user
   * @param  util.Secret $password
   * @return void
   * @throws com.rocketchat.CannotAuthenticate
   */
  public function login($user, Secret $password) {
    $r= $this->api->resource('login')->post(
      ['username' => $user, 'password' => $password->reveal()],
      'application/x-www-form-urlencoded'
    );
    if (200 !== $r->status()) {
      throw new CannotAuthenticate('Cannot authenticate '.$user.'; status '.$r->status());
    }

    $login= $r->data();
    $this->api->with('X-Auth-Token', $login['data']['authToken']);
    $this->api->with('X-User-Id', $login['data']['userId']);
  }
}