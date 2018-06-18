<?php
declare(strict_types=1);

define('DATABASE_INI', dirname(__DIR__) . '/datab.ini');
define('DATABASE_INI_SECTION', 'addressCollection');
define('DATABASE_NAME', 'addresscollection');

define('WEB_ROOT', dirname(dirname(dirname(__DIR__))) . '/html');
define('ASSETS_DIR', __DIR__);
define('PARTIALS_DIR', __DIR__ . '/partials');
define('VENDOR_DIR', dirname(__DIR__) . '/vendor');

$iniSettings = parse_ini_file(DATABASE_INI, TRUE);