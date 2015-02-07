<?php
session_start();
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', 'PUT YOUR CONSUMER_KEY HERE');
define('CONSUMER_SECRET', 'PUT YOUR CONSUMER_SECRET HERE');
define('OAUTH_CALLBACK', 'PUT YOUR CALLBACK HERE');

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
