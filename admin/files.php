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
global $xoopsConfig, $xoopsDB, $xoopsModule;

include '../../../include/cp_header.php';
$relative_script_path = XOOPS_ROOT_PATH.'/modules/digMod';
include "$relative_script_path/includes/config.php";
include "$relative_script_path/admin/robot_functions.php";

xoops_cp_header();
// extract http vars
extract( phpdigHttpVars(
     array('spider_id' => 'integer',
           'spider' => 'integer',
           'sup' => 'integer',
           'site_id' => 'integer'
          )
     ));
$id_connect=$xoopsDB->conn;
$verify = phpdigMySelect($id_connect,'SELECT locked FROM '.PHPDIG_DB_PREFIX.'sites WHERE site_id='.(int)$site_id);

if (is_array($verify) && !$verify[0]['locked'] && $spider_id) {
     mysql_query('UPDATE '.PHPDIG_DB_PREFIX.'sites SET locked=1 WHERE site_id='.$site_id,$id_connect);
     $query = "SELECT site_id,path,file FROM ".PHPDIG_DB_PREFIX."spider where spider_id=$spider_id";
     $result_id = mysql_query($query,$id_connect);
     if (mysql_num_rows($result_id)) {
         list($site_id,$path,$file) = mysql_fetch_row($result_id);
     }
     if ($spider)  {
         $query = "DELETE FROM ".PHPDIG_DB_PREFIX."tempspider WHERE site_id=$site_id";
         $result_id = mysql_query($query,$id_connect);
         $query = "INSERT INTO ".PHPDIG_DB_PREFIX."tempspider SET site_id=$site_id,path='$path',file='$file'";
         $result_id = mysql_query($query,$id_connect);
         mysql_query('UPDATE '.PHPDIG_DB_PREFIX.'sites SET locked=0 WHERE site_id='.$site_id,$id_connect);
         header ("location:".XOOPS_URL."/modules/digMod/admin/spider.php?site_id=$site_id&mode=small&spider_root_id=$spider_id");
         exit();
      }
      if ($sup) {
         $ftp_id = phpdigFtpConnect();
         phpdigDelSpiderRow($id_connect,$spider_id,$ftp_id);
         phpdigFtpClose($ftp_id);
     }
     mysql_query('UPDATE '.PHPDIG_DB_PREFIX.'sites SET locked=0 WHERE site_id='.$site_id,$id_connect);
}

if ($site_id) {
  $query = "SELECT site_url,port,locked FROM ".PHPDIG_DB_PREFIX."sites WHERE site_id=$site_id";
  $result_id = mysql_query($query,$id_connect);
  list ($url,$port,$locked) = @mysql_fetch_row($result_id);
  if ($port) {
      $url = ereg_replace('/$',":$port/",$url);
  }

  $query = "SELECT file,spider_id FROM ".PHPDIG_DB_PREFIX."spider WHERE site_id=$site_id AND path like '$path' ORDER by file";
  $result_id = mysql_query($query,$id_connect);
  $num = mysql_num_rows($result_id);
  if ($num < 1) {
      mysql_free_result($result_id);
  }
}
?>
<img src="fill.gif" width="200" height="114" alt="" /><br/>
<?php if (!$site_id) { ?>
<p class="grey">
<?php phpdigPrnMsg('branch_start') ?>
</p>
<?php } else { ?>
<a name="AAA" />
<?php if (!$locked) { ?>
<p class="grey">
<?php phpdigPrnMsg('branch_help1') ?>
</p>
<?php } ?>
<h3><?php print $num ?> pages</h3>
<?php if (!$locked) { ?>
<p class="blue">
<?php phpdigPrnMsg('branch_help2'); ?><br/>
<b><?php phpdigPrnMsg('warning') ?> </b><?php phpdigPrnMsg('branch_warn') ?>
</p>
<?php } ?>
<p class="grey">
<?php
$aname = "AAA";
for ($n = 0; $n<$num; $n++) {
    $aname2 = $spider_id;
    if ($n == 0) $aname2="AAA";
    list($file_name,$spider_id)=mysql_fetch_row($result_id);
    print "<a name='$aname' />\n";
    $href=$url.$path.$file_name;
    if (!$locked) {
        print "<a href='files.php?site_id=$site_id&amp;spider_id=$spider_id&amp;sup=1#$aname2'><img src='no.gif' width='10' height='10' border='0' align='middle' alt='' /></a>&nbsp;\n";
        print "<a href='files.php?site_id=$site_id&amp;spider_id=$spider_id&amp;spider=1'><img src='yes.gif' width='10' height='10' border='0' align='middle' alt='' /></a>&nbsp;\n";
    }
    print "<a href='$href'>-".rawurldecode($file_name)."&nbsp;</a><br />\n";
}
?>
</p>
<?php }
xoops_cp_footer();
?>

