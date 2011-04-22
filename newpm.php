<?php
$pmrow = mysql_fetch_assoc(mysql_query("select count(*) pm from masnun_pm where tou = '{$j21login}' and rustatus ='0'"));
if ($pmrow['pm'] > 0) {
    echo $pmrow['pm'] . " new MSGs:<br/> ";
    echo "<a href=\"inbox.php?view=all" . $mysid . "\">Inbox</a>";
}
$unreadpm = $pmrow['pm'];
if ($unreadpm > 0) {
    $nxtpmr = mysql_fetch_assoc(mysql_query("select pmid from masnun_pm where tou='{$j21login}' and rustatus='0'"));
    $nextpm = $nxtpmr['pmid'];
    echo " | <a href=\"inbox.php?view=pm&amp;pmid={$nextpm}{$mysid}\">Read</a><br/>";
}

require_once "ads.php";
echo "<br/>";
//include 'altads.php';
?>

