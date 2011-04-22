<?php
function searchposts()
{
    global $mysid;
    setOnline('Searching Posts');


    $m = isset($_REQUEST['str']) ? strtolower($_REQUEST['str']) : '[Empty]';
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    $newstrt = $start + 7;
    $prevstrt = $start - 7;

    $m = htmlspecialchars($m);
    $query = "select * from masnun_post where lower(post) like ('%$m%') or lower(postuser) like ('%$m%') or lower(date) like ('%$m%') limit $start,7;";
    $results = mysql_query($query);
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_post where lower(post) like ('%$m%') or lower(postuser) like ('%$m%') or lower(date) like ('%$m%')"));

    echo "Searching for [<b>" . $m . "</b>] in replies in the forum<br/>";
    echo $count['value'] . " replies found<br/>";
    echo "<br/>";
    while ($post = mysql_fetch_assoc($results)) {
        echo "<a href=\"forum.php?view=viewpost&amp;postid=" . $post['postid'] . $mysid . "\">" . htmlspecialchars(substr($post['post'], 0, 6)) . "..." . "</a><br/>";
    }
    echo "<br/>";
    if ($count['value'] > $newstrt) {
        echo "<a href=\"search.php?what=post&amp;start=" . $newstrt . $mysid . "&amp;str=" . $m . "\">Next</a>";
    }
    if ($start == '7' || $start > 7) {
        echo "<a href=\"search.php?what=post&amp;start=" . $prevstrt . $mysid . "&amp;str=" . $m . "\">Prev</a>";
    }
    echo "<br/><br/>";
    ?>
<a href="search.php?what=search<?php echo $mysid ?>">Search</a><br/>
<a href="main.php?m=1<?php echo $mysid ?>">Home</a><br/>
<?php ;
}

?>