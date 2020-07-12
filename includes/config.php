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

//-------------CONFIGURATION FILE-------
//-------------PHP DIG------------------


if (eregi("config.php",$_SERVER['SCRIPT_FILENAME']) || eregi("config.php",$_SERVER['REQUEST_URI'])) {
  exit();
}

define('PHPDIG_VERSION','1.8.0');

$phpdig_language = "en"; // cs, da, de, en, es, fr, gr, it, nl, no, pt
if (!isset($phpdig_language)) { $phpdig_language = "en"; }

define('PHPDIG_ADM_AUTH','0');     // activates/deactivates the authentification functions
define('PHPDIG_ADM_USER','admin'); // username
define('PHPDIG_ADM_PASS','admin'); // password

define('HIGHLIGHT_BACKGROUND','#FFBB00');        //Highlighting background color
                                                 //Only for classic mode
define('HIGHLIGHT_COLOR','#000000');             //Highlighting text color
                                                 //Only for classic mode

define('LINK_TARGET','_blank');                  //Target for result links
define('WEIGHT_IMGSRC','./tpl_img/weight.gif');  //Baragraph image path
define('WEIGHT_HEIGHT','5');                     //Baragraph height
define('WEIGHT_WIDTH','50');                     //Max baragraph width

define('SEARCH_PAGE',XOOPS_URL.'/modules/digMod/index.php');              //The name of the search page

define('SUMMARY_DISPLAY_LENGTH',50);            //Max chars displayed in summary
define('SNIPPET_DISPLAY_LENGTH',50);            //Max chars displayed in each snippet

define('DISPLAY_SNIPPETS',false);                 //Display text snippets
define('DISPLAY_SNIPPETS_NUM',4);                //Max snippets to display
define('DISPLAY_SUMMARY',true);                 //Display description

define('PHPDIG_DATE_FORMAT','\1-\2-\3');         // Date format for last update
                                                 // \1 is year, \2 month and \3 day
define("END_OF_LINE_MARKER","\r\n");             // End of line marker - keep double quotes

define('SEARCH_BOX_SIZE',60);                    // Search box size
define('SEARCH_BOX_MAXLENGTH',100);               // Search box maxlength

//---------DEFAULT VALUES
define('PHPDIG_ENCODING','iso-8859-1');  // encoding for interface, search and indexing.
                                         // iso-8859-1, iso-8859-2, iso-8859-7, and 
                                         // windows-1251 supported in this version.

// replace/edit phpdig_string_subst/phpdig_words_chars for encodings as needed

$phpdig_string_subst['iso-8859-1'] = 'A:ÀÁÂÃÄÅ,a:àáâãäå,O:ÒÓÔÕÖØ,o:òóôõöø,E:ÈÉÊË,e:èéêë,C:Ç,c:ç,I:ÌÍÎÏ,i:ìíîï,U:ÙÚÛÜ,u:ùúûü,Y:Ý,y:ÿý,N:Ñ,n:ñ';
$phpdig_string_subst['iso-8859-2'] = 'A:ÁÂÄÃ¡,C:ÇÆÈ,D:ÏÐ,E:ÉËÊÌ,I:ÍÎ,L:Å¥£,N:ÑÒ,O:ÓÔÖÕ,R:ÀØ,S:¦ª©,T:Þ«,U:ÚÜÙÛ,Y:Ý,Z:¬¯®,a:áâäã±,c:çæè,d:ïð,e:éëêì,i:íî,l:åµ³,n:ñò,o:óôöõ,r:àø,s:¶º¹,t:þ»,u:úüùû,y:ý,z:¼¿¾';
$phpdig_string_subst['iso-8859-7'] = 'é:ßú,á:Ü,å:Ý,ç:Þ,ï:ü,õ:ýû,ù:þ';
$phpdig_string_subst['windows-1251'] = 'À:à,Á:á,Â:â,Ã:ã,Ä:ä,Å:å,Æ:æ,Ç:ç,È:è,É:é,Ê:ê,Ë:ë,Ì:ì,Í:í,Î:î,Ï:ï,Ð:ð,Ñ:ñ,Ò:ò,Ó:ó,Ô:ô,Õ:õ,Ö:ö,×:÷,Ø:ø,Ù:ù,Ú:ú,Û:û,Ü:ü,Ý:ý,Þ:þ,ß:ÿ';

