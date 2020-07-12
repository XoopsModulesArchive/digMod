DigMod is a port of phpDig to a Xoops module.

Ported by usulix, usulix@yahoo.com

I have tried to change as little as possible in the general functionality of phpDig. So, for most operational support, you can rely on the phpDig documentation at www.phpdig.net

It will be necessary to make a couple of directories writeable to the user that the script will run as. 


$Xoopsroot$/modules/digMod/admin/temp

and

$Xoopsroot$/digMod/text_content


You will need to manually set these to the necessary mode by chmod on the directories.


Because of the hosted nature of my site, I had to make digMod/admin/temp and digMod/text_content readable and writeable to everybody ( unix chmod 777 ). This is probably a security issue and must be done manually in most cases. A better solution, in my mind, would be to have the user that apache runs as be a member of the group that owns the xoops/modules directory and use chmod 770 instead. Version 2 may have the ability to chmod the directory on the fly when necessary. (Or I may quickly release a .1 revision if somebody hacks my site once I release this ;-) 

Another possible security issue is the necessity of creating a new call to the xoops db class outside the admin directory to allow the search engine logging to work. (it's in digMod/libs/phpdig_functions.php ) I was unable to get the xoopsDB global class to execute an INSERT statement without the change to phpdigAddLog.

Many thanks to the crew at phpdig.net and, of course, to the xoops team.

Regards,

usulix
