<?php
require_once 'core.php';
$key = $_GET['key'];
mysql_query("delete from masnun_verification where the_key='{$key}'");
header("Location: http://Jotil21.net");
?>
