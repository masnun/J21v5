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
<p align="center">

    <?php if (!isset($j21login)) {
    echo "You are not signed in <br/><a href=\"index.php\">[= Back =]</a><br/>  ";
}
else {
    include("newpm.php");
    $act = $_REQUEST['act'];
    $uid = $_REQUEST['uid'];
    if ($uid == '1') {
        echo " You can not mod the owner <br/>";
        echo "You will be punished";
        $cs = md5(time());
        mysql_query("update masnun_user set ts='{$cs}' where login='{$j21login}'");

    }
    else {
        if ($staff > 0) {
            if ($act == 'ban') {
                mysql_query("update masnun_user set banned='1' where uid ='$uid'");
                mysql_query("update masnun_user set ts='$cs' where uid='$uid'");
                $tttt = mysql_fetch_assoc(mysql_query("select login from masnun_user where uid='$uid'"));
                $uklogin = $tttt['login'];
                mysql_query("delete from masnun_online where login='$uklogin'");
                echo "User Banned";
            }
            if ($act == 'shield') {
                mysql_query("update masnun_user set shield ='1' where uid ='$uid'");
                echo "User Shielded";
            }
            if ($act == 'unshield') {
                mysql_query("update masnun_user set shield ='0' where uid ='$uid'");
                echo "Shield Removed";
            }
            if ($act == 'banua') {
                $buares = mysql_fetch_assoc(mysql_query("select * from masnun_user where uid = '$uid'"));
                $ua = $buares['ua'];
                mysql_query("insert into masnun_ip (ua) values ('$ua')");
                mysql_query("update masnun_user set banned='1' where uid ='$uid'");
                mysql_query("update masnun_user set ts='$cs' where uid='$uid'");
                $uklogin = $buares['login'];
                mysql_query("delete from masnun_online where login='$uklogin'");
                mysql_query("delete from masnun_pm where tou='$uklogin'");
                mysql_query("delete from masnun_pm where 4mu='$uklogin'");
                mysql_query("delete from masnun_comments where tou='$uklogin' or 4mu ='$uklogin'");
                mysql_query("delete from masnun_friends where tou='$uklogin' or 4mu ='$uklogin'");
                mysql_query("delete from masnun_shout where login='$uklogin'");
                echo "User UA Banned";
            }
            if ($act == 'deltop') {
                $tttt = mysql_fetch_assoc(mysql_query("select login from masnun_user where uid='$uid'"));
                $uklogin = $tttt['login'];
                mysql_query("delete from masnun_topic where topicuser='$uklogin'");
                echo "All topics of <b> $uklogin </b> deleted";
            }
            if ($act == 'delpost') {
                $tttt = mysql_fetch_assoc(mysql_query("select login from masnun_user where uid='$uid'"));
                $uklogin = $tttt['login'];
                mysql_query("delete from masnun_post where postuser='$uklogin'");
                echo "All posts of <b> $uklogin </b> deleted";
            }
            if ($act == 'reset') {
                mysql_query("update masnun_user set banned = '0', staff = '0' where uid ='$uid'");
                echo "User was reset to member";
            }
            if ($act == 'add') {
                $ap = $_REQUEST['ap'];
                $lpr = mysql_fetch_assoc(mysql_query("select points from masnun_user where uid ='$uid'"));
                $cp = $lpr['points'];
                $np = $cp + $ap;
                mysql_query("update masnun_user set points='$np' where uid='$uid'");
                echo "New Points ::: " . $np . "<br/>";
                echo "Old Points ::: " . $cp . "<br/>";
                echo "Added Points ::: " . $ap . "<br/>";
            }
            if ($act == 'sub') {
                $ap = $_REQUEST['ap'];
                $lpr = mysql_fetch_assoc(mysql_query("select points from masnun_user where uid ='$uid'"));
                $cp = $lpr['points'];
                $np = $cp - $ap;
                mysql_query("update masnun_user set points='$np' where uid='$uid'");
                echo "New Points ::: " . $np . "<br/>";
                echo "Old Points ::: " . $cp . "<br/>";
                echo "Reducted Points ::: " . $ap . "<br/>";
            }
        }
        else {
            echo "This area is only for moderators";
        }
        if ($act == 'del') {
            if ($j21login == $owner['login']) {
                $tttt = mysql_fetch_assoc(mysql_query("select login from masnun_user where uid='$uid'"));
                $uklogin = $tttt['login'];
                mysql_query("delete from masnun_user where uid ='$uid'");
                mysql_query("delete from masnun_online where login='$uklogin'");
                mysql_query("delete from masnun_pm where tou='$uklogin'");
                mysql_query("delete from masnun_pm where 4mu='$uklogin'");
                mysql_query("delete from masnun_comments where tou='$uklogin' or 4mu ='$uklogin'");
                mysql_query("delete from masnun_friends where tou='$uklogin' or 4mu ='$uklogin'");
                mysql_query("delete from masnun_shout where login='$uklogin'");
                echo "User was deleted";
            }
            else {
                echo "This area is only for the owner";
            }
        }
        if ($act == 'mod') {
            if ($j21login == $owner['login']) {
                mysql_query("update masnun_user set staff ='1' where uid ='$uid'");
                echo "User was set to mod ";
            }
            else {
                echo "This area is only for owner";
            }
        }
    }

    echo "<br/><br/><a href=\"main.php?m=1{$mysid}\">Home</a><br/><br/>";
}
    ?>
</p>
</body>
</html>