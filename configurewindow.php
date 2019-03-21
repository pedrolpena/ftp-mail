<!DOCTYPE html>
<html>
    <head>
    <style>
        input#from,input#to,input#subject
        {
           max-width:740px;
           width:100%;

           

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
$mailUser = $ini_array['mailUser'];
$mailPassword = $ini_array['mailPassword'];
$FTPUser = $ini_array['FTPUser'];
$FTPPassword = $ini_array['FTPPassword'];
$FTPHost = $ini_array['FTPHost'];
$FTPPath = $ini_array['FTPPath'];
$outboxQueue = $ini_array['outboxQueue'];
$sent = $ini_array['sent'];
$inbox = $ini_array['inbox'];
$trash= $ini_array['trash'];
?>
    <table style="text-align: right;">
		
        <form  method="post" action="writeconfig.php">
           <tr> <td> <label for="mailUser">Mail User Name:</label><input id="mailUser" type="text" name="mailUser" value="<?=$mailUser?>"></td></tr>
           <tr> <td> <label for="mailPassword">Mail Password:</label><input id="mailPassword" type="password" name="mailPassword" value="<?=$mailPassword?>"></td></tr>           		
           <tr> <td> <label for="FTPUser">FTP User Name:</label><input id="FTPUser" type="text" name="FTPUser" value="<?=$FTPUser?>"></td></tr>
           <tr> <td> <label for="FTPPassword">FTP Password:</label><input id="FTPPassword" type="password" name="FTPPassword" value="<?=$FTPPassword?>"></td></tr>           
            <tr><td> <label for="FTPHost">FTP server:</label><input  id="FTPHost" type="text" name="FTPHost" value="<?=$FTPHost?>"></td></tr>
            <tr><td> <label for="FTPPath">Remote Path:</label><input  id="FTPPath" type="text" name="FTPPath" value="<?=$FTPPath?>"></td></tr> 
            <tr> <td> <label for="outboxQueue">Transmit Queue:</label><input id="outboxQueue" type="text" name="outboxQueue"  value="<?=$outboxQueue?>"></td></tr>
            <tr> <td> <label for="inbox">Inbox Location:</label><input id="inbox" type="text" name="inbox"  value="<?=$inbox?>" readonly></td></tr>
            <tr> <td> <label for="sent">Sent Location:</label><input id="sent" type="text" name="sent"  value="<?=$sent?>" readonly></td></tr>
            <tr> <td> <label for="trash">Trash Location:</label><input id="trash" type="text" name="trash"  value="<?=$trash?>" readonly></td></tr>
            <tr><td><input id="save" type="submit" value="SAVE"></td>  </tr>
        </form>
        
    </table>
    </body>

</html>
