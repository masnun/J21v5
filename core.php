<?php
// Runtime Setup
ini_set('arg_separator.output', '&amp;');
ini_set('display_erros', 0);

// Requirements
require_once 'config.php';
require_once 'functions.php';

$_GET['start'] = (int)$_GET['start'];

// Includes Protection
define("BASEPATH", true);

//Connect to database
$db = mysql_connect($host, $username, $password);
mysql_select_db($database, $db);

// Protection Against SQL Injection
if (!get_magic_quotes_gpc()) {
    foreach ($_GET as $key => $value) {
        $_GET[$key] = addslashes($value);
    }
    foreach ($_POST as $key => $value) {
        $_POST[$key] = addslashes($value);
    }
    foreach ($_REQUEST as $key => $value) {
        $_REQUEST[$key] = addslashes($value);
    }
}

// User Information

$user_agent = addslashes($_SERVER['HTTP_USER_AGENT']);
$ip = addslashes($_SERVER['REMOTE_ADDR']);


// Session Management

$j21sid = isset($_REQUEST['j21sid']) ? $_REQUEST['j21sid'] : '';

if (empty($j21sid)) {
    $j21sid = md5(time() . "mXtSDEz45yRv" . rand(0, 999));
}

$mysid = '&amp;j21sid=' . $j21sid;
$sessname = 'j21sid';

$j21data = mysql_fetch_assoc(mysql_query("select * from masnun_user where ts='$j21sid'"));
$j21login = strtolower(trim($j21data['login']));
$j21status = addslashes(strtolower(trim($j21data['status'])));
$staff = (int)strtolower(trim($j21data['staff']));

if ($staff == "") {
    $staff = 0;
}

$banned = strtolower(trim($j21data['banned']));

if ($banned == "") {
    $banned = 0;
}

if (strlen($j21login) < 1) {
    unset($j21login);
}


if ($banned > 0) {
    unset($j21login);
}

if (isset($j21login)) {
    $online_data = mysql_fetch_assoc(mysql_query("select lastonline from masnun_online where login='{$j21login}'"));
    $tdf = time() - $online_data['lastonline'];
    #var_dump($tdf);
    if ($tdf < $sat) {
        $randseed = rand(1, 10000);
        $j21sid = md5($j21login . time() . $randseed);
        $mysid = '&amp;j21sid=' . $j21sid;
        mysql_query("update masnun_user set ts='{$j21sid}' where login='{$j21login}'");
    }
}
?>
