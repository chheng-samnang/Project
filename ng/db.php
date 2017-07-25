<?php

	$conn = new mysqli('localhost','root','123456','khmer_job_db');
	if (mysqli_connect_errno()) 
	{
		die("failed to connect, the error message is:".mysqli_connect_error());
	}

?>