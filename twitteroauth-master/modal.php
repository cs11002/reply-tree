<?php session_start(); ?>
<meta charset="utf-8">
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
		//最初のツイートを取得
		$api = 'statuses/show/'.$_POST['tweetID'];
		$c = 0;
		$tweet = array();//会話一覧を保持する配列
		$tweet[$c] = $connection->get($api);

 		//最初のツイートからリプライをたどる
	 	while($tweet[$c]->in_reply_to_status_id_str != null) {
			$api = 'statuses/show/'.$tweet[$c]->in_reply_to_status_id_str;
			$c++;
			$tweet[$c] = $connection->get($api);
		}
		//会話一覧をテスト表示
		for($i=0; $i<$c+1;$i++) {
			echo "<br / >";
 			echo $tweet[$i]->text;
		}

  	?>
 
	</center>
</div>