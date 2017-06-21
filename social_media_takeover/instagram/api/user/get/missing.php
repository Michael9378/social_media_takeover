<?php 

// gets user in the follows table that arent listed in the user table.

require getcwd().'/../../lib/h.php';

if( isset( $_POST["scrape_limit"] ) ){

	$scrape_limit = $_POST["scrape_limit"];

	$sql = "SELECT DISTINCT `user_id` FROM (";
	$sql .= "SELECT `user_id` FROM `ig_follows` ";
	$sql .= "UNION ";
	$sql .= "SELECT `follows_user_id` AS `user_id` FROM `ig_follows` ";
	$sql .= "UNION ";
	$sql .= "SELECT `user_id` FROM `ig_user_tag_interest`) AS `user_sum` ";
	$sql .= "WHERE `user_sum`.`user_id` NOT IN(";
	$sql .= "SELECT `user_id` FROM `ig_users`) ";
	$sql .= "LIMIT 0,".$scrape_limit.";";

	jr( sql_get_query( $sql ) );
}
else
	jr("Missing scrape_limit param.");

?>