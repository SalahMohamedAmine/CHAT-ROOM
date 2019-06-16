<?php 


	$root='mysql:host=localhost;dbname=id7097555_chat';
	$user='id7097555_root';
	$password='safta0123';
	$option=array(
		PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',
	);

	try
	{
		$con=new PDO($root,$user,$password,$option);
		$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	}
	catch(PDOException $e)
	{
		echo 'Failed To CONNECT'. $e->getMessage();
	}


 ?>