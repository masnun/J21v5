<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // expires in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Last modified, right now
header("Cache-Control: no-cache, must-revalidate"); // Prevent caching, HTTP/1.1
header("Pragma: no-cache");

require_once "core.php";
require_once 'format.php';

echo "<!DOCTYPE html><html><head><title>{$site['name']}</title></head><body>
<p align=\"left\">";
if (!isset($j21login)) {
    echo "You are not signed in. Please sign in.<br/><a href=\"index.php\">[= Back =]</a><br/> ";
}
else {
    setOnline('Reading PMs from SPY');
    echo "<a href=\"main.php?m=1" . $mysid . "\">[H]</a>";
    echo "<a href=\"inbox.php?view=none" . $mysid . "\">[M]</a>";
    echo "<a href=\"online.php?view=online" . $mysid . "\">[A]</a>";
    echo "<a href=\"forum.php?view=forum" . $mysid . "\">[F]</a>";
    echo "<br/>";
    include("newpm.php");

    if ($staff > 0) {

        echo "<b>Currently scanning the following keywords:</b><br/> '" . join("', ' ", $spy) . "<hr/>";


        $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_pm where 4mu='spy'"));
        $start = isset($_GET['start']) ? $_GET['start'] : '0';
        if (isset($_POST['fstart'])) {
            $fstart = $_POST['fstart'];
            if ($fstart > getpg($count['value'], '7')) {
                $fstart = getpg($count['value'], '7');
            }
            if ($fstart < 1) {
                $fstart = 1;
            }
            $fstart = $fstart - 1;
            $start = $fstart * 7;
        }
        $prevstrt = $start - 7;
        $newstrt = $start + 7;

        $result = mysql_query("select * from masnun_pm where 4mu='spy' order by pmid DESC limit $start,7");
        while ($row = mysql_fetch_assoc($result)) {
            echo format($row['msg']) . " (Date: " . gmstrftime("%c", ($row['date'] + 6 * 60 * 60)) . ") <br/>----------<br/>";
        }
        $mypage = getPage($count['value'], '7');
        if ($start == '7' || $start > 7) {
            echo "<a href=\"spypm.php?view=all&amp;start=" . $prevstrt . $mysid . "\">&#171; Prev</a>";
        }
        echo " (" . (($start / 7) + 1) . "/{$mypage}) ";
        if ($count['value'] > $newstrt) {
            echo "<a href=\"spypm.php?view=all&amp;start=" . $newstrt . $mysid . "\">Next &#187;</a>";
        }
        echo "<br/>";

        echo "<a href=\"main.php?m=1{$mysid}\">Home</a>";
    } else {
        echo "Who's the hell are you access this zone?";
    }
    ;
}
echo "</p></body></html>";
?>