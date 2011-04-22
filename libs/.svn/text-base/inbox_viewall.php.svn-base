<?php
function viewall()
{
    global $j21login, $mysid, $sessname, $j21sid;
    require_once 'functions.php';
    setOnline("MSG: Inbox");
    require_once 'newpm.php';
    ?>
<b>Inbox</b><br/>
<?php

    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_pm where tou = '{$j21login}' "));
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
    $results = mysql_query("select * from masnun_pm where tou = '{$j21login}' order by rustatus, pmid DESC limit {$start},7");
    $newstrt = $start + 7;
    while ($row = mysql_fetch_assoc($results)) {
        if ($row['rustatus'] == '0') {
            echo "<b>+</b>";
        } else {
            echo "-";
        }
        echo " <a href=\"inbox.php?view=pm&amp;pmid=" . $row['pmid'] . $mysid . "\">" . $row['4mu'] . "</a><br/>";
    }
    if ($count['value'] < 1) {
        echo "There are no messages in your Inbox.<br />";
    }
    echo "-------<br/>";
    $mypage = getPage($count['value'], '7');
    if ($start == '7' || $start > 7) {
        $prevstrt = $start - 7;
        echo "<a href=\"inbox.php?view=all&amp;start=" . $prevstrt . $mysid . "\">&#171; Prev</a>";
    }
    echo " (" . (($start / 7) + 1) . "/$mypage) ";
    if ($count['value'] > $newstrt) {
        echo "<a href=\"inbox.php?view=all&amp;start=" . $newstrt . $mysid . "\">Next &#187;</a>";
    }
    ?><br/>
<form action="inbox.php" method="POST">
    Jump:
    <input name="fstart" type="text" maxlength="3" size="6">
    <input type="submit" value="GO">
    <input type="hidden" name="view" value="all"/>
    <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>"/>
</form>
<?php ;
}

?>
