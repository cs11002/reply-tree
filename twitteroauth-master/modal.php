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
    <!--<script src="./js/jquery-2.1.1.min.js" type="text/javascript"></script>-->
    <!-- <script type="text/javascript" src="./js/jquery.leanModal.min.js"></script> -->
    <link rel="shortcut icon" href="images/favicon.ico">
  </head>
 <body>
    <div id="container">
			<?php session_start(); ?>
			<!--<div id="div787">-->
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="./index.php">Reply-tree</a>
		    </div>
		    <div class="collapse navbar-collapse" id="navbar-collapse-01">
		      <ul class="nav navbar-nav">           
		        <li><a href="./index.php">Home</a></li>
		        <li><a href="./mention.php">Mention</a></li>          
		        <li><a href="./user.php">User</a></li>
		        <li><span class="fui-new"></span></li>
		        <li><a id="logout" href="./clearsessions.php">Logout</a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </nav>
		  <div style="margin:100px;"></div>
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
		
				$tweet_user = array(); //ツイートした人を入れる配列
				$tweet_user[0] = -1;
				
				$u_c = 0;
				for($i=0; $i<$c+1;$i++) {
					$tweetdata = $tweet[$i];
					if($i == 0){
						$tweet_user[$i] = $tweetdata->user->id_str;
					}else{
						$u_c = count($tweet_user);
						for($j=0;$j<$u_c;$j++){
							if(intval($tweetdata->user->id_str) == $tweet_user[$j]) {
								break;
							}
							if($j == ($u_c-1)){
								$tweet_user[$u_c] = $tweetdata->user->id_str;
							}
						}
					}
				}

				//会話一覧をテスト表示
				for($i=0; $i<$c+1;$i++) {
					for($j=0;$j<count($tweet_user);$j++){
						if($tweet[$i]->user->id_str == $tweet_user[$j]){
							$left =  150*($j);
							break;
							echo $j.'-'.$left.'<br>';
						}
					}
					$j=0;
					echo '<div style="font-size: 9px; position:relative;left:'.$left.'px; border-style: solid ; border-width: 1px; padding: 10px 5px 10px 20px; border-color: white; color: black; background-color: white; width: 200px; border-radius: 15px; box-shadow: 3px 3px 3px #AAA;">';
					echo '<img src="'.$tweet[$i]->user->profile_image_url.'" width="40px" align="left"/>';
					echo '<span style="font-size: 12px;">'.$tweet[$i]->user->name.'</span>';
					echo '@'.$tweet[$i]->user->screen_name.'<br clear="left"/>';
					echo $tweet[$i]->text.'<br/>';
					echo $tweet[$i]->created_at;
					echo'</div></br>';
				}
			
			?>
		<!--</div>-->
		</div><!-- #container -->
 	</body>
 </html>