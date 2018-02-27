<?php
// Classes Autoloader
function __autoload($className) {
    $className = str_replace('_', '/', $className);
    require_once(__DIR__."/../$className.php");
}

// Site Title
$siteTitle = 'Cart package';

//Timezone
date_default_timezone_set('Europe/Riga');

?>

<script language="JavaScript" type="text/javascript">
    // Choose your location
    function getRoot() {
        return window.location.origin+('/latloto/cart/')
    }
</script>
