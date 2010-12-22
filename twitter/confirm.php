<?php
header("refresh:4; home_timeline.php");

include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);

$twitterObj->setToken($_GET['oauth_token']);
$token = $twitterObj->getAccessToken();
$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);

// save to cookies
setcookie('oauth_token', $token->oauth_token);
setcookie('oauth_token_secret', $token->oauth_token_secret);

$twitterInfo= $twitterObj->get_accountVerify_credentials();


echo "<HTML>";
echo "<head><LINK href=\"style.css\" rel=\"stylesheet\" type=\"text/css\"><title> likethis.in / Twitter / Callback Page</title>";
echo "</head>";
echo "<body><center>";
	echo "<br/><br/><br/>";
echo "<div class=\"confirmbox\">";
echo "Hello {$twitterInfo->screen_name} <br/>  <br/> <img src=\"{$twitterInfo->profile_image_url}\">";
echo "</div>";
?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-2484933-8");
pageTracker._trackPageview();
} catch(err) {}</script>
<?php
echo "</center></BODY></HTML>";
?>
