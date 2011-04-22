<?php
function readpm()
{
    global $j21login, $mysid, $sessname, $j21sid;
    $id = isset($_GET['pmid']) ? $_GET['pmid'] : '';
    $row = mysql_fetch_assoc(mysql_query("select * from masnun_pm where pmid = '{$id}'"));
    if (strtolower(trim($row['tou'])) == $j21login) {
        setOnline('Reading MSG from ' . $row['4mu']);
        mysql_query("update masnun_pm set rustatus='1' where pmid='{$id}'");
        require_once 'newpm.php';
        echo "<a href=\"view_profile.php?user=" . $row['4mu'] . $mysid . "\">" . $row['4mu'] . "</a> ";
        echo "<br/>";
        echo gmstrftime("%c", ($row['date'] + 6 * 60 * 60)) . "<br/>";
        echo "-------<br/>";
        echo format($row['msg']) . "<br/>-------<br/>";?>
    <form action="inbox.php" method="POST">
        <b>Reply:</b><br/>
        <input name="msg" type="text"><br/>
        <input type="submit" value="SEND">
        <input type="hidden" name="tou" value="<?php echo trim($row['4mu']); ?>">
        <input type="hidden" name="view" value="sendpm">
        <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>">
    </form><br/>
    <a href="inbox.php?view=forward&amp;pmid=<?php echo $id . $mysid; ?>">Forward</a>
    <a href="inbox.php?view=delpm&amp;pmid=<?php echo $id . $mysid; ?>">Delete</a><br/>
    <?php
            echo "<a href=\"inbox.php?view=conv&amp;pt=" . $row['4mu'] . $mysid . "\">&#187; Conversation</a><br/>";
    }
    else {
        echo "Error Reading PM<br/>";
    }
    ;
}

?>