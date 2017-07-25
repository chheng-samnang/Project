<?php
 	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include("db.php");
	$id = $_GET['id'];	
	$result = $conn->query("SELECT key_id,CONCAT(key_code,' hours',' ','(',key_data,'$',')') AS value  FROM tbl_sysdata WHERE key_type='cv_paid_search' AND key_id='$id'");
	$outp = "";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($outp != "") {$outp .= ",";}	    
	    $outp .= '{"value":"'  . $rs["value"] . '",';	    	    
	    $outp .= '"id":"'. $rs["key_id"]. '"}'; 
	}
	$outp ='{"records":['.$outp.']}';
	$conn->close();
	echo($outp);
?>