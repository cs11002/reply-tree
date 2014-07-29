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
    <div id="wrapper">
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
		  <div style="margin:70px;"></div>
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
				$timeline = $connection->get('statuses/home_timeline',array('count'=>'20')); //枝分かれをつくるためTLを取得(とりあえず20)

				$get_timeline = count($timeline); //取得したTLの数を数える

		 		//最初のツイートからリプライをたどる部分
				
				$find = 0;//TLの中に関係あるtweetを見つけたら数えるやつ
			 	while($tweet[$c]->in_reply_to_status_id_str != null) {

					search_rp($c-$find);//取得したTLの中で、今回のリプライに関係しているつぶやきを探す（枝分かれをつくるため）
					
					$api = 'statuses/show/'.$tweet[$c-$find]->in_reply_to_status_id_str;//rp元をたどる
					$c++;//添字を+1
					$tweet[$c] = $connection->get($api);//rp元を配列に入れる

					if(array_key_exists('errors',$tweet[$c])) { //もしツイ消し等でたどれなくなったら配列を-1して終了
						$c--;
						break;
					}
				}
				
			function search_rp($c_f) {//取得したTLの中で、今回のリプライに関係しているつぶやきを探すやつ（枝分かれをつくるため）
				global $timeline,$tweet,$c,$find,$get_timeline;//globalな男でありたい（照
				for($i=0;$i<$get_timeline;$i++){//取得したTLの中で、今回のリプライに関係しているつぶやきを探す
						if(($timeline[$i]->in_reply_to_status_id_str != null) && ($timeline[$i]->in_reply_to_status_id_str == $tweet[$c_f]->id_str) ){//TLのつぶやき一つ一つのrp元のIDを検索していく
							if(check_tw($timeline[$i]->id_str)){//見つかったtweetが既に配列に追加されているかどうか判別
								$c++;
								$tweet[$c] = $timeline[$i];//未登録なら追加
								$find++;
								search_rp($c);//追加したtweetの枝が更に伸びるか探索（再帰）
							}
							
						}
				}
				return 0 ;
			}
			
			
			function check_tw($text){//取得したツイートが既に配列に入っているかチェックするやつ（良いライブラリあったら教えて♡）
				global $tweet;
				$arraycount = count($tweet);
				for($i=0;$i<$arraycount;$i++){
					if($tweet[$i]->id_str == $text){
						return false;
					}
				}
				return true;
			}
			rsort($tweet);//配列を降順にソート
				
				$tweet_user = array(); //ツイートした人を入れる配列
				$tweet_user[0] = -1;//とりあえず-1入れとくやつ
				$u_c = 0; //ユーサごとに数字を振る用
				
				for($i=0; $i<$c+1;$i++) {
					$tweetdata = $tweet[$i]; //tweetdataにツイートを入れる
					if($i == 0){
						$tweet_user[$i] = $tweetdata->user->id_str;//最初のユーザIDをTweet_userに格納
					}else{
						$u_c = count($tweet_user);//配列の長さを取得
						for($j=0;$j<$u_c;$j++){
							if(intval($tweetdata->user->id_str) == $tweet_user[$j]) {//既に登録されたIDならbreak
								break;
							}
							if($j == ($u_c-1)){//まだ登録されていないIDはtweet_userの[$u_c-1]番目に格納
								$tweet_user[$u_c] = $tweetdata->user->id_str;
							}
						}
					}
				}

				//会話一覧を表示
				for($i=0; $i<$c+1;$i++) {
					for($j=0;$j<count($tweet_user);$j++){//jの値によってユーザが何番目か分かる
						if($tweet[$i]->user->id_str == $tweet_user[$j]){
							$left =  150*($j);
							break;
						}
					}
					$j=0;
					echo '<div class="leaf" style="left:'.$left.'px;">';
					echo '<img src="'.$tweet[$i]->user->profile_image_url.'" width="40px" align="left"/>';
					echo '<span style="font-size: 14px;">'.$tweet[$i]->user->name.'</span>';
					echo '@'.$tweet[$i]->user->screen_name.'<br clear="left"/>';
					echo $tweet[$i]->text.'<br/>';
					echo $tweet[$i]->created_at;
					echo '</div><br/>';
				}
			?>
		</div><!-- #container -->
 	</body>
 </html>