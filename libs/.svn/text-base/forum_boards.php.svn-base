<?php
function view_boards()
{
    global $j21login, $mysid, $sessname, $j21sid, $owner;
    setOnline("Forum Boards");
    /* ADD NEW FORUMS */
    if (isset($_REQUEST['act']) && isset($j21login)) {
        if ($_REQUEST['act'] == 'add' && $j21login == $owner['login']) {
            $forumname = htmlspecialchars($_REQUEST['forumname']);
            $forumname = strip_tags($forumname);
            mysql_query("insert into masnun_forums (forumname) values ('{$forumname}')");
            echo $forumname . " created.<br/>";
        }
        /* ////// Rename Forums ////// */
        if (isset($_REQUEST['act']) && isset($j21login)) {
            if ($_REQUEST['act'] == 'ren' && $j21login == $owner['login']) {
                $newfname = htmlspecialchars($_REQUEST['newfname']);
                $fid = $_REQUEST['fid'];
                mysql_query("update masnun_forums set forumname ='{$newfname}' where forumid='{$fid}'");
                echo "Forum ID {$fid} renamed to {$newfname}.<br/>";
            }
        }

        /* DELETE FORUMS */
        if ($_REQUEST['act'] == 'del' && $j21login == $owner['login']) {
            $forumid = $_REQUEST['forumid'];
            mysql_query("delete from  masnun_forums where forumid='{$forumid}' ");
            mysql_query("delete from  masnun_topic where forumid='{$forumid}' ");
            mysql_query("delete from  masnun_post where forumid='{$forumid}' ");
            echo "Forum ID {$forumid} deleted.<br/>";
        }
    }
    /* View FORUMS */
    echo "<form action=\"forum.php\" method=\"POST\">";
    echo "Topic ID:<br/>";
    echo "<input name=\"topicid\" type=\"text\" size=\"7\">";
    echo "<input type=\"submit\" value=\"Jump\">";
    echo "<input type=\"hidden\" name=\"view\" value=\"topic\">
    <input type=\"hidden\" name=\"{$sessname}\" value=\"{$j21sid}\">
    </form><hr />";
    echo "<a href=\"forum.php?view=active" . $mysid . "\">Today's Topics</a><br/>";
    echo "<hr />";
    $tpcres = mysql_fetch_assoc(mysql_query("select postuser, count(post) mx from masnun_post where date > '" . (time() - 24 * 60 * 60) . "' group by postuser order by mx DESC "));
    $topposter = $tpcres['postuser'];
    $toppoints = $tpcres['mx'];
    echo "Top Poster:<br/><a href=\"view_profile.php?user={$topposter}{$mysid}\">{$topposter}</a> ({$toppoints})<br/>";
    echo "<hr />";
    $result = mysql_query("select * from masnun_forums");
    while ($row = mysql_fetch_assoc($result)) {
        echo "<b>+</b> <a href=\"forum.php?view=topiclist" . $mysid . "&amp;forumid=" . $row['forumid'] . "\">" . strtoupper($row['forumname']) . "</a><br/>";
    }
    echo "<hr />";
    if ($j21login == $owner['login']) {
        echo "<a href=\"forum.php?view=forummod" . $mysid . "\">Forum CP</a><br/>";
    }

}

?>