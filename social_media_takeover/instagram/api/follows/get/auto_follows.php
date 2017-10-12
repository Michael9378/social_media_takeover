<?php 


require getcwd().'/../../lib/h.php';

if( !isset(  $_POST["user_id"] ) && !isset(  $_POST["tags"] ) ){
	jr("Missing user_id and/or tags params.");	
}
else {
	
	$user_id = $_POST["user_id"];
	$tags = $_POST["tags"];
	$tags = json_decode($tags);
	$limit = '2000';
	$min_posts = '0';
	
	if( isset( $_POST["limit"] ) )
		$limit = $_POST["limit"];
	
	if( isset(  $_POST["min_posts"] ) )
		$min_posts = $_POST["min_posts"];	
	
	$sql = 'SELECT follower_user_id as user_id
	FROM (
		SELECT follower_user.user_id AS follower_user_id,
		follower_user.user_num_posts,
		follower_user.user_num_followers,
		follower_user.user_num_following,
		ROUND ( 
			( ABS(follower_user.user_num_followers - ig_'.$user_id.'_avgs.followers) + ABS(follower_user.user_num_following - ig_'.$user_id.'_avgs.following) ) *
			( (follower_user.user_num_followers + follower_user.user_num_following)/(ig_'.$user_id.'_avgs.followers + ig_'.$user_id.'_avgs.following) ) *
			( follower_user.user_num_followers/follower_user.user_num_following ) *
			( follower_user.user_num_posts/ig_'.$user_id.'_avgs.posts )
		) AS follow_rating
		FROM ig_users AS follower_user, (
		SELECT ROUND(AVG(user_num_posts)) AS posts, ROUND(AVG(user_num_followers)) AS followers, ROUND(AVG(user_num_following)) AS following
		FROM ig_users
		WHERE user_id IN 
		(
			SELECT ig_follows.user_id 
			FROM ig_follows 
			WHERE ig_follows.follows_user_id = "'.$user_id.'"
		)
	) AS ig_'.$user_id.'_avgs, ig_user_tag_interest 
	WHERE follower_user.user_num_followers < follower_user.user_num_following
	AND follower_user.user_num_following < 2000
	AND follower_user.user_num_followers < 1500
	AND follower_user.user_num_following > 200
	AND follower_user.user_num_followers > 150
	AND follower_user.user_num_posts > '.$min_posts.'
	AND ig_user_tag_interest.user_id = follower_user.user_id
	AND (';
	foreach($tags as $tag){
		$sql .= 'ig_user_tag_interest.tag_name ="'.$tag.'" OR ';
	}
	$sql = substr($sql, 0, -3);
	$sql .= ')
	ORDER BY follow_rating) as t1
	WHERE t1.follower_user_id NOT IN (
		SELECT user_id
		FROM ig_follows
		WHERE follows_user_id = "'.$user_id.'"
		UNION
		SELECT follows_user_id AS user_id
		FROM ig_follows
		WHERE user_id = "'.$user_id.'"
		UNION
		SELECT follows_user_id AS user_id 
		FROM ig_botaction_follow
		WHERE user_id = "'.$user_id.'"
		UNION
		SELECT user_id FROM ig_deleted_users
	) 
	LIMIT 0,'.$limit.';';
	
	jr( sql_get_query( $sql ) );

}

?>


