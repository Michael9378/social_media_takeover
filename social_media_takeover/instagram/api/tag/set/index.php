<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["tag_name"] ) && isset( $_POST["tag_num_posts"] ) ){

	$tag_name = $_POST["tag_name"];
	$tag_num_posts = $_POST["tag_num_posts"];
	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_tags` ";
	$sql .= "VALUES('".$tag_name."', ".$tag_num_posts.", '".$date."') ";
	$sql .= "ON DUPLICATE KEY UPDATE ";
	$sql .= "`tag_num_posts`=".$tag_num_posts.",`freshness`='".$date."';";
	jr( sql_set_query( $sql ) );
}
else
	jr("Missing tag_name and/or tag_num_posts params.");

?>


