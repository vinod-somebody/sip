<?php
include_once("include/config.php");
include_once("include/functions.php");

$URLS = $_SERVER['REQUEST_URI'];
$URL = explode("/", @$URLS);
$HTTP_HOST = $_SERVER['HTTP_HOST'];
$findme = 'www';
$pos = strpos($HTTP_HOST, $findme);
if ($pos === false) {
    $afterDomain = $URL[2];
} else {
    $afterDomain = $URL[1];
}
$permalinks = $obj->permalinkGrabber();
$customPath = $_GET['url'];
$customPathUrl = explode("/", @$customPath);
$doneurl = sizeof($customPathUrl);
if ($doneurl > 1) {
    $checkcat = $customPathUrl[0];
    if ($permalinks == $checkcat) {
        $newlink11 = $root_url . $permalinks;
        Header("HTTP/1.1 301 Moved Permanently");
        Header("Location:$newlink11");
        exit;
    }
}
if ($afterDomain == 'sip') {
    include('sip.php');
    exit;
} else if ($afterDomain == 'mutual-fund') {
    include('mutual-fund.php');
    exit;
} else {
    include('index.php');
}
?>