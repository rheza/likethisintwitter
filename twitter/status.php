<?php
/**/
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



extract($_REQUEST);
if ($id==""){ 

echo "Wrong status ID";	
	
	}

	else{

	
	

	$twitterObj = new EpiTwitter();
	$url= "/statuses/show/$id.json";
	$autolinker = new Twitter_Autolink();
	$status = $twitterObj->get_basic($url);
	$tweetscomplete = $autolinker->autolink($tweets);
	
	$profileimg= $status->user->profile_image_url;
	$screenname= $status->user->screen_name;
	$tweets = $status->text;
	 
	$profileurl= "http://twitter.com/$screenname";
	$previewtweets = substr($tweets ,0, 25);
	$title = "likethis.in / Twitter / $screenname: $previewtweets... ";
	
	echo "<HTML>";
	echo "<head><LINK href=\"style.css\" rel=\"stylesheet\" type=\"text/css\"><title> $title </title>";
	echo "<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.4.2.js\"></script>";


	
	echo "</head>";
	echo "<body><center>";
	//content goes here
	
		echo "<br/><br/><br/>";
	 
	echo "<div id=\"container\"><div id=\"row\"><div id='left'>";
	echo "<div class=\"statusbox\">";
	
	$profileimg= $status->user->profile_image_url;
	$screenname= $status->user->screen_name;
	$tweets = $status->text;
	
	$tweetscomplete = $autolinker->autolink($tweets);
	$profileurl= "http://twitter.com/$screenname";

	echo "<div id=\"container\"><div id=\"row\">";
	echo "";
echo "<div class=\"usertweetbox\">";

	print "<div class=\"font\">$tweetscomplete</div> ";
	echo "</div>";
	echo "";
	echo "<div id=\"container\"><div id=\"row\"><div id='left'>";
	echo "<br/><div class=\"picturebox\"><a href=\"$profileurl\"><img src=\"$profileimg\" alt=\"$screenname\" border=\"0\" /></a></div>";
	echo "</div><div id='middle'>";
	echo "<br/><a href=\"$profileurl\"><div class=\"usernametweets\">$screenname</div></a></div></div></div>";
	//fb like button
	echo "<div class=\"statuslikebox\">";
	$tweetsurl="http://likethis.in/twitter/status.php?id=$id";
	echo "<iframe src=\"http://www.facebook.com/plugins/like.php?href=$tweetsurl&amp;";
	echo "layout=standard&amp;show_faces=false&amp;width=249&amp;action=like&amp;colorscheme=light\"  scrolling=\"no\"";
	echo "frameborder=\"0\" allowTransparency=\"true\" style=\"border:none; overflow:hidden; width:400px; height:25px\"></iframe>";
	
	
	echo "</div></div>";
	echo "</div></div></div></div>";
	echo "</center></BODY></HTML>";
}


 ?>