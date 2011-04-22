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
    <title><?php echo $site['name'];?></title>
</head>
<body>
<p align="left">
    <?php                       if (!isset($j21login)) {
    echo "You are not signed in. Please sign in.<br/><a href=\"index.php\">Home</a><br/>";
}
else {
    require_once 'format.php';
    require_once 'newpm.php';
    $view = $_REQUEST['view'];
    switch ($view) {
        case 'forum' :
            require_once 'libs/forum_boards.php';
            view_boards();
            break;
        case 'topiclist' :
            require_once 'libs/forum_topiclist.php';
            view_topiclist();
            break;
        case 'topic' :
            require_once 'libs/forum_viewtopic.php';
            viewtopic();
            break;
        case 'forummod' :
            require_once 'libs/forum_cp.php';
            viewforumcp();
            break;
        case 'newtopic' :
            require_once 'libs/forum_newtopic.php';
            newtopic();
            break;
        case 'movetopic' :
            require_once 'libs/forum_movetopic.php';
            movetopic();
            break;
        case 'viewpost' :
            require_once 'libs/forum_viewpost.php';
            viewpost();
            break;
        case 'active' :
            require_once 'libs/forum_viewactive.php';
            viewactive();
            break;
    }

    echo "<a href=\"main.php?m=1" . $mysid . "\">Home</a> &nbsp;";
    echo "<a href=\"inbox.php?view=none" . $mysid . "\">Messages</a> &nbsp;";
    echo "<a href=\"online.php?view=online" . $mysid . "\">Users</a> &nbsp;";
    echo "<a href=\"forum.php?view=forum" . $mysid . "\">Forum</a> &nbsp;";
    echo "<br/>";

}
    ?>
</p>
</body>
</html>