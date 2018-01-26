<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="refresh" content="30">
    <style>
        td
        {
                font-size: 13px;
                width:100px; 
                white-space: nowrap; 
                #overflow: hidden;
                #position: absolute;
                /*right: 10px;*/
                float: center;
                
        }
    </style>
    </head>

    <body>
        <table>
		   <td><u><b>Recipient</b></u></td>
           <td><u><b>Subject</b></u></td>
           <td>    </td>
           <td><u><b>Date Created</b></u></td>
           </tr>
        
<?php

$ini_array = parse_ini_file("./cfg/config.ini");
$queue = $ini_array['outboxQueue'];


           // Open a directory, and read its contents
           if (is_dir($queue))
           {
			   $files = glob($queue."/*.*");
               usort($files, function($a, $b)
               {
               return filemtime($a) < filemtime($b);
               });

				
                   foreach($files as $AbsoluteFileName)
                   {
                           $fileName=basename($AbsoluteFileName);
                                      
                           if(preg_match('/EMAIL/',$fileName) )
                           {
                               $fileContents = file($queue."/".$fileName);//file into array
                               $tmp = preg_split("/:/",$fileContents[1]);
                               $from=$tmp[1];
                               $tmp = preg_split("/:/",$fileContents[2]);
                               $tmp[0]="";
                               $subject=implode("",$tmp);
                               echo "<tr>";
                               echo "<td>".$from."</td>";
                               echo "<td id=\"subject\">";
                               echo "<a href=\"message.php?fileName=".$queue."/".$fileName."\">".$subject."</a>";  
                               echo " </td>";
                               echo "<td>    </td>";
                               echo "<td id=\"date\">";
                               echo date('m/d/y H:i', filemtime($AbsoluteFileName));
                               echo "</td>";
                               echo " </tr>";
                         }//end if

                  }//end for

           }//end if

?>
        </table>
    </body>

</html>
