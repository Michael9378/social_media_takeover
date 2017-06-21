<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) && isset( $_POST["tag_name"] ) ){

	$user_id = $_POST["user_id"];
	$tag_name = $_POST["tag_name"];
	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_user_tag_interest` ";
	$sql .= "VALUES('".$user_id."', '".$tag_name."', '".$date."') ";
	$sql .= "ON DUPLICATE KEY UPDATE ";
	$sql .= "`freshness`='".$date."';";
	
	jr( sql_set_query( $sql ) );
}
else
	jr("Missing user_id and/or tag_name params.");

?>