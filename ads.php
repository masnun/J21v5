<?php



$admob_params = array(
    'PUBLISHER_ID' => 'a149c0a241e7345', // Required to request ads. To find your Publisher ID, log in to your AdMob account and click on the "Sites & Apps" tab.
    'ANALYTICS_ID' => 'a14b7ecf0ca5d72', // Required to collect Analytics data. To find your Analytics ID, log in to your Analytics account and click on the "Edit" link next to the name of your site.
    'AD_REQUEST' => true, // To request an ad, set to TRUE.
    'ANALYTICS_REQUEST' => true, // To enable the collection of analytics data, set to TRUE.
    'TEST_MODE' => false, // While testing, set to TRUE. When you are ready to make live requests, set to FALSE.
    // Additional optional parameters are available at: http://developer.admob.com/wiki/AdCodeDocumentation
    'OPTIONAL' => array()
);


//Modify Here to get ads
//echo admob_request($admob_params);
echo "Admob Ads";

/////////////////////////////////
// Do not edit below this line //
/////////////////////////////////

// This section defines AdMob functions and should be used AS IS.
// We recommend placing the following code in a separate file that is included where needed.

function admob_request($admob_params)
{
    static $pixel_sent = false;

    $ad_mode = false;
    if (!empty($admob_params['AD_REQUEST']) && !empty($admob_params['PUBLISHER_ID'])) $ad_mode = true;

    $analytics_mode = false;
    if (!empty($admob_params['ANALYTICS_REQUEST']) && !empty($admob_params['ANALYTICS_ID']) && !$pixel_sent) $analytics_mode = true;

    $protocol = 'http';
    if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') $protocol = 'https';

    $rt = $ad_mode ? ($analytics_mode ? 2 : 0) : ($analytics_mode ? 1 : -1);
    if ($rt == -1) return '';

    list($usec, $sec) = explode(' ', microtime());
    $params = array('rt=' . $rt,
                    'z=' . ($sec + $usec),
                    'u=' . urlencode($_SERVER['HTTP_USER_AGENT']),
                    'i=' . urlencode($_SERVER['REMOTE_ADDR']),
                    'p=' . urlencode("$protocol://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']),
                    'v=' . urlencode('20081105-PHPCURL-acda0040bcdea222'));

    $sid = empty($admob_params['SID']) ? session_id() : $admob_params['SID'];
    if (!empty($sid)) $params[] = 't=' . md5($sid);
    if ($ad_mode) $params[] = 's=' . $admob_params['PUBLISHER_ID'];
    if ($analytics_mode) $params[] = 'a=' . $admob_params['ANALYTICS_ID'];
    if (!empty($_COOKIE['admobuu'])) $params[] = 'o=' . $_COOKIE['admobuu'];
    if (!empty($admob_params['TEST_MODE'])) $params[] = 'm=test';

    if (!empty($admob_params['OPTIONAL'])) {
        foreach ($admob_params['OPTIONAL'] as $k => $v) {
            $params[] = urlencode($k) . '=' . urlencode($v);
        }
    }

    $ignore = array('HTTP_PRAGMA' => true, 'HTTP_CACHE_CONTROL' => true, 'HTTP_CONNECTION' => true, 'HTTP_USER_AGENT' => true, 'HTTP_COOKIE' => true);
    foreach ($_SERVER as $k => $v) {
        if (substr($k, 0, 4) == 'HTTP' && empty($ignore[$k]) && isset($v)) {
            $params[] = urlencode('h[' . $k . ']') . '=' . urlencode($v);
        }
    }

    $post = implode('&', $params);
    $request = curl_init();
    $request_timeout = 1; // 1 second timeout
    curl_setopt($request, CURLOPT_URL, 'http://r.admob.com/ad_source.php');
    curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($request, CURLOPT_TIMEOUT, $request_timeout);
    curl_setopt($request, CURLOPT_CONNECTTIMEOUT, $request_timeout);
    curl_setopt($request, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Connection: Close'));
    curl_setopt($request, CURLOPT_POSTFIELDS, $post);
    list($usec_start, $sec_start) = explode(' ', microtime());
    $contents = curl_exec($request);
    list($usec_end, $sec_end) = explode(' ', microtime());
    curl_close($request);

    if ($contents === true || $contents === false) $contents = '';

    if (!$pixel_sent) {
        $pixel_sent = true;
        $contents .= "<img src=\"$protocol://p.admob.com/e0?"
                     . 'rt=' . $rt
                     . '&amp;z=' . ($sec + $usec)
                     . '&amp;a=' . ($analytics_mode ? $admob_params['ANALYTICS_ID'] : '')
                     . '&amp;s=' . ($ad_mode ? $admob_params['PUBLISHER_ID'] : '')
                     . '&amp;o=' . (empty($_COOKIE['admobuu']) ? '' : $_COOKIE['admobuu'])
                     . '&amp;lt=' . ($sec_end + $usec_end - $sec_start - $usec_start)
                     . '&amp;to=' . $request_timeout
                     . '" alt="" width="1" height="1"/>';
    }

    return $contents;
}

function admob_setcookie($domain = '', $path = '/')
{
    if (empty($_COOKIE['admobuu'])) {
        $value = md5(uniqid(rand(), true));
        if (!empty($domain) && $domain[0] != '.') $domain = ".$domain";
        if (setcookie('admobuu', $value, mktime(0, 0, 0, 1, 1, 2038), $path, $domain)) {
            $_COOKIE['admobuu'] = $value; // make it visible to admob_request()
        }
    }
}

?>