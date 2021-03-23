<?php

//$con = mysqli_connect('localhost','root' , '' ) ; 

$con = mysqli_connect('localhost','id16434557_admin' ,'w#>oGo$?Az9wO?Rf', 'id16434557_breastdatabase' ) ; 
//id16434557_csbreastdatabse
if (!$con)
{
   echo 'connection error ' ; 
}

$ok = mysqli_select_db($con,'id16434557_breastdatabase');
if (!$ok) echo 'connection error ' ; 

?>



