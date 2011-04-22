<?php
function search()
{
    global $mysid, $sessname, $j21sid;
    ?>

<form action="search.php" method="POST">
    Keyword ::: <br/>
    <input name="str" type="text"><br/>
    <b>Search For</b>
    <br/>
    <select name="what">
        <option value="pm">PM</option>
        <option value="topic">TOPIC</option>
        <option value="post">POST</option>
        <option value="user">USER</option>
    </select>
    <input type="hidden" name="<?php echo $sessname; ?>" value="<?php echo $j21sid; ?>">
    <input type="submit" value="SEARCH">
</form>
<br/>
<br/>
<a href="main.php?m=1<?php echo $mysid ?>">Home</a><br/>
<?php } ?>