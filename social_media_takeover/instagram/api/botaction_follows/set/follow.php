<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) && isset( $_POST["follows_user_id"] ) ){

	$user_id = $_POST["user_id"];
	$follows_user_id = $_POST["follows_user_id"];

	$waitTime = time() + (4 * 24 * 60 * 60);
	$follows_unfollow_date = date("Y-m-d", $waitTime);
	$date = date("Y-m-d");

	$sql = "INSERT INTO `ig_follows` ";
	$sql .= "VALUES('".$user_id."', '".$follows_user_id."', '".$follows_unfollow_date."', '".$date."') ";
	$sql .= "ON DUPLICATE KEY UPDATE ";
	$sql .= "`freshness`='".$date."'; ";
	sql_set_query( $sql );

	$sql = "INSERT INTO `ig_botaction_follow` ";
	$sql .= "VALUES('".$user_id."', '".$follows_user_id."', '".$date."') ";
	$sql .= "ON DUPLICATE KEY UPDATE ";
	$sql .= "`action_date`='".$date."';";
	
	jr( sql_set_query( $sql ) );
}
else
	jr("Missing user_id and/or follows_user_id params.");

?>