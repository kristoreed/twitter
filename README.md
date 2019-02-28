# Twitter api operator

## Composer installation
```
composer require kristoreed/twitter
```
## Configuration file
Add configuration file in project (e.g in Zend Framework in location **config/autoload/twitter.global.php**) with below presented structure.
Twitter app's credenciales can be found on https://developer.twitter.com in section "Keys and tokens".

```php
<?php
return [
    'twitter' => [
        'api' => [
            'host' => 'https://api.twitter.com',
            'version' => '1.1',
            'credential' => [
                'consumer_key' => 'your_consumer_key',
                'consumer_secret' => 'your_consumer_secret',
                'oauth_token' => 'your_oauth_token',
                'oauth_token_secret' => 'your_oauth_token_secret',
            ],
            'authentication_prefix' => [
                'oauth','oauth2'
            ],
        ],
    ],
];
```

## Examples 
_List of all Twitter's api endpoints are avalible on https://developer.twitter.com/en/docs/api-reference-index_

### Retrieving user timeline by screen name
_Request sending to selected endpoint with GET request and Oauth autorization_

```php
<?php
use Kristoreed\Twitter\Authorization\AutorizationOauth;
use Kristoreed\Twitter\Configuration\Configuration;
use Kristoreed\Twitter\Request\RequestGet;
use Kristoreed\Twitter\Twitter;

$configuration = new Configuration($config['twitter']);
$autorizationOauth = new AutorizationOauth($configuration);
$requestGet = new RequestGet($configuration, $autorizationOauth);
$twitter = new Twitter($requestGet);
$statusesJson = $twitter->tweet('statuses/user_timeline.json', ['screen_name' => 'twitterapi']);
$statuses = json_decode($statusesJson, true);

```

### Retrieving a bearer token for Oauth2 autorization
_Request sending to selected endpoint with POST request and Basic autorization_

```php
<?php
use Kristoreed\Twitter\Authorization\AutorizationBasic;
use Kristoreed\Twitter\Configuration\Configuration;
use Kristoreed\Twitter\Request\RequestPost;

$token = false;
if(empty($token)) {
    $configuration = new Configuration($config['twitter']);
    $autorizationBasic = new AutorizationBasic($configuration);
    $requestPost = new RequestPost($configuration, $autorizationBasic);
    $twitter = new Twitter($requestPost);
    $tokenResponseJson = $twitter->tweet("oauth2/token", [
        'grant_type' => 'client_credentials',
    ]);
    $tokenResponse = json_decode($tokenResponseJson, true);
    if(!empty($tokenResponse['access_token'])) {
        $token = $tokenResponse['access_token'];
    }
}

```

### Retrieving user timeline by screen name
_Request sending to selected endpoint with GET request and Oauth2 autorization_

```php
<?php
use Kristoreed\Twitter\Authorization\AutorizationOauth2;
use Kristoreed\Twitter\Configuration\Configuration;
use Kristoreed\Twitter\Request\RequestGet;
use Kristoreed\Twitter\Twitter;

$configuration = new Configuration($config['twitter']);
$autorizationOauth2 = new AutorizationOauth2($configuration, $token);
$requestGet = new RequestGet($configuration, $autorizationOauth2);
$twitter = new Twitter($requestGet);
$statusesJson = $twitter->tweet('statuses/user_timeline.json', ['screen_name' => 'twitterapi']);
$statuses = json_decode($statusesJson, true);

```

### Updating user status
_Request sending to selected endpoint with POST request and Oauth autorization_

```php
<?php
use Kristoreed\Twitter\Authorization\AutorizationOauth;
use Kristoreed\Twitter\Configuration\Configuration;
use Kristoreed\Twitter\Request\RequestPost;
use Kristoreed\Twitter\Twitter;

$configuration = new Configuration($config['twitter']);
$autorizationOauth = new AutorizationOauth($configuration);
$requestPost = new RequestPost($configuration, $autorizationOauth);
$twitter = new Twitter($requestPost);
$statusesJson = $twitter->tweet('statuses/update.json', ['status' => 'Hey Joe!']);
$statuses = json_decode($statusesJson, true);

```