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
</body>
<p align="left">
<?php
    $sess = md5(rand() . "xX345!Zi2g" . $j21login);
    mysql_query("update masnun_user set ts='{$sess}' where login='{$j21login}'");
    ?>
    <b>YOU HAVE SIGNED OUT</b><br/>
    <a href="index.php">&#187; Sign In</a><br/>
</p>
</body>
</html>