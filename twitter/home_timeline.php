<?php
header( 'Content-Type: text/html; charset=utf-8');

include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';
require_once('twitter/Autolink.php');


//time function
function nicetime($date)
{
    if(empty($date)) {
        return "No date provided";
    }

    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");

    $now             = time();
    $unix_date         = strtotime($date);

       // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "ago";

    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j] {$tense}";
}

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret, $_COOKIE['oauth_token'], $_COOKIE['oauth_token_secret']);
//auto linker
$autolinker = new Twitter_Autolink();
$userInfo= $twitterObj->get_accountVerify_credentials();
$curruser=$userInfo->screen_name;
$title="likethis.in / Twitter / Home Timeline / $curruser";
extract($_REQUEST);
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">";
echo "<HTML>";
echo "<head><LINK href=\"style.css\" rel=\"stylesheet\" type=\"text/css\"><title>$title</title>";
echo "<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.4.2.js\"></script>";
?>
<script type="text/javascript" src="http://include.reinvigorate.net/re_.js"></script>
<script type="text/javascript">
try {
reinvigorate.track("s0v12-o57137z386");
} catch(err) {}
</script>
<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery(".content").hide();
  //toggle the componenet with class msg_body
  jQuery(".heading").click(function()
  {
    jQuery(this).next(".content").slideToggle(400);
  });
});
</script>
<?php
echo "</head>";
echo "<body><center>";

echo "<div id=\"container\">  <div id=\"row\"><div id='left'>";

echo $background;
//page based
if ($page==""){
	 $creds = $twitterObj->get('/statuses/home_timeline.json', array('page' => 1));
	 $nextpage = 2;
}
else {
	$creds = $twitterObj->get('/statuses/home_timeline.json', array('page' => $page));
	
	$nextpage = ($page+1);
	$prevpage = ($page-1);
}



echo "<br/><br/><br/>";





echo "<div class=\"bigbox\">";


//prev PAGE NAVIGATION//

if ($prevpage==0 or $prevpage<=-1){

}

else {
	echo "<div class=\"pagenavigation\">";

echo "<a class=\"navigation\" href=\"http://likethis.in/twitter/home_timeline.php?page=$prevpage\">Previous Page</a>";	
echo "</div>";
}







foreach($creds as $status ) {
	$profileimg= $status->user->profile_image_url;
	$screenname= $status->user->screen_name;
	
	$profileurl= "http://twitter.com/$screenname";
	echo "<div id=\"container\"><div id=\"row\"><div id='left'><br/><a href=\"$profileurl\"><img src=\"$profileimg\" alt=\"$screenname\" border=\"0\" /></a></div>";
	echo "<div id='middle'>";
echo "<ul>";

	$statusid=$status->id;
	$time=$status->created_at;
	$ago= nicetime($time);
	$via=$status->source;
	$privatestatus= $status->user->protected;
	$tweets=$status->text;
	$url = "http://twitter.com/$screenname/status/$statusid";
	//echo "$privatestatus";
	echo "<li> ";
	echo "<div class=\"font\">";
	$tweetsurl="http://likethis.in/twitter/status.php?id=$statusid";
	$tweetscomplete = $autolinker->autolink($tweets);
	
	echo "<a href=\"$profileurl\"><b>$screenname</b></a>";
	echo " $tweetscomplete   ";
	
	
	echo "<div class=\"infobox\"><div class=\"fontsmall\"><a href=\"$url\">$ago</a> via $via</div></div>";
	
	echo "</div></li>";
	

		
	
	//fb like button
	echo "<div class=\"buttonbox\">";
	
	if($privatestatus=="1")
			{
	
		echo "<div class=\"fontprotected\">! Tweets Protected</div>";
			}
	else 
			{
				
				echo "<iframe src=\"http://www.facebook.com/plugins/like.php?href=$tweetsurl&amp;";
				echo "layout=standard&amp;show-faces=false&amp;width=249&amp;action=like&amp;colorscheme=light\"  scrolling=\"no\"";
				echo "frameborder=\"0\" allowTransparency=\"true\" style=\"border:none; overflow:hidden; width:400px; height:25px\"></iframe>";





//verify user name and retweet button

//$userInfo= $twitterObj->get_accountVerify_credentials();
//echo $userInfo->screen_name;


			if($curruser==$screenname){
	
						}
			else{
	
					echo "<a href=\"http://likethis.in/twitter/retweet.php?id=$statusid&submit=retweet\""; echo "target=\"windowName\" onclick=\"window.open(this.href,this.target,'width=300,height=300');";
					echo "\"return false;\"><img src=\"img/retweet-active.png\" border=\"0\" alt=\"retweet this\" /></a>";
				}
				
				echo "</div>";
			}
			
			
//echo " <br/>";
//echo "</div>";
	echo "</ul>";
	echo "</div></div></div>";
						}


//next PAGE NAVIGATION//
echo "<div class=\"pagenavigation\">";

echo "<a class=\"navigation\" href=\"http://likethis.in/twitter/home_timeline.php?page=$nextpage\">Next Page</a>";	
echo "</div>";
//next page navigation end

echo "</div>";
//bigbox end


echo "</div>";
//left end
echo "<div id='middle'>";
//middle box start
echo "<br/><br/><br/>";
//MENU CONTENT
echo "<div class=\"menubox\">";
//menubox start

//echo "<br/>";

//atas load more

echo "<div class=\"layer1\">";
//layer1 start
echo "<p class=\"heading\">Menu</p>";
echo "<div class=\"content\">";

echo "<a href=\"http://likethis.in/\">likethis.in</a>";
echo "<br/><br/>";
echo "<a href=\"http://likethis.in/twitter/home_timeline.php\">home timeline</a>";


echo "</div>";
//layer1 end



//menubox end
echo "</div>";
echo "<p class=\"heading\">Follow Dev likethis.in</p>";
echo "<center><a href=\"http://www.twitter.com/rheza\"><img src=\"http://twitter-badges.s3.amazonaws.com/twitter-b.png\" alt=\"Follow rheza on Twitter\"/></a></center>";
//middle box end

echo "</div>";
//row end




echo "</div>";
//container end
echo "<br/><br/><br/>";

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
