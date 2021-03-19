<?PHP
//session_start();
require("dbcon.php");
function signup() {
   // echo "frommethod" ;  
    require("dbcon.php");
    $name = $_GET['name'];
    $email = $_GET['email'];
    $image = $_GET['image'];

    $username = $_GET['username'];
    $mobile = $_GET['phone'];
    $adress = $_GET['adress'];
    $pass = $_GET['pass'];
    $salry = $_GET['salry']; 
   // $salry = $_GET['salry']; 
    $email = $_GET['email']; 
    $bloodtype = $_GET['bloodtype']; 

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
$q = "INSERT INTO `patient` (`id`, `name`, `username`, `email`, `pass` , `image`,`bloodtype`,`adress` , `mobile`) values ('$id','$name','$username','$email','$pass','$image' ,'$bloodtype' , '$adress','$mobile'  ) ; ";

$r=mysqli_query($con,$q);
$s=mysqli_affected_rows($con);
if ($s>0)
{

Echo "success" ;

}

}
catch (Exception $ex) {

echo $ex; 


  }
}


?>