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

### Request to selected endpoint with GET request and Oauth autorization

```php
<?php
use Kristoreed\Twitter\Authorization\AutorizationOauth;
use Kristoreed\Twitter\Configuration\Configuration;
use Kristoreed\Twitter\Request\RequestGet;
use Kristoreed\Twitter\Twitter as TwitterApi;

$configuration = new Configuration($config['twitter']);
$autorizationOauth = new AutorizationOauth($configuration);
$requestGet= new RequestGet($configuration, $autorizationOauth);
$twitter = new TwitterApi($requestGet);
$statusesJson = $twitter->tweet('statuses/user_timeline.json', ['screen_name' => 'twitterapi']);
$statuses = json_decode($statusesJson, true);

```

### Basic autorization with POST request 
_Retrieving a bearer token for Oauth2_

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
    $tokenResponseJson = $requestPost->send("oauth2/token", [
        'grant_type' => 'client_credentials',
    ]);
    $tokenResponse = json_decode($tokenResponseJson, true);
    if(!empty($tokenResponse['access_token'])) {
        $token = $tokenResponse['access_token'];
    }
}

```

### Request to selected endpoint with GET request and Oauth2 autorization 
_Authorization with bearer token_

```php
<?php
use Kristoreed\Twitter\Authorization\AutorizationOauth2;
use Kristoreed\Twitter\Configuration\Configuration;
use Kristoreed\Twitter\Request\RequestGet;
use Kristoreed\Twitter\Twitter as TwitterApi;

$configuration = new Configuration($config['twitter']);
$autorizationOauth2 = new AutorizationOauth2($configuration, $token);
$requestGet= new RequestGet($configuration, $autorizationOauth2);
$twitter = new TwitterApi($requestGet);
$statusesJson = $twitter->tweet('statuses/user_timeline.json', ['screen_name' => 'twitterapi']);
$statuses = json_decode($statusesJson, true);

```