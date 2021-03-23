<?php
 require('dbcon.php');
 session_start();
// $_SESSION['logtype'] = "user";
if ($_SERVER['REQUEST_METHOD']  =="POST" &&isset ($_POST['usernamein']))
//if isset($_POST(['username']))
{
 
    $username  =  $_POST['usernamein'];
      $pass  =  $_POST['pass'];  
        $q=  " SELECT *FROM patient WHERE username ='$username' and PASS = '$pass' ; ";
       // echo $q ; 

       // echo $q ; 
        $r = mysqli_query($con,$q);
        if (mysqli_num_rows($r)>0)
        {
        //  echo "Welcome !";
            $arr = mysqli_fetch_array($r); 
            $_SESSION['username'] = $username;
            $_SESSION['pass'] = $pass;
            $_SESSION['logtype'] = "patient";
            header('Location:controller.php') ;
       
        }
        else {
          $q=  " SELECT *FROM doctor  WHERE username ='$username' and PASS = '$pass' ; ";

       
           $r = mysqli_query($con,$q);
           if (mysqli_num_rows($r)>0)
           {
           
               $arr = mysqli_fetch_array($r); 
               $_SESSION['username'] = $username;
               $_SESSION['logtype'] = "doctor";
               $_SESSION['pass'] = $pass;
               header('Location:controller.php') ;
       
          
           }
   else {

          echo"not found , try again <br>" ; 
          include_once('loginform.html')   ; 
        }

        }
     

    }
    
    
    
    else{
       //echo $_SERVER['REQUEST_METHOD']  ; 
     include_once('loginform.html')   ;
      
     } 
   
?>