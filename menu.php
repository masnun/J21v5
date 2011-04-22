<?php 
require_once 'core.php';
require_once 'format.php';
echo "<!DOCTYPE html><html><head>";
echo "<title>{$site['name']}</title>
</head>
<body>
<p align=\"left\">";
if (!isset($j21login)) {
    echo "You are not signed in. Please sign in. <br/><a href=\"index.php\">Home</a><br/>  ";
}
else {
    setOnline("Menu");
    echo "<a href=\"main.php?m=1" . $mysid . "\">[H]</a>";
    echo "<a href=\"inbox.php?view=none" . $mysid . "\">[M]</a>";
    echo "<a href=\"online.php?view=online" . $mysid . "\">[A]</a>";
    echo "<a href=\"forum.php?view=forum" . $mysid . "\">[F]</a>";
    echo "<br/>";
    require_once 'newpm.php';

    if ($staff > 0) {
        echo "&#187; <a href=\"spypm.php?m=1{$mysid}\">SPY PMs</a><br/>";
    }
    echo "&#187; <a href=\"main.php?view=sb{$mysid}\">Status Updates</a><br/>";
    echo "&#187; <a href=\"inbox.php?view=none{$mysid}\">MSG</a>";
    echo " <a href=\"inbox.php?view=newpm{$mysid}\">[W]</a><br/>";
    echo "&#187; <a href=\"forum.php?view=forum{$mysid}\">Forums</a><br/>";
    $data = mysql_fetch_assoc(mysql_query("select count(*) c from masnun_online"));
    echo "&#187; <a href=\"online.php?view=online{$mysid}\">Active ({$data['c']})</a><br/>";
    echo "&#187; <a href=\"profile.php?view=profile{$mysid}\">Account</a><br/>";
    echo "&#187; <a href=\"search.php?what=search{$mysid}\">Search</a><br/>";
    echo "&#187; <a href=\"stats.php?task=viewstats{$mysid}\">Site Stats</a><br/>";
    echo "&#187; <a href=\"help.php?hw=none{$mysid}\">Help &amp; Support</a><br/>";
    echo "&#187; <a href=\"logout.php?do=signout{$mysid}\">Sign Out</a><br/>";
    if ($j21login == $owner['login']) {
        echo "&#187; <a href=\"owner_cp.php?do=masnunify{$mysid}\">" . "CPanel</a><br/>";
    }
    ;
}
echo "</p></body></html>";
?>
