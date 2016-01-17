<?php
//session_start();
require_once("twitteroauth/twitteroauth.php"); //Path to twitteroauth library
 
$twitteruser = ""; //isi dengan username twitter yang akan diambil timelinenya
$notweets = 10; // cumlah timeline yang akan ditampilkan

/* isi sesuai informasi dari https://dev.twitter.com/apps/ dgn membuat aplikasi baru */
$consumerkey = ""; 
$consumersecret = "";
$accesstoken = "";
$accesstokensecret = "";
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
 
/* disini kita akan mengekstrak data dari variabel $tweets
   silahkan dimodifikasi sesuai keinginan untuk bagian ini.
 */
foreach($tweets as $tweet)
{
	echo "{$tweet->text}\n";
} 
?>