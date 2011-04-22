<?php
function movetopic()
{
    global $j21login, $mysid, $sessname, $j21sid, $staff;
    setOnline('Moving Topic');
    if ($staff > 0) {
        $topicid = $_REQUEST['topicid'];
        $results = mysql_query("select * from masnun_forums");
        echo "<b>Move To:</b><br/>";
        while ($r = mysql_fetch_assoc($results)) {
            echo "&#187; <a href=\"forum.php?view=topiclist&amp;act=move&amp;forumid=" . $r['forumid'] . $mysid . "&amp;topicid=" . $topicid . "\">" . $r['forumname'] . "</a><br/>";
        }

    } else {
        echo "WTF!! You're not a site staff, are you?";
    }
    echo "<br/><br/>";
}

?>