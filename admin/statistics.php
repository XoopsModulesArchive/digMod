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

include "$relative_script_path/admin/robot_functions.php";

global $xoopsConfig, $xoopsDB, $xoopsModule;
$id_connect=$xoopsDB->conn;
xoops_cp_header();

?>
<table><tr><td valign="top">
<img src="../phpdig_logo_2.png" width="200" height="114" alt="PhpDig <?php print PHPDIG_VERSION ?>" /><br />
<h1><?php phpdigPrnMsg('statistics') ?></h1>
<p class='grey'>
<a href="statistics.php?type=mostkeys"><?php phpdigPrnMsg('mostkeywords') ?></a>
<br /><a href="statistics.php?type=mostpages"><?php phpdigPrnMsg('richestpages') ?></a>
<br /><a href="statistics.php?type=mostterms"><?php phpdigPrnMsg('mostterms') ?></a>
<br /><a href="statistics.php?type=largestresults"><?php phpdigPrnMsg('largestresults') ?></a>
<br /><a href="statistics.php?type=mostempty"><?php phpdigPrnMsg('mostempty') ?></a>
<br /><a href="statistics.php?type=lastqueries"><?php phpdigPrnMsg('lastqueries') ?></a>
<br /><a href="statistics.php?type=responsebyhour"><?php phpdigPrnMsg('responsebyhour') ?></a>
</p>
<a href="index.php" target="_top">[<?php phpdigPrnMsg('back') ?>]</a> <?php phpdigPrnMsg('to_admin') ?>.
</td><td valign="top">
<?php
if ($type)
    {
    $query = "SET OPTION SQL_BIG_SELECTS=1";
    mysql_query($query,$id_connect);

    $start_table_template = "<table class=\"borderCollapse\">\n";
    $end_table_template = "</table>\n";
    $line_template = "<tr>%s</tr>\n";
    $title_cell_template = "\t<td class=\"blueForm\">%s</td>\n";
    $cell_template[0] = "\t<td class=\"greyFormDark\">%s</td>\n";
    $cell_template[1] = "\t<td class=\"greyForm\">%s</td>\n";
    $cell_template[2] = "\t<td class=\"greyFormLight\">%s</td>\n";
    $cell_template[3] = "\t<td class=\"greyForm\">%s</td>\n";

    $mod_template = count($cell_template);
    flush();

    $result = phpdigGetLogs($id_connect,$type);

    if ((is_array($result)) && (count($result) > 0)) {
        print $start_table_template;
        // title line
        $title_line = '';
        list($i,$titles) = each($result);
        foreach($titles as $field => $useless) {
            $title_line .= sprintf($title_cell_template,ucwords(str_replace('_',' ',$field)));
        }
        printf($line_template,$title_line);
        foreach($result as $id => $row) {
           $this_line = '';
           $id_row_style = $id % $mod_template;
           foreach ($row as $value) {
                $this_line .= sprintf($cell_template[$id_row_style],$value);
           }
           printf($line_template,$this_line);
        }
        print $end_table_template;
    }
    }
?>
</td></tr></table>
<?php
xoops_cp_footer();
?>
