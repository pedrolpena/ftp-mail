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
			   <td id="messageHeader"><u><b>SENT MESSAGES</b></u></td>
			   <td></td>
			   <td></td>
		   </tr>
           <tr>
		   <td><u><b>To</b></u></td>
           <td><u><b>Subject</b></u></td>
           <td id="date">    </td>
           <td id="date"><u><b>Date Created (GMT)</b></u></td>
           <!--<td id="date"><u><b>Date Sent (GMT)</b></u></td> -->          
           </tr>
           		   
		   <?php
		   $ini_array = parse_ini_file("./cfg/config.ini");
		   $user=$ini_array['user'];
           $sentDir = $ini_array['sent']."/".$user;
           $queue = $ini_array['outboxQueue'];
           
           // Open a directory, and read its contents
           if (is_dir($sentDir))
           {
			   $files = glob($sentDir."/*.*");
               usort($files, function($a, $b)
               {
               return filemtime($a) < filemtime($b);
               });

				
                   foreach($files as $AbsoluteFileName)
                   {
					       clearstatcache();
                           $fileName=basename($AbsoluteFileName);
                           $queueTemp=$queue."/".$fileName;
                           $queueFileBase = pathinfo($queue."/".$fileName, PATHINFO_FILENAME);
                           //$sentFileBase = pathinfo($AbsoluteFileName, PATHINFO_FILENAME);
                           $txt=$queue."/".$queueFileBase.".txt";
                           $zip=$queue."/".$queueFileBase.".zip";
                           if (!file_exists($txt) && !file_exists($zip)){
                           $fileContents = file($sentDir."/".$fileName);//file into array
                           $tmp = preg_split("/:/",$fileContents[1]);
                           $to=$tmp[1];
                           $tmp = preg_split("/:/",$fileContents[2]);
                           $tmp[0]="";
                           $subject=implode("",$tmp);
                           if(trim($to) == "")
                           {
                               $to="No Recipient";
                           }
                           if(trim($subject) == ""){
							   $subject="No Subject";
							   }
                           $fileNameTokens=preg_split("/_/",$fileName);
                           $sentTime = new DateTime("@$fileNameTokens[0]");
                           $createdTime = new DateTime("@".filemtime($AbsoluteFileName));
                           echo "<tr>";
                           echo "<td>".$to."</td>";
                           echo "<td id=\"subject\">";
                           echo "<a href=\"message.php?fileName=".$sentDir."/".$fileName."\">".$subject."</a>";  
                           echo " </td>";
                           echo "<td id=\"date\">";
                           echo "<td id=\"date\">".$createdTime->format('m/d/y H:i')."</td>";
                           //echo "<td id=\"date\">".$sentTime->format('m/d/y H:i')."</td>";                          
                           echo " </tr>";
					   }//end if
                         

                  }//end for

           }//end if
           else
           {
			   //mkdir($sentDir,0775,true);
           }//end else
           

   
           
            ?>
       </table>
    </body>





</html>
