<?php 


require getcwd().'/../../lib/h.php';

if( !isset(  $_POST["user_id"] ) ){
	jr("Missing user_id param.");	
}
else {
	if( isset( $_POST["limit"] ) && isset( $_POST["min_posts"] ) ){

		$user_id = $_POST["user_id"];
		$limit = $_POST["limit"];
		$min_posts = $_POST["min_posts"];

		$sql = 'SELECT follower_user_id as user_id
	FROM (SELECT follower_user.user_id AS follower_user_id,
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
				(SELECT ig_follows.user_id 
				FROM ig_follows 
				WHERE ig_follows.follows_user_id = "'.$user_id.'")
		) AS ig_'.$user_id.'_avgs 
		WHERE follower_user.user_id NOT IN (
			SELECT user_id FROM ig_follows WHERE follows_user_id = "'.$user_id.'"
			UNION
			SELECT follows_user_id AS user_id FROM ig_follows WHERE user_id = "'.$user_id.'"
			UNION
			SELECT follows_user_id AS user_id FROM ig_botaction_follow WHERE user_id = "'.$user_id.'"
			UNION
			SELECT user_id FROM ig_deleted_users
		) 
		AND follower_user.user_num_followers < follower_user.user_num_following
		AND follower_user.user_num_following < 2000
		AND follower_user.user_num_followers < 2000
		AND follower_user.user_num_following > 150
		AND follower_user.user_num_followers > 100
		AND follower_user.user_num_posts >= '.$min_posts.'
		ORDER BY follow_rating 
		LIMIT 0,'.$limit.') as t1;';

		jr( sql_get_query( $sql ) );
	}

	else if( isset( $_POST["limit"] ) ){

		$user_id = $_POST["user_id"];
		$limit = $_POST["limit"];

		$sql = 'SELECT follower_user_id as user_id
	FROM (SELECT follower_user.user_id AS follower_user_id,
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
				(SELECT ig_follows.user_id 
				FROM ig_follows 
				WHERE ig_follows.follows_user_id = "'.$user_id.'")
		) AS ig_'.$user_id.'_avgs 
		WHERE follower_user.user_id NOT IN (
			SELECT user_id FROM ig_follows WHERE follows_user_id = "'.$user_id.'"
			UNION
			SELECT follows_user_id AS user_id FROM ig_follows WHERE user_id = "'.$user_id.'"
			UNION
			SELECT follows_user_id AS user_id FROM ig_botaction_follow WHERE user_id = "'.$user_id.'"
			UNION
			SELECT user_id FROM ig_deleted_users
		) 
		AND follower_user.user_num_followers < follower_user.user_num_following
		AND follower_user.user_num_following < 2000
		AND follower_user.user_num_followers < 2000
		AND follower_user.user_num_following > 150
		AND follower_user.user_num_followers > 100
		AND follower_user.user_num_posts > 0
		ORDER BY follow_rating 
		LIMIT 0,'.$limit.') as t1;';

		jr( sql_get_query( $sql ) );
	}
	else {

		$user_id = $_POST["user_id"];

		$sql = 'SELECT follower_user_id as user_id
	FROM (SELECT follower_user.user_id AS follower_user_id,
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
				(SELECT ig_follows.user_id 
				FROM ig_follows 
				WHERE ig_follows.follows_user_id = "'.$user_id.'")
		) AS ig_'.$user_id.'_avgs 
		WHERE follower_user.user_id NOT IN (
			SELECT user_id FROM ig_follows WHERE follows_user_id = "'.$user_id.'"
			UNION
			SELECT follows_user_id AS user_id FROM ig_follows WHERE user_id = "'.$user_id.'"
			UNION
			SELECT follows_user_id AS user_id FROM ig_botaction_follow WHERE user_id = "'.$user_id.'"
			UNION
			SELECT user_id FROM ig_deleted_users
		) 
		AND follower_user.user_num_followers < follower_user.user_num_following
		AND follower_user.user_num_following < 2000
		AND follower_user.user_num_followers < 2000
		AND follower_user.user_num_following > 150
		AND follower_user.user_num_followers > 100
		AND follower_user.user_num_posts > 0
		ORDER BY follow_rating 
		LIMIT 0,2000) as t1;';

		jr( sql_get_query( $sql ) );
	}

}





/*
CREATE TEMPORARY TABLE IF NOT EXISTS ig_$user_id_avgs AS (
	SELECT ROUND(AVG(user_num_posts)) AS posts, ROUND(AVG(user_num_followers)) AS followers, ROUND(AVG(user_num_following)) AS following
		FROM ig_users
		WHERE user_id IN 
			(SELECT ig_follows.user_id 
			FROM ig_follows 
			WHERE ig_follows.follows_user_id = "$user_id")
);

SELECT follower_user.user_id AS follower_user_id,
follower_user.user_num_posts,
follower_user.user_num_followers,
follower_user.user_num_following,
ROUND ( 
	( ABS(follower_user.user_num_followers - ig_$user_id_avgs.followers) + ABS(follower_user.user_num_following - ig_$user_id_avgs.following) ) *
	( (follower_user.user_num_followers + follower_user.user_num_following)/(ig_$user_id_avgs.followers + ig_$user_id_avgs.following) ) *
	( follower_user.user_num_followers/follower_user.user_num_following ) *
	( follower_user.user_num_posts/ig_$user_id_avgs.posts )
) AS follow_rating
FROM ig_users AS follower_user, ig_$user_id_avgs 
WHERE follower_user.user_id NOT IN (
		SELECT user_id FROM ig_follows WHERE follows_user_id = "'.$user_id.'"
		UNION
		SELECT follows_user_id AS user_id FROM ig_follows WHERE user_id = "'.$user_id.'"
		UNION
		SELECT follows_user_id AS user_id FROM ig_botaction_follow WHERE user_id = "'.$user_id.'"
		UNION
		SELECT user_id FROM ig_deleted_users
) 
AND follower_user.user_num_followers < follower_user.user_num_following
AND follower_user.user_num_following < 2000
AND follower_user.user_num_followers < 2000
AND follower_user.user_num_following > 150
AND follower_user.user_num_followers > 100
AND follower_user.user_num_posts > 0
ORDER BY follow_rating;
*/

?>

