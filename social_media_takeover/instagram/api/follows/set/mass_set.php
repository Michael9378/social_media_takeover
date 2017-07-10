<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) && isset( $_POST["follow_base"] ) ){

	$user_id = $_POST["user_id"];
	$follow_base = $_POST["follow_base"];
	$follow_base = json_decode($follow_base);

	$followers = $follow_base->followers;
	$following = $follow_base->following;

	// Flush follow info for refill.
	sql_set_query("DELETE FROM `ig_follows` WHERE `follows_user_id` = '" . $user_id . "' OR `user_id` = '" . $user_id . "';");

	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_follows` ";
	$sql .= "VALUES";
	foreach($followers as $follow){
		$sql .= "('".$follow."', '".$user_id."', 'NULL', '".$date."'), ";
	}
	foreach($following as $follow){
		$sql .= "('".$user_id."', '".$follow."', 'NULL', '".$date."'), ";
	}
	$sql = substr($sql, 0, -2);
	$sql .= " ON DUPLICATE KEY UPDATE ";
	$sql .= "`freshness`='".$date."';";

	jr( sql_set_query( $sql ) );
}
else
	jr("Missing user_id and/or follow_base params.");

?>