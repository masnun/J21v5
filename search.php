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
<?php
            if (!isset($j21login)) {
    echo "You are not signed in <br/><a href=\"index.php\">[= Back =]</a><br/>  ";
}
else {
    echo "<a href=\"main.php?m=1" . $mysid . "\">[H]</a>";
    echo "<a href=\"inbox.php?view=none" . $mysid . "\">[M]</a>";
    echo "<a href=\"online.php?view=online" . $mysid . "\">[A]</a>";
    echo "<a href=\"forum.php?view=forum" . $mysid . "\">[F]</a>";
    echo "<br/>";
    include("newpm.php");
    setOnline('Search Zone');

    $what = isset($_REQUEST['what']) ? $_REQUEST['what'] : 'pm';

    switch ($what) {
        case 'search' :
            require_once 'libs/search_search.php';
            search();
            break;

        case 'pm' :
            require_once 'libs/search_pm.php';
            searchpm();
            break;
        case 'topic' :
            require_once 'libs/search_topic.php';
            searchtopic();
            break;
        case 'post' :
            require_once 'libs/search_posts.php';
            searchposts();
            break;
        case 'user' :
            require_once 'libs/search_users.php';
            searchusers();
            break;
    }
}
    ?>
</p>
</body>
</html>