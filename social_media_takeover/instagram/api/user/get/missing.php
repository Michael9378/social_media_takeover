<?php 

// gets user in the follows table that arent listed in the user table.

require getcwd().'/../../lib/h.php';
if( isset( $_POST["scrape_limit"] ) && isset( $_POST["user_id"] ) ){

	$scrape_limit = $_POST["scrape_limit"];
	$user_id = $_POST["user_id"];
	$month_ago =  date('Y-m-d',strtotime("-30 days"));

	$sql = "SELECT DISTINCT `user_id` FROM `ig_follows` WHERE ";
	$sql .= "`follows_user_id` = '" . $user_id . "' ";
	$sql .= "&& `user_id` NOT IN(";
	$sql .= "SELECT `user_id` FROM `ig_users` WHERE `freshness` > '" . $month_ago . "' ";	
	$sql .= ") AND `user_id` NOT IN (SELECT `user_id` FROM ig_deleted_users) LIMIT 0,".$scrape_limit.";";

	jr( sql_get_query( $sql ) );
}
else if( isset( $_POST["scrape_limit"] ) && isset( $_POST["tag_interest"] ) ){

	$scrape_limit = $_POST["scrape_limit"];
	$tag_interest = json_decode($_POST["tag_interest"]);

	$sql = "SELECT DISTINCT `user_id` 
		FROM `ig_user_tag_interest` 
		WHERE  (";

	foreach($tag_interest as $tag){
		$sql .= " `tag_name` = '".$tag."' OR";
	}

	$sql = substr($sql, 0, -2);

	$sql .= ")
		AND `user_id` NOT IN
		(SELECT `user_id` FROM ig_deleted_users UNION 
   	SELECT `user_id` FROM `ig_users`)";
	$sql .= "ORDER BY RAND() LIMIT 0,".$scrape_limit.";";
	
	jr( sql_get_query( $sql ) );
}
else if( isset( $_POST["scrape_limit"] ) ){

	$scrape_limit = $_POST["scrape_limit"];

	$sql = "SELECT DISTINCT `user_id` 
		FROM `ig_user_tag_interest` 
		WHERE `user_id` NOT IN
			(SELECT `user_id` FROM ig_deleted_users UNION 
   		SELECT `user_id` FROM `ig_users`)";
	$sql .= "ORDER BY RAND() LIMIT 0,".$scrape_limit.";";

	jr( sql_get_query( $sql ) );
}
else
	jr("Missing scrape_limit param.");

?>
