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
           
           position: relative;
           left: auto;

         }
        
 
       input#subject,input#from,input#to
        { 
           max-width:530px;
           width:100%;

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
    <body>    <table style="text-align: right;">
            <form name="inboxForm" action="composewindow.php" method="post">
                <tr> <td><label for="from">From:</label><input value="<?=$from?>" id="from" type="text" name="from" readonly ></td></tr>
                <tr> <td><label for="subject">Subject:</label><input  value="<?=$subject?>" id="subject" type="text" name="subject" readonly></td></tr>
                <tr> <td><label for="to">To:</label><input value="<?=$to?>" id="to" type="text" name="to" readonly></td></tr>
                <tr> <td><textarea id="inboxMessage" name="inboxMessage" readonly ><?=$message?> </textarea></td></tr>
           
            <tr> <td><input id="reply" type="submit" value="Reply"> </td></tr>     
        </form>
            </table>
    </body>

</html>
