# Twitter api operator

## Installation by composer
```
composer require kristoreed/twitter
```
## Configuration file
Add configuration file in location **config/autoload/twitter.global.php** with below structure. 
You Can find it on https://developer.twitter.com in "Keys and tokens" App section.

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
List of all Twitter's api avalible endpoints: https://developer.twitter.com/en/docs/api-reference-index

### OAuth autorization with GET request

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
Retrieving a bearer token for Oauth2

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

### Oauth2 autorization with GET request
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
$statusesJson = $twitter->tweet('statuses/user_timeline.json', ['screen_name' => 'JerzyMackiewicz']);
$statuses = json_decode($statusesJson, true);

```