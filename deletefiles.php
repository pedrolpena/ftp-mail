<?php
  $message = $_POST['deleted'];
  $ini_array = parse_ini_file("./cfg/config.ini");
  $mailUser=$ini_array['mailUser'];
  $trashDir = $ini_array['trash']."/".$mailUser;  
 
  if(!empty($message)) 
  {
    $N = count($message);

    for($i=0; $i < $N; $i++)
    {
		if(isset($message[$i]))
		{
			unlink($message[$i]);
		
		}
      
    }
  }
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
