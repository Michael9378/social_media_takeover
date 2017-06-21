<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["tag_name"] ) ){

	$tag_name = $_POST["tag_name"];

	$sql = "SELECT `tag_num_posts` ";
	$sql .= "FROM `ig_tags` ";
	$sql .= "WHERE `tag_name` = '".$tag_name."';";
	jr( sql_get_query( $sql ) );
}
else
	jr("Missing tag_name param.");

?>