<?php 

// gets user in the follows table that arent listed in the user table.

require getcwd().'/../../lib/h.php';

if( isset( $_POST["scrape_limit"] ) ){

	$scrape_limit = $_POST["scrape_limit"];

	$sql = "SELECT `ig_follows`.`user_id` AS `user_id`";
	$sql .= "FROM `ig_follows`";
	$sql .= "LEFT JOIN `ig_users`";
	$sql .= "ON `ig_follows`.`user_id` = `ig_users`.`user_id`";
	$sql .= "WHERE `ig_follows`.`user_id` NOT IN (SELECT `user_id` FROM `ig_users`)";
	$sql .= "UNION";
	$sql .= "SELECT `ig_follows`.`follows_user_id` AS `user_id`";
	$sql .= "FROM `ig_follows`";
	$sql .= "LEFT JOIN `ig_users`";
	$sql .= "ON `ig_follows`.`follows_user_id` = `ig_users`.`user_id`";
	$sql .= "WHERE `ig_follows`.`follows_user_id` NOT IN (SELECT `user_id` FROM `ig_users`)";
	$sql .= "LIMIT 0,".$scrape_limit.";";

	jr( sql_get_query( $sql ) );
}
else
	jr("Missing scrape_limit param.");

?>