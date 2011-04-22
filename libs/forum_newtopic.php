<?php
function newtopic()
{
    global $j21login, $mysid, $sessname, $j21sid;
    setOnline('Creating New Topic');
    $forumid = $_GET['forumid'];
    $forum_row = mysql_fetch_assoc(mysql_query("select forumname from masnun_forums where forumid='{$forumid}'"));

    if (!empty($forum_row['forumname'])) {
        echo "<b>New Topic</b><br/>";
        echo "<form action=\"forum.php\" method=\"post\">";
        echo "Topic Title:<br/>";
        echo "<input name=\"topictitle\" type=\"text\"/>
                <br/> Message:<br/>
                <input name=\"topictext\" type=\"text\"/><br/>
                <input type=\"submit\" value=\"ADD\">
                <input type=\"hidden\" name=\"act\" value=\"add\"/>
                <input type=\"hidden\" name=\"{$sessname}\" value=\"{$j21sid}\"/>
                <input type=\"hidden\" name=\"view\" value=\"topiclist\"/>
                <input type=\"hidden\" name=\"forumid\" value=\"$forumid\"/>
                </form>
                <a href=\"forum.php?view=topiclist&amp;forumid=$forumid.$mysid\">&#171; Back</a><br/>";


    } else {
        echo "WTF are you doing here?<br/>";
    }
}

?>