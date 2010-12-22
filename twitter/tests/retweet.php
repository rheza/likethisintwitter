<?php
/*
include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret, $_COOKIE['oauth_token'], $_COOKIE['oauth_token_secret']);


$creds = $twitterObj->get('/account/verify_credentials.json');
echo $creds->responseText;
*/
if ( isset($_POST['submit'])){
$url="http://api.twitter.com/1/statuses/retweet";

echo $id;

$link="$url/$id.json";

echo $link;




//'http://api.twitter.com/1/statuses/retweet/12950214856.xml




}



else{ ?>
<html>
<head>
<title>Search Book</title>
</head>
<body>
<center>
<h3>Search Book</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

<input type="varchar" name="id" size=10 /><br><br>

<input type="Submit" name="submit" value="retweet">

</form>

</center>

</body>
</html>
<?php }  

?>