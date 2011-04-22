<?php
function searchusers()
{
    global $mysid;
    setOnline('Searching Users');

    $m = isset($_REQUEST['str']) ? strtolower($_REQUEST['str']) : '[Empty]';
    $start = isset($_GET['start']) ? $_GET['start'] : '0';
    $newstrt = $start + 7;
    $prevstrt = $start - 7;

    $m = htmlspecialchars($m);
    $query = "select * from masnun_user where lower(fullname) like ('%$m%') or
		lower(email) like ('%$m%') or
		lower(age) like ('%$m%') or
		lower(sex) like ('%$m%') or
		lower(location) like ('%$m%') or
		lower(login) like ('%$m%') or
		lower(about) like ('%$m%') limit $start,7;";

    //echo $query;

    $results = mysql_query($query);
    $count = mysql_fetch_assoc(mysql_query("select count(*) value from masnun_user where lower(fullname) like ('%$m%') or
		lower(email) like ('%$m%') or
		lower(age) like ('%$m%') or
		lower(sex) like ('%$m%') or
		lower(location) like ('%$m%') or
		lower(login) like ('%$m%') or
		lower(about) like ('%$m%')"));
    echo "Searching for [<b>" . $m . "</b>] in user profiles <br/>";
    echo $count['value'] . " users found<br/>";
    echo "<br/>";


    while ($user = mysql_fetch_assoc($results)) {
        //print_r($user)        ;
        echo "<a href=\"view_profile.php?user=" . $user['login'] . $mysid . "\">" . $user['login'] . "</a><br/>";
    }
    echo "<br/>";
    if ($count['value'] > $newstrt) {
        echo "<a href=\"search.php?what=user&amp;start=" . $newstrt . $mysid . "&amp;str=" . $m . "\">Next</a>";
    }
    if ($start == '7' || $start > 7) {
        echo "<a href=\"search.php?what=user&amp;start=" . $prevstrt . $mysid . "&amp;str=" . $m . "\">Prev</a>";
    }
    echo "<br/>";
    ?>
<a href="search.php?what=search<?php echo $mysid ?>">Search</a><br/>
<a href="main.php?m=1<?php echo $mysid ?>">Home</a><br/>
<?php ;
}

?>
