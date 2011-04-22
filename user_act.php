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
<?php if (!isset($j21login)) {
    echo "You are not signed in. Please sign in. <br/><a href=\"index.php\">Home</a><br/>  ";
}
else {
    $uid = isset($_GET['uid']) ? $_GET['uid'] : '0';
    $data['uid'] = $uid;
    $ur = mysql_fetch_assoc(mysql_query("select * from masnun_user where uid='$uid'"));
    echo "Moderate ::: <b>" . $ur['login'] . "</b><br/>";
    ?>
    <?php if ($staff > 0 || $j21login == $owner['login']) { ?>
        <a href="usermod.php?act=ban&amp;uid=<?php echo $data['uid']; ?><?php echo $mysid; ?>">Ban User</a><br/>
        <a href="usermod.php?act=banua&amp;uid=<?php echo $data['uid']; ?><?php echo $mysid; ?>">Ban User Agent</a><br/>
        <a href="usermod.php?act=shield&amp;uid=<?php echo $data['uid']; ?><?php echo $mysid; ?>">Shield User</a><br/>
        <a href="usermod.php?act=unshield&amp;uid=<?php echo $data['uid']; ?><?php echo $mysid; ?>">Remove Shield</a>
        <br/>
        <a href="usermod.php?act=deltop&amp;uid=<?php echo $data['uid']; ?><?php echo $mysid; ?>">Delete All Topics</a>
        <br/>
        <a href="usermod.php?act=delpost&amp;uid=<?php echo $data['uid']; ?><?php echo $mysid; ?>">Delete All Posts</a>
        <br/>

        <?php if ($j21login == $owner['login']) { ?>
            <a href="usermod.php?act=del&amp;uid=<?php echo $data['uid']; ?><?php echo $mysid; ?>">Delete User</a><br/>
            <a href="usermod.php?act=mod&amp;uid=<?php echo $data['uid']; ?><?php echo $mysid; ?>">Make Mod</a><br/>
            <?php ;
        }?>
        <a href="usermod.php?act=reset&amp;uid=<?php echo $data['uid']; ?><?php echo $mysid; ?>">Reset Status</a><br/>
    <form action="usermod.php" method="GET">
        <br/>
        <b>Points :::</b><br/>
        <input name="ap" type="text"/><br/>
        <select name="act">
            <option value="add">ADD</option>
            <option value="sub">SUB</option>
        </select>
        <input type="hidden" name="uid" value="<?php echo $data['uid']; ?>">
        <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>">
        <input type="submit" value="SUBMIT">
    </form>
    <br/>
        <?php ;
    }?>
<a href="main.php?m=1<?php echo $mysid; ?>">Home</a><br/>
    <?php ;
}?>
</p>
</body>
</html>