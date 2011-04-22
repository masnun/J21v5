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
    <title><?php echo $site; ?></title>
</head>
<body>
<p align="left">
<?php
            if (!isset($j21login)) {
    echo "You are not signed in. Please login. <br/><a href=\"index.php\">Home</a><br/>";
}
else {
    if ($j21login == $owner['login']) {
        $act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';

        if ($act == 'del') {
            $fid = $_GET['uid'];
            mysql_query("delete from masnun_ip where uid='{$fid}'");
            echo "IP released<br/><br/>";
        }
    }


    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    $newstrt = $start + 7;
    $prevstrt = $start - 7;
    $results = mysql_query("select * from masnun_ip order by uid DESC limit {$start},7");
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_ip"));
    echo "<b>Banned UA</b><br/>";
    echo $count['value'] . " UA(s) are banned <br/>";
    while ($f = mysql_fetch_assoc($results)) {
        echo "<b>&#187;</b> " . $f['ua'];
        echo "<br/>";
        if ($staff > 0) {
            echo "<a href=\"banned_ua.php?act=del&amp;uid=" . $f['uid'] . $mysid . "\">[X]</a><br/>";
        }
    }
    echo "<br/>";
    if ($start == 7 || $start > 7) {
        echo "<a href=\"banned_ua.php?what=ua&amp;start=" . $prevstrt . $mysid . "\">&#171; Prev</a>";
    }
    echo "  ";
    if ($count['value'] > $newstrt) {
        echo "<a href=\"banned_ua.php?what=ua&amp;start=" . $newstrt . $mysid . "\">Next &#187;</a>";
    }
    echo "<br/><br/>";
    ?>

    <a href="main.php?m=1<?php echo $mysid; ?>">Home</a>
    <?php

}?>
</p>
</body>
</html>
