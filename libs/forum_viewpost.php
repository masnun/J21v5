<?php
function viewpost()
{
    global $mysid, $staff;
    $postid = $_GET['postid'];
    $prow = mysql_fetch_assoc(mysql_query("select * from masnun_post where postid='{$postid}'"));
    $topicid = $prow['topicid'];
    $trow = mysql_fetch_assoc(mysql_query("select * from masnun_topic where topicid='{$topicid}'"));
    $forumid = $prow['forumid'];
    $frow = mysql_fetch_assoc(mysql_query("select * from masnun_forums where forumid='{$forumid}'"));
    setOnline('Viewing Post');
    echo "Post ID: $postid <br/>";
    echo "<a href=\"view_profile.php?user=" . $prow['postuser'] . $mysid . "\">" . $prow['postuser'] . "</a> @ " . gmstrftime("%c", ($prow['date'] + 6 * 60 * 60)) . "<br/>";
    echo format($prow['post']);
    echo "<hr />";
    echo "<b>Topic:</b> " . $trow['topictitle'] . " <br/>";
    echo "<b>Topic MSG: </b>" . format($trow['topictext']) . " <br/>";
    echo "<b>Forum:</b> " . $frow['forumname'] . " <br/>";
    echo "<br/>";
    if ($staff > 0) {
        echo "<a href=\"forum.php?view=topic&amp;act=del&amp;postid=" . $prow['postid'] . $mysid . "&amp;topicid=" . $topicid . "\">+Delete</a><br/>";
    }
    echo "<a href=\"forum.php?view=topic&amp;topicid=" . $prow['topicid'] . $mysid . "\">+View Topic</a><br/>";
    echo "<br/>";
}

?>
