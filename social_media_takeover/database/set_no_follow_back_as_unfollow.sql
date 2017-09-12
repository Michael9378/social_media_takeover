CREATE TEMPORARY TABLE unfollows
AS 
(
	SELECT DISTINCT follows_user_id 
	FROM `ig_follows` 
	WHERE `user_id` = 'dirtkingdom' and `follows_user_id` NOT IN ( 
	SELECT user_id 
	FROM `ig_follows` 
	WHERE `follows_user_id` = 'dirtkingdom')
);

SELECT * 
FROM `unfollows`;

UPDATE `ig_follows` 
SET `follows_unfollow_date`='0000-00-01'
WHERE `user_id` = 'dirtkingdom' 
AND `follows_user_id` IN 
(
    SELECT * 
    FROM `unfollows`
);