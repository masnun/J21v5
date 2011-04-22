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
<body>
<p align="left">
<?php
            if (!isset($j21login)) {
    echo "You are not signed in. Please sign in. <br/><a href=\"index.php\">Home</a><br/>  ";
}
else {
    setOnline('Account Settings');
    include("newpm.php");

    if (!empty($_REQUEST['task']) && $_REQUEST['task'] == 'update') {
        $fullname = isset($_REQUEST['fullname']) ? $_REQUEST['fullname'] : '';
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
        $age = isset($_REQUEST['age']) ? $_REQUEST['age'] : '';
        $sex = isset($_REQUEST['sex']) ? $_REQUEST['sex'] : '';
        $location = isset($_REQUEST['location']) ? $_REQUEST['location'] : '';
        $about = isset($_REQUEST['about']) ? $_REQUEST['about'] : '';
        $pwd = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : '';
        $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
        $photo = isset($_REQUEST['photo']) ? $_REQUEST['photo'] : '';

        $email = htmlspecialchars($email);
        $fullname = htmlspecialchars($fullname);
        $location = htmlspecialchars($location);
        $age = htmlspecialchars($age);
        $about = htmlspecialchars($about);
        $sex = htmlspecialchars($sex);
        $status = htmlspecialchars($status);
        $photo = htmlspecialchars($photo);

        mysql_query("update masnun_user set fullname ='{$fullname}',
					email = '{$email}',
					age = '{$age}',
					 status = '{$status}',
					sex = '{$sex}',
					location = '{$location}',
					about = '{$about}',
					photo = '{$photo}',
					pwd = '{$pwd}'
					where login='{$j21login}'");

        echo "<b>Profile Updated :) </b> <br/>";
        echo "<a href=\"extprofile.php?view=full&amp;user=" . $j21login . $mysid . "\">[View Profile]</a><br/><br/>";
    }

    $data = mysql_fetch_assoc(mysql_query("select * from masnun_user where login='{$j21login}'"));
    ?>
<form action="profile.php" method="POST">
    Password :::<br/>
    <input name="pwd" type="password" value="<?php echo $data['pwd']; ?>"><br/>
    Signature :::<br/>
    <input name="status" type="text" value="<?php echo $data['status']; ?>"><br/>
    Photo :::<br/>
    <input name="photo" type="text" value="<?php echo $data['photo']; ?>"><br/>
    <small><a href="images/">Browse</a> our image directory
        to find image url(s).
    </small>
    <br/>
    Full Name :::<br/>
    <input name="fullname" type="text" value="<?php echo $data['fullname']; ?>"><br/>
    Email ::: <br/>
    <input name="email" type="text" value="<?php echo $data['email']; ?>"><br/>
    Age ::: <br/>
    <input name="age" type="text" value="<?php echo $data['age']; ?>"><br/>
    Gender ::: <br/>
    <input name="sex" type="text" value="<?php echo $data['sex']; ?>"><br/>
    Location ::: <br/>
    <input name="location" type="text" value="<?php echo $data['location']; ?>"><br/>
    About ::: <br/>
    <input name="about" type="text" value="<?php echo $data['about']; ?>"><br/>
    <input type="submit" value="UPDATE">
    <input type="hidden" name="task" value="update">
    <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>"/>
</form>
<br/><br/>
<a href="main.php?m=1<?php echo $mysid ?>">Home</a><br/>
    <?php ;
}?>

</p>
</body>
</html>