<!DOCTYPE html>
<html>
    <head>
    <style>
        input#from,input#to,input#subject
        {
           max-width:840px;
           width:100%;

           

        }
 

       textarea#messageArea
       {
		   
          width: 930px;
          height: 250px;
          resize: none;

       }
       input#send
        { 
           
           position: relative;
           left: auto;
     

        }


    </style>
    </head>

    <body>
<?php
$ini_array = parse_ini_file("./cfg/config.ini");
$pp=basename($_GET['reply']);

$from="";
$to="";
$subject="";
$message="";
$subject ="";

if($pp!="no"){
$from=$_POST["from"];
$to=$_POST["to"];
$subject=$_POST["subject"];
$message="\n\n\n\n".$from." wrote:\n".$_POST["inboxMessage"];
$subject ="Re: ".$subject;
}
$user = $ini_array['user'];


?>
    <table style="text-align: right;">
		
        <form  method="post" action="sendmessage.php">
           <tr> <td> <label for="from">From:</label><input id="from" type="email" name="from" value="<?=$user?>" readonly></td></tr>
           <tr> <td> <label for="to">To:</label><input id="to" type="email" name="to"  value="<?=$from?>" multiple></td></tr>
            <tr><td> <label for="subject">Subject:</label><input  id="subject" type="text" name="subject" value="<?=$subject?>"></td></tr>
      <tr><td>  <textarea id="messageArea" name="messageArea"><?=$message?></textarea> </td>  </tr>        
            <tr><td><input id="send" type="submit" value="SEND"></td>  </tr>
        </form>
        
    </table>
    </body>

</html>
