<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["post_id"] ) ){

	$post_id = $_POST["post_id"];

	$sql = "SELECT DISTINCT `user_id` ";
	$sql .= "FROM `ig_likes` ";
	$sql .= "WHERE `post_id` = '".$post_id."';";
	jr( sql_get_query( $sql ) );
}
else
	jr("Missing post_id param.");

?>