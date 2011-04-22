<?php

if (!function_exists('format')) {
    function format($text)
    {
        global $j21login, $mysid, $sessname, $j21sid, $masnun, $bst, $mytime, $today, $now, $site;


        $smiley_array = array(

            ":d" => "xD.gif",
            ":)" => "smile.gif",
            "--arf--" => "arf.gif",
            "--back--" => "back.gif",
            ":|" => "bof.gif",
            ":h" => "boss.gif",
            "--bomb--" => "boulet.gif",
            ":(" => "cry.gif",
            "--emo--" => "emo.gif",
            "--evil--" => "evil.gif",
            "--funky--" => "funky.gif",
            "--gna--" => "gna.gif",
            "--love--" => "heart.gif",
            "--jap--" => "jap.gif",
            "--kiss--" => "kiss.gif",
            "--lol--" => "lol.gif",
            "--lol2--" => "lol2.gif",
            "--shy--" => "manga.gif",
            "--next--" => "next.gif",
            "--no--" => "no.gif",
            ";)" => "o_o.gif",
            "--rolleyes--" => "rolleyes.gif",
            "--zzz--" => "sleep.gif",
            "--stop--" => "stop.gif",
            "--protest--" => "suspens.gif",
            "--tux--" => "tux.gif",
            "--wow--" => "wow.gif",
            "--slick--" => "5slick.gif",
            ":@" => "angry4.gif",
            "--jump--" => "blob10.gif",
            ":p" => "blum3.gif",
            "--boast--" => "boast.gif",
            "--wink--" => "bwink3.gif",
            "--c_ya--" => "c_ya.gif",
            "--declare--" => "declare.gif",
            "--no-mention--" => "dont_mention.gif",
            "--explain--" => "explain.gif",
            "--flower--" => "flower01.gif",
            "--getout--" => "getout.gif",
            "--giverose--" => "giverose.gif",
            "--hahaha--" => "hahaha.gif",
            "--hehe--" => "hehe.gif",
            "--smash--" => "kokz.gif",
            "--music--" => "music00.gif",
            "--play--" => "play.gif",
            "--idiot--" => "prankster2.gif",
            "--queen--" => "queen.gif",
            "--hahaha--" => "hahaha.gif",
            "--shocking--" => "shocking.gif",
            "--hahaha--" => "hahaha.gif",
            "--thankyou--" => "thankyou2.gif",
            "--think--" => "think00.gif",
            "--ura--" => "ura.gif",
            "--wild--" => "wild.gif",
            "--scared--" => "scared.gif"

        );


        foreach ($smiley_array as $sml => $image) {
            $text = str_ireplace($sml, "<img src=\"smileys/{$image}\" alt=\"{$sml}\" />", $text);
        }


        $text = preg_replace("/\[b\](.*?)\[\/b\]/i", "<b>\\1</b>", $text);
        $text = preg_replace("/\[i\](.*?)\[\/i\]/i", "<i>\\1</i>", $text);
        $text = preg_replace("/\[u\](.*?)\[\/u\]/i", "<u>\\1</u>", $text);
        $text = preg_replace("/\[big\](.*?)\[\/big\]/i", "<big>\\1</big>", $text);
        $text = preg_replace("/\[small\](.*?)\[\/small\]/i", "<small>\\1</small>", $text);
        $text = preg_replace("/\[color\=(.*?)\](.*?)\[\/color\]/is", "<font color=\"$1\">$2</font>", $text);
        $text = preg_replace("/\[move\](.*?)\[\/move\]/i", "$1", $text);
        $text = preg_replace("/\[url\=(.*?)\](.*?)\[\/url\]/is", "<a href=\"link.php?url=$1\">$2</a>", $text);
        $text = preg_replace("/\[att\=(.*?)\](.*?)\[\/att\]/is", "<b>Attached:</b>[$2]<br/><a href=\"$1\">Download</a><br/>", $text);
        $text = preg_replace("/\[img\=(.*?)\]/is", "<img src=\"img.php?url=$1\" alt=\"$1\"/>", $text);
        $text = preg_replace("/\[invite\=(.*?)\](.*?)\[\/invite\]/is", "Dear " . $j21login . ", Please visit my topic ::: <a href=\"forum.php?view=topic&amp;topicid=$1&amp;j21sid=$j21sid\">$2</a>", $text);
        $text = preg_replace("/\[topic\=(.*?)\](.*?)\[\/topic\]/is", "<a href=\"forum.php?view=topic&amp;topicid=$1&amp;j21sid=$j21sid\">$2</a>", $text);
        $text = preg_replace("/\[gift\=(.*?)\](.*?)\[\/gift\]/is", "<a href=\"gift_shop.php?view=my_gift&amp;gid=$1&amp;j21sid=$j21sid\">$2</a>", $text);
        $text = preg_replace("/\[forum\=(.*?)\](.*?)\[\/forum\]/is", "<a href=\"forum.php?view=topiclist&amp;forumid=$1&amp;j21sid=$j21sid\">$2</a>", $text);
        $text = preg_replace("/\[user\=(.*?)\](.*?)\[\/user\]/is", "<a href=\"view_profile.php?user=$1&amp;j21sid=$j21sid\">$2</a>", $text);
        $text = preg_replace("/\[help\=(.*?)\](.*?)\[\/help\]/is", "<a href=\"help.php?hw=$1&amp;j21sid=$j21sid\">$2</a>", $text);
        $text = str_replace("[chat]", "<a href=\"chat.php?view=chat&amp;j21sid=$j21sid\">[Chat]</a>", $text);
        $text = preg_replace("/sml\((.*?)\)/is", "<img src=\"http://jotil21.net/smileys/$1\" alt=\"$1\"/>", $text);
        $text = str_replace("[br/]", "<br/>", $text);
        $text = str_replace("[stats]", "<a href=\"stats.php?j21sid=$j21sid\">Site Stats</a>", $text);
        $text = str_replace("[profile]", "<a href=\"profile.php?j21sid=$j21sid\">My Profile</a>", $text);

        return $text;
    }
}
?>
