<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["post_id"] ) && isset( $_POST["user_id"] ) ){

	$post_id = $_POST["post_id"];
	$user_id = $_POST["user_id"];
	$post_time = $_POST["post_time"];
	$post_num_likes = $_POST["post_num_likes"];
	$post_description = str_replace("'", "", $_POST["post_description"]);
	$post_is_video = $_POST["post_is_video"];
	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_users` ";
	$sql .= "VALUES('".$post_id."', ".$user_id.", ".$post_time.", ".$post_num_likes.", '".$post_description."', ".$post_is_video.", '".$date."') ";

	// only update the passed values
	$sql .= "ON DUPLICATE KEY UPDATE ";
	
	if( isset( $_POST["post_time"] ) )
		$sql .= "`post_time`=".$post_time.",";
	if( isset( $_POST["post_num_likes"] ) )
		$sql .= "`post_num_likes`=".$post_num_likes.",";
	if( isset( $_POST["post_description"] ) )
		$sql .= "`post_description`='".$post_description."',";
	if( isset( $_POST["post_is_video"] ) )
		$sql .= "`post_is_video`='".$post_is_video."',";
	if( isset( $_POST["date"] ) )
		$sql .= "`date`='".$date."',";

	$sql .= "`freshness`='".$date."';";
	jr( sql_set_query( $sql ) );
	
}

else
	jr("Missing post_id/user_id param.");

?>
