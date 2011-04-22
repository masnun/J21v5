<?php
function menu()
{
    global $mysid, $j21login;
    setOnline("MSG Menu");
    require_once 'newpm.php';
    echo "<b>MSG Menu</b><br/>";?>
&#187; <a href="inbox.php?view=newpm<?php echo $mysid; ?>">Write</a><br/>
&#187; <a href="inbox.php?view=all<?php echo $mysid ?>">Inbox</a> <?php if ($unreadpm > 0) {
    echo "($unreadpm)";
}?>
<br/>
&#187; <a href="inbox.php?view=sent<?php echo $mysid ?>">Sent</a><br/>
<?php } ?>