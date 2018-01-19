<!DOCTYPE html>
<html>
    <head>
        <style>
            td#date
            {
                position: absolute;
                /*right: 10px;*/
                float: center;

            }
            td, a
            {
                font-size: 13px;
                width:130px; 
                white-space: nowrap; 
                overflow: hidden;
            }


        </style>
    </head>

    <body>
       <table>
		   <?php
		   $ini_array = parse_ini_file("./cfg/config.ini");
		   $user=$ini_array['user'];
           $inboxDir = $ini_array['inbox']."/".$user;
           
           // Open a directory, and read its contents
           if (is_dir($inboxDir))
           {
               if ($dh = opendir($inboxDir))
               {
                   while (($fileName = readdir($dh)) !== false)
                   {
					   if($fileName != "." && $fileName != "..")
					   {
						   $fileContents = file($inboxDir."/".$fileName);//file into array
						   $tmp = preg_split("/:/",$fileContents[0]);
						   $from=$tmp[1];
						   $tmp = preg_split("/:/",$fileContents[2]);
						   $subject=$tmp[1];
						   echo "<tr>";
						   echo "<td>";
                           //echo "" . $fileName . "";
                           echo "</td>";
                           echo "<td id=\"subject\">";
                           echo $from." "."<a href=\"message.php?fileName=".$inboxDir."/".$fileName."\">".$subject."</a>";  
                           echo " </td>";
                           //echo "<td id=""date"">";
                           //echo "    12:00 01/01/1970";
                           //echo "</td>";
                           echo " </tr>";
                       }
                  }
                  closedir($dh);
               }
           }
            ?>
       </table>
    </body>





</html>
