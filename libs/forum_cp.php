<?php
function viewforumcp()
{
    global $j21login, $mysid, $sessname, $j21sid, $owner;
    setOnline('Forum CP');
    if ($j21login == $owner['login']) {
        echo "<b>Create A Forum</b><br/>";
        echo "<form action=\"forum.php\" method=\"post\">";
        echo "Forum Name:<br/>";
        echo "<input name=\"forumname\" type=\"text\"><br/>";
        echo "<input type=\"submit\" value=\"ADD\">";
        echo "
            <input type=\"hidden\" name=\"act\" value=\"add\">
            <input type=\"hidden\" name=\"{$sessname}\" value=\"{$j21sid}\">
            <input type=\"hidden\" name=\"view\" value=\"forum\">";
        echo "</form><br/><br/>";
        echo "<b>Delete A Forum</b><br/>";
        echo "<form action=\"forum.php\" method=\"post\">";
        echo "Forum ID:<br/>";
        echo "<input name=\"forumid\" type=\"text\"/><br/>";
        echo "<input type=\"submit\" value=\"DEL\">";
        echo "
            <input type=\"hidden\" name=\"act\" value=\"del\"/>
            <input type=\"hidden\" name=\"{$sessname}\" value=\"{$j21sid}\"/>
            <input type=\"hidden\" name=\"view\" value=\"forum\"/>
        ";
        echo "</form><br/><br/>";
        echo "<b>Rename Forum</b><br/>";
        echo "<form action=\"forum.php\" method=\"post\">";
        echo "Forum ID:<br/>";
        echo "<input name=\"fid\" type=\"text\"/><br/>";
        echo "New Name:<br/>";
        echo "<input name=\"newfname\" type=\"text\"/><br/>";
        echo "<input type=\"submit\" value=\"REN\">";
        echo "
            <input type=\"hidden\" name=\"act\" value=\"ren\"/>
            <input type=\"hidden\" name=\"{$sessname}\" value=\"{$j21sid}\"/>
            <input type=\"hidden\" name=\"view\" value=\"forum\"/>
            </form><br/><br/>
        ";
    }
}

?>