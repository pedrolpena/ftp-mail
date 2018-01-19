<!DOCTYPE html>
<html>
    <head>
        <style>
           textarea#inboxMessage
          {
              width: 620px;
              height: 300px;
              resize: none;

           }
         input#reply
         { 
           
             position: absolute;
             right: 5px;

         }
        
 
       input#subject,input#from,input#to
        { 
           width:545px;
           position: absolute;
           left: 80px;

        }
        </style>
    </head>
   
<?php

$pp=basename($_SERVER['HTTP_REFERER']);
$caller_page=$_POST["caller_page"];
$from="";
$to="";
$subject="";
$message="";
$subject ="";

$fileName=$_GET['fileName'];
$fileContents = file($fileName);//file into array
$tmp = preg_split("/:/",$fileContents[0]);
$from=$tmp[1];

$tmp = preg_split("/[:@]/",$fileContents[1]);
$to=$tmp[1];
$tmp = preg_split("/:/",$fileContents[2]);
$subject=$tmp[1];

//extract message
$fileContents[0]="";
$fileContents[1]="";
$fileContents[2]="";

$message=implode("",$fileContents);


?>
    <body>
            <form name="inboxForm" action="composewindow.php" method="post">
                <label for="from">From:</label><input value="<?=$from?>" id="from" type="text" name="from" readonly ><br><br>
                <label for="subject">Subject:</label><input  value="<?=$subject?>" id="subject" type="text" name="subject" readonly><br><br>
                <label for="to">To:</label><input value="<?=$to?>" id="to" type="text" name="to" readonly><br><br>
                <textarea id="inboxMessage" name="inboxMessage" readonly ><?=$message?> </textarea>
            </textarea>  
            <input id="reply" type="submit" value="Reply">      
        </form>
    </body>

</html>
