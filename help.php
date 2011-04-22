<?php
require_once 'core.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $site['name']; ?></title>
</head>
<body>
<p align="left">
<?php if ($_GET['hw'] == 'none') { ?>
    <b>JOTIL21 G2</b>
    <br/>
    [+] <a href="help.php?hw=abt<?php echo $mysid; ?>">ABOUT</a><br/>
    [+] <a href="help.php?hw=smileys">Smileys List </a><br/>
    [+] <a href="help.php?hw=ss<?php echo $mysid; ?>">Site Staff</a><br/>
    [+] <a href="help.php?hw=ft<?php echo $mysid; ?>">Smart Text</a><br/>
    [+] <a href="help.php?hw=il<?php echo $mysid; ?>">Smart Links</a><br/>
    [+] <a href="help.php?hw=ii<?php echo $mysid; ?>">Using Images</a><br/>
    [+] <a href="help.php?hw=usz<?php echo $mysid; ?>">Using Search Zone</a><br/>
    [+] <a href="help.php?hw=si<?php echo $mysid; ?>">Software Info</a><br/>
    <?php ;
}?>

<?php if ($_GET['hw'] == 'ss') { ?>
    <b>SITE STAFF</b><br/>
    ----------<br/>
    <?php $results = mysql_query("select * from masnun_user where staff > 0");
    while ($d = mysql_fetch_assoc($results)) {
        echo "<a href=\"view_profile.php?user=" . $d['login'] . $mysid . "\">" . $d['login'] . "</a><br/>";
    }
    ?>
    <br/><a href="help.php?hw=none<?php echo $mysid; ?>">Help &amp; Support</a><br/>
    <br/><br/>
    <?php ;
}?>
<?php if ($_GET['hw'] == 'smileys') { ?>
    <b>Smileys List</b><br/>
<hr/>
    <?php
            $smiley = array(

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

    foreach ($smiley as $sml => $image) {
        echo "[<b>$sml</b>  <img src=\"smileys/$image\" alt=\"$sml\" />] &nbsp; ";
    }

    ?>

<br/><br/><a href="help.php?hw=none<?php echo $mysid; ?>">Help &amp; Support</a><br/>
    <?php ;
}?>

<?php if ($_GET['hw'] == 'ft') { ?>
<b>Smart TEXT</b><br/>
----------<br/>

[b] text [/b] ==> <b> text </b><br/>
[i] text [/i] ==> <i> text </i><br/>
[u] text [/u] ==> <u> text </u><br/>
[small] text [/small] ==>
<small> text</small><br/>
[big] text [/big] ==> <big> text </big><br/>
[br/] ==> Line Break <br/>
[color=green]Green Text[/color] ==> <font color="green">Green Text</font><br/>
<br/>
Text formatting applies to forum posts, chat room and in PM(s).<br/>
You can not apply text formatting to topic titles but in topic messages and replies, you can use text formatting.
<br/><br/><a href="help.php?hw=none<?php echo $mysid; ?>">Help &amp; Support</a><br/>
    <?php ;
}?>
<?php if ($_GET['hw'] == 'il') { ?>
<b>Smart LINKS</b><br/>
----------<br/>
<br/>[url=http://masnun.com] masnun [/url] creates
a link to http://masnun.com with the text masnun.
<br/> Example ::: <a href="http://masnun.com">masnun</a><br/>
[user=masnun]Masnun's Profile[/user]<br/>
[att=http://masnun.com/mig33.jar] Mig33 [/att] creates an attachment<br/>
[topic=18]Topic Descr. [/topic] ==> Link to Topic ID 18<br/>
Similarly ::<br/>
[forum=1]Forum Descr[/forum]<br/>
[chat]<br/>
[profile] --> My Profile<br/>
[stats] --> Site Stats<br/>
[help=sym]Symbols[/help]<br/>
[help=ss]Site Staffs[/help]<br/>
[help=ft]Smart Texts[/help]<br/>
[help=il]Smart Links[/help]<br/>
[help=ii]Using Images[/help]<br/>
[help=usz]Using Search Zone[/help]<br/>
[help=abt]About[/help]<br/>
[help=si]Software Info[/help]<br/>
[help=smileys]Using Smileys[/help]<br/>
<br/>
Plz remember we have built in spam protection, so even if you use the url tag, you'll be caught if you spam.
<br/><br/><b>We have "ZeroTolerance" policy against spam</b><br/><br/><br/>
<a href="help.php?hw=none<?php echo $mysid; ?>">Help &amp; Support</a>
    <?php ;
}?>
<?php if ($_GET['hw'] == 'ii') { ?>
<b>INSERTING IMAGES</b><br/>
----------<br/>
To insert smileys, type --> sml(smiley_code)<br/>
[img=http://masnun.wen.ru/masnun.wbmp] inserts
the image http://masnun.wen.ru/masnun.wbmp.<br/>
<br/>
For bandwith and storage problem we don't let you upload images to our server, yet we provide stand-alone image hosting.
Contact us for more details.<br/>

Please don't post PORN, ADULT or any sort of INAPPROPRIATE images in the forums or chat rooms.<br/>
<br/><a href="help.php?hw=none<?php echo $mysid; ?>">Help &amp; Support</a><br/>
<br/>
    <?php ;
}?>
<?php if ($_GET['hw'] == 'usz') { ?>
<b>USING SEARCH ZONE</b><br/>
----------<br/>
Enter a keyword and click the appropriate link to
search for your desired type.<br/>
We're glad to let you know that you can search in any property of an item.<br/>
Here is a short list ::::<br/><br/>
<b>PMs</b><br/>
# To <br/>
# From<br/>
# Date <br/>
# Message Body <br/>
<br/>
<b>Topics</b><br/>
# Topic Title<br/>
# Topic Message (Not replies, just the message of the topic)<br/>
# Creator of the Topic (You may type an username and it'll return all the topics by/about that user. <br/>
# Topic Creation Date<br/>
<br/>
<b>Posts (Replies to Topics)</b><br/>
# The Post<br/>
# The user who made the post/reply<br/>
# Date of the post<br/>
<br/>
<b>USERS</b><br/>
All the info on you see on an users "Detailed Info" are searchable.
<br/>
<a href="help.php?hw=none<?php echo $mysid; ?>">Help &amp; Support</a><br/>
    <?php ;
}?>

<?php if ($_GET['hw'] == 'si') { ?>

<b>[o_O]</b> If you want this software for free, please contact :::  masnun@gmail.com.<br/><br/>
<a href="help.php?hw=none<?php echo $mysid; ?>">Help &amp; Support</a><br/>
    <?php ;
}?>
<?php if ($_GET['hw'] == 'abt') { ?>
<b>JOTIL21 G2 v5.2:<br/> RESTORATION</b><br/><br/>
I have tried my level best to reshape the user interface and provide a very unique experience to our members.
<b>Abu Ashraf Masnun</b><br/>
masnun@gmail.com<br/>
<br/>
<a href="help.php?hw=none<?php echo $mysid; ?>">Help &amp; Support</a><br/>
    <?php ;
}?>
<br/>
<a href="main.php?m=1<?php echo $mysid; ?>">Home</a>
</p>
</body>
</html>
