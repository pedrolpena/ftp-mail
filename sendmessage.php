<?php
$ini_array = parse_ini_file("./cfg/config.ini");
$queue = $ini_array['outboxQueue'];
$user = $ini_array['user'];
$sentDir = $ini_array['sent']."/".$user;

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
$email="from:".$from."\nto:".$to."\nsubject:".$subject."\n".$message;
$fileName=time()."_".$user."_EMAIL.txt";
$queueFile=$queue."/".$fileName;
$sentFile=$sentDir."/".$fileName;
file_put_contents($queueFile,$email);
file_put_contents($sentFile,$email);
header('Location: messagelist.php');
?>
