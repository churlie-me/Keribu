<?php
/**
@author muni
@copyright http:www.smarttutorials.net
 */

require_once 'messages.php';

//site specific configuration declartion

define( 'BASE_PATH', 'http://keribu.ug/advertise/startsell.php');
define( 'DB_HOST', 'localhost' );
define( 'DB_USERNAME', 'root');
define( 'DB_PASSWORD', '');
define( 'DB_NAME', 'keribu');


//Facebook App Details
define('FB_APP_ID', '1541302149487185');
define('FB_APP_SECRET', '2a2c0723e9c0dfb20503412dd0a6a981');
define('FB_REDIRECT_URI', 'http://keribu.ug/');




//Google App Details
define('GOOGLE_APP_NAME', 'CultivatingHappyness Google+ login');
define('GOOGLE_OAUTH_CLIENT_ID', '370233674821-n1oeus5vkqrpbnb4e9ajcn77epd5b12s.apps.googleusercontent.com');
define('GOOGLE_OAUTH_CLIENT_SECRET', '4q063rDmu3P3Db5dZ_PxWQ07');
define('GOOGLE_OAUTH_REDIRECT_URI', 'https://keribu.ug/oauth2callback');
define("GOOGLE_SITE_NAME", 'http://keribu.ug/'); 


//Twitter login
define('TWITTER_CONSUMER_KEY', ' oJYa6r1xyUrVsVHC9F3dsaxLp');
define('TWITTER_CONSUMER_SECRET', 'urMYBCnXetz8o3idVEKM8JqzLmMYUQu0QrJANZYXIxvXHSvjQ1');
define('TWITTER_OAUTH_CALLBACK', 'http://keribu.ug/');



function __autoload($class)
{
	$parts = explode('_', $class);
	$path = implode(DIRECTORY_SEPARATOR,$parts);
	require_once $path . '.php';
}
