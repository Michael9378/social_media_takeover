<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) && isset( $_POST["post_id"] ) ){

	$user_id = $_POST["user_id"];
	$post_id = $_POST["post_id"];
	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_botaction_like` ";
	$sql .= "VALUES('".$user_id."', '".$post_id."', '".$date."') ";
	$sql .= "ON DUPLICATE KEY UPDATE ";
	$sql .= "`action_date`='".$date."';";
	
	jr( sql_set_query( $sql ) );
}
else
	jr("Missing user_id and/or post_id params.");

?>