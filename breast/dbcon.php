<?php

$con = mysqli_connect('localhost','root' , '' ) ; 
if (!$con)
{
   echo 'connection error ' ; 
}

$ok = mysqli_select_db($con,'breast');
if (!$ok) echo 'connection error ' ; 

?>



