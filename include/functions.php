<?php
include_once('config.php');

class Functionclass
{
    public function __construct($rootUrl, $fullUrl)
    {
        $this->rootUrl = $rootUrl;
        $this->fullUrl = $fullUrl;
    }

    public function get_data_query($query, $index = null)
    {
        $query = $this->pdo->prepare($query);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($index == 1 && count($data) > 0) {
            $data = $data[0];
        }
        return $data;
    }

    public function getval($db, $setcol, $setval, $getcol)
    {
        $sql = "SELECT `" . $getcol . "` FROM `" . $db . "` where `" . $setcol . "`='" . $setval . "'";
        $q = $this->get_data_query($sql);
        if ($q)
            return $q[$getcol];
    }

    public function set_data_query($query)
    {
        $query = $this->pdo->prepare($query);
        $data = $query->execute();
        return $data;
    }

    public function permalinkGrabber()
    {
        $permalinkquery = explode('?', $_SERVER['REQUEST_URI']);
        $permalink = explode('/', $permalinkquery[0]);
        $permalinks = $permalink[count($permalink) - 1];
        $newpermalink = ($permalinks == "") ? $permalink[count($permalink) - 2] : $permalink[count($permalink) - 1];
        return $newpermalink;
    }

    public function getbrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/Chrome/i', $u_agent)) {
            return true;
        } else {
            return false;
        }
    }

    public function googleAnalytics()
    {
?>
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-5MZQN23');
        </script>
        <meta name="google-site-verification" content="tfMkhanLI6-gkSN_GABLYT3np4YcffhOUpw1SBznXQs" />
        <!-- End Google Tag Manager -->


        <!-- Google Analytics -->
        <link rel="preconnect" href="https://www.google-analytics.com">
        <!-- Google Tag Manager -->
        <link rel="preconnect" href="https://www.googletagmanager.com">
        <link rel="dns-prefetch" href="https://stats.g.doubleclick.net">
        <link rel="dns-prefetch" href="https://ajax.cloudflare.com">
        <link rel="dns-prefetch" href="https://static.zdassets.com">

    <?php
    }

    public function header_meta($r = null)
    {
        global $copyRight;
        global $permalinks;

        global $language;
        $meta_title = @$r['meta_title'];
        $meta_description = @$r['meta_description'];
        $meta_robots = @$r['meta_robots'];
        $meta_author = $this->rootUrl;

        $meta_copyright = $copyRight;
        $language_local = 'en';
    ?>

        <meta property="og:locale" content="<?php echo $language_local; ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <link rel="apple-touch-icon" sizes="152x152" href="<?PHP echo $this->rootUrl; ?>images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?PHP echo $this->rootUrl; ?>images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?PHP echo $this->rootUrl; ?>images/favicon/favicon-16x16.png">
        <link rel="manifest" href="<?PHP echo $this->rootUrl; ?>site.webmanifest">
        <link rel="mask-icon" href="<?PHP echo $this->rootUrl; ?>images/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#054a95">
        <meta name="application-name" content="New Assignment Help">
        <meta http-equiv="refresh">
        <meta http-equiv="cleartype" content="on">
        <link rel="canonical" href="<?php
                                    if ($permalinks == "404.php") {
                                        echo $this->rootUrl . $permalinks;
                                    } else {
                                        $actual_link1 = explode("?", $this->fullUrl);
                                        echo strtolower($actual_link1[0]);
                                    }
                                    ?>" />
        <?php
        if ($meta_title) {
        ?>
            <meta name="apple-mobile-web-app-title" content="<?php echo $meta_title; ?>">
            <title><?php echo $meta_title; ?></title>
        <?php
        }
        if ($meta_description) {
        ?>
            <meta name="description" content="<?php echo $meta_description; ?>" />
        <?php
        }
        if ($meta_author) {
        ?>
            <meta name="author" content="<?php echo $meta_author; ?>" />
        <?php
        }
        if ($language) {
        ?>
            <meta name="Language" content="<?php echo $language; ?>" />
        <?php
        }
        if ($meta_copyright) {
        ?>
            <meta name="Copyright" content="<?php echo $meta_copyright; ?>" />
        <?php
        }
        if ($meta_robots) {
        ?>
            <meta name="Robots" content="<?php echo $meta_robots; ?>" />
<?php
        }
        $this->googleAnalytics();
    }

    public function isMobileDevice($tablets = null)
    {
        if ($tablets == 1) {
            $aMobileUA = array(
                '/iphone/i' => 'iPhone',
                '/ipod/i' => 'iPod',
                '/ipad/i' => 'iPad',
                '/android/i' => 'Android',
                '/blackberry/i' => 'BlackBerry',
                '/webos/i' => 'Mobile'
            );
        } else if ($tablets == 2) {
            $aMobileUA = array(
                '/iphone/i' => 'iPhone',
                '/ipod/i' => 'iPod',
                '/ipad/i' => 'iPad'
            );
        } else {
            $aMobileUA = array(
                '/iphone/i' => 'iPhone',
                /* '/ipod/i' => 'iPod',
                  '/ipad/i' => 'iPad', */
                '/android/i' => 'Android',
                '/blackberry/i' => 'BlackBerry',
                '/webos/i' => 'Mobile'
            );
        }
        /* Return true if Mobile User Agent is detected */
        foreach ($aMobileUA as $sMobileKey => $sMobileOS) {
            if (preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])) {
                return true;
            }
        }
        /* Otherwise return false.. */
        return false;
    }
}

$obj = new Functionclass($rootUrl, $fullUrl);
