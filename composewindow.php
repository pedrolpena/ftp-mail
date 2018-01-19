<!DOCTYPE html>
<html>
    <head>
    <style>
        input#from,input#to,input#subject
        {
            width:545px;
           position: absolute;
           left: 80px;

        }
 

       textarea#messageArea
       {
          width: 620px;
          height: 300px;
          resize: none;

       }
       input#send
        { 
           
           position: absolute;
           right: 5px;

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
        <form  method="post" action="sendmessage.php">
            <label for="from">From:</label><input id="from" type="email" name="from" value="<?=$user?>" readonly><br><br>
            <label for="to">To:</label><input id="to" type="email" name="to"  value="<?=$from?>" multiple><br><br>
            <label for="subject">Subject:</label><input  id="subject" type="text" name="subject" value="<?=$subject?>"><br><br>
 
            <textarea id="messageArea" name="messageArea"><?=$message?></textarea>           
            <input id="send" type="submit" value="SEND">
        </form>
    </body>

</html>
