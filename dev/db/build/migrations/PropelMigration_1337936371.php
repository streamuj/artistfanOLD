<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1337936371.
 * Generated on 2012-05-25 10:59:31 by ssergy
 */
class PropelMigration_1337936371
{

	public function preUp($manager)
	{
		// add the pre-migration code here
	}

	public function postUp($manager)
	{
		// add the post-migration code here
	}

	public function preDown($manager)
	{
		// add the pre-migration code here
	}

	public function postDown($manager)
	{
		// add the post-migration code here
	}

	/**
	 * Get the SQL statements for the Up migration
	 *
	 * @return array list of the SQL strings to execute for the Up migration
	 *               the keys being the datasources
	 */
	public function getUpSQL()
	{
		return array (
  'artistfan' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP INDEX `sortid` ON `countries`;

DROP INDEX `sortid_2` ON `countries`;

ALTER TABLE `countries` CHANGE `iso2` `iso2` VARCHAR(2) NOT NULL;

ALTER TABLE `countries` CHANGE `name` `name` VARCHAR(100) DEFAULT \'\';

ALTER TABLE `countries` CHANGE `pcode` `pcode` VARCHAR(10) DEFAULT \'\';

ALTER TABLE `countries` CHANGE `sortid` `sortid` INTEGER(11) DEFAULT 0;

CREATE INDEX `countries_I_1` ON `countries` (`name`,`sortid`);

ALTER TABLE `event` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `event` CHANGE `event_type` `event_type` INTEGER(11) DEFAULT 0;

ALTER TABLE `event` CHANGE `price` `price` FLOAT DEFAULT 0;

ALTER TABLE `event` CHANGE `code` `code` VARCHAR(50) DEFAULT \'\';

ALTER TABLE `event` CHANGE `status` `status` TINYINT(1) DEFAULT 1;

ALTER TABLE `event` CHANGE `deleted` `deleted` TINYINT(1) DEFAULT 0;

ALTER TABLE `event` ADD CONSTRAINT `event_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `event_attend` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `event_attend` CHANGE `event_id` `event_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `event_attend` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `event_attend` ADD CONSTRAINT `event_attend_FK_1`
	FOREIGN KEY (`event_id`)
	REFERENCES `event` (`id`);

ALTER TABLE `event_purchase` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `event_purchase` CHANGE `event_id` `event_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `event_purchase` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `event_purchase` ADD CONSTRAINT `event_purchase_FK_1`
	FOREIGN KEY (`event_id`)
	REFERENCES `event` (`id`);

ALTER TABLE `music` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `music` CHANGE `album_id` `album_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `music` CHANGE `track_length` `track_length` VARCHAR(20) DEFAULT \'\';

ALTER TABLE `music` CHANGE `track_preview` `track_preview` VARCHAR(100) DEFAULT \'\';

ALTER TABLE `music` CHANGE `track_preview_length` `track_preview_length` VARCHAR(20) DEFAULT \'\';

ALTER TABLE `music` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `music` CHANGE `deleted` `deleted` TINYINT(1) DEFAULT 0;

ALTER TABLE `music` ADD CONSTRAINT `music_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `music` ADD CONSTRAINT `music_FK_2`
	FOREIGN KEY (`album_id`)
	REFERENCES `music_album` (`id`);

ALTER TABLE `music` ADD CONSTRAINT `music_FK_3`
	FOREIGN KEY (`id`)
	REFERENCES `music_purchase` (`music_id`);

ALTER TABLE `music_album` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `music_album` CHANGE `price` `price` FLOAT DEFAULT 0;

ALTER TABLE `music_album` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `music_album` CHANGE `featured` `featured` TINYINT(1) DEFAULT 0;

ALTER TABLE `music_album` CHANGE `deleted` `deleted` TINYINT(1) DEFAULT 0;

ALTER TABLE `music_album` ADD CONSTRAINT `music_album_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `music_purchase` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `music_purchase` CHANGE `music_id` `music_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `music_purchase` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `music_purchase` ADD CONSTRAINT `music_purchase_FK_1`
	FOREIGN KEY (`music_id`)
	REFERENCES `music` (`id`);

ALTER TABLE `pages` CHANGE `sortid` `sortid` INTEGER(11) DEFAULT 0;

ALTER TABLE `pages` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `payment_info` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `payment_info` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `payment_info` ADD CONSTRAINT `payment_info_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `payout` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `payout` CHANGE `ptype` `ptype` TINYINT(1) DEFAULT 0;

ALTER TABLE `payout` CHANGE `balance` `balance` FLOAT DEFAULT 0;

ALTER TABLE `payout` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `payout` CHANGE `user_from` `user_from` INTEGER(11) DEFAULT 0;

ALTER TABLE `payout` CHANGE `payment_info_id` `payment_info_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `payout` ADD CONSTRAINT `payout_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `payout` ADD CONSTRAINT `payout_FK_2`
	FOREIGN KEY (`payment_info_id`)
	REFERENCES `payment_info` (`id`);

ALTER TABLE `photo` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `photo` CHANGE `album_id` `album_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `photo` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `photo` ADD CONSTRAINT `photo_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `photo` ADD CONSTRAINT `photo_FK_2`
	FOREIGN KEY (`album_id`)
	REFERENCES `photo_album` (`id`);

ALTER TABLE `photo_album` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `photo_album` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `photo_album` ADD CONSTRAINT `photo_album_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `shopping_log` CHANGE `wall_id` `wall_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `artist_id` `artist_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `album_id` `album_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `music_id` `music_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `video_id` `video_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `event_id` `event_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `shopping_log` ADD CONSTRAINT `shopping_log_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

DROP INDEX `fb_id` ON `user`;

ALTER TABLE `user` CHANGE `band_name` `band_name` VARCHAR(150) DEFAULT \'\';

ALTER TABLE `user` CHANGE `country` `country` VARCHAR(2) DEFAULT \'\';

ALTER TABLE `user` CHANGE `location` `location` VARCHAR(250) DEFAULT \'\';

ALTER TABLE `user` CHANGE `zip` `zip` VARCHAR(20) DEFAULT \'\';

ALTER TABLE `user` CHANGE `hide_loc` `hide_loc` TINYINT(1) DEFAULT 0;

ALTER TABLE `user` CHANGE `likes` `likes` VARCHAR(250) DEFAULT \'\';

ALTER TABLE `user` CHANGE `last_login` `last_login` INTEGER(11) DEFAULT 0;

ALTER TABLE `user` CHANGE `last_reload` `last_reload` INTEGER(11) DEFAULT 0;

ALTER TABLE `user` CHANGE `reg_date` `reg_date` INTEGER(11) DEFAULT 0;

ALTER TABLE `user` CHANGE `wallet` `wallet` FLOAT DEFAULT 0;

ALTER TABLE `user` CHANGE `wallet_block` `wallet_block` FLOAT DEFAULT 0;

ALTER TABLE `user` CHANGE `fb_id` `fb_id` VARCHAR(100) DEFAULT \'\';

ALTER TABLE `user` CHANGE `fb_token` `fb_token` VARCHAR(200) DEFAULT \'\';

ALTER TABLE `user` CHANGE `fb_start` `fb_start` INTEGER(1) DEFAULT 0;

ALTER TABLE `user` CHANGE `tw_start` `tw_start` INTEGER(1) DEFAULT 0;

ALTER TABLE `user` CHANGE `tw_id` `tw_id` VARCHAR(100) DEFAULT \'\';

ALTER TABLE `user` CHANGE `tw_oauth_token` `tw_oauth_token` VARCHAR(200) DEFAULT \'\';

ALTER TABLE `user` CHANGE `tw_oauth_token_secret` `tw_oauth_token_secret` VARCHAR(200) DEFAULT \'\';

ALTER TABLE `user` CHANGE `featured` `featured` TINYINT(1) DEFAULT 0;

ALTER TABLE `user_follow` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `user_follow` CHANGE `user_id_follow` `user_id_follow` INTEGER(11) DEFAULT 0;

ALTER TABLE `user_follow` CHANGE `fan_rating` `fan_rating` FLOAT DEFAULT 0;

ALTER TABLE `user_follow` ADD CONSTRAINT `user_follow_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `user_follow` ADD CONSTRAINT `user_follow_FK_2`
	FOREIGN KEY (`user_id_follow`)
	REFERENCES `user` (`id`);

ALTER TABLE `video` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `video` CHANGE `video_preview` `video_preview` VARCHAR(250) DEFAULT \'\';

ALTER TABLE `video` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `video` CHANGE `from_yt` `from_yt` TINYINT(1) DEFAULT 0;

ALTER TABLE `video` CHANGE `deleted` `deleted` TINYINT(1) DEFAULT 0;

ALTER TABLE `video` CHANGE `status` `status` TINYINT(1) DEFAULT 0;

ALTER TABLE `video` ADD CONSTRAINT `video_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

DROP INDEX `video_purchase_FI_1` ON `video_purchase`;

ALTER TABLE `video_purchase` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `video_purchase` CHANGE `video_id` `video_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `video_purchase` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

CREATE INDEX `video_purchase_FI_1` ON `video_purchase` (`user_id`);

CREATE INDEX `video_purchase_FI_2` ON `video_purchase` (`video_id`);

ALTER TABLE `video_purchase` ADD CONSTRAINT `video_purchase_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `video_purchase` ADD CONSTRAINT `video_purchase_FK_2`
	FOREIGN KEY (`video_id`)
	REFERENCES `video` (`id`);

ALTER TABLE `wall` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `wall` CHANGE `user_id_from` `user_id_from` INTEGER(11) DEFAULT 0;

ALTER TABLE `wall` ADD CONSTRAINT `wall_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `wall` ADD CONSTRAINT `wall_FK_2`
	FOREIGN KEY (`user_id_from`)
	REFERENCES `user` (`id`);

CREATE TABLE `broadcast_viewers`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`event_id` VARCHAR(250) DEFAULT \'\',
	`user_id` INTEGER(11) DEFAULT 0,
	`pdate` INTEGER(11) DEFAULT 0,
	`udate` INTEGER(11) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `broadcast_viewers_I_1` (`event_id`, `udate`),
	INDEX `broadcast_viewers_FI_1` (`user_id`),
	CONSTRAINT `broadcast_viewers_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
) ENGINE=MyISAM;

CREATE TABLE `broadcast_flows`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`event_id` INTEGER(11) DEFAULT 0,
	`user_id` INTEGER(11) DEFAULT 0,
	`pdate` INTEGER(11) DEFAULT 0,
	`flow` VARCHAR(250) DEFAULT \'\',
	`status` TINYINT(1) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `broadcast_flows_I_1` (`event_id`),
	INDEX `broadcast_flows_FI_1` (`user_id`),
	CONSTRAINT `broadcast_flows_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
) ENGINE=MyISAM;

CREATE TABLE `event_video`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`event_id` INTEGER(11) DEFAULT 0,
	`user_id` INTEGER(11) DEFAULT 0,
	`video` VARCHAR(250) DEFAULT \'\',
	`order` TINYINT(3) DEFAULT 0,
	`pdate` INTEGER(11) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `event_video_FI_1` (`user_id`),
	INDEX `event_video_FI_2` (`event_id`),
	CONSTRAINT `event_video_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	CONSTRAINT `event_video_FK_2`
		FOREIGN KEY (`event_id`)
		REFERENCES `event` (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
	}

	/**
	 * Get the SQL statements for the Down migration
	 *
	 * @return array list of the SQL strings to execute for the Down migration
	 *               the keys being the datasources
	 */
	public function getDownSQL()
	{
		return array (
  'artistfan' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `broadcast_viewers`;

DROP TABLE IF EXISTS `broadcast_flows`;

DROP TABLE IF EXISTS `event_video`;

DROP INDEX `countries_I_1` ON `countries`;

ALTER TABLE `countries` CHANGE `iso2` `iso2` CHAR(2) DEFAULT \'\' NOT NULL;

ALTER TABLE `countries` CHANGE `name` `name` VARCHAR(44) DEFAULT \'\' NOT NULL;

ALTER TABLE `countries` CHANGE `pcode` `pcode` VARCHAR(10) NOT NULL;

ALTER TABLE `countries` CHANGE `sortid` `sortid` INTEGER NOT NULL;

CREATE INDEX `sortid` ON `countries` (`sortid`);

CREATE INDEX `sortid_2` ON `countries` (`sortid`);

ALTER TABLE `event` DROP FOREIGN KEY `event_FK_1`;

ALTER TABLE `event` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `event` CHANGE `event_type` `event_type` INTEGER DEFAULT 0;

ALTER TABLE `event` CHANGE `price` `price` FLOAT DEFAULT 0 NOT NULL;

ALTER TABLE `event` CHANGE `code` `code` VARCHAR(50) DEFAULT \'\' NOT NULL;

ALTER TABLE `event` CHANGE `status` `status` TINYINT(1) DEFAULT 1 NOT NULL;

ALTER TABLE `event` CHANGE `deleted` `deleted` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `event_attend` DROP FOREIGN KEY `event_attend_FK_1`;

ALTER TABLE `event_attend` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `event_attend` CHANGE `event_id` `event_id` INTEGER DEFAULT 0;

ALTER TABLE `event_attend` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `event_purchase` DROP FOREIGN KEY `event_purchase_FK_1`;

ALTER TABLE `event_purchase` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `event_purchase` CHANGE `event_id` `event_id` INTEGER DEFAULT 0;

ALTER TABLE `event_purchase` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `music` DROP FOREIGN KEY `music_FK_1`;

ALTER TABLE `music` DROP FOREIGN KEY `music_FK_2`;

ALTER TABLE `music` DROP FOREIGN KEY `music_FK_3`;

ALTER TABLE `music` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `music` CHANGE `album_id` `album_id` INTEGER DEFAULT 0;

ALTER TABLE `music` CHANGE `track_length` `track_length` VARCHAR(20);

ALTER TABLE `music` CHANGE `track_preview` `track_preview` VARCHAR(100) NOT NULL;

ALTER TABLE `music` CHANGE `track_preview_length` `track_preview_length` VARCHAR(20);

ALTER TABLE `music` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `music` CHANGE `deleted` `deleted` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `music_album` DROP FOREIGN KEY `music_album_FK_1`;

ALTER TABLE `music_album` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `music_album` CHANGE `price` `price` FLOAT DEFAULT 0 NOT NULL;

ALTER TABLE `music_album` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `music_album` CHANGE `featured` `featured` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `music_album` CHANGE `deleted` `deleted` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `music_purchase` DROP FOREIGN KEY `music_purchase_FK_1`;

ALTER TABLE `music_purchase` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `music_purchase` CHANGE `music_id` `music_id` INTEGER DEFAULT 0;

ALTER TABLE `music_purchase` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `pages` CHANGE `sortid` `sortid` INTEGER DEFAULT 0;

ALTER TABLE `pages` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `payment_info` DROP FOREIGN KEY `payment_info_FK_1`;

ALTER TABLE `payment_info` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `payment_info` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `payout` DROP FOREIGN KEY `payout_FK_1`;

ALTER TABLE `payout` DROP FOREIGN KEY `payout_FK_2`;

ALTER TABLE `payout` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `payout` CHANGE `ptype` `ptype` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `payout` CHANGE `balance` `balance` FLOAT DEFAULT 0 NOT NULL;

ALTER TABLE `payout` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `payout` CHANGE `user_from` `user_from` INTEGER DEFAULT 0;

ALTER TABLE `payout` CHANGE `payment_info_id` `payment_info_id` INTEGER DEFAULT 0 NOT NULL;

ALTER TABLE `photo` DROP FOREIGN KEY `photo_FK_1`;

ALTER TABLE `photo` DROP FOREIGN KEY `photo_FK_2`;

ALTER TABLE `photo` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `photo` CHANGE `album_id` `album_id` INTEGER DEFAULT 0;

ALTER TABLE `photo` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `photo_album` DROP FOREIGN KEY `photo_album_FK_1`;

ALTER TABLE `photo_album` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `photo_album` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `shopping_log` DROP FOREIGN KEY `shopping_log_FK_1`;

ALTER TABLE `shopping_log` CHANGE `wall_id` `wall_id` INTEGER DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `artist_id` `artist_id` INTEGER DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `album_id` `album_id` INTEGER DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `music_id` `music_id` INTEGER DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `video_id` `video_id` INTEGER DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `event_id` `event_id` INTEGER DEFAULT 0 NOT NULL;

ALTER TABLE `shopping_log` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `user` CHANGE `band_name` `band_name` VARCHAR(150);

ALTER TABLE `user` CHANGE `country` `country` VARCHAR(2);

ALTER TABLE `user` CHANGE `location` `location` VARCHAR(150) DEFAULT \'\';

ALTER TABLE `user` CHANGE `zip` `zip` VARCHAR(20) DEFAULT \'\' NOT NULL;

ALTER TABLE `user` CHANGE `hide_loc` `hide_loc` TINYINT(1) DEFAULT 1 NOT NULL;

ALTER TABLE `user` CHANGE `likes` `likes` VARCHAR(250);

ALTER TABLE `user` CHANGE `last_login` `last_login` INTEGER DEFAULT 0;

ALTER TABLE `user` CHANGE `last_reload` `last_reload` INTEGER DEFAULT 0;

ALTER TABLE `user` CHANGE `reg_date` `reg_date` INTEGER DEFAULT 0;

ALTER TABLE `user` CHANGE `wallet` `wallet` FLOAT;

ALTER TABLE `user` CHANGE `wallet_block` `wallet_block` FLOAT DEFAULT 0 NOT NULL;

ALTER TABLE `user` CHANGE `fb_id` `fb_id` VARCHAR(100) DEFAULT \'\' NOT NULL;

ALTER TABLE `user` CHANGE `fb_token` `fb_token` VARCHAR(200) NOT NULL;

ALTER TABLE `user` CHANGE `fb_start` `fb_start` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `user` CHANGE `tw_start` `tw_start` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `user` CHANGE `tw_id` `tw_id` VARCHAR(100);

ALTER TABLE `user` CHANGE `tw_oauth_token` `tw_oauth_token` VARCHAR(200);

ALTER TABLE `user` CHANGE `tw_oauth_token_secret` `tw_oauth_token_secret` VARCHAR(200);

ALTER TABLE `user` CHANGE `featured` `featured` TINYINT(1) DEFAULT 0 NOT NULL;

CREATE INDEX `fb_id` ON `user` (`fb_id`);

ALTER TABLE `user_follow` DROP FOREIGN KEY `user_follow_FK_1`;

ALTER TABLE `user_follow` DROP FOREIGN KEY `user_follow_FK_2`;

ALTER TABLE `user_follow` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `user_follow` CHANGE `user_id_follow` `user_id_follow` INTEGER DEFAULT 0;

ALTER TABLE `user_follow` CHANGE `fan_rating` `fan_rating` FLOAT DEFAULT 0 NOT NULL;

ALTER TABLE `video` DROP FOREIGN KEY `video_FK_1`;

ALTER TABLE `video` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `video` CHANGE `video_preview` `video_preview` VARCHAR(250) DEFAULT \'\' NOT NULL;

ALTER TABLE `video` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `video` CHANGE `from_yt` `from_yt` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `video` CHANGE `deleted` `deleted` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `video` CHANGE `status` `status` TINYINT(1) DEFAULT 0 NOT NULL;

ALTER TABLE `video_purchase` DROP FOREIGN KEY `video_purchase_FK_1`;

ALTER TABLE `video_purchase` DROP FOREIGN KEY `video_purchase_FK_2`;

DROP INDEX `video_purchase_FI_2` ON `video_purchase`;

DROP INDEX `video_purchase_FI_1` ON `video_purchase`;

ALTER TABLE `video_purchase` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `video_purchase` CHANGE `video_id` `video_id` INTEGER DEFAULT 0;

ALTER TABLE `video_purchase` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

CREATE INDEX `video_purchase_FI_1` ON `video_purchase` (`video_id`);

ALTER TABLE `wall` DROP FOREIGN KEY `wall_FK_1`;

ALTER TABLE `wall` DROP FOREIGN KEY `wall_FK_2`;

ALTER TABLE `wall` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `wall` CHANGE `user_id_from` `user_id_from` INTEGER DEFAULT 0;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
	}

}