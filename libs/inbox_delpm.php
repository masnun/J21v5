<?php
 function delpm()
{
    global $j21login, $mysid;
    $id = isset($_GET['pmid']) ? $_GET['pmid'] : '';
    $res = mysql_fetch_assoc(mysql_query("select * from masnun_pm where pmid='{$id}'"));

    if ($j21login == $res['tou']) {
        mysql_query("Delete from masnun_pm where pmid ='{$id}'");
    } else {
        echo "You don't have permission to delete this PM<br/>";
    }
    require_once 'newpm.php';
    echo "MSG deleted <br/>";
    setOnline("Deleted a message");


}

?>