<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_name"] ) ){

	$user_id = $_POST["user_name"];
	$user_num_posts = $_POST["user_num_posts"];
	$user_num_followers = $_POST["user_num_followers"];
	$user_num_following = $_POST["user_num_following"];
	$date = date("Y/m/d");

	$sql = "INSERT IGNORE INTO `ig_user_historical` ";
	$sql .= "VALUES('".$user_id."', ".$user_num_posts.", ".$user_num_followers.", ".$user_num_following.", '".$date."');";

	jr( sql_set_query( $sql ) );
}
else
	jr("Missing user_name param.");

?>