<?php
function forwardpm()
{
    global $j21login, $mysid, $sessname, $j21sid;
    setOnline('Forwarding MSG');
    require_once 'newpm.php';

    $id = isset($_GET['pmid']) ? $_GET['pmid'] : '';
    $row = mysql_fetch_assoc(mysql_query("select * from masnun_pm where pmid = '{$id}'"));
    $msg = "[br/]-------[br/]Forwarded MSG[br/]-------[br/]To: " . $row['tou'] . "[br/]From:" . $row['4mu'] . "[br/]Date: " . $row['date'] . "[br/][br/]" . $row['msg'];
    ?>
<b>Forward PM</b><br/>
<form action="inbox.php" method="POST">
    Forward to:<br/>
    <input name="tou" type="text"><br/>
    <input type="submit" value="FORWARD">
    <input type="hidden" name="msg" value="<?php echo $msg ?>"/>
    <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>"/>
    <input type="hidden" name="view" value="sendpm"/>
</form>
<br/>
<?php ;
}

?>