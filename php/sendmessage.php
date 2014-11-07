<?php
$queue="/usr/local/share/transmission_queue";
$from=$_POST["from"];
$to=$_POST["to"];
$subject=$_POST["subject"];
$message=$_POST["messageArea"];
$email="from:".$from."\nto:".$to."\nsubject:".$subject."\n".$message;
$user="ax99";
$file=$queue."/".time()."_".$user."_EMAIL.txt";
file_put_contents($file,$email);
header('Location: messagelist.php');
?>



