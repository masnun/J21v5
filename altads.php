<?php

$ad_url = "http://besttop.mobi/in.php?id=56180";
//echo $ad_url;
$alt_texts = array("Katrina Kaif Videos",
                   "Aishwariya Half Nude",
                   "Latest Cricket News!",
                   "Earn Money From Internet",
                   "Free Unlimited Downloads",
                   "Katrina Kaif Sexy Pose",
                   "Anushka Semi Naked",
                   "Unlimited Mobile Videos",
                   "Play online games",
                   "Earn Money Now",
                   "Click to Earn Money",
                   "Aishwariya with Amitabh",
                   "Get a hard on now!",
                   "Chat with HOT girls!",
                   "BD Girls Phone NO",
                   "Chat With BD Girls",
                   "Bangladeshi Girls",
                   "Mallika Sherawat Naked",
                   "Mobile Facebook",
                   "Top Sites",
                   "Earn 300 TK Flexi",
                   "Unlimited Free SMS",
                   "Free SMS to Bangladesh",
                   "Earn Money From Mobile",
                   "Shilpa Shethy Videos",
                   "Naked Video Chats",
                   "XXX Downloads",
                   "Unlimted Mobile Porn",
                   "Bipasha Bashu Naked",
                   "Monalisa XXX 3GP",
                   "Tisha Sex Videos",
                   "Moyuri Big Boobs",
                   "Opu Bishwash XXX",
                   "Naked Teen Girls",
                   "Free Sex Chats",


);

// $xrand = rand(0,3);
//echo "X: $xrand ";
if ($staff < 1) {
    // if($xrand == 3) {
    $rand = rand(0, count($alt_texts));
    //echo "R: $rand";
    $alt_ad = "Ad: <a href=\"{$ad_url}\">{$alt_texts[$rand]}</a> <br/>";
    echo $alt_ad;
    //}
}
?>
