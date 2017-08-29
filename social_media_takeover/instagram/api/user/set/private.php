<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) ){

	$user_id = $_POST["user_id"];

	$sql = "INSERT IGNORE INTO `ig_private_users` VALUES('".$user_id."');";

	jr( sql_set_query( $sql ) );
}
else
	jr("Missing user_id param.");

?>