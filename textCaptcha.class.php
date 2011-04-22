<?php


class TextCaptcha
{
    public function getCaptcha($id)
    {
        $res = mysql_fetch_assoc(mysql_query("select captcha from masnun_text_captcha where id='{$id}'"));
        return $res['captcha'];
    }

    public function verifyCaptcha($id, $captcha)
    {
        $captchaFromId = $this->getCaptcha($id);
        if (!empty ($captchaFromId) && $captchaFromId == $captcha) {
            mysql_query("delete from masnun_text_captcha where id='{$id}'");
            return true;
        } else {
            return false;
        }
    }

    public function createNew()
    {

        $time = time();
        $last_time = $time - 24 * 60 * 60;
        mysql_query("delete from masnun_text_captcha where time < '{$last_time}'");

        $salt = "mZs45#";
        $rand = rand(0, 100);
        $hash = md5($time . $salt . $rand);
        $string = substr($hash, 0, 5);
        mysql_query("insert into masnun_text_captcha (captcha,time) values('$string','$time')");
        $id = mysql_insert_id();
        $data['id'] = $id;
        $data['captcha'] = $string;
        return (object)$data;
    }
}

?>
