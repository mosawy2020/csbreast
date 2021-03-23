<?PHP
//session_start();
require("dbcon.php");
function signup() {
   // echo "frommethod" ;  
    require("dbcon.php");
    $name = $_POST['name'];
    $email = $_POST['email'];
    //$image = $_POST['uploadfile'];

    $username = $_POST['username'];
    $mobile = $_POST['phone'];
    $adress = $_POST['adress'];
    $pass = $_POST['pass'];
    $salry = $_POST['salry']; 
 
    $email = $_POST['email']; 
    $bloodtype = $_POST['bloodtype']; 

    $filename = $_FILES["uploadfile"]["name"]; 
    $tempname = $_FILES["uploadfile"]["tmp_name"];     
        $folder = "image/".$filename; 
   // echo $filename ; 

  $id =0 ;
  $n = 'SELECT COUNT(*) FROM patient';
$r=mysqli_query($con,$n);
$arr = mysqli_fetch_array($r); 
//print_r( $arr); 

$id = $arr[0]+1; 


try {
    

$u = "SELECT *FROM patient WHERE username ='$username'";
$ur=mysqli_query($con,$u);
//if (!isset($ur)) echo"no" ; 
$ros=mysqli_num_rows($ur);
if ( $ros>0)
{
//echo $ros;
echo "username already exists !" ;
include_once('signupform.html');
exit();
}
$q = "INSERT INTO `patient` ( `name`, `username`, `email`, `pass` , `image`,`bloodtype`,`adress` , `mobile`) values ('$name','$username','$email','$pass','$filename' ,'$bloodtype' , '$adress','$mobile'  ) ; ";

$r=mysqli_query($con,$q);
$msg="";
if (move_uploaded_file($tempname, $folder))  { 
  $msg = "Image uploaded successfully"; 
}else{ 
  $msg = "Failed to upload image"; 
} 
echo $msg;

$s=mysqli_affected_rows($con);
if ($s>0)
{

Echo "success" ;
session_unset();
session_destroy();
session_start();
$_SESSION['username'] = $username;
$_SESSION['logtype'] = "patient";
$_SESSION['pass'] = $pass;
}

}
catch (Exception $ex) {

echo $ex; 


  }
}
function docsignup() {
  // echo "frommethod" ;  
   require("dbcon.php");
   $name = $_POST['name'];
   $email = $_POST['email'];
   //$image = $_POST['image'];

   $username = $_POST['docusername'];
   $mobile = $_POST['phone'];
   $adress = $_POST['adress'];
   $pass = $_POST['pass'];
   $salry = $_POST['salry']; 
  // $salry = $_POST['salry']; 
   $email = $_POST['email']; 
   $holidaydays = $_POST['holidaydays']; 
   $filename = $_FILES["uploadfile"]["name"]; 
   $tempname = $_FILES["uploadfile"]["tmp_name"];     
       $folder = "image/".$filename;  
 $id =0 ;
 $n = 'SELECT COUNT(*) FROM patient';
$r=mysqli_query($con,$n);
$arr = mysqli_fetch_array($r); 
//print_r( $arr); 

$id = $arr[0]+1; 


try {
   

$u = "SELECT *FROM doctor WHERE username ='$username'";
$ur=mysqli_query($con,$u);
//if (!isset($ur)) echo"no" ; 
$ros=mysqli_num_rows($ur);
if ( $ros>0)
{
//echo $ros;
echo "username already exists !" ;
include_once('signupform.html');
exit();
}
$q = "INSERT INTO `doctor` ( `name`, `username`, `email`, `pass` , `image`,`holidaydays`,`adress` , `mobile`,`cost`) values ('$name','$username','$email','$pass','$filename' ,'$holidaydays' , '$adress','$mobile','$salry'  ) ; ";

$r=mysqli_query($con,$q);
$msg="";
if (move_uploaded_file($tempname, $folder))  { 
  $msg = "Image uploaded successfully"; 
}else{ 
  $msg = "Failed to upload image"; 
} 
echo $msg;
$s=mysqli_affected_rows($con);
if ($s>0)
{

Echo "success" ;
session_unset();
session_destroy();
session_start();
$_SESSION['username'] = $username;
$_SESSION['logtype'] = "doctor";
$_SESSION['pass'] = $pass;

}

}
catch (Exception $ex) {

echo $ex; 


 }
}
function showalldocdata(){
  require("dbcon.php");
  $q = "SELECT `id`, `name`, `username`, `email`, `pass`, `image`, `holidaydays`, `adress`, `mobile`, `cost` FROM `doctor`"; 
  $r = mysqli_query($con,$q);

while ($arr = mysqli_fetch_array($r))   {

     
$curdocname = $arr['name'] ; 
$curdocimage = $arr['image'] ; 
$curdochloi = $arr['holidaydays'] ; 
$curdoccost = $arr['cost'] ; 
$curdocaddress = $arr['adress'] ;
$curdocmobile = $arr['mobile'] ; 
$folder = "image/".$curdocimage; 
$id = $arr['id'] ;
      
     echo "<html>
     <body>
     <center> <table style='width:100%'; border='1' frame='BOX' rules='NONE'>
     <tr>
     <th>name </th>
     <th>image</th> 
     <th>holi</th>
   </tr>
       <tr>
         <th> $curdocname</th>
         <th> <img src='$folder'  height=50px width=50px></img></th> 
         <th>  $curdochloi</th>
       </tr>
    
     </table>
           
     <form method='POST' action='controller.php' enctype='multipart/form-data'>
      
  <input type= 'submit' name= 'details' value= 'make appointment'> </input>
  <input type= 'text' name= 'id' value= '$id'  style='visibility: hidden' >  </input>

     </form> 
     </body>
     </html><br></center>
    " ; 
    

    } 
 
}
function displaynamephoto(){

$tbname = $_SESSION['logtype'] ; 
require("dbcon.php");
$username  =   $_SESSION['username'] ; 
$pass  = $_SESSION['pass'] ; 
 $q=  " SELECT *FROM ". $tbname."  WHERE username ='$username' and PASS = '$pass' ; ";
//echo $q ; 
$r = mysqli_query($con,$q);
$arr = mysqli_fetch_array($r) ; 
$name = $arr['name'] ; 
$photo = $arr['image'] ; 
$folder = "image/".$photo; 
//echo  $folder;
echo "Welcome ! $name <br><img src='$folder' alt='notfound'style='width:128px;height:128px;'> " ; 


}
function addappiontment(){

  $tbname = $_SESSION['logtype'] ; 
  require("dbcon.php");
  $id  =   $_SESSION['id'] ; 
  $username  =   $_SESSION['username'] ;
  $q = "SELECT `name`,`cost`  FROM `doctor`"; 
  $r = mysqli_query($con,$q);

$arr = mysqli_fetch_array($r)  ;   
$cost = $arr['cost'] ; 
$name = $arr['name'] ; 
     
$curdocname = $arr['name'] ; 
  $q = "INSERT INTO `appointments` ( `docname`, `patientusername`,`date` ,`cost` ) values ('$name','$username','test' ,'$cost'  ) ; ";
  $r = mysqli_query($con,$q);
 
  $s=mysqli_affected_rows($con);
  if ($s>0)
  {
  
  Echo "success" ;}
  
  }
  function setappointments (){

  require("dbcon.php");
  $q = "SELECT `id`, `docname`, `patientusername`, `date`, `cost` FROM `appointments` "; 
  $r = mysqli_query($con,$q);

while ($arr = mysqli_fetch_array($r))   {

     
$curdocname = $arr['docname'] ; 
$curdocdate = $arr['date'] ; 
$curdoccost = $arr['cost'] ; 

$id = $arr['id'] ;
      
     echo "<html>
     <body>
     <center> <table style='width:100%'; border='1' frame='BOX' rules='NONE'>
     <tr>
     <th>name </th>
     <th>date</th> 
     <th>cost</th>
   </tr>
       <tr>
         <th> $curdocname</th>
         <th> $curdocdate</th> 
         <th>  $curdoccost</th>
       </tr>
    
     </table>
           
     <form method='POST' action='controller.php' enctype='multipart/form-data'>
      
  <input type= 'submit' name= 'cancel' value= 'cancel'> </input>
  <input type= 'text' name= 'appid' value= '$id'  style='visibility: hidden' >  </input>

     </form> 
     </body>
     </html><br></center>
    " ; 
    

    } 
 
}
function cancel (){

  require("dbcon.php");
  $id =  $_SESSION['appid'] ; 
  $q = "DELETE FROM `appointments` WHERE id = '$id'" ; 
  $r=mysqli_query($con,$q);
  $s=mysqli_affected_rows($con);
  if ($s>0)
  {echo "success" ; }
}
function myrecord (){

  require("dbcon.php");
  $q = "SELECT `id`, `name`, `result` FROM `records` "; 
  $r = mysqli_query($con,$q);

while ($arr = mysqli_fetch_array($r))   {

     
$recordname = $arr['name'] ; 
$reslt = $arr['result'] ; 
//$curdoccost = $arr['cost'] ; 
//O&%owMipUlg#PlGC57T1 website pass
//w#>oGo$?Az9wO?Rf   db pass
$id = $arr['id'] ;
      
     echo "<html>
     <body>
     <center> <table style='width:100%'; border='1' frame='BOX' rules='NONE'>
     <tr>
     <th>name </th>
     <th>result</th> 
  
   </tr>
       <tr>
         <th> $recordname</th>
         <th> $reslt</th> 
       </tr>
    
     </table>
           
     <form method='POST' action='controller.php' enctype='multipart/form-data'>
      
  <input type= 'submit' name= 'delete' value= 'delete'> </input>
  <input type= 'submit' name= 'edit' value= 'edit'> </input>
  <input type= 'text' name= 'recordid' value= '$id'  style='visibility: hidden' >  </input>

     </form> 
     </body>
     </html><br></center>
    " ; 
    

    } 
    echo "  <form method='POST' action='controller.php' enctype='multipart/form-data'>
      
    <input type= 'input' name= 'recordname' value= 'name'> </input>
    <input type= 'input' name= 'recordresult' value= 'result'> </input>

    <input type= 'submit' name= 'addrecord' value= 'add'> </input>
  
       </form> " ;
 
}
function addrecord (){

   require("dbcon.php");
   $name = $_POST['recordname'] ; 
   $reslut = $_POST['recordresult'] ; 
$username = $_SESSION['username'] ; 
$q = "INSERT INTO `records`( `name`, `result`, `patientusername`)  values ('$name','$reslut' ,'$username'  ) ; ";
$r = mysqli_query($con,$q);

$s=mysqli_affected_rows($con);
if ($s>0)
{

Echo "success" ; 
}

    

 
}
?>