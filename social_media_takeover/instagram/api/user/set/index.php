<?php 


require getcwd().'/../../lib/h.php';

if( isset( $_POST["user_name"] ) ){

	$user_id = $_POST["user_name"];
	$user_idNum = $_POST["user_id"];
	$user_num_posts = $_POST["user_num_posts"];
	$user_num_followers = $_POST["user_num_followers"];
	$user_num_following = $_POST["user_num_following"];
	$user_profile_pic = $_POST["user_profile_pic"];
	$user_real_name = str_replace("'", "", $_POST["user_real_name"]);
	$user_bio = str_replace("'", "", $_POST["user_bio"]);
	$user_website = str_replace("'", "", $_POST["user_website"]);
	$date = date("Y/m/d");

	$sql = "INSERT INTO `ig_users` ";
	$sql .= "VALUES('".$user_id."', '".$user_idNum."', ".$user_num_posts.", ".$user_num_followers.", ".$user_num_following.", '".$user_profile_pic."', '".$user_real_name."', '".$user_bio."', '".$user_website."', '".$date."') ";

	// only update the passed values
	$sql .= "ON DUPLICATE KEY UPDATE ";

	if( isset( $_POST["user_num_posts"] ) )
		$sql .= "`user_num_posts`=".$user_num_posts.",";
	if( isset( $_POST["user_num_followers"] ) )
		$sql .= "`user_num_followers`=".$user_num_followers.",";
	if( isset( $_POST["user_num_following"] ) )
		$sql .= "`user_num_following`=".$user_num_following.",";
	if( isset( $_POST["user_profile_pic"] ) )
		$sql .= "`user_profile_pic`='".$user_profile_pic."',";
	if( isset( $_POST["user_real_name"] ) )
		$sql .= "`user_real_name`='".$user_real_name."',";
	if( isset( $_POST["user_bio"] ) )
		$sql .= "`user_bio`='".$user_bio."',";
	if( isset( $_POST["user_website"] ) )
		$sql .= "`user_website`='".$user_website."',";

	$sql .= "`freshness`='".$date."';";
	jr( sql_set_query( $sql ) );
}
else
	jr("Missing user_name param.");

?>