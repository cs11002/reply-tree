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

$json = $connection->get('statuses/home_timeline',array('count'=>'5'));

$tweet = '';

for ( $i=0; $i<5; $i++ ){

	$tweet .= '<article id='.$i.'><img src="'.$json[$i]->user->profile_image_url.'"/>';
	$tweet .= '<span>'.$json[$i]->user->name.'</span>';
	$tweet .= '@'.$json[$i]->user->screen_name.'<br/>';
	$tweet .= $json[$i]->text.'<br/>';
	$tweet .= $json[$i]->created_at.'<hr/></article>';

}


$content = $tweet;

// $content = $connection->get('statuses/user_timeline',array('count'=>'5'));


/* Some example calls */
//$connection->get('users/show', array('screen_name' => 'abraham'));
//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
//$connection->post('statuses/destroy', array('id' => 5437877770));
//$connection->post('friendships/create', array('id' => 9436992));
//$connection->post('friendships/destroy', array('id' => 9436992));

/* Include HTML to display on the page */
include('html.inc');
