<?php
require_once 'core.php';
require_once 'format.php';
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
    echo "You are not signed in. Please sign in. <br/><a href=\"index.php\">Home</a><br/>  ";
}
else {
    include("newpm.php");
    $puser = isset($_REQUEST['user']) ? $_REQUEST['user'] : $masnun;
    $puser = trim($puser);
    setOnline("Profile: [user=" . $puser . "]" . $puser . "[/user]");

    if ($puser == 'SPY') {
        echo "Automated Bot!";
    } else {
        $is_user = mysql_fetch_assoc(mysql_query("select count(login) c from masnun_user where login='$puser'"));
        if ($is_user['c'] > 0) {
            $it = isset($_REQUEST['it']) ? $_REQUEST['it'] : "";
            if (empty($it)) {
                echo "Profile of <b>$puser</b><br/>";
                echo "<form action=\"inbox.php\" method=\"post\">
                                <input name=\"msg\" type=\"text\">
                                <br/>
                                <input type=\"submit\" value=\"SEND PM\">
                                <input type=\"hidden\" name=\"tou\" value=\"$puser\">
                                <input type=\"hidden\" name=\"view\" value=\"sendpm\">
                                <input type=\"hidden\" name=\"$sessname\" value=\"$j21sid\">
                                </form><br/><br/>";
                $s = mysql_fetch_assoc(mysql_query("select count(*) c from masnun_comments where tou='$puser'"));
                $sc = $s['c'];
                echo "<a href=\"extprofile.php?it=yap&amp;user=$puser$mysid\">&#187; View Profile</a><br/>";
                echo "<a href=\"view_profile.php?it=yap&amp;user=$puser$mysid\">&#187; More Details</a><br/>";
                echo "<a href=\"comments.php?view=scraps&amp;j21_member=$puser$mysid\">&#187; Reviews ($sc)</a><br/>";

                echo "<br/><a href=\"main.php?m=1$mysid\">Home</a><br/>";
            } else {

                $data = mysql_fetch_assoc(mysql_query("select * from masnun_user where login ='$puser'"));
                echo "Profile of <b>" . $puser . "</b><br/>";
                echo"-----<br/>";
                $puser = strtolower($puser);
                echo "<b>UID :::</b> " . $data['uid'] . "<br/>";
                if ($data['staff'] > 0) {
                    echo "<b>--Site Staff--</b><br/>";
                }
                if ($data['banned'] > 0) {
                    echo "<b>-Banned-</b><br/>";
                }
                echo "<b>Member Level :::</b> ";
                $rank = ceil($data['points'] / 500);
                if ($rank == 0) {
                    $rank = 1;
                }
                echo "( $rank ) <br/>";
                echo "<img src=\"img.php?url=" . $data['photo'] . "\" alt=\"photo\"/><br/>";
                echo "<b>Signature :::</b> " . format($data['status']) . "<br/>";
                echo "<b>Points :::</b> " . $data['points'] . "<br/>";
                $fdata = mysql_fetch_assoc(mysql_query("select count(topictitle) value from masnun_topic where topicuser='$puser'"));
                echo "<b>Topics ::: </b><a href=\"statsview.php?userx=$puser&amp;view=topic$mysid\">[" . $fdata['value'] . "]</a><br/>";
                $fdata = mysql_fetch_assoc(mysql_query("select count(post) value from masnun_post where postuser='$puser'"));
                echo "<b>Posts ::: </b><a href=\"statsview.php?userx=$puser&amp;view=post$mysid\">[" . $fdata['value'] . "]</a><br/>";
                if ($staff > 0 || $j21login == $puser) {
                    echo "<b>Last UA ::: </b> " . $data['ua'] . " <a href=\"statsview.php?view=ua$mysid&amp;ua=" . $data['ua'] . "\">[=]</a><br/>";
                }
                else {
                    echo "<b>Last UA ::: </b> (Private)<br/>";
                }
                echo "<b>Shield ::: </b> ";
                if ($data['shield'] == '1') {
                    echo "Active";
                } else {
                    echo "Disabled";
                }
                echo"<br/>";
                echo"-----<br/>";
                ?>
                <a href="inbox.php?view=conv&amp;pt=<?php echo $puser . $mysid ?>">&#187; Conversation</a><br/>
                <a href="extprofile.php?view=full<?php echo $mysid; ?>&amp;user=<?php echo $puser; ?>">&#187; Basic
                    Profile</a><br/>
                <?php if ($staff > 0 || $j21login == $owner['login']) { ?>
                    <a href="user_act.php?uid=<?php echo $data['uid'] . $mysid; ?>">&#187; Moderate User</a><br/>
                    <?php ;
                }?>
                <br/>
                <a href="main.php?m=1<?php echo $mysid; ?>">Home</a>
                <?php   ;
            } ?><?php ;
        } else {
            echo "User Does Not Exist";
        }
    }

}
    ?>

</p>
</body>
</html>