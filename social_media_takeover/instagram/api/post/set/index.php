<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["post_id"] ) ){

	$post_id = $_POST["post_id"];
	$user_id = $_POST["user_id"];
	$post_time = $_POST["post_time"];
	$num_likes = $_POST["num_likes"];
	$description = $_POST["description"];
	$location = $_POST["location"];
	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_users` ";
	$sql .= "VALUES('".$post_id."', ".$user_id.", ".$post_time.", ".$num_likes.", '".$description."', '".$location."', '".$date."') ";

	// only update the passed values
	$sql .= "ON DUPLICATE KEY UPDATE ";

	if( isset( $_POST["user_id"] ) )
		$sql .= "`user_id`=".$user_id.",";
	if( isset( $_POST["post_time"] ) )
		$sql .= "`post_time`=".$post_time.",";
	if( isset( $_POST["num_likes"] ) )
		$sql .= "`num_likes`=".$num_likes.",";
	if( isset( $_POST["description"] ) )
		$sql .= "`description`='".$description."',";
	if( isset( $_POST["location"] ) )
		$sql .= "`location`='".$location."',";
	if( isset( $_POST["date"] ) )
		$sql .= "`date`='".$date."',";

	$sql .= "`freshness`='".$date."';";
	jr( sql_set_query( $sql ) );
	
}

else
	jr("Missing post_id param.");

?>
