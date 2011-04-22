<?php
function readsent()
{
    global $j21login, $mysid;
    setOnline('Reading Sent MSG');
    require_once 'newpm.php';
    $id = isset($_GET['pmid']) ? $_GET['pmid'] : '';
    $row = mysql_fetch_assoc(mysql_query("select * from masnun_pm where pmid = '{$id}'"));
    if (trim(strtolower($row['4mu'])) == $j21login) {
        echo "To: <a href=\"view_profile.php?user=" . $row['tou'] . $mysid . "\">" . $row['tou'] . "</a><br/>";
        echo gmstrftime("%c", ($row['date'] + 6 * 60 * 60)) . "<br/>";
        echo "-------<br/>";
        echo format($row['msg']) . "<br/>-------<br/>";
    }
    else {
        echo "Navigation ERROR";
    }
    ;
}

?>