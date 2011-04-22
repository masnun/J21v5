<?php
require_once 'core.php';
require_once 'format.php';
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
            if (!isset($j21login)) {
    echo "You are not signed in. Please sign in.<br/><a href=\"index.php\">Home</a><br/> ";
}
else {
    $view = $_REQUEST['view'];
    include("newpm.php");
    switch ($view) {
        case 'users' :
            viewusers();
            break;
        case 'banned' :
            viewbanned();
            break;
        case 'shielded' :
            viewshielded();
            break;
        case 'ua' :
            viewua();
            break;
        case 'active' :
            viewactive();
            break;
        case 'topic' :
            viewtopic();
            break;
        case 'post' :
            viewpost();
            break;
    }
}
?>

<?php
            function viewusers()
{
    global $sessname, $j21sid, $mysid;
    setOnline('All Users List');
    echo "<b>All Users</b><hr/>";
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_user"));
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    if (isset($_POST['fstart'])) {
        $fstart = $_POST['fstart'];
        if ($fstart > getPage($count['value'], '10')) {
            $fstart = getPage($count['value'], '10');
        }
        if ($fstart < 1) {
            $fstart = 1;
        }
        $fstart = $fstart - 1;
        $start = $fstart * 10;
    }
    $newstart = $start + 10;
    $prevstart = $start - 10;
    $rs = mysql_query("select * from masnun_user order by uid DESC limit {$start},10 ");
    $pgcount = "0";
    while ($rd = mysql_fetch_assoc($rs)) {
        echo "<a href=\"view_profile.php?user=" . $rd['login'] . $mysid . "\">" . $rd['login'] . "</a>(" . $rd['status'] . ")<br/>";
        $pgcount = $pgcount + 1;
    }
    $mytpage = getPage($count['value'], 10);
    echo "<hr/>";
    if ($start == '10' || $start > 10) {
        echo "<a href=\"statsview.php?view=users&amp;start={$prevstart}{$mysid}\">&#171; Prev</a>";
    }
    echo " (" . (($start / 10) + 1) . "/$mytpage) ";
    if ($count['value'] > $newstart) {
        echo "<a href=\"statsview.php?view=users&amp;start={$newstart}{$mysid}\">Next &#187;</a>";
    }
    echo "<br/>";
    ?>
<form action="statsview.php" method="POST">
    Jump:
    <input name="fstart" type="text" maxlength="3" size="6">
    <input type="submit" value="GO">
    <input type="hidden" name="view" value="users"/>
    <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>"/>
</form>
<br/>
    <?php
                echo "<a href=\"main.php?m=1{$mysid}\">Home</a><br/>";
}?>
<?php
        function viewactive()
{
    global $sessname, $j21sid, $mysid;
    setOnline('Active Users List');

    echo "<b>Active Users</b><hr/>";
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_user"));
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    $newstart = $start + 7;
    $prevstart = $start - 7;
    $rs = mysql_query("select * from masnun_user order by points DESC limit {$start},7 ");
    while ($rd = mysql_fetch_assoc($rs)) {
        echo "<a href=\"view_profile.php?user=" . $rd['login'] . $mysid . "\">" . $rd['login'] . "</a>(" . format($rd['status']) . ") [" . $rd['points'] . "] <br/>";
    }
    echo "<br/>";
    if ($count['value'] > $newstart) {
        echo "<a href=\"statsview.php?view=active&amp;start={$newstart}{$mysid}\">Next &#187;</a>";
    }
    if ($start == '7' || $start > 7) {
        echo "<a href=\"statsview.php?view=active&amp;start={$prevstart}{$mysid}\">&#171; Prev</a>";
    }
    echo "<br/>";
    echo "<a href=\"main.php?m=1{$mysid}\">Home</a><br/>";
}?>
<?php
        function viewbanned()
{
    global $sessname, $j21sid, $mysid;
    setOnline('Banned Users List');

    echo "<b>Banned Users</b><hr/>";
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_user where banned > 0"));
    echo "Banned Users ::: [" . $count['value'] . "] <br/><br/>";
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    $newstart = $start + 7;
    $prevstart = $start - 7;
    $rs = mysql_query("select * from masnun_user where banned > 0 order by uid DESC limit {$start},7 ");
    while ($rd = mysql_fetch_assoc($rs)) {
        echo "[" . $rd['uid'] . "] ::: <a href=\"view_profile.php?user=" . $rd['login'] . $mysid . "\">" . $rd['login'] . "</a>(" . $rd['status'] . ")<br/>";
    }
    echo "<br/>";
    if ($start == '7' || $start > 7) {
        echo "<a href=\"statsview.php?view=banned&amp;start={$prevstart}{$mysid}\">&#171; Prev</a>&nbsp;";
    }
    if ($count['value'] > $newstart) {
        echo "<a href=\"statsview.php?view=banned&amp;start={$newstart}{$mysid}\">Next &#187;</a>";
    }

    echo "<br/>";
    echo "<a href=\"main.php?m=1{$mysid}\">Home</a><br/>";
}?>
<?php
        function viewshielded()
{
    global $sessname, $j21sid, $mysid;
    setOnline('Shielded Users List');

    echo "<b>Shielded Users</b><hr/>";
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_user where shield='1'"));
    echo "Shielded Users ::: [" . $count['value'] . "] <br/><br/>";
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    $newstart = $start + 7;
    $prevstart = $start - 7;
    $rs = mysql_query("select * from masnun_user where shield='1' order by uid DESC limit $start,7 ");
    while ($rd = mysql_fetch_assoc($rs)) {
        echo "[" . $rd['uid'] . "] ::: <a href=\"view_profile.php?user=" . $rd['login'] . $mysid . "\">" . $rd['login'] . "</a>(" . $rd['status'] . ")<br/>";
    }
    echo "<br/>";
    if ($start == '7' || $start > 7) {
        echo "<a href=\"statsview.php?view=shielded&amp;start={$prevstart}{$mysid}\">&#171; Prev</a>&nbsp;";
    }
    if ($count['value'] > $newstart) {
        echo "<a href=\"statsview.php?view=shielded&amp;start={$newstart}{$mysid}\">Next &#187;</a>";
    }

    echo "<br/>";
    echo "<a href=\"main.php?m=1{$mysid}\">Home</a><br/>";
}?>
<?php
        function viewua()
{
    global $sessname, $j21sid, $mysid;
    setOnline('UA Match');

    $ua = isset($_GET['ua']) ? $_GET['ua'] : '';
    echo "<b>Match UA</b><br/>";
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_user where ua='{$ua}'"));
    echo "Matches ::: [" . $count['value'] . "] <br/><br/>";
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    $newstart = $start + 7;
    $prevstart = $start - 7;
    $rs = mysql_query("select * from masnun_user where ua='{$ua}' limit {$start},7 ");
    while ($rd = mysql_fetch_assoc($rs)) {
        echo "[" . $rd['uid'] . "] ::: <a href=\"view_profile.php?user=" . $rd['login'] . $mysid . "\">" . $rd['login'] . "</a>(" . $rd['status'] . ")<br/>";
    }
    echo "<br/>";

    $ua = urlencode($ua);

    if ($start == '7' || $start > 7) {
        echo "<a href=\"statsview.php?view=ua&amp;ua={$ua}&amp;start={$prevstart}{$mysid}\">&#171 Prev</a>&nbsp;";
    }
    if ($count['value'] > $newstart) {
        echo "<a href=\"statsview.php?view=ua&amp;ua={$ua}&amp;start={$newstart}{$mysid}\">Next &#187;</a>";
    }
    echo "<br/><br/>";
    echo "<a href=\"main.php?m=1{$mysid}\">Home</a><br/>";
}?>
<?php
        function viewtopic()
{
    global $sessname, $j21sid, $mysid;
    $userX = $_REQUEST['userx'];
    setOnline('Topics by [user=' . $userX . ']' . $userX . '[/user]');

    echo "<b>Topics by {$userX} </b><br/>";
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_topic where topicuser='$userX'"));
    echo "Total Topics ::: [" . $count['value'] . "] <br/><br/>";
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    if (isset($_POST['fstart'])) {
        $fstart = $_POST['fstart'];
        if ($fstart > getPage($count['value'], '10')) {
            $fstart = getPage($count['value'], '10');
        }
        if ($fstart < 1) {
            $fstart = 1;
        }
        $fstart = $fstart - 1;
        $start = $fstart * 10;
    }
    $newstart = $start + 10;
    $prevstart = $start - 10;
    $rs = mysql_query("select * from masnun_topic where topicuser='$userX' order by topicid DESC limit $start,10 ");
    $pgcount = "0";
    while ($rd = mysql_fetch_assoc($rs)) {
        echo "<a href=\"forum.php?view=topic&amp;topicid=" . $rd['topicid'] . $mysid . "\">" . $rd['topictitle'] . "</a><br/>";
        $pgcount = $pgcount + 1;
    }
    echo "<br/>-----------<br/>";
    if ($start == '10' || $start > 10) {
        echo "<a href=\"statsview.php?userx={$userX}&amp;view=topic&amp;start={$prevstart}{$mysid}\">&#171; Prev</a>";
    }
    $mypage = getPage($count['value'], '10');
    echo " (" . (($start / 10) + 1) . "/$mypage) ";
    if ($count['value'] > $newstart) {
        echo "<a href=\"statsview.php?userx={$userX}&amp;view=topic&amp;start={$newstart}{$mysid}\">Next &#187;</a>";
    }
    echo "<br/>";
    ?>
<form action="statsview.php" method="POST">
    Jump:
    <input name="fstart" type="text" maxlength="3" size="6">
    <input type="submit" value="GO">
    <input type="hidden" name="view" value="topic"/>
    <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>"/>
    <input type="hidden" name="userx" value="<?php echo $userX; ?>"/>
</form>
<br/>
    <?php echo "<a href=\"main.php?m=1{$mysid}\">Home</a><br/>";
}?>

