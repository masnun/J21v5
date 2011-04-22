<?php
function viewsent()
{
    global $j21login, $mysid, $sessname;
    setOnline("Sent message list");
    require_once 'newpm.php';
    ?><b>Sent Messages</b><br/>
<?php
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    $results = mysql_query("select * from masnun_pm where 4mu = '{$j21login}' order by pmid DESC limit {$start},7");
    $newstrt = $start + 7;
    while ($row = mysql_fetch_assoc($results)) {
        if ($row['rustatus'] == 0) {
            echo '<b>+</b>';
        } else {
            echo "-";
        }
        echo " <a href=\"inbox.php?view=readsent&amp;pmid=" . $row['pmid'] . $mysid . "\">" . $row['tou'] . "</a><br/>";
    }
    echo '-------<br/>';
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_pm where 4mu = '{$j21login}' "));
    if ($start == 7 || $start > 7) {
        $prevstrt = $start - 7;
        echo "<a href=\"inbox.php?view=sent&amp;start=" . $prevstrt . $mysid . "\">&#171; Prev</a>";
    }
    if ($count['value'] > $newstrt) {
        echo "<a href=\"inbox.php?view=sent&amp;start=" . $newstrt . $mysid . "\">Next &#187;</a>";
    }
    echo "<br/>";
    ?>
<br/>
<?php ;
}

?>