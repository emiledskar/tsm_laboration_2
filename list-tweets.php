<?php

require_once 'config.php';
require_once 'header.php';

$connection->setOauthToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);


if( !empty($_POST) ){

	echo '<div class="row" style="padding-top:20px;">
			<div class="col-xs-4 col-xs-offset-4">
				<form method="post" action="list-tweets">
					<div class="input-group form-search">
						<input name="query" value="'.$_POST['query'].'" class="form-control search-query">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-primary" data-type="last">Search</button>
						</span>
					</div>
				</form>
			</div>
		</div>';

	$tweets = $connection->get('search/tweets', array( 'q' => $_POST['query'], 'result_type' => 'recent', 'count' => 100));
	
	
	if(!empty($tweets->statuses)){
		$nr = 0;
		foreach ( $tweets->statuses as $tweet) {
			if(!isset($tweet->retweeted_status)){
				$date_parts = explode(' ',$tweet->created_at);

				echo '<div class="timeline">
						<dl>';
				if($nr % 2){
					echo '<dd class="pos-right clearfix">
								<div class="circ">
								</div>
								<div class="time">'.$date_parts[1].' '.$date_parts[2].'</div>
								<div class="events">
									<div class="pull-left"><img class="events-object img-rounded" src="'.$tweet->user->profile_image_url.'"></div>
									<div class="events-body">
										<h4 class="events-heading">'.$tweet->user->name.'</h4>
										<p>'.$tweet->text.'</p>
									</div>
								</div>
							</dd>';
				}else{
					echo '<dd class="pos-left clearfix">
								<div class="circ">
								</div>
								<div class="time">'.$date_parts[1].' '.$date_parts[2].'</div>
								<div class="events">
									<div class="pull-left"><img class="events-object img-rounded" src="'.$tweet->user->profile_image_url.'"></div>
									<div class="events-body">
										<h4 class="events-heading">'.$tweet->user->name.'</h4>
										<p>'.$tweet->text.'</p>
									</div>
								</div>
							</dd>';		
				}

							
				echo '</dl>
					</div>';

				$nr++;
			}
		}	
	}else{
		echo '<div class="row" style="padding-top:20px;">
				<div class="col-xs-4 col-xs-offset-4 text-center">
					No tweet´s found.
				</div>
				</div>';
	}
}else{
	echo '<div class="row" style="position: relative; top: 50%; transform: translateY(-50%);">
			<div class="col-xs-4 col-xs-offset-4">
				<form method="post" action="list-tweets">
					<div class="input-group form-search">
						<input name="query" class="form-control search-query">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-primary" data-type="last">Search</button>
						</span>
					</div>
				</form>
			</div>
		</div>';
}