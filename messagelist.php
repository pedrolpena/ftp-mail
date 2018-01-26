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
           <tr>
		   <td><u><b>Sender</b></u></td>
           <td><u><b>Subject</b></u></td>
           <td>    </td>
           <td><u><b>Date Received</b></u></td>
           </tr>
           		   
		   <?php
		   $ini_array = parse_ini_file("./cfg/config.ini");
		   $user=$ini_array['user'];
           $inboxDir = $ini_array['inbox']."/".$user;
           
           // Open a directory, and read its contents
           if (is_dir($inboxDir))
           {
			   $files = glob($inboxDir."/*.*");
               usort($files, function($a, $b)
               {
               return filemtime($a) < filemtime($b);
               });

				
                   foreach($files as $AbsoluteFileName)
                   {
                           $fileName=basename($AbsoluteFileName);
                           $fileContents = file($inboxDir."/".$fileName);//file into array
                           $tmp = preg_split("/:/",$fileContents[0]);
                           $from=$tmp[1];
                           $tmp = preg_split("/:/",$fileContents[2]);
                           $subject=$tmp[1];
                           echo "<tr>";
                           echo "<td>".$from."</td>";
                           echo "<td id=\"subject\">";
                           echo "<a href=\"message.php?fileName=".$inboxDir."/".$fileName."\">".$subject."</a>";  
                           echo " </td>";
                           echo "<td>    </td>";
                           echo "<td id=\"date\">";
                           echo date('m/d/y H:i', filemtime($AbsoluteFileName));
                           echo "</td>";
                           echo " </tr>";
                         

                  }//end while

           }//end if
           

   
           
            ?>
       </table>
    </body>





</html>
