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
    echo "<a href=\"main.php?m=1" . $mysid . "\">[H]</a>";
    echo "<a href=\"inbox.php?view=none" . $mysid . "\">[M]</a>";
    echo "<a href=\"online.php?view=online" . $mysid . "\">[A]</a>";
    echo "<a href=\"forum.php?view=forum" . $mysid . "\">[F]</a>";
    echo "<br/>";
    include("newpm.php");
    setOnline("Today\'s Active Members List");

    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_online"));
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    if (isset($_POST['fstart'])) {
        $fstart = $_POST['fstart'];
        if ($fstart > getPage($count['value'], '7')) {
            $fstart = getPage($count['value'], '7');
        }
        if ($fstart < 1) {
            $fstart = 1;
        }
        $fstart = $fstart - 1;
        $start = $fstart * 7;
    }
    $newstrt = $start + 7;
    $results = mysql_query("select * from masnun_online order by lastonline DESC limit {$start},7 ");
    $pgcount = '0';
    echo "<hr />";
    echo "<a href=\"view_profile.php?user=" . "SPY" . $mysid . "\">" . "SPY" . "</a> is active :-) " . '<hr />';
    while ($online = mysql_fetch_assoc($results)) {
        echo "<a href=\"view_profile.php?user=" . $online['login'] . $mysid . "\">" . $online['login'] . "</a> ";
        echo "<small>(" . format($online['status']) . ")</small> <br /> ";
        echo format($online['lastlocation']) . '<hr/> ';
        $pgcount = $pgcount + 1;
    }

    echo '<br/>';
    if ($count['value'] == '0') {
        $start = -1;
        $pgcount = 1;
    }
    if ($start == 7 || $start > 7) {
        $prevstrt = $start - 7;
        echo "<a href=\"online.php?view=online&amp;start=" . $prevstrt . $mysid . "\">&#171; Prev</a> ";
    }
    echo "(" . (($start / 7) + 1) . "/" . getPage($count['value'], 7) . ")";
    if ($count['value'] > $newstrt) {
        echo " <a href=\"online.php?view=online&amp;start=" . $newstrt . $mysid . "\">Next &#187;</a> ";
    }
    ?>
    <br/>
<form action="online.php" method="POST">
    Jump:<input name="fstart" type="text" maxlength="3" size="6">
    <input type="submit" value="GO">
    <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>">
</form>
    <?php
}
echo "<br/>";
echo "<a href=\"main.php?m=1" . $mysid . "\">Home</a> ";
echo "<a href=\"inbox.php?view=none" . $mysid . "\">MSG</a> ";
echo "<a href=\"forum.php?view=forum" . $mysid . "\">Forum</a> ";
echo "<a href=\"online.php?view=online" . $mysid . "\">Active</a> ";
echo "<a href=\"search.php?what=search" . $mysid . "\">Search</a><br/> ";
?>
</p>
</body>
</html>