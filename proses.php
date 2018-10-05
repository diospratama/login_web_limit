<?php 
   session_start();
	include "dbcon.php";
	
	$user=$_POST['username'];
	$password=$_POST['pass'];
	

$ip = $_SERVER["REMOTE_ADDR"];
mysqli_query($koneksi, "INSERT INTO `ip` (`address` ,`timestamp`)VALUES ('$ip',CURRENT_TIMESTAMP)");
$result = mysqli_query($koneksi, "SELECT COUNT(*) FROM `ip` WHERE `address` LIKE '$ip' AND `timestamp` > (now() - interval 10 minute)");
$count = mysqli_fetch_array($result, MYSQLI_NUM);

if($count[0] >= 3){
  echo "Your are allowed 3 attempts in 10 minutes";
  echo "<script>alert('You are banned for 10 minutes. Try again later')</script>";
  echo "<meta http-equiv='refresh' content='1 url=index.html'>";

  

}
if($count[0] < 3){
		$sql="select * from login where user_name='$user' and pass='$password'";
	//echo $sql;
	$query=mysqli_query($koneksi,$sql);
	$data=mysqli_fetch_array($query);
	$_COOKIE['login']=0;


 		if($user==$data['user_name'] && $password==$data['pass']&& $_COOKIE['login'] < 3){
	
			// $_SESSION["user_name"]=$user;
			// $_SESSION["pass"]=$password;

       		 echo "<script> alert('berhasil')</script>";
	
        
		}
		else{
			echo "<script>alert('Username atau Password salah')</script>";
			echo "<meta http-equiv='refresh' content='1 url=index.html'>";

		}

}









 ?>