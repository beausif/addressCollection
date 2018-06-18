<?php
declare(strict_types=1);

use Database\MySql;

require_once 'globals.php';

require_once VENDOR_DIR . '/autoload.php';

$db = new MySql($iniSettings[DATABASE_INI_SECTION]['databaseHost']);
$db->setUsername($iniSettings[DATABASE_INI_SECTION]['databaseUser']);
$db->setPassword($iniSettings[DATABASE_INI_SECTION]['databasePassword']);
$db->connect();