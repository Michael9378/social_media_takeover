<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) && isset( $_POST["follows_user_id"] ) ){

	$user_id = $_POST["user_id"];
	$follows_user_id = $_POST["follows_user_id"];
	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_follows` ";
	$sql .= "VALUES('".$user_id."', '".$follows_user_id."', '".$date."') ";
	$sql .= "ON DUPLICATE KEY UPDATE ";
	$sql .= "`follows_user_id`='".$follows_user_id."',";
	$sql .= "`freshness`='".$date."';";
	
	jr( sql_set_query( $sql ) );
}
else
	jr("Missing parameters.");

?>