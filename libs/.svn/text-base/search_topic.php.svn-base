<?php
function searchtopic()
{
    global $mysid;
    setOnline('Searching Topics');
    $m = isset($_REQUEST['str']) ? strtolower($_REQUEST['str']) : '[Empty]';
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    $newstrt = $start + 7;
    $prevstrt = $start - 7;
    $m = htmlspecialchars($m);
    $query = "select * from masnun_topic where lower(topictitle) like ('%$m%') or lower(topictext) like ('%$m%') or lower(topicuser) like ('%$m%') or lower(topicdate) like ('%$m%') order by lastactive DESC limit $start,7;";
    $results = mysql_query($query);
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_topic where lower(topictitle) like ('%$m%') or lower(topictext) like ('%$m%') or lower(topicuser) like ('%$m%') or lower(topicdate) like ('%$m%')"));

    echo "Searching for [ <b>" . $m . "</b> ] in topics in the forum<br/>";
    echo $count['value'] . " topics found<br/><br/> ";
    while ($topic = mysql_fetch_assoc($results)) {
        echo "<a href=\"forum.php?view=topic&amp;topicid=" . $topic['topicid'] . $mysid . "\">" . $topic['topictitle'] . "</a>";
        $fid = $topic['forumid'];
        $fr = mysql_query("select forumname from masnun_forums where forumid ='$fid'");
        $fname = mysql_fetch_assoc($fr);
        echo " (" . $fname['forumname'] . ")<br/>";
    }
    echo "<br/>";
    if ($count['value'] > $newstrt) {
        echo "<a href=\"search.php?what=topic&amp;start=" . $newstrt . $mysid . "&amp;str=" . $m . "\">[Next]</a>";
    }
    if ($start == '7' || $start > 7) {
        echo "<a href=\"search.php?what=topic&amp;start=" . $prevstrt . $mysid . "&amp;str=" . $m . "\">[Prev]</a>";
    }
    echo "<br/>";
    ?>
<a href="search.php?what=search<?php echo $mysid ?>">Search</a><br/>
<a href="main.php?m=1<?php echo $mysid ?>">Home</a><br/>
<?php ;
}

?>