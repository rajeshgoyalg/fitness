<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

// APPLICATION ENVIRONMENT.
// load different configurations depending on your current environment.
if (isset($_SERVER['APP_ENV'])) {
    $environment = $_SERVER['APP_ENV'];
} else {
    $environment = 'development';
}
    
$configFile = dirname(__FILE__) . '/config/' . $environment . '.php';

if (is_readable($configFile)) {
    require_once $configFile;
} else {
    require_once dirname(__FILE__) . '/config/default.php';
}
