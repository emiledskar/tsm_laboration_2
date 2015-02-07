<?php

require_once 'config.php';
require_once 'header.php';

$access_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

$_SESSION['oauth_token'] = $access_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $access_token['oauth_token_secret'];
?>

<div class="row vertical-center">
	<div class="col-xs-2 col-xs-offset-5">
		<a href="https://api.twitter.com/oauth/authenticate?oauth_token=<?=$_SESSION['oauth_token']?>">
			<button type="button" class="btn btn-info btn-block">
				Sign in with Twitter
			</button>
		</a>
	</div>
</div>

<?php
	require_once 'footer.php';