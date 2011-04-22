<?php
function searchpm()
{
    global $j21login, $mysid;
    setOnline('Searching PM');

    $m = isset($_REQUEST['str']) ? strtolower($_REQUEST['str']) : '[Empty]';
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    $newstrt = $start + 7;
    $prevstrt = $start - 7;
    $user = $j21login;
    $m = htmlspecialchars($m);
    $query = "select * from masnun_pm where ( tou ='{$user}' and lower(4mu) like ('%$m%') ) or
( 4mu ='$user' and lower(tou) like ('%$m%') ) or
( 4mu ='$user' and lower(date) like ('%$m%') ) or
( tou ='$user' and lower(date) like ('%$m%') ) or
( tou ='$user' and lower(msg) like ('%$m%') ) or
( 4mu ='$user' and lower(msg) like ('%$m%') ) order by pmid DESC
 limit $start,7;";
    $results = mysql_query($query);
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_pm where ( tou ='$user' and lower(4mu) like ('%$m%') ) or
( 4mu ='$user' and lower(tou) like ('%$m%') ) or
( 4mu ='$user' and lower(date) like ('%$m%') ) or
( tou ='$user' and lower(date) like ('%$m%') ) or
( tou ='$user' and lower(msg) like ('%$m%') ) or
( 4mu ='$user' and lower(msg) like ('%$m%') ) "));

    echo "Searching for [<b>" . $m . "</b>] in your PM(s)<br/>";
    echo $count['value'] . " pms found <br/><br/>";
    while ($pm = mysql_fetch_assoc($results)) {
        if ($pm['rustatus'] == '0') {
            echo "[<b>+</b>]";
        } else {
            echo "[<b>-</b>]";
        }
        if ($pm['tou'] == $user) {
            echo " (&gt;)";
        } else {
            echo " (&lt;)";
        }
        if ($pm['tou'] == $user) {
            echo " <a href=\"inbox.php?view=pm&amp;pmid=" . $pm['pmid'] . $mysid . "\">" . $pm['4mu'] . "</a>";
        } else {
            echo " <a href=\"inbox.php?view=readsent&amp;pmid=" . $pm['pmid'] . $mysid . "\">" . $pm['tou'] . "</a>";
        }
        echo "<br/>";
    }
    echo "<br/>";
    if ($count['value'] > $newstrt) {
        echo "<a href=\"search.php?what=pm&amp;start=" . $newstrt . $mysid . "&amp;str=" . $m . "\">Next</a>";
    }


    if ($start == '7' || $start > 7) {
        echo "<a href=\"search.php?what=pm&amp;start=" . $prevstrt . $mysid . "&amp;str=" . $m . "\">Prev</a>";
    }
    echo "<br/>";
    ?>
<a href="search.php?what=search<?php echo $mysid ?>">Search</a><br/>
<a href="main.php?m=1<?php echo $mysid ?>">Home</a><br/>
<?php ;
}

?>