RocketChat API
==============

[![Build Status on TravisCI](https://secure.travis-ci.org/xp-forge/rocketchat.svg)](http://travis-ci.org/xp-forge/rocketchat)
[![XP Framework Module](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Required PHP 5.6+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-5_6plus.png)](http://php.net/)
[![Supports PHP 7.0+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-7_0plus.png)](http://php.net/)
[![Supports HHVM 3.4+](https://raw.githubusercontent.com/xp-framework/web/master/static/hhvm-3_4plus.png)](http://hhvm.com/)
[![Latest Stable Version](https://poser.pugx.org/xp-forge/rocketchat/version.png)](https://packagist.org/packages/xp-forge/rocketchat)

Wraps the [RocketChat REST API](https://rocket.chat/docs/developer-guides/rest-api).

Examples
--------

```php
use com\rocketchat\RocketChatApi;
use util\Secret;

$username= '...';
$secret= new Secret('...');

$api= new RocketChatApi('https://chat.example.com/');
$api->login($username, $secret);

$channel= $api->channels->named('test');

foreach ($api->channels->historyOf($channel) as $message) {
  // ...
}
```