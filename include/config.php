<?php
header("ETag: PUB" . time());
header("Last-Modified: " . gmdate("D, d M Y H:i:s", time() - 10) . " GMT");
header("Content-Language: en");
header("Cache-Control: max-age=1");
header('Cache-Control: no-cache="set-cookie"');
header('Content-Type: text/html; charset=utf-8');
header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60 * 24 * 30))); // 30days

$HTTP_HOST = $_SERVER['HTTP_HOST'];
$findme = 'www';
$pos = strpos($HTTP_HOST, $findme);
if ($pos === false) {
    $live = 0;
    $live_cnt = 1;
    $rootUrl = "http://" . $HTTP_HOST . "/sip/";
    $fullUrl = "http://" . $HTTP_HOST . $_SERVER['REQUEST_URI'] . ""; /* local */
} else {
    $live = 1;
    $live_cnt = 0;
    $rootUrl = "https://www.mysipcalculator.co.in/";
    $fullUrl = 'https://www.mysipcalculator.co.in' . $_SERVER['REQUEST_URI']; //* live*/
}
global $rootUrl;
$language = 'en';
$copyRight = 'Copyright ' . date('Y') . ' @  SIP Calculator India';
$site_name = "SIP Calculator India";
$ipAddr = @$_SERVER['REMOTE_ADDR'];
$_SESSION['rootUrl'] = $rootUrl;
function pr($a) {echo "<pre>"; print_r($a); echo "</pre>";}