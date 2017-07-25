<?php
 	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	include("db.php");
	$priority = $_GET['priority'];	

	$result = $conn->query("SELECT rate_det_id,duration FROM tbl_rate_detail WHERE rate_det_type='{$priority}' ORDER BY duration ASC");
	$outp = "";
	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
	    if ($outp != "") {$outp .= ",";}	    
	    $outp .= '{"duration":"'  . $rs["duration"] . '",';
	    //$outp .= '"duration":"'  . $rs["duration"] . '",';	    
	    $outp .= '"id":"'. $rs["rate_det_id"]. '"}'; 
	}
	$outp ='{"records":['.$outp.']}';
	$conn->close();
	echo ($outp);
?>