<?php
#################################################
#   Xoops Module -- phpDig v1.0                 #
#   Copyright 2004 By Gregory Gray              #
#   greg@getnetez.com                           #
#   Released under the GPL as included.         #
#   If the GPL was not included and you want    #
#   a copy you can download it seperately at    #
#   www.getnetez.com/licenses/gpl.txt           #
#   The short version : This is free, do what   #
#   you want with it, but don't blame me if     #
#   something bad/weird happens that you don't  #
#   like. You are welcome to email me and I     #
#   will help you as much as I can if I have    #
#   the time.                                   #
#                                               #
#   This module is a port of the phpDig         #
#   search engine project to xoops as a         #
#   pluggable module. Full credit is given      #
#   and honestly meant for the developers       #
#   at phpDig -- I just did the port.           #
#################################################


$modversion['name'] = _MI_DIGMOD_NAME;
$modversion['version'] = 1.00;
$modversion['description'] = _MI_DIGMOD_DESC;
$modversion['author'] = 'Usulix<br />( http://www.getnetez.com/ )<br />usulix@yahoo.com';
$modversion['credits'] = 'Thanks phpDig.net for a great base search engine to port.';
$modversion['help'] = 'help.html';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = 'images/digMod_slogo.png';
$modversion['dirname'] = 'digMod';

// Sql
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "digmod_engine";
$modversion['tables'][1] = "digmod_keywords";
$modversion['tables'][2] = "digmod_sites";
$modversion['tables'][3] = "digmod_spider";
$modversion['tables'][4] = "digmod_tempspider";
$modversion['tables'][5] = "digmod_excludes";
$modversion['tables'][6] = "digmod_logs";

// Admin
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";

// Menu
$modversion['hasMain'] = 1;

// Templates
$modversion['templates'][1]['file'] = 'digMod.html';
$modversion['templates'][1]['description'] = 'Search Results';

// Blocks
$modversion['blocks'][1]['file'] = "digModBlock.php";
$modversion['blocks'][1]['name'] = _MI_DIGMOD_BNAME1;
$modversion['blocks'][1]['description'] = _MI_DIGMOD_DESCRIP;
$modversion['blocks'][1]['show_func'] = "b_digMod_show";
$modversion['blocks'][1]['template'] = 'digModBlock.html';

?>
