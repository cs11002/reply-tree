<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

mb_internal_encoding("UTF-8");
ini_set( 'display_errors', "1" );

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */

$json = $connection->get('statuses/mentions_timeline',array('count'=>'200'));

$tweet = '';

for ( $i=0; $i<count($json); $i++ ){

	if($i > 10) {
		$tweet .= '<article id='.$i.' style="display:none">';
	}else{
		$tweet .= '<article id='.$i.'>';
	}

	$tweet .= '<img src="'.$json[$i]->user->profile_image_url.'"/>';
	$tweet .= '<span class="name">'.$json[$i]->user->name.'</span>';
	$tweet .= '@'.$json[$i]->user->screen_name.'<br />';
	$tweet .= '<div class="tweet">'.$json[$i]->text.'</div>';
	$tweet .= '<span class="time">'.$json[$i]->created_at.'</span><br />';
	$tweet .= '<span class="glyphicon glyphicon-share-alt"></span>返信<span class="glyphicon glyphicon-retweet"></span>リツイート<span class="glyphicon glyphicon-star"></span>お気に入りに登録';

	if( $json[$i]->in_reply_to_status_id != null ){
		$id = $json[$i]->id_str;
		$tweet .= '<form action="modal.php" method="post" name="tree" >';
		$tweet .= '<input type="hidden" name="tweetID" value="'.$id.'" />';
		// $tweet .= '<a href="modal.php" class="modal">';
		$tweet .= '<input type="submit" class="btn btn-primary" value="ReplyTree表示" />';
		// $tweet .= '</a>';
		$tweet .= '</form>';
	}

	$tweet .= "<hr/></article>\n";

}

// $tweet .= "<form id=\"read-more\">\n";
// $tweet .= "<center>\n";
// $tweet .= "<input class=\"btn btn-default\" id=\"read-more\" type=\"button\" value=\"readmore\" onclick=\"readmore()\">\n";
// $tweet .= "</center>\n";
// $tweet .= "</form>\n";

$content = $tweet;

/* Include HTML to display on the page */
include('html.inc');
