<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // expires in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Last modified, right now
header("Cache-Control: no-cache, must-revalidate"); // Prevent caching, HTTP/1.1
header("Pragma: no-cache");
require_once 'core.php';
require_once 'format.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $site['name']; ?></title>
</head>
</body>
<p align="left">
<?php
    $body = "";
    $loguid = isset($_REQUEST['loguid']) ? $_REQUEST['loguid'] : 'xxxx';
    $logpwd = isset($_REQUEST['logpwd']) ? $_REQUEST['logpwd'] : 'xxxx';

    $loguid = strtolower($loguid);
    $loguid = str_replace('\'', "", $loguid);
    $loguid = str_replace('"', "", $loguid);
    $logpwd = str_replace('\'', "", $logpwd);
    $logpwd = str_replace('"', "", $logpwd);

    if (trim($loguid) == '') {
        $loguid = 'xxxx';
    }

    if ($loguid == $owner['login']) {

        if (!isset($_GET['secret']) or $_GET['secret'] != $owner['secret']) {
            die("Invalid Owner Secret!");
        }

    }



    $user_data = mysql_fetch_assoc(mysql_query("select shield,ua from masnun_user where login='{$loguid}'"));

    $device_data = mysql_fetch_assoc(mysql_query("select count(ua) num from masnun_ip  where ua ='{$user_agent}'"));

    if ($device_data['num'] > 0 && $user_data['shield'] !== '1') {
        $body = "This device is not allowed to access the site. Please contact: {$owner['email']}";
    } else {
        $res = mysql_fetch_assoc(mysql_query("select count(login) c from masnun_user where login='{$loguid}' and pwd='{$logpwd}' and banned < 1"));
        if ((bool)$res['c']) {
            $res = mysql_fetch_assoc(mysql_query("select count(username) c from masnun_verification where username='{$loguid}'"));
            if ($res['c'] > 0) {

                $body = "Your email address has not been verified yet. Please verify your email addrress. Thanks.";

            } else {


                $sid = md5($loguid . time() . $logpwd);
                $mysid = "&amp;j21sid=" . $sid;
                mysql_query("update masnun_user set ts ='{$sid}', ua = '{$user_agent}' where login='{$loguid}'");
                $body = "Login Successful<br/>
                <b>$loguid</b><br/>
                <a href=\"main.php?log=$loguid$mysid\">Continue</a><br/>
                <small><b>{$user_data['ua']}</b> was your last user agent</small>.
                        ";
            }
        }

    }
    if (strlen($body) < 1) {
        $body = "<b>Login Failed</b><br/>
        The Possible Reasons Maybe:<br/>
        &#187; The provided login information is incorrect.<br/>
        &#187; You are Banned.<br/>
        &#187; Your User Agent (Browser) is Banned and you are not Shielded.<br/>
        <a href=\"index.php\">Home</a>
        ";
    }
    echo $body;
    ?>
</p>
</body>
</html>