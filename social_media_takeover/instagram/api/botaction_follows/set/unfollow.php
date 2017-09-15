<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) && isset( $_POST["unfollows_user_id"] ) ){

	$user_id = $_POST["user_id"];
	$unfollows_user_id = $_POST["unfollows_user_id"];

	$date = date("Y/m/d");

	$sql = "DELETE FROM `ig_follows` ";
	$sql .= "WHERE `user_id` = '".$user_id."' AND `follows_user_id` = '".$unfollows_user_id."';";
	
	jr( sql_set_query( $sql ) );
}
else
	jr("Missing user_id and/or unfollows_user_id params.");

?>