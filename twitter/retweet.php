<?php

include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret, $_COOKIE['oauth_token'], $_COOKIE['oauth_token_secret']);

extract($_REQUEST);


$url="1/statuses/retweet";


$link="$url/$id.json";


$creds = $twitterObj->post($link);

$result = "$creds->responseText";



if($result=="{\"errors\":\"Share sharing is not permissable for this status (Share validations failed)\"}")
{
	echo "error";
}
else 
{
	
	echo "Retweet Success";
	
}




/*



else{ ?>
<html>
<head>
<title>Search Book</title>
</head>
<body>
<center>
<h3>Search Book</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">

<input type="varchar" name="id" size=10 /><br><br>

<input type="Submit" name="submit" value="retweet">

</form>

</center>

</body>
</html>
<?php }  
*/
?>