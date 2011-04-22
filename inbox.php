<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
require_once 'core.php';
require_once 'format.php';
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
    echo "You are not signed in. Please sign in. <br/><a href=\"index.php\">Home</a><br/> ";
}
else {
    echo "<a href=\"main.php?m=1" . $mysid . "\">[H]</a>";
    echo "<a href=\"inbox.php?view=none" . $mysid . "\">[M]</a>";
    echo "<a href=\"online.php?view=online" . $mysid . "\">[A]</a>";
    echo "<a href=\"forum.php?view=forum" . $mysid . "\">[F]</a>";
    echo "<br/>";

    $view = $_REQUEST['view'];
    switch ($view) {
        case 'all' :
            require_once 'libs/inbox_viewall.php';
            viewall();
            break;
        case 'sent' :
            require_once 'libs/inbox_viewsent.php';
            viewsent();
            break;
        case 'readsent' :
            require_once 'libs/inbox_readsent.php';
            readsent();
            break;
        case 'pm'  :
            require_once 'libs/inbox_readpm.php';
            readpm();
            break;
        case 'sendpm'  :
            require_once 'libs/inbox_sendpm.php';
            sendpm();
            break;
        case 'forward'  :
            require_once 'libs/inbox_forwardpm.php';
            forwardpm();
            break;
        case 'delpm'  :
            require_once 'libs/inbox_delpm.php';
            delpm();
            break;
        case 'newpm'  :
            require_once 'libs/inbox_newpm.php';
            newpm();
            break;
        case 'conv'  :
            require_once 'libs/inbox_conv.php';
            conv();
            break;
        case 'none'  :
            require_once 'libs/inbox_menu.php';
            menu();
            break;
    }
    echo "<a href=\"main.php?m=1" . $mysid . "\">[H]</a>";
    echo "<a href=\"inbox.php?view=none" . $mysid . "\">[M]</a>";
    echo "<a href=\"online.php?view=online" . $mysid . "\">[A]</a>";
    echo "<a href=\"forum.php?view=forum" . $mysid . "\">[F]</a>";
    echo "<br/>";
}
    ?>
</p>
</body>
</html>







