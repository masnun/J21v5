<?php require_once 'core.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $site['name']; ?></title>
</head>
<body>
<p align="left">
<?php
            if (!isset($j21login)) {
    echo "You are not signed in. Please sign in. <br/><a href=\"index.php\">Home</a><br/>  ";
}
else {
    if ($j21login == $owner['login']) {
        if (isset($_REQUEST['act'])) {
            $act = $_REQUEST['act'];
            if ($act == 'update') {
                $welcomemsg = $_REQUEST['welcomemsg'];
                mysql_query("update masnun_settings set value = '{$welcomemsg}' where name='msg' ");
                echo "Site Settings Updated<br/>";
                $pmdlt = $_REQUEST['pmdlt'];
                if (strtolower($pmdlt) == 'read') {
                    mysql_query("delete from masnun_pm where rustatus='1'");
                    echo "READ PMs deleted<br/>";
                }
                if (strtolower($pmdlt) == 'spy') {
                    mysql_query("delete from masnun_pm where lower(4mu)='spy'");
                    echo "SPY Pms Deleted<br/>";
                }
                if (strtolower($pmdlt) == 'all') {
                    mysql_query("delete from masnun_pm");
                    echo "ALL PMs deleted<br/>";
                }
            }
        }

        require_once "newpm.php";
        ?>

    <form action="owner_cp.php" method="POST">
        <b>Welcome Message</b><br/>
        <small>This message is displayed on the Main Menu, just below the site title.</small>
        <br/>
        <input name="welcomemsg" type="text">
        <br/><b>Delete PMs</b><br/>
        ALL | Read | SPY <br/>
        <input name="pmdlt" type="text" value="None">
        <br/>
        <input type="submit" value="UPDATE">
        <input type="hidden" name="act" value="update"/>
        <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>"/>
    </form>

    <a href="main.php?m=1<?php echo $mysid; ?>">Home</a>
        <?php

    }
}
?>
</p>
</body>
</html>
