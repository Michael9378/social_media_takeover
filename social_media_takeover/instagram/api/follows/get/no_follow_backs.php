<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) ){

	$user_id = $_POST["user_id"];

	$sql = "SELECT DISTINCT follows_user_id ";
	$sql .= "FROM `ig_follows` ";
	$sql .= "WHERE `user_id` = '".$user_id."' and `follows_user_id` NOT IN ( ";
	$sql .= "SELECT user_id ";
	$sql .= "FROM `ig_follows` ";
	$sql .= "WHERE `follows_user_id` = '".$user_id."');";
	
	jr( sql_get_query( $sql ) );
}
else
	jr("Missing parameters.");
?>