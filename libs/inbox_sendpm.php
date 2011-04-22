<?php
function sendpm()
{
    global $j21login, $spy, $mysid, $owner;
    $mytime = time();
    $tou = isset($_REQUEST['tou']) ? $_REQUEST['tou'] : '$masnun';
    $tou = trim($tou);
    $tou = strtolower($tou);
    $tou = strip_tags($tou);

    if ($tou == '') {
        $tou = $owner['login'];
    }
    $msg = isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '[Empty]';
    $user = isset($j21login) ? $j21login : 'SPY';


    $msg = htmlspecialchars($msg);
    echo "============<br/>";
    echo format($msg) . "<br/>";
    echo "============<br/>";
    $tou = explode(',', $tou);
    foreach ($tou as $tou) {
        $tou = trim($tou);
        $uecr = mysql_fetch_assoc(mysql_query("select banned from masnun_user where login='{$tou}'"));
        if ($uecr) {
            $uest = $uecr['banned'];
            if ($uest == '' || $uest < 1) {
                if ($j21login != $owner['login']) {
                    $tou = htmlspecialchars($tou);

                    $spy1 = 0;

                    for ($i = 0; $i < count($spy); $i++) {
                        if (stristr(strtolower($msg), strtolower($spy[$i])) == true) {
                            $spy1 = $spy1 + 1;
                            //echo "OK";
                        }
                    }
                    if ($spy1 > 0) {
                        mysql_query("insert into masnun_pm (4mu,tou,msg,rustatus,date) values ('SPY','{$owner['login']}','This message was sent to [user={$tou}]" . $tou . "[/user] by [user={$user}]" . $user . "[/user]. : {$msg}','0','{$mytime}')");
                    }
                }
                mysql_query("insert into masnun_pm (4mu,tou,msg,rustatus,date) values ('{$user}','{$tou}','{$msg}','0','{$mytime}')");
                echo "Sent to <b>" . $tou . "</b> <br/>";
            } else {
                echo "User is banned : <b{$tou}</b><br/>";
            }
        }

        else {
            echo "User does not exist : <b>{$tou}</b> <br/>";
        }


    }
    echo "============<br/>";
    setOnline('Sent MSG to ' . $tou);
    require_once 'newpm.php';
}

?>