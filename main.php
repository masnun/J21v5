<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // expires in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Last modified, right now
header("Cache-Control: no-cache, must-revalidate"); // Prevent caching, HTTP/1.1
header("Pragma: no-cache");
require 'core.php';
echo "<!DOCTYPE html><html><head><title>{$site['name']}</title></head><body>
<p align=\"left\">";
if (!isset($j21login)) {
    echo "You are not signed in. Please sign in. <br/><a href=\"index.php\">Home</a><br/> ";
}
else {
    require_once 'format.php';

    echo "Welcome, <a href=\"{$site['url']}u/{$j21login}\">{$j21login}</a>! <br />";
    echo gmstrftime("%d-%m-%Y %H:%M:%S", (time() + 6 * 60 * 60));
    echo "<br />";
    require_once 'newpm.php';
    echo '<hr />';
    $row = mysql_fetch_assoc(mysql_query("select value from masnun_settings where name='msg' "));
    if (!empty($row['value'])) {
        echo "<b>Message:</b><br />";
        echo format($row['value']);
        echo '<hr/>';
    }

    echo "
<b>What's on your mind?</b>
<form action=\"main.php\" method=\"post\">
<input name=\"msg\" type=\"text\" size=\"12\"><input type=\"submit\" value=\"ADD\">
<input type=\"hidden\" name=\"{$sessname}\" value=\"{$j21sid}\">
<input type=\"hidden\" name=\"act\" value=\"add\">
</form>";
    echo "<a href=\"main.php?m=1" . $mysid . "\">Refresh</a> <hr />";
    /* Delete Text */

    if (isset($_REQUEST['pid'])) {
        $pid = $_REQUEST['pid'];
        $login = mysql_fetch_assoc(mysql_query("select * from masnun_shout where shoutid='{$pid}'"));
        if ($staff > 0 || $j21login == $login['login']) {
            mysql_query("delete from masnun_shout where shoutid='{$pid}'");
            echo "Status Deleted<hr/>";
        }
    }
    /*   Add Text */
    $msg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '';
    $msg = htmlspecialchars($msg);
    $user = isset($j21login) ? $j21login : '';
    if (isset($_REQUEST['msg'])) {
        mysql_query("insert into masnun_shout (msg,login,date) values ('{$msg}','{$user}','" . time() . "')");
        echo " Status Updated! <hr/>";

    }

    echo "<a href=\"menu.php?m=1" . $mysid . "\">Menu</a> ";
    echo "<a href=\"inbox.php?view=none" . $mysid . "\">Message</a> ";
    echo "<a href=\"online.php?view=online" . $mysid . "\">Users</a> ";
    echo "<a href=\"forum.php?view=forum" . $mysid . "\">Forums</a> ";
    echo "<hr/>";
    setOnline("Home");
    /*   Show Texts */
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_shout"));
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    if (isset($_POST['fstart'])) {
        $fstart = $_POST['fstart'];
        if ($fstart > getPage($count['value'], '10')) {
            $fstart = getPage($count['value'], '10');
        }
        if ($fstart < 1) {
            $fstart = 1;
        }
        $fstart = $fstart - 1;
        $start = $fstart * 10;
    }
    $prevstrt = $start - 10;
    $newstrt = $start + 10;

    $result = mysql_query("select * from masnun_shout order by shoutid DESC limit $start,10");
    while ($row = mysql_fetch_assoc($result)) {
        echo "<a href=\"view_profile.php?user=" . $row['login'] . $mysid . "\">" . $row['login'] . ":</a> " . format($row['msg']);
        if ($staff > 0 || $j21login == $row['login']) {
            echo " <a href=\"main.php?pid=" . $row['shoutid'] . $mysid . "\">x</a>";
        }
        echo "<hr/>";
    }
    $mypage = getPage($count['value'], '10');
    if ($start == '10' || $start > 10) {
        echo "<a href=\"main.php?view=all&amp;start=" . $prevstrt . $mysid . "\">&#171; Prev</a>";
    }
    echo " (" . (($start / 10) + 1) . "/$mypage) ";
    if ($count['value'] > $newstrt) {
        echo "<a href=\"main.php?view=all&amp;start=" . $newstrt . $mysid . "\">Next &#187;</a>";
    }
    echo "<br/>";
    echo "
<form action=\"main.php\" method=\"post\">
Jump:
<input name=\"fstart\" type=\"text\" maxlength=\"3\" size=\"6\">
<input type=\"submit\" value=\"GO\">
<input type=\"hidden\" name=\"$sessname\" value=\"$j21sid\"/>
</form>";


}
echo "</p></body></html>";
?>