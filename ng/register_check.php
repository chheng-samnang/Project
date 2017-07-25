<?php
 	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include("db.php");

    $email =$_GET['email'];
	if($email!="")
	{	
		$result = $conn->query("SELECT acc_email  FROM tbl_account WHERE acc_email='$email'");
	}
	$outp = "";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)){
	    if ($outp != "") {$outp.= ",";}else{ return FALSE; }
	    $outp .= '{"Email":"' .$rs["acc_email"]  .'"}';
	}
	$outp ='{"records":['.$outp.']}';
	$conn->close();
	echo($outp);
?>