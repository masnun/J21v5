<?php
function viewtopic()
{
    global $j21login, $mysid, $sessname, $j21sid, $staff;
    /* //////// ADD Post ///// */
    if (isset($_REQUEST['act']) && isset($j21login)) {
        if ($_REQUEST['act'] == 'add') {
            $topicid = $_REQUEST['topicid'];
            $posttext = $_REQUEST['posttext'];
            $results = mysql_query("select forumid,pp from masnun_topic where topicid='{$topicid}'");
            $row = mysql_fetch_assoc($results);
            $forumid = $row['forumid'];
            $pp_x = $row['pp'];
            $posttext = htmlspecialchars($posttext);
            $posttext = substr($posttext, 0, 500);
            // echo "PP: $pp_x <br/>";
            if ($pp_x == 1) {
                mysql_query("insert into masnun_post (topicid,forumid,post,date,postuser) values ('{$topicid}','{$forumid}','{$posttext}','" . time() . "','$j21login')");
                mysql_query("update masnun_topic set lastactive='" . time() . "' where topicid='{$topicid}'");
                echo "Reply added.<br/>";
                setOnline("Replied to: [topic=$topicid]Topic ID : $topicid [/topic]");
                $lpr = mysql_fetch_assoc(mysql_query("select points from masnun_user where login ='{$j21login}'"));
                $cp = $lpr['points'];
                $np = $cp + 2;
                mysql_query("update masnun_user set points='{$np}' where login='{$j21login}'");
                echo "+2 Points. Total Points: {$np}<br/>";
            } else {
                echo "Topic Locked.<br/>";
            }

        }

        /* //////// EDIT Post ///// */
        if ($_REQUEST['act'] == 'edit') {
            $postid = $_REQUEST['postid'];
            $posttext = $_REQUEST['posttext'];
            $posttext = strip_tags($posttext);
            $posttext = htmlspecialchars($posttext);
            $q = mysql_fetch_assoc(mysql_query("select postuser from masnun_post where postid='{$postid}'"));
            if (strtolower($q['postuser']) == $j21login || $staff > 0) {

                mysql_query("update masnun_post set post='{$posttext}' where postid='{$postid}' ");
                echo "Post ID {$postid} updated.<br/>";
            } else {
                echo "Access denied.<br />";
            }
        }

        /* //////// DELETE Post ///// */
        if ($_REQUEST['act'] == 'del' && $staff > 0) {
            $postid = $_REQUEST['postid'];
            mysql_query("delete from  masnun_post where postid='{$postid}' ");
            echo "Post ID {$postid} deleted.<br/>";
        }
    }
    $topicid = isset($_REQUEST['topicid']) ? $_REQUEST['topicid'] : '0';
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_post  where topicid = '{$topicid}' "));
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    if (isset($_REQUEST['fstart'])) {
        $fstart = $_REQUEST['fstart'];
        if ($fstart > getPage($count['value'], '5')) {
            $fstart = getPage($count['value'], '5');
        }
        if ($fstart < 1) {
            $fstart = 1;
        }
        $fstart = $fstart - 1;
        $start = $fstart * 5;
    }
    $newstrt = $start + 5;
    $prevstrt = $start - 5;
    $results = mysql_query("select * from masnun_topic where topicid='{$topicid}'");
    $row = mysql_fetch_assoc($results);
    $fid = $row['forumid'];
    $fr = mysql_query("select forumname from masnun_forums where forumid ='{$fid}'");
    $fname = mysql_fetch_assoc($fr);
    echo "<b><a href=\"forum.php?view=topiclist&amp;forumid=" . $fid . $mysid . "\">" . strtoupper($fname['forumname']) . "</a>  &gt;  ";
    echo $row['topictitle'] . "</b><br/>";
    echo "<small>Topic # " . $row['topicid'] . " | Replies: " . $count['value'] . "<br/>";
    if ($row['topicstatus'] == '1') {
        echo "+Stuck ";
    }
    if ($row['pp'] !== '1') {
        echo "+Locked ";
    }
    echo "</small><br/>";
    if ($count['value'] > 5) {
        if ((($start / 5) + 1) != 1) {
            echo "<a href=\"forum.php?view=topic&amp;topicid={$topicid}&amp;fstart=0{$mysid}\">&lt; First Page</a><br/> ";
        }
        $mypage = getPage($count['value'], '5');
        $cpage = (($start / 5) + 1);
        if ($cpage != $mypage) {
            echo " <a href=\"forum.php?view=topic&amp;topicid={$topicid}&amp;fstart=" . getPage($count['value'], '5') . "{$mysid}\">Last Page &gt;</a><br/>";
        }
    }
    if ((($start / 5) + 1) == 1) {
        $postuser = $row['topicuser'];
        echo "<a href=\"view_profile.php?user=" . $row['topicuser'] . $mysid . "\">" . $row['topicuser'] . "</a>:";
        echo " " . format($row['topictext']);
        echo "<br/><small>" . gmstrftime("%c", ($row['topicdate'] + 6 * 60 * 60)) . "</small><br/>";
        if ($staff > 0 || $j21login == $row['topicuser']) {
            echo "<small><a href=\"edits.php?view=etopic&amp;topicid=$topicid$mysid\">&#187; Edit Topic</a></small>";
        }
    }

    if ((($start / 5) + 1) == 1) {
        echo "<br/>";
    }
    if (!isset($_REQUEST['act']) || $_REQUEST['act'] !== 'add') {
        setOnline('Topic: [topic=' . $topicid . ']' . $row['topictitle'] . '[/topic]');
    }
    if ((($start / 5) + 1) == 1) {
        if ($staff > 0) {
            echo "<hr />";
            echo "<a href=\"forum.php?view=topiclist&amp;act=del&amp;topicid={$topicid}&amp;forumid={$fid}{$mysid}\">&#187;Delete</a> ";
            echo "<a href=\"forum.php?view=movetopic&amp;topicid=" . $topicid . $mysid . "\">&#187;Move</a> ";
            if ($row['topicstatus'] == 0) {
                echo "<a href=\"forum.php?view=topiclist&amp;act=stck&amp;topicid=" . $topicid . $mysid . "&amp;forumid=" . $fid . "\">&#187;Stick</a> ";
            }
            else {
                echo "<a href=\"forum.php?view=topiclist&amp;act=ustck&amp;topicid=" . $topicid . $mysid . "&amp;forumid=" . $fid . "\">&#187;Unstick</a> ";
            }
            if ($row['pp'] == '1') {
                echo "<a href=\"forum.php?view=topiclist&amp;act=lock&amp;topicid=" . $topicid . $mysid . "&amp;forumid=" . $fid . "\">&#187;Lock</a> ";
            }
            else {
                echo "<a href=\"forum.php?view=topiclist&amp;act=unlck&amp;topicid=" . $topicid . $mysid . "&amp;forumid=" . $fid . "\">&#187;Unlock</a> ";
            }
            echo "<hr />";
        }
    }

    $results = mysql_query("select * from masnun_post  where topicid = '$topicid' order by postid limit $start, 5");
    $pgcount = 0;
    while ($m = mysql_fetch_assoc($results)) {
        echo "<a href=\"view_profile.php?user=" . $m['postuser'] . $mysid . "\">" . $m['postuser'] . "</a>: " . format($m['post']) . "<br/><small>" . gmstrftime("%c", ($m['date'] + 6 * 60 * 60)) . "</small><br/>";
        $pgcount = $pgcount + 1;
        if ($staff > 0) {
            echo "  <a href=\"forum.php?view=topic&amp;act=del&amp;postid=" . $m['postid'] . $mysid . "&amp;topicid=" . $topicid . "\">[X]</a> ";
        }
        if ($staff > 0 || $j21login == $m['postuser']) {
            echo "  <a href=\"edits.php?view=epost&amp;postid=" . $m['postid'] . $mysid . "\">[E]</a>";
        }
        echo "<hr /> \n";
    }

    $mypage = getPage($count['value'], '5');
    if ($mypage == '0') {
        $mypage = '1';
    }

    if ($row['pp'] == '1') {
        echo "<form action=\"forum.php\" method=\"post\">";
        echo "<br/>Reply:<br/>";
        echo "<input name=\"posttext\" type=\"text\"/><br/>";
        echo "<input type=\"submit\" value=\"POST\">";
        echo "
            <input type=\"hidden\" name=\"view\" value=\"topic\"/>
            <input type=\"hidden\" name=\"act\" value=\"add\"/>
            <input type=\"hidden\" name=\"fstart\" value=\"1\"/>
            <input type=\"hidden\" name=\"topicid\" value=\"{$topicid}\"/>
            <input type=\"hidden\" name=\"{$sessname}\" value=\"{$j21sid}\"/>";
        echo "</form>";
    }

    if ($start == 5 || $start > 5) {
        echo "<a href=\"forum.php?view=topic&amp;topicid=" . $topicid . $mysid . "&amp;start=" . $prevstrt . "\">&#171; Prev</a>";
    }
    echo " (" . (($start / 5) + 1) . "/{$mypage}) ";
    if ($count['value'] > $newstrt) {
        echo "<a href=\"forum.php?view=topic&amp;topicid=" . $topicid . $mysid . "&amp;start=" . $newstrt . "\">Next &#187;</a>";
    }


    echo "<br/>";
    echo "<form action=\"forum.php\" method=\"post\">";
    echo "Jump:";
    echo "<input name=\"fstart\" type=\"text\" maxlength=\"3\"/>";
    echo "<input type=\"submit\" value=\"GO\">";
    echo "
        <input type=\"hidden\" name=\"view\" value=\"topic\"/>
        <input type=\"hidden\" name=\"topicid\" value=\"{$topicid}\"/>
        <input type=\"hidden\" name=\"{$sessname}\" value=\"{$j21sid}\"/>";
    echo "</form>";

}

?>