$phpdig_words_chars['iso-8859-1'] = '[:alnum:]ðþßµ';
$phpdig_words_chars['iso-8859-2'] = '[:alnum:]ðþßµ';
$phpdig_words_chars['iso-8859-7'] = '[:alnum:]ÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÓÔÕÖ×ØÙ¢¸¹º¼¾¿ÚÛáâãäåæçèéêëìíîïðñóôõö÷øùÜÝÞßüýþúûÀà';
$phpdig_words_chars['windows-1251'] = '[:alnum:]ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿ';

// start is AND OPERATOR, exact is EXACT PHRASE, and any is OR OPERATOR
define('SEARCH_DEFAULT_MODE','start');  // default search mode (start|exact|any)
// in language pack make the appropriate changes to 'w_begin', 'w_whole', and 'w_part'
// 'w_begin' => 'and operator', 'w_whole' => 'exact phrase', 'w_part' => 'or operator'

define('SEARCH_DEFAULT_LIMIT',10);      //results per page

define('SPIDER_MAX_LIMIT',2);          //max recurse levels in spider
define('SPIDER_DEFAULT_LIMIT',0);       //default value
define('RESPIDER_LIMIT',1);             //recurse limit for update

define('LIMIT_DAYS',0);                 //default days before reindex a page

define('SMALL_WORDS_SIZE',2);           //words to not index
define('MAX_WORDS_SIZE',30);            //max word size
define('PHPDIG_EXCLUDE_COMMENT','<!-- phpdigExclude -->');
                                        //comment to exclude a page part
define('PHPDIG_INCLUDE_COMMENT','<!-- phpdigInclude -->');
                                        //comment to include a page part

define('PHPDIG_DEFAULT_INDEX',false);    //phpDig considers /index or /default
                                         //html, htm, php, asp, phtml as the
                                         //same as '/'
define('PHPDIG_SESSID_REMOVE',true);     // remove SIDS from indexed URLS
define('PHPDIG_SESSID_VAR','PHPSESSID'); // name of the SID variable

define('TITLE_WEIGHT',3);                //relative title weight
define('CHUNK_SIZE',2048);               //chunk size for regex processing

define('SUMMARY_LENGTH',100);            //length of results summary

define('TEXT_CONTENT_PATH','text_content/'); //Text content files path
define('CONTENT_TEXT',1);                    //Activates/deactivates the
                                             //storage of text content.
define('PHPDIG_IN_DOMAIN',false);            //allows phpdig jump hosts in the same
                                             //domain. If the host is "www.mydomain.tld",
                                             //domain is "mydomain.tld"

define('PHPDIG_LOGS',true);               //write logs

define('TEMP_FILENAME_LENGTH',8);         //filename length of temp files
// if using external tools with extension, use 4 for filename of length 8

define('NUMBER_OF_RESULTS_PER_SITE',-1);  //max number of results per site
                                          // use -1 to display all results

define('USE_RENICE_COMMAND','1');         //use renice for process priority

//---------EXTERNAL TOOLS SETUP
// if set to true is_executable used - set to '0' if is_executable is undefined
define('USE_IS_EXECUTABLE_COMMAND','1'); //use is_executable for external binaries

// if set to true, full path to external binary required
define('PHPDIG_INDEX_MSWORD',false);
define('PHPDIG_PARSE_MSWORD','/usr/local/bin/catdoc');
define('PHPDIG_OPTION_MSWORD','-s 8859-1');

define('PHPDIG_INDEX_PDF',false);
define('PHPDIG_PARSE_PDF','/usr/local/bin/pstotext');
define('PHPDIG_OPTION_PDF','-cork');

define('PHPDIG_INDEX_MSEXCEL',false);
define('PHPDIG_PARSE_MSEXCEL','/usr/local/bin/xls2csv');
define('PHPDIG_OPTION_MSEXCEL','');

//---------EXTERNAL TOOLS EXTENSIONS
// if external binary is not STDOUT or different extension is needed
// for example, use '.txt' if external binary writes to filename.txt
define('PHPDIG_MSWORD_EXTENSION','');
define('PHPDIG_PDF_EXTENSION','');
define('PHPDIG_MSEXCEL_EXTENSION','');

//---------FTP SETTINGS
define('FTP_ENABLE',0);//enable ftp content for distant PhpDig
define('FTP_HOST','<ftp host>'); //if distant PhpDig, ftp host;
define('FTP_PORT',21); //ftp port
define('FTP_PASV',1); //passive mode
define('FTP_PATH','<path to phpdig directory>'); //distant path from the ftp root
define('FTP_TEXT_PATH','text_content');//ftp path to text-content directory
define('FTP_USER','<ftp usename>');
define('FTP_PASS','<ftp password>');

