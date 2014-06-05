<?php session_start(); ?>
<div id="div787">
	<center>
		<b>Reply-tree</b><br />	
 	<?php

		mb_internal_encoding("UTF-8");
		ini_set( 'display_errors', "1" );

		/* Load required lib files. */
		require_once('twitteroauth/twitteroauth.php');
		require_once('config.php');

		/* Get user access tokens out of the session. */
		$access_token = $_SESSION['access_token'];

		/* Create a TwitterOauth object with consumer/user tokens. */
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

		/* If method is set change API call made. Test is called by default. */
		$json = $connection->get('statuses/user_timeline',array('count'=>'5'));
 	
 		echo "<br / >";
 		echo $json[$_POST['tweetID']]->id;

  	?>
 	<!-- <img src="./images/photo1.jpg" width="50%" height="50%"> -->
	</center>
</div>