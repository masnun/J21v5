<?php
require_once 'core.php';
require_once 'format.php';
$view = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'none'; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $site['name']; ?></title>
</head>
<body>
<p align="left">
    <?php if (!isset($j21login)) {
    echo "You are not signed in. Please login.<br/><a href=\"index.php\">Home</a><br/>";
}
else {

    require_once "newpm.php";

    if ($view == 'scraps') {
        extract($_GET);
        if (empty($page)) {
            $page = 1;
        }
        $start = ($page - 1) * 7;
        if (isset($_POST['msg'])) {
            $msg = $_POST['msg'];
            $time = time();
            if (mysql_query("insert into masnun_comments (4mu,tou,date,msg) values ('{$j21login}','{$j21_member}','{$time}','{$msg}')")) {
                echo "Comment Added!<br/>";
            }
        }
        if (isset($del)) {
            if (mysql_query("delete from masnun_comments where id='{$del}'")) {
                echo "Comment deleted!<br/>";
            }
        }

        $q = mysql_query("select * from masnun_comments where tou='{$j21_member}' order by id DESC limit {$start},7");
        while ($row = mysql_fetch_assoc($q)) {
            echo "<a href=\"view_profile.php?user=" . $row['4mu'] . $mysid . "\">" . $row['4mu'] . "</a>: <br/>";
            echo format($row['msg']);
            echo "<br/>";
            echo gmstrftime("%B %d,%Y - %I:%M %p ", $row['date']);
            if ($row['4mu'] == $j21login || $row['tou'] == $j21login) {
                echo " <a href=\"comments.php?view=scraps&amp;j21_member={$j21_member}&amp;del=" . $row['id'] . $mysid . "\">[X]</a>";
            }
            echo "<br/><br/>";
        }
        $t = mysql_fetch_assoc(mysql_query("select count(*) n from masnun_comments where tou='{$j21_member}'"));
        $total_page = getPage($t['n'], '7');
        echo "<b>Comments:</b> " . $t['n'] . "<br/>";
        echo  "<a href=\"comments.php?view=add&amp;j21_member={$j21_member}{$mysid}\">Add Message</a><br/>";
        if ($page > 1) {
            echo "<a href=\"comments.php?view=scraps&amp;j21_member={$j21_member}&amp;page=" . ($page - 1) . $mysid . "\">&#171; Prev</a>";
        }

        echo "({$page}/{$total_page}";

        if ($page < $total_page) {
            echo "<a href=\"comments.php?view=scraps&amp;j21_member={$j21_member}&amp;page=" . ($page + 1) . $mysid . "\">Next &#187;</a>";
        }
        echo "<br/>";

    }

    if ($view == "add") {
        extract($_GET);
        echo"<form action=\"comments.php?j21_member={$j21_member}&amp;view=scraps{$mysid}\" method=\"post\">
                <b>Comments: </b><br/>
                <input type=\"text\" name=\"msg\"/><br/>
                <input type=\"Submit\" value=\"Post\">
                <br/>
                </form>";

    }

    echo
    "<br/><a href=\"view_profile.php?user={$j21_member}{$mysid}\">&#171; Back</a><br/>
            <a href=\"main.php?m=1$mysid\">HOME</a><br/> ";
    setOnline('User Reviews');

}?>

</p>
</body>
</html>