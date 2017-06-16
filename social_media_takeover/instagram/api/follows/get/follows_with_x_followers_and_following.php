<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["follow_sum"] ) ){

	$follow_sum = $_POST["follow_sum"];

	$sql = "SELECT DISTINCT user_id ";
	$sql .= "FROM `ig_users` ";
	$sql .= "WHERE `user_num_followers` + `user_num_following` >= '".$follow_sum."';";
	jr( sql_get_query( $sql ) );
}
else
	jr("Missing parameters.");

?>