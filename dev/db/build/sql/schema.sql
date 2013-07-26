
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`email` VARCHAR(255) DEFAULT '' NOT NULL,
	`status` TINYINT(3) DEFAULT 0,
	`email_confirmed` TINYINT(1) DEFAULT 0,
	`first_name` VARCHAR(26) DEFAULT '',
	`last_name` VARCHAR(26) DEFAULT '',
	`band_name` VARCHAR(150) DEFAULT '',
	`name` VARCHAR(40) DEFAULT '',
	`pass` VARCHAR(100) DEFAULT '',
	`avatar` VARCHAR(100) DEFAULT '',
	`country` VARCHAR(2) DEFAULT '',
	`location` VARCHAR(250) DEFAULT '',
	`hide_loc` TINYINT(1) DEFAULT 0,
	`zip` VARCHAR(20) DEFAULT '',
	`about` TEXT,
	`likes` VARCHAR(250) DEFAULT '',
	`years_active` VARCHAR(250),
	`genres` VARCHAR(250),
	`members` TEXT,
	`website` VARCHAR(250),
	`bio` TEXT,
	`record_label` TEXT,
	`record_label_link` TEXT,
	`dob` DATE DEFAULT '0000-00-00',
	`gender` TINYINT(2) DEFAULT 0,
	`checksum` VARCHAR(250) DEFAULT '',
	`ip` VARCHAR(15) DEFAULT '',
	`last_login` INTEGER(11) DEFAULT 0,
	`last_reload` INTEGER(11) DEFAULT 0,
	`blocked` TINYINT(3) DEFAULT 0,
	`block_reason` VARCHAR(250) DEFAULT '',
	`reg_date` INTEGER(11) DEFAULT 0,
	`wallet` FLOAT DEFAULT 0,
	`wallet_block` FLOAT DEFAULT 0,
	`fb_id` VARCHAR(100) DEFAULT '',
	`fb_token` VARCHAR(200) DEFAULT '',
	`fb_start` INTEGER(1) DEFAULT 0,
	`tw_start` INTEGER(1) DEFAULT 0,
	`tw_id` VARCHAR(100) DEFAULT '',
	`tw_oauth_token` VARCHAR(200) DEFAULT '',
	`tw_oauth_token_secret` VARCHAR(200) DEFAULT '',
	`featured` TINYINT(1) DEFAULT 0,
	`is_admin` TINYINT(1) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `user_I_1` (`email`),
	INDEX `user_I_2` (`status`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- user_follow
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_follow`;

CREATE TABLE `user_follow`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`user_id_follow` INTEGER(11) DEFAULT 0,
	`fan_rating` FLOAT DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `user_follow_I_1` (`user_id`, `user_id_follow`),
	INDEX `user_follow_FI_2` (`user_id_follow`),
	CONSTRAINT `user_follow_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	CONSTRAINT `user_follow_FK_2`
		FOREIGN KEY (`user_id_follow`)
		REFERENCES `user` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- wall
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `wall`;

CREATE TABLE `wall`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`user_id_from` INTEGER(11) DEFAULT 0,
	`mesg` TEXT,
	`pdate` INTEGER(1) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `wall_I_1` (`user_id`, `user_id_from`),
	INDEX `wall_FI_2` (`user_id_from`),
	CONSTRAINT `wall_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	CONSTRAINT `wall_FK_2`
		FOREIGN KEY (`user_id_from`)
		REFERENCES `user` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- countries
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries`
(
	`iso2` VARCHAR(2) NOT NULL,
	`name` VARCHAR(100) DEFAULT '',
	`pcode` VARCHAR(10) DEFAULT '',
	`sortid` INTEGER(11) DEFAULT 0,
	`iso3` INTEGER(5) DEFAULT 0,
	PRIMARY KEY (`iso2`),
	INDEX `countries_I_1` (`name`, `sortid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- music_album
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `music_album`;

CREATE TABLE `music_album`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`title` VARCHAR(250) DEFAULT '',
	`descr` TEXT,
	`date_release` DATE DEFAULT '0000-00-00',
	`image` VARCHAR(100) DEFAULT '',
	`price` FLOAT DEFAULT 0,
	`pdate` INTEGER(11) DEFAULT 0,
	`active` TINYINT(1) DEFAULT 0,
	`deleted` TINYINT(1) DEFAULT 0,
	`featured` TINYINT(1) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `music_album_FI_1` (`user_id`),
	CONSTRAINT `music_album_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- event
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`title` VARCHAR(255) DEFAULT '',
	`descr` TEXT,
	`event_type` INTEGER(11) DEFAULT 0,
	`location` VARCHAR(255),
	`price` FLOAT DEFAULT 0,
	`event_date` DATETIME,
	`code` VARCHAR(50) DEFAULT '',
	`pdate` INTEGER(1) DEFAULT 0,
	`status` TINYINT(1) DEFAULT 1,
	`deleted` TINYINT(1) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `event_I_1` (`event_date`),
	INDEX `event_FI_1` (`user_id`),
	CONSTRAINT `event_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- event_attend
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `event_attend`;

CREATE TABLE `event_attend`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`event_id` INTEGER(11) DEFAULT 0,
	`pdate` INTEGER(11) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `event_attend_FI_1` (`event_id`),
	CONSTRAINT `event_attend_FK_1`
		FOREIGN KEY (`event_id`)
		REFERENCES `event` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- event_purchase
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `event_purchase`;

CREATE TABLE `event_purchase`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`event_id` INTEGER(11) DEFAULT 0,
	`price` FLOAT DEFAULT 0,
	`code` VARCHAR(250) DEFAULT '',
	`pdate` INTEGER(11) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `event_purchase_FI_1` (`event_id`),
	CONSTRAINT `event_purchase_FK_1`
		FOREIGN KEY (`event_id`)
		REFERENCES `event` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- music
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `music`;

CREATE TABLE `music`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`title` VARCHAR(250) DEFAULT '',
	`album_id` INTEGER(11) DEFAULT 0,
	`genre` VARCHAR(250) DEFAULT '',
	`date_release` DATE DEFAULT '0000-00-00',
	`label` VARCHAR(250) DEFAULT '',
	`price` FLOAT DEFAULT 0,
	`track` VARCHAR(100) DEFAULT '',
	`track_preview` VARCHAR(100) DEFAULT '',
	`track_length` VARCHAR(20) DEFAULT '',
	`track_preview_length` VARCHAR(20) DEFAULT '',
	`pdate` INTEGER(11) DEFAULT 0,
	`active` TINYINT(1) DEFAULT 0,
	`deleted` TINYINT(1) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `music_FI_1` (`user_id`),
	INDEX `music_FI_2` (`album_id`),
	CONSTRAINT `music_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	CONSTRAINT `music_FK_2`
		FOREIGN KEY (`album_id`)
		REFERENCES `music_album` (`id`),
	CONSTRAINT `music_FK_3`
		FOREIGN KEY (`id`)
		REFERENCES `music_purchase` (`music_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- music_purchase
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `music_purchase`;

CREATE TABLE `music_purchase`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`music_id` INTEGER(11) DEFAULT 0,
	`with_all_album` TINYINT(1) DEFAULT 0,
	`price` FLOAT DEFAULT 0,
	`pdate` INTEGER(11) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `I_referenced_music_FK_3_1` (`music_id`),
	CONSTRAINT `music_purchase_FK_1`
		FOREIGN KEY (`music_id`)
		REFERENCES `music` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- video
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `video`;

CREATE TABLE `video`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`title` VARCHAR(250) DEFAULT '',
	`price` FLOAT DEFAULT 0,
	`video` VARCHAR(250) DEFAULT '',
	`video_preview` VARCHAR(250) DEFAULT '',
	`pdate` INTEGER(11) DEFAULT 0,
	`active` TINYINT(1) DEFAULT 0,
	`deleted` TINYINT(1) DEFAULT 0,
	`from_yt` TINYINT(1) DEFAULT 0,
	`status` TINYINT(1) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `video_FI_1` (`user_id`),
	CONSTRAINT `video_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- video_purchase
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `video_purchase`;

CREATE TABLE `video_purchase`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`video_id` INTEGER(11) DEFAULT 0,
	`price` FLOAT DEFAULT 0,
	`pdate` INTEGER(11) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `video_purchase_FI_1` (`user_id`),
	INDEX `video_purchase_FI_2` (`video_id`),
	CONSTRAINT `video_purchase_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	CONSTRAINT `video_purchase_FK_2`
		FOREIGN KEY (`video_id`)
		REFERENCES `video` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- payout
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `payout`;

CREATE TABLE `payout`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`payment_info_id` INTEGER(11) DEFAULT 0,
	`method` INTEGER(5) DEFAULT 0,
	`ptype` TINYINT(1) DEFAULT 0,
	`money` FLOAT DEFAULT 0,
	`balance` FLOAT DEFAULT 0,
	`status` INTEGER DEFAULT 0,
	`pdate` INTEGER(11) DEFAULT 0,
	`user_from` INTEGER(11) DEFAULT 0,
	`description` TEXT,
	PRIMARY KEY (`id`),
	INDEX `payout_FI_1` (`user_id`),
	INDEX `payout_FI_2` (`payment_info_id`),
	CONSTRAINT `payout_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	CONSTRAINT `payout_FK_2`
		FOREIGN KEY (`payment_info_id`)
		REFERENCES `payment_info` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- shopping_log
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shopping_log`;

CREATE TABLE `shopping_log`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`wall_id` INTEGER(11) DEFAULT 0,
	`artist_id` INTEGER(11) DEFAULT 0,
	`user_id` INTEGER(11) DEFAULT 0,
	`action` VARCHAR(15) DEFAULT '',
	`money` FLOAT DEFAULT 0,
	`album_id` INTEGER(11) DEFAULT 0,
	`music_id` INTEGER(11) DEFAULT 0,
	`video_id` INTEGER(11) DEFAULT 0,
	`event_id` INTEGER(11) DEFAULT 0,
	`data` VARCHAR(255) DEFAULT '',
	`pdate` INTEGER(11) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `shopping_log_I_1` (`artist_id`),
	INDEX `shopping_log_I_2` (`wall_id`),
	INDEX `shopping_log_FI_1` (`user_id`),
	CONSTRAINT `shopping_log_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- pages
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) NOT NULL,
	`pagename` VARCHAR(255) NOT NULL,
	`sortid` INTEGER(11) DEFAULT 0,
	`story` TEXT,
	`active` TINYINT(1) DEFAULT 1,
	`pdate` INTEGER(11) DEFAULT 0,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- photo
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `photo`;

CREATE TABLE `photo`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`title` TEXT,
	`album_id` INTEGER(11) DEFAULT 0,
	`photo_date` DATE DEFAULT '0000-00-00',
	`image` VARCHAR(100) DEFAULT '',
	`is_cover` TINYINT(1) DEFAULT 0,
	`pdate` INTEGER(11) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `photo_FI_1` (`user_id`),
	INDEX `photo_FI_2` (`album_id`),
	CONSTRAINT `photo_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	CONSTRAINT `photo_FK_2`
		FOREIGN KEY (`album_id`)
		REFERENCES `photo_album` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- photo_album
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `photo_album`;

CREATE TABLE `photo_album`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`title` VARCHAR(250) DEFAULT '',
	`pdate` INTEGER(11) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `photo_album_FI_1` (`user_id`),
	CONSTRAINT `photo_album_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- payment_info
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `payment_info`;

CREATE TABLE `payment_info`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(11) DEFAULT 0,
	`routing_code` VARCHAR(250) DEFAULT '',
	`account_number` VARCHAR(250) DEFAULT '',
	`holder_name` VARCHAR(250) DEFAULT '',
	`account_type` TINYINT(1) DEFAULT 0,
	`pdate` INTEGER(11) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `payment_info_FI_1` (`user_id`),
	CONSTRAINT `payment_info_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- broadcast_viewers
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `broadcast_viewers`;

CREATE TABLE `broadcast_viewers`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`event_id` VARCHAR(250) DEFAULT '',
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

-- ---------------------------------------------------------------------
-- broadcast_flows
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `broadcast_flows`;

CREATE TABLE `broadcast_flows`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`event_id` INTEGER(11) DEFAULT 0,
	`user_id` INTEGER(11) DEFAULT 0,
	`pdate` INTEGER(11) DEFAULT 0,
	`flow` VARCHAR(250) DEFAULT '',
	`status` TINYINT(1) DEFAULT 0,
	`used` INTEGER(11) DEFAULT 0,
	PRIMARY KEY (`id`),
	INDEX `broadcast_flows_I_1` (`event_id`),
	INDEX `broadcast_flows_FI_1` (`user_id`),
	CONSTRAINT `broadcast_flows_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- event_video
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `event_video`;

CREATE TABLE `event_video`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`event_id` INTEGER(11) DEFAULT 0,
	`user_id` INTEGER(11) DEFAULT 0,
	`video` VARCHAR(250) DEFAULT '',
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
