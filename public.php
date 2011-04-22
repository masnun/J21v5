<?php
require_once 'core.php';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
$view = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'none'; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $site['name']; ?></title>
</head>
<body>
<p align="left">
<?php
            include("format.php");
    include("ads.php");
    $is_user = mysql_fetch_assoc(mysql_query("select count(login) c from masnun_user where login='$view'"));
    if ($is_user['c'] > 0) {
        $data = mysql_fetch_assoc(mysql_query("select * from masnun_user where login ='$view'"));
        echo "<h2>{$data['fullname']}</h2>";

        echo "<hr />";
        if (!empty($data['photo'])) {
            echo "<img src=\"" . $data['photo'] . "\" alt=\"photo\"/><br/>";
        }
        echo "<b>Gender: </b>" . $data['sex'] . "<br/>";
        echo "<b>Age: </b>" . $data['age'] . "<br/>";
        echo "<b>Email: </b>" . $data['email'] . "<br/>";
        echo "<b>Location: </b>" . $data['location'] . "<br/>";
        echo "<b>About: </b>" . format($data['about']) . "<br/>";
        echo "<b>Signature:</b> " . format($data['status']) . "<br/>";
        echo admob_request($admob_params);
        echo "<hr />";
        echo "<h3>JOTIL21 Stats:</h3>";
        if ($data['staff'] > 0) {
            echo "<b>--Site Staff--</b><br/>";
        }
        if ($data['banned'] > 0) {
            echo "<b>--Banned--</b><br/>";
        }
        echo "<b>Member Level: </b> ";
        $rank = ceil($data['points'] / 500);
        if ($rank == 0) {
            $rank = 1;
        }
        echo "$rank<br/>";
        echo "<b>Points: </b> " . $data['points'] . "<br/>";
        $s = mysql_fetch_assoc(mysql_query("select count(*) c from masnun_comments where tou='$view'"));
        echo "<b>Reviews: </b> " . $s['c'] . "<br/>";
        echo admob_request($admob_params);
        echo "<hr />";
        echo "<h3>Status Updates:</h3>";
        $status_q = mysql_query("select msg,date from masnun_shout where login='{$view}' order by shoutid DESC limit 0,10");
        while ($row = mysql_fetch_assoc($status_q)) {
            echo format($row['msg']) . "<br /><small>(" . $row['date'] . ")</small> <br /><br /> ";
        }
        echo "<hr />";
        echo "<a href=\"index.php\">HOME</a>&nbsp;<a href=\"http://jotil21.mobi\">JOTIL21.moBi</a> ";

    }
    else {
        echo "User does not exist!";
    }
    ?>
</p>
</body>
</html>

