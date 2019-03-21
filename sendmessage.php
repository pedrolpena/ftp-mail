<?php
$ini_array = parse_ini_file("./cfg/config.ini");
$queue = $ini_array['outboxQueue'];
$mailUser = $ini_array['mailUser'];
$sentDir = $ini_array['sent']."/".$mailUser;

if (!is_dir($sentDir))
{
	mkdir($sentDir,0777,true);
}

if (!is_dir($queue))
{
	mkdir($queue,0777,true);
}

$from=$_POST["from"];
$to=$_POST["to"];
$subject=$_POST["subject"];
$message=$_POST["messageArea"];
if(trim($from) == "")
{
    $from="No Sender";
}
if(trim($to) == "")
{
    $to="No Recipient";
}
if(trim($subject) == "")
{
    $subject="No Subject";
}
if(trim($message) == "No Message")
{
    $message="";
}
$email="from:".$from."\nto:".$to."\nsubject:".$subject."\n".$message;
$fileName=time()."_".$mailUser."_EMAIL.txt";
$queueFile=$queue."/".$fileName;
$sentFile=$sentDir."/".$fileName;
file_put_contents($queueFile,$email);
file_put_contents($sentFile,$email);
header('Location: messagelist.php');
?>
