<?php
$ini_array = parse_ini_file("./cfg/config.ini");
$queue = $ini_array['outboxQueue'];
$user = $ini_array['user'];
$from=$_POST["from"];
$to=$_POST["to"];
$subject=$_POST["subject"];
$message=$_POST["messageArea"];
$email="from:".$from."\nto:".$to."\nsubject:".$subject."\n".$message;
$file=$queue."/".time()."_".$user."_EMAIL.txt";
file_put_contents($file,$email);
header('Location: messagelist.php');
?>



