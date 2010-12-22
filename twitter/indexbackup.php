<?php
include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
echo "<HTML>";
echo "<head><LINK href=\"style.css\" rel=\"stylesheet\" type=\"text/css\"><title> likethis.in / Twitter </title>";

echo "</head>";
echo "<body><center>";
//content goes here

	echo "<br/><br/><br/>";
	echo "<div class=\"homebox\">";
	echo "likethis.in/twitter <p class=\"homefont\">is simple implementation of facebook like button to twitter. How it is works ?, simply click facebook like button under any tweet, and it will show up your name according on your facebook account, also on your facebook profile page under recent activity. To start using it, click Sign in with Twitter button below. </p>

<center>


<img src=\"img/shot2.png\" alt=\"step 2 \" />

<img src=\"img/shot3.png\" alt=\"step 3\" />	
</center>
	";
	echo "</div>"; 
echo "<div id=\"container\">";

echo "<div id=\"row\"><div id='left'>";

echo "<div class=\"statusbox\">";

echo '<a href="' . $twitterObj->getAuthenticateUrl() . '"><img src=img/signin.png border=\"0\" alt=\"retweet this\" /></a>';

echo "</div></div></div>";

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

