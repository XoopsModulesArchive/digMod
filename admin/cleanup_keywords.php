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
include '../../../include/cp_header.php';

$relative_script_path = XOOPS_ROOT_PATH.'/modules/digMod';
ini_set("max_execution_time", "600");

include "$relative_script_path/includes/config.php";

if ( file_exists("../language/".$xoopsConfig['language']."/main.php") ) {
	include "../language/".$xoopsConfig['language']."/main.php";
} else {
	include "../language/english/main.php";
}

global $xoopsConfig, $xoopsDB, $xoopsModule;
$id_connect=$xoopsDB->conn;
xoops_cp_header();

?>
<h2><?php phpdigPrnMsg('cleaningdictionnary'); ?></h2>
<?php
$del = 0;
$locks = phpdigMySelect($id_connect,'SELECT locked FROM '.PHPDIG_DB_PREFIX.'sites WHERE locked = 1');
if (is_array($locks)) {
    phpdigPrnMsg('onelock');
}
else {
mysql_query('UPDATE '.PHPDIG_DB_PREFIX.'sites SET locked=1',$id_connect);
set_time_limit(3600);
phpdigPrnMsg('pwait')." ...<br />";
$query = "SET OPTION SQL_BIG_SELECTS=1";
mysql_query($query,$id_connect);
//list of keyword's id's
$query = "SELECT key_id FROM ".PHPDIG_DB_PREFIX."keywords";
$id = mysql_query($query,$id_connect);
while (list($key_id) = mysql_fetch_row($id))
       {
       $query = "SELECT key_id FROM ".PHPDIG_DB_PREFIX."engine WHERE key_id=$key_id";
       $id_key = mysql_query($query,$id_connect);
       if (mysql_num_rows($id_key) < 1)
           {
           //if this key_id is not in engine database, delete it
           print "X ";
           $query_delete = "DELETE FROM ".PHPDIG_DB_PREFIX."keywords WHERE key_id=$key_id";
           $id_del = mysql_query($query_delete,$id_connect);
           $del++;
           }
       else
           print ". ";

       mysql_free_result($id_key);
       }
if ($del)
print "<br />$del".phpdigMsg('keywordsnotok');
else
print "<br />".phpdigMsg('keywordsok');
mysql_query('UPDATE '.PHPDIG_DB_PREFIX.'sites SET locked=0',$id_connect);
}
?>
<br />
<a href="index.php" target="_top">[<?php phpdigPrnMsg('back'); ?>]</a> <?php phpdigPrnMsg('to_admin'); ?>.
<?php
xoops_cp_footer();
?>
