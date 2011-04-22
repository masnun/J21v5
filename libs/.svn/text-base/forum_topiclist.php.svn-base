<?php
function view_topiclist()
{
    global $j21login, $mysid, $sessname, $j21sid, $staff;
    if (isset($_REQUEST['act']) && isset($j21login)) {
        /* ADD NEW TOPIC */
        if ($_REQUEST['act'] == 'add') {
            $topictitle = $_REQUEST['topictitle'];
            $topictext = $_REQUEST['topictext'];
            $forumid = $_REQUEST['forumid'];
            $topictitle = strip_tags($topictitle);
            $topictitle = substr($topictitle, 0, 250);
            $topictitle = htmlspecialchars($topictitle);
            $topictext = htmlspecialchars($topictext);
            $topictext = substr($topictext, 0, 500);
            mysql_query("insert into masnun_topic (forumid,topictitle,topictext,topicdate,topicstatus,topicuser,lastactive) values ('{$forumid}','{$topictitle}','{$topictext}','" . time() . "','0','$j21login','" . time() . "' )");
            echo "<b>{$topictitle}</b> created.<br/>";

            $lpr = mysql_fetch_assoc(mysql_query("select points from masnun_user where login ='{$j21login}'"));
            $cp = $lpr['points'];
            $np = $cp + 5;
            mysql_query("update masnun_user set points='{$np}' where login='{$j21login}'");
            echo "+5 Points. Total Points: {$np}.<br/>";
            setOnline("Created Topic: {$topictitle} ");


        }

        /* EDIT TOPIC */
        if ($_REQUEST['act'] == 'edit') {
            $topicid = $_REQUEST['topicid'];
            $topictitle = $_REQUEST['topictitle'];
            $topictext = $_REQUEST['topictext'];
            $topictitle = strip_tags($topictitle);
            $topictext = strip_tags($topictext);
            $topictitle = htmlspecialchars($topictitle);
            $topictext = htmlspecialchars($topictext);
            $q = mysql_fetch_assoc(mysql_query("select topicuser from masnun_topic where topicid='{$topicid}'"));
            //echo "$j21login -- {$q['topicuser']} <br/><br/>";
            if (strtolower($q['topicuser']) == $j21login || $staff > 0) {
                mysql_query("update masnun_topic set topictext='{$topictext}',topictitle='{$topictitle}' where topicid='{$topicid}'");
                echo "Topic ID {$topicid} updated.<br/>";
            } else {
                echo "Access denied.<br/>";
            }
        }

        /* DELETE Topic */
        if ($_REQUEST['act'] == 'del' && $staff > 0) {
            $topicid = $_REQUEST['topicid'];
            mysql_query("delete from  masnun_topic where topicid='{$topicid}' ");
            mysql_query("delete from  masnun_post where topicid='{$topicid}' ");
            echo "Topic ID {$topicid} deleted.<br/>";
        }
        /* Stick Topic */
        if ($_REQUEST['act'] == 'stck' && $staff > 0) {
            $topicid = $_REQUEST['topicid'];
            mysql_query("update masnun_topic set topicstatus ='1' where topicid='{$topicid}' ");
            echo "Topic ID {$topicid} stuck.<br/>";
        }
        /* Lock Topic */
        if ($_REQUEST['act'] == 'lock' && $staff > 0) {
            $topicid = $_REQUEST['topicid'];
            mysql_query("update masnun_topic set pp ='0' where topicid='{$topicid}' ");
            echo "Topic ID {$topicid} locked.<br/>";
        }
        /* Unlock Topic */
        if ($_REQUEST['act'] == 'unlck' && $staff > 0) {
            $topicid = $_REQUEST['topicid'];
            mysql_query("update masnun_topic set pp ='1' where topicid='{$topicid}' ");
            echo "Topic ID {$topicid} unlocked.<br/>";
        }
        /* Unstick Topic */
        if ($_REQUEST['act'] == 'ustck' && $staff > 0) {
            $topicid = $_REQUEST['topicid'];
            mysql_query("update masnun_topic set topicstatus ='0' where topicid='{$topicid}' ");
            echo "Topic ID {$topicid} unstuck.<br/>";
        }
        /* Move Topic */
        if ($_REQUEST['act'] == 'move' && $staff > 0) {
            $topicid = $_REQUEST['topicid'];
            $forumid = $_REQUEST['forumid'];
            mysql_query("update masnun_topic set forumid ='{$forumid}' where topicid='{$topicid}' ");
            mysql_query("update masnun_post set forumid ='{$forumid}' where topicid='{$topicid}' ");
            echo "Topic ID {$topicid} moved.<br/>";
        }
        /* ----> View TopicList */
    }

    $forumid = isset($_REQUEST['forumid']) ? $_REQUEST['forumid'] : '1';
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_topic where forumid ='{$forumid}' "));
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
    $newstrt = $start + 10;
    $prevstrt = $start - 10;
    $results = mysql_query("select * from masnun_forums where forumid='{$forumid}'");
    $row = mysql_fetch_assoc($results);
    if (!isset ($_REQUEST['act']) || $_REQUEST['act'] !== 'add') {
        setOnline('[forum=' . $forumid . ']' . strtoupper($row['forumname']) . '[/forum] board');

    }
    echo "<b> " . strtoupper($row['forumname']) . "</b><br/>";
    echo "<small><b>(" . $count['value'] . ")</b> Topic(s) </small><br/><br/>";
    echo "<a href=\"forum.php?view=newtopic&amp;forumid=$forumid" . $mysid . "\">&#187; New Topic</a><hr/>";
    echo "<br/>";
    $results = mysql_query("select * from masnun_topic  where forumid = '{$forumid}' order by topicstatus DESC, lastactive DESC , topicid DESC limit {$start}, 10");
    $pgcount = 0;
    while ($m = mysql_fetch_assoc($results)) {
        if ($m['topicstatus'] == '1') {
            echo "+ ";
        }
        echo "<a href=\"forum.php?view=topic&amp;topicid=" . $m['topicid'] . $mysid . "\">";
        echo $m['topictitle'];
        $tid = $m['topicid'];
        $pcdt = mysql_fetch_assoc(mysql_query("select count(*) pc from masnun_post where topicid='{$tid}'"));
        echo " (" . $pcdt['pc'] . ")";
        echo "</a> ";
        if ($m['pp'] !== '1') {
            echo "[Locked] ";
        }
        $topicid = $m['topicid'];
        $mypage = getPage($pcdt['pc'], '5');
        echo " <a href=\"forum.php?view=topic&amp;topicid={$topicid}&amp;fstart={$mypage}{$mysid}\">&gt;</a> <br />\n";
    }
    echo "<hr/>";
    echo "<a href=\"forum.php?view=newtopic&amp;forumid={$forumid}{$mysid}\">&#187; New Topic</a><br/>";
    $mypage = getPage($count['value'], '10');
    if ($mypage == '0') {
        $mypage = '1';
    }
    if ($count['value'] == '0') {
        $start = -1;
        $pgcount = 1;
    }
    if ($start == 10 || $start > 10) {
        echo "<a href=\"forum.php?view=topiclist&amp;forumid=" . $forumid . $mysid . "&amp;start=" . $prevstrt . "\">&#171; Prev</a>";
    }
    echo " (" . (($start / 10) + 1) . "/$mypage) ";
    if ($count['value'] > $newstrt) {
        echo "<a href=\"forum.php?view=topiclist&amp;forumid=" . $forumid . $mysid . "&amp;start=" . $newstrt . "\">Next &#187;</a>";
    }
    echo "<br/>";
    echo "<form action=\"forum.php\" method=\"post\">";
    echo "Jump:";
    echo "<input name=\"fstart\" type=\"text\" maxlength=\"3\" size=\"6\">";
    echo "<input type=\"submit\" value=\"JUMP\">";
    echo "
<input type=\"hidden\" name=\"view\" value=\"topiclist\"/>
<input type=\"hidden\" name=\"forumid\" value=\"{$forumid}\"/>
<input type=\"hidden\" name=\"{$sessname}\" value=\"{$j21sid}\"/>
</form><br/>";
}

?>