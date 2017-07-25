<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '123456';
	$db   =  'khmer_job_db';

	try
	{
		$DBH = new pdo("mysql:host=$host; dbname=$db",$user,$pass);
	}catch(PDOException $e)
	{
		echo "Not Connection...".$e->getMessage();
	}
   
?>