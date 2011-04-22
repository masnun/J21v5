<?php require_once 'core.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $site['name'];?></title>
</head>
<body>
<p align="left"><b><?php echo $site['name']; ?></b><br/>

<form action="signin.php" method="GET">
    <b>Username:</b><br/>
    <input name="loguid" type="text"/><br/>
    <b>Password:</b><br/>
    <input name="logpwd" type="password"/><br/>
    <small><?php $data = mysql_fetch_assoc(mysql_query("select count(ua) num from masnun_ip  where ua ='$user_agent'"));
        if ($data['num'] > 0) {
            echo "<b>Blocked UA:</b><br/>You can login only if you are shielded.<br/>";
        }
        ?></small>
    <input type="submit" value="SIGN IN">
</form>
<br/><br/>
<small>
    <b>Active:</b> <?php $data = mysql_fetch_assoc(mysql_query("select count(*) c from masnun_online")); echo $data['c'];?>
</small>
<br/>
<small>
    <b>Total:</b> <?php $data = mysql_fetch_assoc(mysql_query("select count(*) c from masnun_user")); echo $data['c']; ?>
</small>
<br/>
<b> Not a member yet? </b><br/><a href="register.php">Sign Up</a><br/><a href="stats.php">&#187; Site Stats</a><br/>
<br/>
</p>
</body>
</html>