<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="mailstyle.css">
</head>

<body>

    <table id="mainTable">

        <tr>
            <td id="tabRowa" colspan="3">
                <ul id="headerList">
                    <li><a href="messagelist.php" target="messageIframe">Inbox</a></li><li><a href="outboxlist.php" target="messageIframe">Outbox</a></li><li><a href="sentlist.php" target="messageIframe">Sent</a></li><li><a href="smswindow.php" target="messageIframe">SMS</a></li>
                    </ul>
</td>
        <tr >
            <td id="header1" colspan="3">
               AOML FTP Mail
            </td>
        </tr>
        </tr>
        <tr>
            <td id="headerRowa">
                <table id="tableLeft">
                    <tr>
                        <td><br><a href="composewindow.php?reply=no" target="messageIframe">Compose</a></td>
                    </tr>

                </table>
            </td>
            <td id="headerRowb">
                <iframe src="blank.php" name="messageIframe" id="messageIframe">
                </iframe>
            </td>
            <td id="headerRowc">&nbsp;&nbsp;&nbsp;</td>
        </tr>

        <tr>
            <td id="footerRowa" colspan="3">NOAA</td>
        </tr>

    </table>

</body>

</html>
