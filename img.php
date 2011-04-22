<?php
$url = $_GET['url'];
unset($_GET['url']);
foreach ($_GET as $k => $v) {
    $url .= "&{$k}={$v}";
}

header("Content-type: image/jpeg");
echo file_get_contents($url);
?>
