<?php
require_once 'core.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $site['name']; ?></title>
</head>
<body>
<p align="left">

<?php
            if (isset($j21login)) {
    require_once 'newpm.php';
}
    ?>

    <br/>
    <b>Site Stats</b><br/>

    <b>Users</b><br/>
    <b>&#187;</b> Total: <a
        href="statsview.php?view=users<?php echo $mysid; ?>"><?php $stat1 = mysql_fetch_assoc(mysql_query("select count(*) uc from masnun_user"));
    echo $stat1['uc']; ?></a><br/>

    <b>&#187;</b>
    Newest: <?php $stat3 = mysql_fetch_assoc(mysql_query("select login from masnun_user order by uid DESC"));
    echo "<a href=\"view_profile.php?user=" . $stat3['login'] . $mysid . "\">" . $stat3['login'] . "</a>"; ?><br/>

    <b>&#187;</b> Most
    Active: <?php $stat2 = mysql_fetch_assoc(mysql_query("select login,points from masnun_user order by points DESC"));
    echo "<a href=\"view_profile.php?user=" . $stat2['login'] . $mysid . "\">" . $stat2['login'] . "</a>";
    echo " (" . $stat2['points'] . ") ";
    ?><a href="statsview.php?view=active<?php echo $mysid; ?>">&#187;</a> <br/>

    <b>&#187;</b> Site Staff: <a
        href="help.php?hw=ss<?php echo $mysid; ?>"><?php $stat3 = mysql_fetch_assoc(mysql_query("select count(*) adminc from masnun_user where staff > 0 "));
    echo $stat3['adminc'];?></a><br/>
    <b>Banning</b><br/>
    <b>&#187;</b> Banned Users: <a
        href="statsview.php?view=banned<?php echo $mysid; ?>"><?php $stat3 = mysql_fetch_assoc(mysql_query("select count(*) adminc from masnun_user where banned > 0 "));
    echo $stat3['adminc'];?><br/></a>

    <b>&#187;</b> Banned User Agents: <a
        href="banned_ua.php?view=ua<?php echo $mysid; ?>"><?php $stat = mysql_fetch_assoc(mysql_query("select count(*) c from masnun_ip"));
    echo $stat['c'];?></a><br/>

    <b>&#187;</b> Shielded Users: <a
        href="statsview.php?view=shielded<?php echo $mysid; ?>"><?php $stat3 = mysql_fetch_assoc(mysql_query("select count(*) adminc from masnun_user where shield ='1' "));
    echo $stat3['adminc'];?></a><br/>
    <b>Forum</b><br/>
    <b>&#187;</b> Boards: <?php $stat = mysql_fetch_assoc(mysql_query("select count(*) c from masnun_forums"));
    echo $stat['c'];?><br/>

    <b>&#187;</b> Topics: <?php $stat = mysql_fetch_assoc(mysql_query("select count(*) c from masnun_topic"));
    echo $stat['c'];?><br/>

    <b>&#187;</b> Replies: <?php $stat = mysql_fetch_assoc(mysql_query("select count(*) c from masnun_post"));
    echo $stat['c'];?><br/>
    <b>Messages</b><br/>
    <b>&#187;</b> Stored: <?php $stat = mysql_fetch_assoc(mysql_query("select count(*) c from masnun_pm"));
    echo $stat['c'];
    $cpm = $stat['c'];
    ?><br/>

    <b>&#187;</b> All
    Time: <?php $stat = mysql_fetch_assoc(mysql_query("select pmid from masnun_pm order by pmid DESC"));
    echo $stat['pmid'];?><br/>

    <b>&#187;</b> Deleted: <?php echo $stat['pmid'] - $cpm;?><br/>

    <br/>

    <?php if (isset($j21login)) {
    echo "<a href=\"main.php?m=1" . $mysid . "\">Home</a><br/>";
} else {
    echo "<a href=\"index.php\">Home</a><br/><br/>";
} ?>
</p>
</body>
</html>