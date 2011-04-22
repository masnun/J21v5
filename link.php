<?php
$url = $_GET['url'];
unset($_GET['url']);
foreach ($_GET as $k => $v) {
    $url .= "&{$k}={$v}";
}

header("Location: {$url}");
?>
