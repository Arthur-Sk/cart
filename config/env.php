<?php

// Site Title
$siteTitle = 'Cart package';

//Date and time
date_default_timezone_set('Europe/Riga');
$date = date('Y-m-d H:i:s', time());

// Classes Autoloader
function __autoload($className) {
    $className = str_replace('_', '/', $className);
    require_once(__DIR__."/../$className.php");
}
?>

<script language="JavaScript" type="text/javascript">
    // Choose your location
    function getRoot() {
        return window.location.origin+('/latloto/cart/')
    }
</script>
