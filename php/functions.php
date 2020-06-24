<?php
 function connect($host,$user,$pass,$dbname) {

	$db = mysqli_connect($host,$user,$pass,$dbname);
	if(mysqli_connect_error($db)) {
		exit('Connect Error: ' . mysqli_connect_error($db));
	}	
	return $db;
}
	
function get_rash($db) {
		
	$result = mysqli_query($db,"SELECT `time` as time, `temp` as temp FROM `tempkrsk`");		
	
	$arr = array();	
	
	while($record=$result->fetch_row()) {
		$arr[] = array($record[0],$record[1]);		
	}		
	
	$arr = json_encode($arr);	
	
	return $arr;
}

?>