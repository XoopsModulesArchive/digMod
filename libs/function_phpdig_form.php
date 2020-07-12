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

//===============================================
// form for the search query.
// $query_string is the previous query if exists
// $option is search option
// $limite is the num results per page
// $result_page is path to the search.php script
// $site is the site to limit the results
// $path as the same purpose
function phpdigMakeForm($query_string = "",$option="start",$limite=10,$result_page="index.php",$site="",$path="",$mode='classic',$template="")
{
// $result_page is SEARCH_PAGE from config.php file
// $mode is 'template' from search_function.php file

if (!isset($option))
     $option = 'start';
settype($limite,'integer');
if ($limite == 0)
     $limite = 10;

$check_start = array('start' => 'checked="checked"' , 'any' => '', 'exact' => '');
$check_any = array('start' => '' , 'any' => 'checked="checked"', 'exact' => '');
$check_exact = array('start' => '' , 'any' => '', 'exact' => 'checked="checked"');

$limit10 = array(10 => 'selected="selected"', 30=> '', 100=> '');
$limit30 = array(10 => '', 30=> 'selected="selected"', 100=> '');
$limit100 = array(10 => '', 30=> '', 100=> 'selected="selected"');

$result['form_head'] = "<form action='$result_page' method='get'>
<input type='hidden' name='site' value='$site'/>
<input type='hidden' name='path' value='$path'/>
<input type='hidden' name='result_page' value='$result_page'/>
";
$result['form_foot'] = "</form>";
$result['form_title'] = phpdigMsg('search');
$result['form_field'] = "<input type='text' class='phpdiginputtext' size='".SEARCH_BOX_SIZE."' maxlength='".SEARCH_BOX_MAXLENGTH."' name='query_string' value='".htmlspecialchars(stripslashes($query_string),ENT_QUOTES)."'/>";
$result['form_select'] = phpdigMsg('display')."
  <select name='limite' class='phpdigselect'>
  <option ".$limit10[$limite].">10</option>
  <option ".$limit30[$limite].">30</option>
  <option ".$limit100[$limite].">100</option>
  </select>
  ".phpdigMsg('results')."
 ";
$result['form_button'] = "<input type='submit' class='phpdiginputsubmit' name='search' value='Go'/>";
$result['form_radio'] = "<input type=\"radio\" class='phpdiginputradio' name=\"option\" value=\"start\" ".$check_start[$option]."/>".phpdigMsg('w_begin')."&nbsp;
 <input type=\"radio\" class='phpdiginputradio' name=\"option\" value=\"exact\" ".$check_exact[$option]."/>".phpdigMsg('w_whole')."&nbsp;
 <input type=\"radio\" class='phpdiginputradio' name=\"option\" value=\"any\" ".$check_any[$option]."/>".phpdigMsg('w_part')."&nbsp;
 ";
if ($mode == 'classic')
{
extract($result);
$form="";
$form.="$form_head 
<table class=\"borderCollapse\" width=\"100%\">
 <tr>
  <td class=\"blueForm\">
$form_title 
  </td>
 </tr>
 <tr>
  <td class=\"greyForm\">
$form_field 
  $form_button 
$form_select 
  </td>
 </tr>
 <tr>
 <td class=\"greyForm\">
$form_radio 
 </td>
 </tr>
</table>
</form>";
return $form;
}
else
return $result;
}

//===============================================
//parse a phpdig template
function phpdigParseTemplate($template,$t_strings,$table_results)
{
if (!is_file($template)) {
     print "No template file found !";
     return 0;
}

$in_loop = 0;
$f_handler = fopen($template,'r');
while ($line = fgets($f_handler,4096)) {
       if (eregi('(.*)<phpdig:results>(.*)',$line,$regs)) {
           $i = 0;
           $line .= $regs[1];
           $loop_part[$i++] = $regs[2];
           $in_loop = 1;
           $first_line = 1;
       }
       if ($in_loop == 1) {
           if (eregi('(.*)</phpdig:results>(.*)',$line,$regs)) {
               $loop_part[$i++] = $regs[1];
               $line = $regs[2];
               $in_loop = 0;
               //parse the loop

               if (is_array($table_results) && is_array($loop_part)) {
                   foreach ($table_results as $id => $result) {
                          $result['n'] = $id;
                          foreach ($loop_part as $i => $this_loop) {
                              print phpdigParseTags($this_loop,$result);
                          }
                    }
               }
           }
           else if ($first_line == 1) {
               $first_line = 0;
           }
           else {
               $loop_part[$i++] = $line;
           }
       }

       if ($in_loop == 0) {
           print phpdigParseTags($line,$t_strings);
       }
}
}

//replace <phpdig:/> tags by adequate value in a string
function  phpdigParseTags($line,$t_strings)
{
while(ereg('<phpdig:',$line) && ereg('<phpdig:([a-zA-Z0-9_]+)([[:blank:]]+src=["\']?([a-zA-Z0-9./_-]+)["\']?)?/>',$line,$regs)) {
         if (!isset($t_strings[$regs[1]])) {
            $t_strings[$regs[1]] = '';
         }
         //links with images
         if ($regs[2]) {
             if ($regs[3] && $t_strings[$regs[1]]) {
                 if (ereg('^http',$t_strings[$regs[1]])) {
                     $target = ' target="_blank"';
                 }
                 else {
                     $target = '';
                 }
                 $replacement = '<a href="'.$t_strings[$regs[1]].'"'.$target.'><img src="'.$regs[3].'" border="0" align="bottom" alt="" /></a>';
             }
             else {
                 $replacement = '';
             }
             $line = str_replace($regs[0],$replacement,$line);
         }
         else {
             $line = str_replace($regs[0],$t_strings[$regs[1]],$line);
         }
}
return $line;
}
?>
