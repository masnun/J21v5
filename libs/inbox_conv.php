<?php
function conv()
{
    global $j21login, $mysid;
    setOnline("Viewing Conversation");
    require_once 'newpm.php';
    $partner = $_GET['pt'];
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    $newstrt = $start + 5;
    $prevstrt = $start - 5;
    $cnvcres = mysql_fetch_assoc(mysql_query("select count(*) c from masnun_pm where 4mu='{$j21login}' and tou='{$partner}' or ( 4mu='{$partner}' and tou='{$j21login}') order by pmid"));
    $count = $cnvcres['c'];
    echo "<b>Conversation</b>: <b>{$j21login}</b> &amp; <b>{$partner}</b><br/>";
    echo "<b>[ $count ]</b> messages <br/>";
    $convres = mysql_query("select * from masnun_pm where (4mu='{$j21login}' and tou='{$partner}') or ( 4mu='{$partner}' and tou='{$j21login}') order by pmid DESC limit {$start}, 5 ");
    echo "----------<br/>";
    while ($c = mysql_fetch_assoc($convres)) {
        $from = $c['4mu'];
        echo "<b>" . $from . "</b> @ " . gmstrftime("%c", ($c['date'] + 6 * 60 * 60)) . " : " . format($c['msg']) . '<br/>----------<br/>';
    }


    $mypage = getPage($count, '5');
    if ($start == '5' || $start > 5) {
        echo "<a href=\"inbox.php?view=conv&amp;pt=$partner&amp;start=" . $prevstrt . $mysid . "\">&#171; Prev</a>";
    }

    echo " (" . (($start / 5) + 1) . "/$mypage) ";

    if ($count > $newstrt) {
        echo "<a href=\"inbox.php?view=conv&amp;pt=$partner&amp;start=" . $newstrt . $mysid . "\">Next &#187;</a>";
    }
    echo "<br/>";
}

?>
