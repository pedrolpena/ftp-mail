<?php

  $message = $_POST['deleted'];
  if(!empty($message)) 
  {
    $N = count($message);

    for($i=0; $i < $N; $i++)
    {
		if(isset($message[$i]))
		{
			//rename(,);
			header('Location: trashlist.php');
		
		}
      
    }
  }
header('Location: messagelist.php');
?>
