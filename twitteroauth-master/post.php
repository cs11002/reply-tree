<?php

	mb_internal_encoding("UTF-8");
	ini_set( 'display_errors', "1" );

	session_start();

	require_once('twitteroauth/twitteroauth.php');
	require_once('config.php');

	/* Get user access tokens out of the session. */
	$access_token = $_SESSION['access_token'];

	// $message = "OAuth Tweet Test is scceeded!";
	$message = $_POST["tweet"];

	/* Create a TwitterOauth object with consumer/user tokens. */
	$oauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

	$tweet = $oauth->oAuthRequest("https://api.twitter.com/1.1/statuses/update.json","POST", array("status" => $message));

	// check tweet by json
	// $result = json_decode($tweet);
	// var_dump($result);

	$uri = $_SERVER['HTTP_REFERER'];
	header("Location: ".$uri);