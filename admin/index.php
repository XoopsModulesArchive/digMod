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
xoops_cp_header();

// extract vars
extract( phpdigHttpVars(
     array('message'=>'string')
     ));

?>
<div align='center'>
<table border="0" ><tr><td>
 <a href="<?php print $relative_script_path ?>"><img src="../phpdig_logo_2.png" width="200" height="114" alt="PhpDig <?php print PHPDIG_VERSION ?>" border="0" /></a><br />
 </td><td>
 <div align='center'>
<?php
$phpdig_tables = array('sites'=>'Hosts','spider'=>'Pages','engine'=>'Index','keywords'=>'Keywords','tempspider'=>'Temporary table');
print "<table class=\"borderCollapse\">\n";
print "<tr><td class=\"greyFormDark\" colspan='2' align='center'><b>".phpdigMsg('databasestatus')."</b></td></tr>\n";
while (list($table,$name) = each($phpdig_tables))
       {
       $sql="SELECT count(*) as num FROM ".PHPDIG_DB_PREFIX."$table";
       $res = $xoopsDB->query($sql);
       $result=$xoopsDB->fetchArray($res);
       print "<tr>\n\t<td class=\"greyFormLight\">\n$name : </td>\n\t<td class=\"greyForm\">\n<b>".$result['num']."</b>".phpdigMsg('entries')."</td>\n</tr>\n";
       }
print "</table>\n";
?>
 </div>
</td></tr>
<tr>
<td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr><td valign="top">
<h3><?php phpdigPrnMsg('index_uri') ?></h3>
<form class="grey" action="<? print XOOPS_URL."/modules/digMod/admin/" ?>spider.php" method="post">
<input class="phpdigSelect" type="text" name="url" value="http://" size="56"/>
<br/>
<?php phpdigPrnMsg('spider_depth') ?> :
<select class="phpdigSelect" name="limit">
<?php
//select list for the depth limit of spidering
for($i = 0; $i <= SPIDER_MAX_LIMIT; $i++) {
    print "\t<option value=\"$i\"";
    if($i==SPIDER_DEFAULT_LIMIT){
        print "selected=\"selected\"";
    }
    print ">$i</option>\n";
} ?>
</select>
<input type="submit" name="spider" value="Dig this !" />
</form>
<p class="blue">
<?php if ($message) { phpdigPrnMsg($message); } ?>
</p>
<div class='grey'>
<a href="cleanup_engine.php"><?php print phpdigMsg('clean')." ".phpdigMsg('t_index'); ?></a> |
<a href="cleanup_keywords.php"><?php print phpdigMsg('clean')." ".phpdigMsg('t_dic'); ?></a> |
<a href="cleanup_common.php"><?php print phpdigMsg('clean')." ".phpdigMsg('t_stopw'); ?></a> |
<a href="statistics.php"><?php phpdigPrnMsg('statistics') ?></a>
</div>
</td><td valign="top" rowspan="2">
<div align='center'>
<h3><?php phpdigPrnMsg('site_update') ?></h3>
<form action="<? print XOOPS_URL."/modules/digMod/admin/" ?>update_frame.php" >
<select class="phpdigSelect" name="site_ids[]" multiple="multiple" size="10">
<?php
//list of sites in the database
$query = "SELECT site_id,site_url,port,locked FROM ".PHPDIG_DB_PREFIX."sites ORDER BY site_url";
$result_id = $xoopsDB->query($query);
while (list($id,$url,$port,$locked) = $xoopsDB->fetchRow($result_id))
    {
    if ($port)
        $url .= " (port #$port)";
    if ($locked) {
        $url = '*'.phpdigMsg('locked').'* '.$url;
    }
    print "\t<option value='$id'>$url</option>\n";
    }
?>
</select>
<br/>
<input type="submit" name="update" value="<?php phpdigPrnMsg('updateform'); ?>" />
<input type="submit" name="delete" value="<?php phpdigPrnMsg('deletesite'); ?>" />
</form>
<br/>
</div>
</td></tr>
<tr><td valign="top">
<div align='center'>
<h3><?php phpdigPrnMsg('new_urls') ?></h3>
<?php
$query="SELECT CONCAT('http://',".PHPDIG_DB_PREFIX."keywords.keyword,'/') as url,
".PHPDIG_DB_PREFIX."sites.site_url
FROM ".PHPDIG_DB_PREFIX."keywords LEFT JOIN ".PHPDIG_DB_PREFIX."sites
ON CONCAT('http://',".PHPDIG_DB_PREFIX."keywords.keyword,'/')=".PHPDIG_DB_PREFIX."sites.site_url
WHERE ".PHPDIG_DB_PREFIX."sites.site_url is NULL
AND ".PHPDIG_DB_PREFIX."keywords.twoletters = 'ww'
LIMIT 0,50";
$result_id = $xoopsDB->query($query);
print "<table border=\"1\"><tr>
<th>URL</th><th>Search Depth</th><th>Dig</th></tr>";
while (list($url) = $xoopsDB->fetchRow($result_id)){
    print "<tr><form action=\"".XOOPS_URL."/modules/digMod/admin/spider.php\" method=\"post\">
    <td><input type=\"hidden\" name=\"url\" value=\"".$url."\">".$url."</td>
    <td><select class=\"phpdigSelect\" name=\"limit\">";
    for($i = 0; $i <= SPIDER_MAX_LIMIT; $i++) {
        print "\t<option value=\"$i\"";
        if($i==SPIDER_DEFAULT_LIMIT){
            print "selected=\"selected\"";
        }
        print ">$i</option>\n";
    }
    print "</select></td><td>
    <input type=\"submit\" name=\"spider\" value=\"Dig this !\" /></td></form></tr>";
}
print "</table>";
?>
</td></tr>
</table>
</div>
<?php
xoops_cp_footer();
?>

