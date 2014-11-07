<!DOCTYPE html>
<html>
    <head>
        <style>
            td#date
            {
                position: absolute;
                /*right: 10px;*/
                float: center;

            }
            td, a
            {
                font-size: 13px;
                width:130px; 
                white-space: nowrap; 
                overflow: hidden;
            }


        </style>
    </head>

    <body>
       <table>
           <tr>
               <td>
                   john.doe@whoknowswhere.com
               </td>
               <td id="subject">
                   <a href="message.php">This is a test subject for development</a>  
               </td>
               <td id="date">
                   12:00 01/01/1970
               </td>
           </tr>
           <tr>
               <td>
                   john.doe@whoknowswhere.com
               </td>
               <td id="subject">
                   <a href="message.php" >This is a test subject for development</a>  
               </td>
               <td id="date">
                   12:00 01/01/1970
               </td>
           </tr>
       </table>
    </body>

</html>
