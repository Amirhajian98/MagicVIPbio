<?php
/*
Magic Time Bio /AmirHajian
*/

 //1 min cronjob 
 
   $host = "https://site.com/MagicVIPbio"; //source of time location
   unlink("session.madeline.lock");
   unlink("MadelineProto.log");
   unlink("madeline.phar.version");
   unlink("madeline.phar");
   unlink("madeline.php");
   json_decode(file_get_contents("$host/index.php"),true);
 /*
Magic Time Bio /AmirHajian
*/
 ?>