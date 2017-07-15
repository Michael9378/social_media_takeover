<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["log_msg"] ) && isset( $_POST["log_type"] ) && isset( $_POST["log_time"] ) ){

	$log_time = $_POST["log_time"];
	$log_type = $_POST["log_type"];
	$log_msg = $_POST["log_msg"];
	
	$sql = "INSERT INTO `ig_log` ";
	$sql .= "VALUES('".$log_time."', '".$log_type."', '".$log_msg."');";
	
	jr( sql_set_query( $sql ) );
}
else
	jr("Missing log_time, log_type, and/or log_msg params.");

?>