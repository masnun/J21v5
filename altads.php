<?php

$ad_url = "http://besttop.mobi/in.php?id=56180";
//echo $ad_url;
$alt_texts = array(
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
