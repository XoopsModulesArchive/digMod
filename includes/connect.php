<?php
/*
--------------------------------------------------------------------------------
PhpDig Version 1.6.x
This program is provided under the GNU/GPL license.
See the LICENSE file for more information.
All contributors are listed in the CREDITS file provided with this package.
PhpDig Website : http://www.phpdig.net/
--------------------------------------------------------------------------------
*/
define('PHPDIG_DB_PREFIX','xoops_digmod_');
$file = XOOPS_ROOT_PATH.'/class/database/'.XOOPS_DB_TYPE.'database.php';
require_once $file;
$class = 'Xoops'.ucfirst(XOOPS_DB_TYPE).'DatabaseSafe';
$SUdb =& new $class();
$SUdb->setLogger(XoopsLogger::instance());
$SUdb->setPrefix(XOOPS_DB_PREFIX);
if (!$SUdb->connect()) {
     trigger_error("Unable to connect to database", E_USER_ERROR);
}else{
//connection to the MySql server
$id_connect = $SUdb->conn;
//$id_connect = @mysql_connect(PHPDIG_DB_HOST,PHPDIG_DB_USER,PHPDIG_DB_PASS);
    if (!$id_connect) {
        die("Unable to connect to database : Check the connection script.\n");
    }
}

?>
