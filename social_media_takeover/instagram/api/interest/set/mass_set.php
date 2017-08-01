<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["tag_name"] ) && isset( $_POST["tag_base"] ) ){

	$tag_name = $_POST["tag_name"];
	$tag_base = $_POST["tag_base"];
	$tag_base = json_decode($tag_base);
	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_user_tag_interest` ";
	$sql .= "VALUES";
	foreach($tag_base as $user_id){
		$sql .= "('".$user_id."', '".$tag_name."', '".$date."'), ";
	}
	// trim the space and comma
	$sql = substr($sql, 0, -2);
	$sql .= " ON DUPLICATE KEY UPDATE ";
	$sql .= "`freshness`='".$date."';";

	jr( sql_set_query( $sql ) );
}
else
	jr("Missing tag_name and/or tag_base params.");

?>