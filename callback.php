<?php

require_once 'config.php';
require_once 'header.php';

if( ( strcmp($_SESSION['oauth_token'], $_REQUEST['oauth_token']) != 0 ) ){
	die('something went worng');
}


$connection->setOauthToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
//Get access_token, last step to fetch user specific details
$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

//print_r($access_token);
$connection->setOauthToken($access_token['oauth_token'], $access_token['oauth_token_secret']);

echo '<h1>Lists for '.$access_token['screen_name'].'</h1>';

$lists = $connection->get('lists/ownerships', array('screen_name' => $access_token['screen_name']));

//print_r($lists->lists[1]);
echo '<ul>';
foreach ($lists->lists as $list) {
	if( $_REQUEST['list_id'] ==  $list->id ){
		echo '<li><a href="callback.php?list_id='.$list->id.'">'.$list->name.'</a>******</li>';	
	}else{
		echo '<li><a href="callback.php?list_id='.$list->id.'">'.$list->name.'</a></li>';
	}
}
echo '</ul>';

echo '<br/><hr/><br/><h1>Tweets from list '.$lists->lists[1]->name.'</h1>';
$tweets_from_list = $connection->get('lists/statuses', array('list_id' => $lists->lists[1]->id, 'count' => 4));

echo '<ul>';
foreach ($tweets_from_list as $tweet) {
	echo '<li>'.$tweet->text.'</li>';
}
echo '</ul>';

require_once 'footer.php';