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
			   <td id="messageHeader"><u><b>INBOX</b></u></td>
			   <td></td>
			   <td></td>
		   </tr>		   
           <tr>
		   <td><u><b>From</b></u></td>
           <td><u><b>Subject</b></u></td>
           <td id="date">    </td>
           <td id="date"><u><b>Date Rcvd (GMT)</b></u></td>
           <td id="date"><u><b>Date Sent (GMT)</b></u></td>           
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
                           $tmp[0]="";
                           $subject=implode("",$tmp);
                           $fileNameTokens=preg_split("/_/",$fileName);
                           $sentTime = new DateTime("@$fileNameTokens[0]");
                           $createdTime = new DateTime("@".filemtime($AbsoluteFileName));
                           echo "<tr>";
                           echo "<td>".$from."</td>";
                           echo "<td id=\"subject\">";
                           echo "<a href=\"message.php?fileName=".$inboxDir."/".$fileName."\">".$subject."</a>";  
                           echo " </td>";
                           echo "<td id=\"date\">";
                           echo "<td id=\"date\">".$createdTime->format('m/d/y H:i')."</td>";
                           echo "<td id=\"date\">".$sentTime->format('m/d/y H:i')."</td>";                          
                           echo " </tr>";
                         

                  }//end for

           }//end if
           else
           {
			   //mkdir($inboxDir,0775,true);
           }//end else           

   
           
            ?>
       </table>
    </body>





</html>
