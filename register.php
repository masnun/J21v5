<?php require_once 'core.php';
require_once 'textCaptcha.class.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $site['name']; ?></title>
</head>
<body>
<p align="left">
<?php
            $data = mysql_fetch_assoc(mysql_query("select count(ua) num from masnun_ip  where ua ='{$ua}'"));
if ($data['num'] > 0) {
    echo "This User Agent is Banned. <br/> You can't Sign Up.";
}
else {

    $TextCaptcha = new TextCaptcha(); # Construct the object


    if (!empty($_REQUEST['act']) && $TextCaptcha->verifyCaptcha($_REQUEST['act'], $_REQUEST['code']) && $_REQUEST['login'] != '' && $_REQUEST['email'] != '') {
        $login = strip_tags($_REQUEST['login']);
        $pwd = $_REQUEST['pwd'];
        $age = htmlspecialchars($_REQUEST['age']);
        $loc = htmlspecialchars($_REQUEST['loc']);
        $sex = htmlspecialchars($_REQUEST['sex']);
        $email = htmlspecialchars($_REQUEST['email']);
        $login = trim($login);
        $login = strtolower($login);
        $login = str_replace(' ', '_', $login);
        $login = str_replace('0wner', 'owner', $login);
        $login = str_replace('owner', '', $login);
        $login = str_replace('spy', '', $login);

        $login = str_replace('?', '', $login);
        $login = str_replace('&', '', $login);
        $login = str_replace('+', '', $login);
        $login = str_replace('%', '', $login);
        $login = str_replace('\\', '', $login);
        $login = str_replace('mod', '', $login);
        $login = str_replace('admin', '', $login);
        $login = htmlspecialchars($login);

        $results = mysql_query("select count(*) login from masnun_user where login = '{$login}' or email='{$email}'");
        $count = mysql_fetch_assoc($results);
        if ($count['login'] > 0) {
            echo "The username or email address is already in use.";
        }
        else {
            if (trim($login) == '') {
                echo "Empty username";
            } else {
                $key = md5(time() . "key");
                #var_dump($key);
                mysql_query("insert into masnun_verification (username, the_key) values ('{$login}','{$key}')");
                #echo mysql_error();
                mysql_query("insert into masnun_user (login,status,pwd,points,ua,age,sex,location,email) values ('{$login}','I love JOTIL21!','{$pwd}','0','{$ua}','{$age}','{$sex}','{$loc}','{$email}')");
                echo "You have successfully signed up. Please check your email to activate your account.<br/>
                               <b>Username:</b>$login <br/>
                               <b>Password:</b>$pwd <br/>";

                $message = "
                        Hello, 
                        Your email address {$email} has been used to create 
                        the username - {$login} on {$site['url']} .
                        Please visit this page: {$site['url']}activate.php?key={$key}
                        to activate your account.\n\n

                        If you didn't create an account there, simply ignore this message. \n\n

                        Thanks,
                        Owner,
                        {$site['name']}
                                    ";

                $header = "From: {$owner['email']} \r\n";

                mail($email, "{$site['name']} Registration", $message, $header);
            }
        }
    }
    else {
        ?>
    <form action="register.php" method="POST">
        <b>Username:</b> <br/>
        <input name="login" type="text"/><br/>
        <b>Password:</b> <br/>
        <input name="pwd" type="text"/><br/>
        <b>Email:</b> <br/>
        <small>Email adress must be valid. You'll need to verify email address to complete registration.</small>
        <br/>
        <input name="email" type="text"/><br/>
        <b>Age:</b> <br/>
        <input name="age" type="text"/><br/>
        <b>Location:</b> <br/>
        <input name="loc" type="text"/><br/>
        <b>Gender:</b> <br/>
        <select name="sex">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select><br/>
        <b><u>Verification:</u></b><br/>
        <small>Type the following code in the box below:<br/>
            <b>Code: </b>
            <?php $captcha = $TextCaptcha->createNew();
            echo $captcha->captcha;
            ?>

        </small>
        <br/>
        <input type="hidden" name="act" value="<?php echo $captcha->id;?>">
        <input name="code" type="text"/><br/>
        <br/>
        <input type="submit" value="SIGN UP">
        <br/>
    </form>
        <?php ;
    }
}
?>
<br/>
<a href="index.php">Home</a><br/>
</p>
</body>
</html>