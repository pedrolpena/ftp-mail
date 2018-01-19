<!DOCTYPE html>
<html>
    <head>
    <style>
        td#filnameTD
        {
            text-align: center;
        }
    </style>
    </head>

    <body>
        <table>
            <tr>
                <td id="filnameTD" colspan="3">
                    <h4>Outbox</h4>
                </td>
            </tr>
        
<?php

$ini_array = parse_ini_file("./cfg/config.ini");
$queue = $ini_array['outboxQueue'];
$dh  = opendir($queue);



echo "<br>";
while (false !== ($filename = readdir($dh))) {
    if(preg_match('/EMAIL/',$filename) ){



echo "           <tr>";
echo "                <td>";
echo "                    $filename"; 
echo "                </td>";
echo "               <td >";
 echo "               </td>";
echo "               <td>";
echo "                   ";
echo "               </td>";
echo "           </tr>";
    }

}



?>
        </table>
    </body>

</html>
