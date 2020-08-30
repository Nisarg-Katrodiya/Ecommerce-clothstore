 <?php
session_start();
$con=new mysqli('localhost','root','','ecommerce');

if($con->connect_error)
{
	echo "Connection not done";
	
}

?>