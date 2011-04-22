<?php

function getPage($t, $d)
{
    return ceil($t / $d);
}


function setOnline($page)
{
    global $j21login, $j21sid, $j21status;
    $page = mysql_real_escape_string($page);
    if (isset($j21login)) {
        $nowx = time();
        $lastonline = time() - 60 * 60;
        mysql_query("delete from masnun_online where login='{$j21login}' or lastonline < '{$lastonline}' ");
        mysql_query("insert into masnun_online (lastonline,lastlocation,status,login,sessionid) values ('$nowx','$page','$j21status','$j21login','$j21sid')");
    }

}

?>
