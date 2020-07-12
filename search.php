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
$relative_script_path = '.';

if (is_file("$relative_script_path/includes/config.php")) {
    include "$relative_script_path/includes/config.php";
}
else {
    die("Cannot find config.php file.\n");
}

if (is_file("$relative_script_path/libs/search_function.php")) {
    include "$relative_script_path/libs/search_function.php";
}
else {
   die("Cannot find search_function.php file.\n");
}

// extract vars
extract(phpdigHttpVars(
     array('query_string'=>'string',
           'refine'=>'integer',
           'refine_url'=>'string',
           'site'=>'integer',
           'limite'=>'integer',
           'option'=>'string',
           'lim_start'=>'integer',
           'browse'=>'integer',
           'path'=>'string'
           )
     ));

phpdigSearch($id_connect, $query_string, $option, $refine,
              $refine_url, $lim_start, $limite, $browse,
              $site, $path, $relative_script_path, $template);
?>