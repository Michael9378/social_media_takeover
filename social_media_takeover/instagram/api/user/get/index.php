<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) ){

	$user_id = $_POST["user_id"];

	$sql = "SELECT DISTINCT * ";
	$sql .= "FROM `ig_users` ";
	$sql .= "WHERE `user_id` = '".$user_id."';";
	jr( sql_get_query( $sql ) );
}
else
	jr("Missing user_id param.");

?>