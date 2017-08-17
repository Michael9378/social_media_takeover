<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) && isset( $_POST["post_id"] ) && isset( $_POST["comment_content"] ) ){

	$user_id = $_POST["user_id"];
	$post_id = $_POST["post_id"];
	$comment_content = str_replace("'", "", $_POST["comment_content"]);
	$comment_time = $_POST["comment_time"];
	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_likes` ";
	$sql .= "VALUES('".$user_id."', '".$post_id."', '".$comment_content."', ".$comment_time.", '".$date."') ";
	$sql .= "ON DUPLICATE KEY UPDATE ";
	$sql .= "`freshness`='".$date."';";
	
	jr( sql_set_query( $sql ) );
}
else
	jr("Missing user_id, comment_content and/or post_id params.");

?>