<?php
function viewactive()
{
    global $mysid, $sessname, $j21sid;

    $today = time() - 24 * 60 * 60;

    setOnline("Today\'s Active Topics");


    echo "<b>Today's Active Topics</b><br/>";
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_topic where lastactive > '" . $today . "'"));
    $totlaact = $count['value'];
    echo "($totlaact) topics<br/><br/>";
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
    $res = mysql_query("select * from masnun_topic where lastactive > '" . $today . "' order by lastactive DESC limit {$start}, 10 ");
    while ($m = mysql_fetch_assoc($res)) {
        echo "<a href=\"forum.php?view=topic&amp;topicid=" . $m['topicid'] . $mysid . "\">";
        if ($m['topicstatus'] == '1') {
            echo "+ ";
        }
        echo $m['topictitle'];
        if ($m['pp'] !== '1') {
            echo "(X)";
        } else {
            $tid = $m['topicid'];
            $pcdt = mysql_fetch_assoc(mysql_query("select count(*) pc from masnun_post
            where topicid='$tid'"));
            echo " (" . $pcdt['pc'] . ")";
        }
        echo "</a>";
        $topicid = $m['topicid'];
        $count = mysql_fetch_assoc(mysql_query("select count(post) value from masnun_post where topicid='{$topicid}'"));
        $mypage = getPage($count['value'], '5');
        echo " <a href=\"forum.php?view=topic&amp;topicid=$topicid&amp;fstart={$mypage}{$mysid}\">&gt;</a> <hr/> \n ";
    }
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_topic where lastactive > '" . $today . "'"));
    $newstrt = $start + 10;
    $prevstrt = $start - 10;

    $mypage = getPage($count['value'], '10');
    if ($start == 10 || $start > 10) {
        echo "<a href=\"forum.php?view=active&amp;start={$prevstrt}" . $mysid . "\">&#171; Prev</a>";
    }
    echo " (" . (($start / 10) + 1) . "/{$mypage}) ";
    if ($count['value'] > $newstrt) {
        echo "<a href=\"forum.php?view=active&amp;start={$newstrt}" . $mysid . "\">Next &#187;</a>";
    }
    echo "<br/>";
    echo "<form action=\"forum.php\" method=\"post\">";
    echo "Jump:";
    echo
    "<input name=\"fstart\" type=\"text\" maxlength=\"3\" size=\"6\">
        <input type=\"submit\" value=\"GO\">
        <input type=\"hidden\" name=\"view\" value=\"active\"/>
        <input type=\"hidden\" name=\"{$sessname}\" value=\"{$j21sid}\"/>
        </form><br/>";
}

?>

