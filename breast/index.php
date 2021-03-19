<?php
 require_once('dbcon.php');
 session_start();
if ($_SERVER['REQUEST_METHOD']  =="GET" &&isset ($_GET['username']))
//if isset($_POST(['username']))
{
  //echo "ok" ; 
    $username  =  $_GET['username'];
      $pass  =  $_GET['pass'];  
        $q=  " SELECT *FROM staff WHERE username ='$username' and PASS = '$pass' ; ";
       // echo $q ; 
        $r = mysqli_query($con,$q);
        if (mysqli_num_rows($r)>0)
        {
          echo "Welcome !";
            $arr = mysqli_fetch_array($r); 
            $_SESSION['username'] = $username;
          //  $_SESSION['access_level'] = $arr['job tittle'];
    
    
          $user= $_SESSION['access_level'];

             // echo $user; 
    //   header("location:dashboard.php?user=".$user); 
           // header("location:dashboard.php"); 
       
        }
        else {

          echo"not found , try again <br>" ; 
          include_once('loginform.html')   ; 
        }

    }
    
    
    
    else{
       //echo $_SERVER['REQUEST_METHOD']  ; 
     include_once('loginform.html')   ;
      
     } 
   
?>