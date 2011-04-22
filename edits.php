<?php require_once 'core.php'; ?>
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
    $view = $_REQUEST['view'];
    switch ($view) {
        case 'etopic' :
            edit_topic();
            break;
        case 'epost' :
            edit_post();
            break;
    }
    ;
}?>
</p>
</body>
</html>
<?php function edit_topic()
{
    global $j21login, $staff, $j21sid, $sessname;

    $topicid = isset($_GET['topicid']) ? $_GET['topicid'] : '0';
    $res = mysql_fetch_assoc(mysql_query("select * from masnun_topic where topicid='{$topicid}'"));
    if ($staff > 0 || $j21login == $res['topicuser']) {
        ?>
    <form action="forum.php" method="POST">
        Topic Title ::: <br/>
        <input name="topictitle" type="text" value="<?php echo $res['topictitle'];?>"/><br/>
        Topic Text ::: <br/>
        <input name="topictext" type="text" value="<?php echo $res['topictext'];?>"/><br/>
        <input type="hidden" name="act" value="edit"/>
        <input type="hidden" name="topicid" value="<?php echo $res['topicid']; ?>"/>
        <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>"/>
        <input type="hidden" name="view" value="topiclist"/>
        <input type="hidden" name="forumid" value="<?php echo $res['forumid']; ?>"/>
        <input type="submit" value="SUBMIT">
    </form>
    <br/>
    <?php

    }
}

?>
<?php function edit_post()
{
    global $j21login, $staff, $j21sid, $sessname;
    $postid = isset($_GET['postid']) ? $_GET['postid'] : '0';
    $res = mysql_fetch_assoc(mysql_query("select * from masnun_post where postid='{$postid}'"));
    $topicid = $res['topicid'];
    if ($staff > 0 || $j21login == $res['postuser']) {
        ?>
    <form action="forum.php" method="POST">
        Message :::<br/>
        <input name="posttext" type="text" value="<?php echo $res['post']; ?>"/><br/>
        <input type="hidden" name="act" value="edit"/>
        <input type="hidden" name="topicid" value="<?php echo $res['topicid']; ?>"/>
        <input type="hidden" name="postid" value="<?php echo $res['postid']; ?>"/>
        <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>"/>
        <input type="hidden" name="view" value="topic"/>
        <input type="submit" value="EDIT">
    </form>
    <br/>
    <?php

    }
}

?>