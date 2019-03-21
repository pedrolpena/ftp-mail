<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="refresh" content="5">
    <link rel="stylesheet" type="text/css" href="mailstyle.css">
    <style>
    </style>
    </head>

    <body>
        <table>
		   <tr>
			   <td></td>
			   <td></td>
			   <td id="messageHeader"><u><b>OUTBOX</b></u></td>
			   <td></td>
			   <td></td>
		   </tr>			
		   <td><u><b>To</b></u></td>
           <td><u><b>Subject</b></u></td>
           <td>    </td>
           <td id="date"><u><b>Date Created (GMT)</b></u></td>
           </tr>
        
<?php

$ini_array = parse_ini_file("./cfg/config.ini");
$mailUser=$ini_array['mailUser'];
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
                           $ext = strtolower(pathinfo($AbsoluteFileName, PATHINFO_EXTENSION));
                           $to=$fileName;
                           $subject="";
                                      
                           if(preg_match('/'.$mailUser.'_EMAIL/',$fileName) )
                           {
							   if( $ext == "txt" )
							   {
                                   $fileContents = file($queue."/".$fileName);//file into array
                                   $tmp = preg_split("/:/",$fileContents[1]);
                                   $to=$tmp[1];
                                   $tmp = preg_split("/:/",$fileContents[2]);
                                   $tmp[0]="";
                                   $subject=implode("",$tmp);
                                   if(trim($to) == "")
                                   {
                                       $to="No Recipient";
                                   }
                                   if(trim($subject) == "")
                                   {
							           $subject="No Subject";
							       }                                   
                               }//end if
                               $fileNameTokens=preg_split("/_/",$fileName);
                               $timeCreated = new DateTime("@$fileNameTokens[0]");                             
                               echo "<tr>";
                               echo "<td>".$to."</td>";
                               echo "<td id=\"subject\">";
                               echo "<a href=\"message.php?fileName=".$queue."/".$fileName."\">".$subject."</a>";  
                               echo " </td>";
                               echo "<td>    </td>";
                               echo "<td id=\"date\">".$timeCreated->format('m/d/y H:i')."</td>";
                               echo "</td>";
                               echo " </tr>";
                         }//end if

                  }//end for

           }//end if
           else
           {
			   //mkdir($queue,0775,true);
           }//end else             

?>
        </table>
    </body>

</html>
