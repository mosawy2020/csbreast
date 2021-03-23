<?php
session_start();
require("dbcon.php");
require("fuctions.php");
// if (isset( $_SESSION['username']))
//echo "Welcome !".$_SESSION['logtype'];
//if (isset($_POST['sublog']) ) 
if (isset($_SESSION['logtype'])) {
   include('user.html')   ; 
}
if (isset($_POST['doctors']) )
{
   showalldocdata();
}
if (isset($_POST['appointment']) )
{
   setappointments ();
}
if (isset($_POST['myrecord']) )
{
   myrecord ();
}

if (isset($_POST['recordname']) )
{
    addrecord ();
}
if (isset($_POST['cancel']) )
{
    $_SESSION['appid'] = $_POST['appid'] ; 
    cancel ();
}
if (isset($_POST['id']) )
{    $_SESSION['id'] = $_POST['id'] ; 
   addappiontment();
exit(); 
}

 if (isset($_POST['username']) )
{
   signup();
   //include_once('logout.php')  ;
}
 if (isset($_POST['docusername']) )
{   
   docsignup();
}
if (isset($_SESSION['logtype'])) {
//echo "Welcome !".$_SESSION['logtype'];
//showalldocdata();
displaynamephoto() ; 
}


// if (!isset( $_SESSION['username'])) { header("location:index.php"); }






?>