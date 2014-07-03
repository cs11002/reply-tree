<HTML> 
 <head>
    <meta charset="utf-8">
    <title>Reply-tree</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Loading Bootstrap -->
    <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <script src="./js/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="./js/jquery.leanModal.min.js"></script>
    <link rel="shortcut icon" href="images/favicon.ico">
  </head>
 <body>
<?php session_start(); ?>
<!--<div id="div787">-->
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
		$tweet_u_id = array();
		

 		//最初のツイートからリプライをたどる
	 	while($tweet[$c]->in_reply_to_status_id_str != null) {
			$api = 'statuses/show/'.$tweet[$c]->in_reply_to_status_id_str;
			$c++;
			$tweet[$c] = $connection->get($api);
		}
$tweet_user = array();
for($i=0; $i<$c+1;$i++) {
 $tweetdata = $tweet[$i];
 if(!array_key_exists($tweetdata->user->id_str,$tweet_user)) {
  $tweet_user[] = $tweetdata->user->id_str;
 }
}

		
		
		//会話一覧をテスト表示
$top = 20;
	for($i=0; $i<$c+1;$i++) {
		for($j=0;$j<count($tweet_user);$j++){
			if($tweet[$i]->user->id_str == $tweet_user[$j]){
				$left = -300 + 300*($j-1);
			}
		}
		echo '
<div style="position:relative;left:'.$left.'px; border-style: solid ; border-width: 1px; padding: 10px 5px 10px 20px; border-color: white; color: black; background-color: white; width: 400px; border-radius: 30px; box-shadow: 5px 5px 5px #AAA;">';
		echo '<article id='.$i.'><img src="'.$tweet[$i]->user->profile_image_url.'"/>';
		echo '<span>'.$tweet[$i]->user->name.'</span>';
		echo '@'.$tweet[$i]->user->screen_name.'<br/>';
		echo $tweet[$i]->text.'<br/>';
		echo $tweet[$i]->created_at;
		echo'</div></br>';
		$top = $top + 300;
	}
  	?>
 
	</center>
<!--</div>-->
 </body>
 </html>