
DROP TABLE IF EXISTS ig_users;
DROP TABLE IF EXISTS ig_follows;
DROP TABLE IF EXISTS ig_posts;
DROP TABLE IF EXISTS ig_likes;
DROP TABLE IF EXISTS ig_comments;
DROP TABLE IF EXISTS ig_tags;
DROP TABLE IF EXISTS ig_user_tag_interest;
DROP TABLE IF EXISTS ig_tagged_in_post;
DROP TABLE IF EXISTS ig_botaction_follow;
DROP TABLE IF EXISTS ig_botaction_like;
DROP TABLE IF EXISTS ig_log;

CREATE TABLE ig_users
(
	user_id VARCHAR(35),
	user_num_posts INT,
	user_num_followers INT,
	user_num_following INT,
	user_profile_pic VARCHAR(200),
	user_real_name VARCHAR(50),
	user_bio VARCHAR(500),
	user_website VARCHAR(100),
	freshness DATE,
	PRIMARY KEY (user_id)
);

CREATE TABLE ig_follows
(
	user_id VARCHAR(35),
	follows_user_id VARCHAR(35),
	follows_unfollow_date DATE,
	freshness DATE,
	PRIMARY KEY (user_id, follows_user_id)
);

CREATE TABLE ig_posts
(
	post_id VARCHAR(100),
	user_id VARCHAR(35),
	post_time INT,
	post_num_likes INT,
	post_description VARCHAR(500),
	post_is_video INT,
	freshness DATE,
	PRIMARY KEY(post_id),
	FOREIGN KEY(user_id) references ig_users(user_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE ig_tagged_in_post
(
	user_id VARCHAR(35),
	post_id VARCHAR(100),
	freshness DATE,
	PRIMARY KEY(post_id, user_id),
	FOREIGN KEY(post_id) references ig_posts(post_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(user_id) references ig_users(user_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE ig_likes
(
	post_id VARCHAR(100),
	user_id VARCHAR(35),
	freshness DATE,
	PRIMARY KEY(post_id, user_id),
	FOREIGN KEY(post_id) references ig_posts(post_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(user_id) references ig_users(user_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE ig_comments
(
	post_id VARCHAR(100),
	user_id VARCHAR(35),
	comment_content VARCHAR(500),
	comment_time INT,
	freshness DATE,
	PRIMARY KEY(post_id, user_id, comment_content),
	FOREIGN KEY(post_id) references ig_posts(post_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(user_id) references ig_users(user_id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE ig_tags
(
	tag_name VARCHAR(35),
	tag_num_posts INT,
	freshness DATE,
	PRIMARY KEY(tag_name)
);

CREATE TABLE ig_user_tag_interest
(
	user_id VARCHAR(35),
	tag_name VARCHAR(35),
	freshness DATE,
	PRIMARY KEY(user_id, tag_name)
);

CREATE TABLE ig_botaction_follow
(
	user_id VARCHAR(35),
	follows_user_id VARCHAR(35),
	action_date DATE,
	PRIMARY KEY (user_id, follows_user_id)
);

CREATE TABLE ig_botaction_like
(
	post_id VARCHAR(100),
	user_id VARCHAR(35),
	action_date DATE,
	PRIMARY KEY(post_id, user_id)
);

CREATE TABLE ig_log
(
	log_time DATE,
	log_type VARCHAR(10),
	log_msg VARCHAR(200),
	PRIMARY KEY(log_time, log_msg)
);

/*
CREATE OR REPLACE VIEW ig_user_avgs AS
	SELECT ROUND(AVG(`user_num_posts`)) AS `posts`, ROUND(AVG(`user_num_followers`)) AS `followers`, ROUND(AVG(`user_num_following`)) AS `following` 
	FROM `ig_users`
	WHERE `ig_users`.`user_id` IN (
		SELECT `user_id` FROM `ig_follows` WHERE `follows_user_id` = 'dirtkingdom'
		);

CREATE OR REPLACE VIEW ig_user_stats AS
	SELECT `user_id`,`user_num_posts`,`user_num_followers`,`user_num_following`,
	ROUND((`user_num_followers` / `user_num_following`) * (ABS(`user_num_followers` - `followers`) + ABS(`user_num_following` - `following`))) AS `auto_follow_rating`,
	(ABS(`user_num_followers` - `followers`) + ABS(`user_num_following` - `following`)) AS `dev_rating`,
	ABS(`user_num_followers` - `followers`) AS `followers_dev`, 
	ABS(`user_num_following` - `following`) AS `following_dev`
	FROM `ig_users`, `ig_user_avgs` 
	WHERE `user_id` IN (
		SELECT `user_id` FROM `ig_follows` WHERE `follows_user_id` = 'dirtkingdom'
	) AND `user_num_following` < 2000
	AND `user_num_followers` < 2000
	ORDER BY (`auto_follow_rating`) ASC;
*/