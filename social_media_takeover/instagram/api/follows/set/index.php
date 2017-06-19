<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) && isset( $_POST["follows_user_id"] ) ){

	$user_id = $_POST["user_id"];
	$follows_user_id = $_POST["follows_user_id"];

	// check if this comes with an unfollow date and format for null or actual 'date'
	$follows_unfollow_date = "NULL";
	if( isset( $_POST["follows_unfollow_date"] ) )
		$follows_unfollow_date = "'".$_POST["follows_unfollow_date"]."'";

	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_follows` ";
	$sql .= "VALUES('".$user_id."', '".$follows_user_id."', '".$follows_unfollow_date."', '".$date."') ";
	$sql .= "ON DUPLICATE KEY UPDATE ";
	$sql .= "`follows_user_id`='".$follows_user_id."',";
	$sql .= "`follows_unfollow_date`=".$follows_unfollow_date.","; // no '' wrapping this var as already wrapped into variable
	$sql .= "`freshness`='".$date."';";
	
	jr( sql_set_query( $sql ) );
}
else
	jr("Missing user_id and/or follows_user_id params.");

?>