<?php

require_once 'config.php';

if( ( strcmp($_SESSION['oauth_token'], $_REQUEST['oauth_token']) != 0 ) ){
	header('Location: http://127.0.0.1/laboration_2_tsm/index.php');
}

$connection->setOauthToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

//Get access_token, last step to fetch user specific details
$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

//print_r($access_token);
$_SESSION['oauth_token'] = $access_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $access_token['oauth_token_secret'];
$connection->setOauthToken($access_token['oauth_token'], $access_token['oauth_token_secret']);


header('Location: http://127.0.0.1/laboration_2_tsm/list-tweets.php');
