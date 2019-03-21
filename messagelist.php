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
		   <form  method="post" action="trashfiles.php">
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
           <td></td>
           <td><u><b>Delete</b></u></td>         
           </tr>
           		   
		   <?php
		   $ini_array = parse_ini_file("./cfg/config.ini");
		   $mailUser=$ini_array['mailUser'];
           $inboxDir = $ini_array['inbox']."/".$mailUser;
           
           // Open a directory, and read its contents
           if (is_dir($inboxDir))
           {
			   $files = glob($inboxDir."/*_EMAIL.txt");
               usort($files, function($a, $b)
               {
               return filemtime($a) < filemtime($b);
               });

				
                   foreach($files as $AbsoluteFileName)
                   {
                           $fileName=basename($AbsoluteFileName);
                           $ext = strtolower(pathinfo($AbsoluteFileName, PATHINFO_EXTENSION));
                           $fileContents = file($inboxDir."/".$fileName);//file into array
                           $tmp = preg_split("/:/",$fileContents[0]);
                           $from=$tmp[1];
                           $tmp = preg_split("/:/",$fileContents[2]);
                           $tmp[0]="";
                           $subject=implode("",$tmp);
                           if(trim($subject) == "")
                           {
						       $subject="No Subject";
							}
							if(trim($from) == "")
                            {
                                $from="No Sender";
                            }
							
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
                           echo "<td></td>";
                           echo '<td><input type="checkbox" name="deleted[]" value="'.$inboxDir."/".$fileName.'" /></td>';                     
                           echo " </tr>";
                         

                  }//end for

           }//end if
           else
           {
			   //mkdir($inboxDir,0775,true);
           }//end else           

   
           
            ?>
            <tr><td><td></td></td><td></td><td></td><td></td><td></td><td><input id="save" type="submit" value="DELETE"></td>  </tr>
            </form>
       </table>
    </body>





</html>
