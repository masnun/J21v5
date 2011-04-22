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
    echo "You are not signed in. Please sign in. <br/><a href=\"index.php\">Home</a><br/>";
}
else {
    include("newpm.php");
    $user = isset($_GET['user']) ? $_GET['user'] : '';
    setOnline('Profile: [user=' . $user . ']' . $user . '[/user]');

    $data = mysql_fetch_assoc(mysql_query("select * from masnun_user where login ='{$user}'"));
    echo "<b><i>" . $user . "</i></b><br/>";
    echo"<hr/>";
    echo "<b>Full Name: </b>" . $data['fullname'] . "<br/>";
    echo "<b>Gender: </b>" . $data['sex'] . "<br/>";
    echo "<b>Age: </b>" . $data['age'] . "<br/>";
    echo "<b>Email: </b>" . $data['email'] . "<br/>";
    echo "<b>Location: </b>" . $data['location'] . "<br/>";
    echo "<b>About: </b>" . format($data['about']) . "<br/>";
    echo"<br/>";
    ?>
    <a href="main.php?m=1<?php echo $mysid; ?>">Home</a>
    <?php ;
}?>
</p>
</body>
</html>