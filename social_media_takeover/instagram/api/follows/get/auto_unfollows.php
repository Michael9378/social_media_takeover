<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) && isset( $_POST["num_unfollows"] ) ){

	$user_id = $_POST["user_id"];
	$num_unfollows = $_POST["num_unfollows"];

	$sql = "SELECT DISTINCT follows_user_id ";
	$sql .= "FROM `ig_follows` ";
	$sql .= "WHERE `user_id` = '".$user_id."' ";
	$sql .= "AND `follows_unfollow_date` <= '".date("Y-m-d")."' ";
	$sql .= "AND `follows_unfollow_date` != '0000-00-00' ";
	$sql .= "ORDER BY `follows_unfollow_date` ASC ";
	$sql .= "LIMIT 0,".$num_unfollows.";";
	
	jr( sql_get_query( $sql ) );
}
else
	jr("Missing user_id and/or num_unfollows params.");
?>