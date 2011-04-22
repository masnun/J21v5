<?php
function newpm()
{
    global $sessname, $j21sid, $j21login, $mysid;
    setOnline("Writing Message");

    require_once 'newpm.php';
    ?>
<b>Send PM</b><br/>
<small>Send to multiple users by separating the usernames with comma.</small><br/>
<form action="inbox.php" method="POST">
    <b>To:</b><br/>
    <input name="tou" type="text"><br/>
    <b>Message:</b><br/>
    <input name="msg" type="text">
    <br/>
    <input type="submit" value="SEND">
    <input type="hidden" name="view" value="sendpm"/>
    <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>"/>
</form><br/>
<?php    ;
}

?>