<?php
        function viewpost()
{
    global $sessname, $j21sid, $mysid;
    $userX = $_REQUEST['userx'];
    setOnline("Posts by [user=$userX]" . $userX . "[/user]");

    echo "<b>Posts by $userX </b><br/>";
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_post where postuser='$userX'"));
    echo "Total Posts ::: [" . $count['value'] . "] <br/><br/>";
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    if (isset($_POST['fstart'])) {
        $fstart = $_POST['fstart'];
        if ($fstart > getPage($count['value'], '10')) {
            $fstart = getPage($count['value'], '10');
        }
        if ($fstart < 1) {
            $fstart = 1;
        }
        $fstart = $fstart - 1;
        $start = $fstart * 10;
    }
    $newstart = $start + 10;
    $prevstart = $start - 10;
    $rs = mysql_query("select * from masnun_post where postuser='$userX' order by postid DESC limit $start,10 ");
    $pgcount = "0";
    while ($rd = mysql_fetch_assoc($rs)) {
        echo "<a href=\"forum.php?view=viewpost&amp;postid=" . $rd['postid'] . $mysid . "\">" . substr($rd['post'], 0, 7) . "...</a><br/>";
        $pgcount = $pgcount + 1;
    }
    echo "<br/>-----------<br/>";
    $mypage = getPage($count['value'], '10');
    echo "Page ::" . (($start / 10) + 1) . " / $mypage <br/>";
    if ($count['value'] == '0') {
        $start = -1;
        $pgcount = 1;
    }
    echo ($start + 1) . '-' . ($start + $pgcount) . ' of ' . $count['value'] . '<br/>';
    echo "-----------<br/>"; ?>

<form action="statsview.php" method="POST">
    Page:
    <input name="fstart" type="text" maxlength="3">
    <input type="submit" value="GO">
    <input type="hidden" name="view" value="post"/>
    <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>"/>
    <input type="hidden" name="userx" value="<?php echo $userX; ?>"/>
</form>
<br/>
    <?php
                if ($count['value'] > $newstart) {
    echo "<a href=\"statsview.php?userx=$userX&amp;view=post&amp;start=$newstart$mysid\">Next &#187;</a>";
}
    if ($start == '10' || $start > 10) {
        echo "<a href=\"statsview.php?userx=$userX&amp;view=post&amp;start=$prevstart$mysid\">&#171; Prev</a>";
    }
    echo "<br/>";
    echo "<a href=\"main.php?m=1$mysid\">Home</a><br/>";
}?>
</p>
</body>
</html>