// regular expression to ban useless external links in index
define('BANNED','^ad\.|banner|doubleclick');

// regexp forbidden extensions - return sometimes text/html mime-type !!!
define('FORBIDDEN_EXTENSIONS','\.(ico|cab|swf|css|gz|z|tar|zip|tgz|msi|arj|zoo|rar|r[0-9]+|exe|bin|pkg|rpm|deb|bz2)$');

//----------HTML ENTITIES
$spec = array( "&amp" => "&",
               "&agrave" => "à",
               "&egrave" => "è",
               "&ugrave" => "ù",
               "&oacute;" => "ó",
               "&eacute" => "é",
               "&icirc" => "î",
               "&ocirc" => "ô",
               "&ucirc" => "û",
               "&ecirc" => "ê",
               "&ccedil" => "ç",
               "&#156" => "oe",
               "&gt" => " ",
               "&lt" => " ",
               "&deg" => " ",
               "&apos" => "'",
               "&quot" => " ",
               "&acirc" => "â",
               "&iuml" => "ï",
               "&euml" => "ë",
               "&auml" => "ä",
               "&ouml" => "ö",
               "&uuml" => "ü",
               "&nbsp" => " ",
               "&szlig" => "ß",
               "&iacute" => "í",
               "&reg" => " ",
               "&copy" => " ",
               "&aacute" => "á",
               "&Aacute" => "Á",
               "&eth" => "ð",
               "&ETH" => "Ð",
               "&Eacute" => "É",
               "&Iacute" => "Í",
               "&Oacute" => "Ó",
               "&uacute" => "ú",
               "&Uacute" => "Ú",
               "&THORN" => "Þ",
               "&thorn" => "þ",
               "&Ouml" => "Ö",
               "&aelig" => "æ",
               "&AELIG" => "Æ",
               "&aring" => "å",
               "&Aring" => "Å",
               "&oslash" => "ø",
               "&Oslash" => "Ø"
               );

//month names in iso dates
$month_names = array ('jan'=>1,
                      'feb'=>2,
                      'mar'=>3,
                      'apr'=>4,
                      'may'=>5,
                      'jun'=>6,
                      'jul'=>7,
                      'aug'=>8,
                      'sep'=>9,
                      'oct'=>10,
                      'nov'=>11,
                      'dec'=>12
                      );

//apache multi indexes parameters
$apache_indexes = array (  "?N=A" => 1,
                           "?N=D" => 1,
                           "?M=A" => 1,
                           "?M=D" => 1,
                           "?S=A" => 1,
                           "?S=D" => 1,
                           "?D=A" => 1,
                           "?D=D" => 1,
                           "?C=N&amp;O=A" => 1,
                           "?C=M&amp;O=A" => 1,
                           "?C=S&amp;O=A" => 1,
                           "?C=D&amp;O=A" => 1,
                           "?C=N&amp;O=D" => 1,
                           "?C=M&amp;O=D" => 1,
                           "?C=S&amp;O=D" => 1,
                           "?C=D&amp;O=D" => 1);

//includes language file
if (is_file("$relative_script_path/locales/$phpdig_language-language.php")) {
    include "$relative_script_path/locales/$phpdig_language-language.php";
}
elseif (is_file("$relative_script_path/locales/en-language.php")) {
    include "$relative_script_path/locales/en-language.php";
}
else {
    die("Unable to select language pack.\n");
}

//connection to database
if (is_file("$relative_script_path/includes/connect.php")) {
    include "$relative_script_path/includes/connect.php";
}

//includes of libraries
if (is_file("$relative_script_path/libs/phpdig_functions.php")) {
    include "$relative_script_path/libs/phpdig_functions.php";
}
else {
    die ("Unable to find phpdig_functions.php file.\n");
}
if (is_file("$relative_script_path/libs/function_phpdig_form.php")) {
    include "$relative_script_path/libs/function_phpdig_form.php";
}
else {
    die ("Unable to find function_phpdig_form.php file.\n");
}
if (is_file("$relative_script_path/libs/mysql_functions.php")) {
    include "$relative_script_path/libs/mysql_functions.php";
}
else {
    die ("Unable to find mysql_functions.php file.\n");
}

// parse encodings (create global $phpdigEncode);
phpdigCreateSubstArrays($phpdig_string_subst);

if (!isset($no_connect)) {
     phpdigCheckTables($id_connect,array('engine',
                                    'excludes',
                                    'keywords',
                                    'sites',
                                    'spider',
                                    'tempspider',
                                    'logs'));
}
?>
