<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["post_id"] ) ){

	$post_id = $_POST["post_id"];

	$sql = "SELECT DISTINCT `user_id` ";
	$sql .= "FROM `ig_botaction_like` ";
	$sql .= "WHERE `post_id` = '".$post_id."';";
	jr( sql_get_query( $sql ) );
}
elseif( isset( $_POST["user_id"] ) ){

	$user_id = $_POST["user_id"];

	$sql = "SELECT DISTINCT `post_id` ";
	$sql .= "FROM `ig_botaction_like` ";
	$sql .= "WHERE `user_id` = '".$user_id."';";
	jr( sql_get_query( $sql ) );
}
else
	jr("Missing post_id/user_id param.");

?>