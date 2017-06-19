<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_id"] ) && isset( $_POST["num_follows"] ) ){

	$user_id = $_POST["user_id"];
	$num_follows = $_POST["num_follows"];
	$sql = "";

	if( isset( $_POST["tag_name"] ) ){
		$tag_name = $_POST["tag_name"];
		$sql .= "SELECT DISTINCT `user_id` ";
		$sql .= "FROM `ig_user_tag_interest` ";
		$sql .= "WHERE `tag_name` == '".$tag_name."' AND `user_id` IN (";
	}

	$sql .= "SELECT DISTINCT `user_id` ";
	$sql .= "FROM `ig_users` ";
	$sql .= "WHERE `user_num_followers` <= 800 ";
	$sql .= "AND `user_num_following` <= 800 ";
	$sql .= "AND `user_num_followers` <= 100 + `user_num_following` ";
	$sql .= "AND `user_num_following` <= 200 + `user_num_followers` ";
	$sql .= "AND `user_num_followers` >= 150 ";
	$sql .= "AND `user_num_following` >= 200 ";
	$sql .= "AND `user_id` NOT IN ";
	$sql .= "(SELECT `user_id` FROM `ig_follows` WHERE `follows_user_id` == '".$user_id."')";
	$sql .= "AND `user_id` NOT IN ";
	$sql .= "(SELECT `follows_user_id` FROM `ig_follows` WHERE `user_id` == '".$user_id."')";
	$sql .= "ORDER BY `user_num_followers` ASC";

	if( isset( $_POST["tag_name"] ) ){
		$sql .= ") ";
	}

	$sql .= "LIMIT 0,".$num_follows.";";
	
	jr( sql_get_query( $sql ) );
}
else
	jr("Missing user_id and/or num_follows params.");
?>