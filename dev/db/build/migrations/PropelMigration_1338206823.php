<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1338206823.
 * Generated on 2012-05-28 14:07:03 by ssergy
 */
class PropelMigration_1338206823
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

ALTER TABLE `broadcast_flows` CHANGE `event_id` `event_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `broadcast_flows` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `broadcast_flows` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `broadcast_flows` ADD
(
	`used` INTEGER(11) DEFAULT 0
);

ALTER TABLE `broadcast_flows` ADD CONSTRAINT `broadcast_flows_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `broadcast_viewers` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `broadcast_viewers` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `broadcast_viewers` CHANGE `udate` `udate` INTEGER(11) DEFAULT 0;

ALTER TABLE `broadcast_viewers` ADD CONSTRAINT `broadcast_viewers_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `countries` CHANGE `sortid` `sortid` INTEGER(11) DEFAULT 0;

ALTER TABLE `event` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `event` CHANGE `event_type` `event_type` INTEGER(11) DEFAULT 0;

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

ALTER TABLE `event_video` CHANGE `event_id` `event_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `event_video` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `event_video` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `event_video` ADD CONSTRAINT `event_video_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `event_video` ADD CONSTRAINT `event_video_FK_2`
	FOREIGN KEY (`event_id`)
	REFERENCES `event` (`id`);

ALTER TABLE `music` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `music` CHANGE `album_id` `album_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `music` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

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

ALTER TABLE `music_album` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

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

ALTER TABLE `user` CHANGE `last_login` `last_login` INTEGER(11) DEFAULT 0;

ALTER TABLE `user` CHANGE `last_reload` `last_reload` INTEGER(11) DEFAULT 0;

ALTER TABLE `user` CHANGE `reg_date` `reg_date` INTEGER(11) DEFAULT 0;

ALTER TABLE `user_follow` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `user_follow` CHANGE `user_id_follow` `user_id_follow` INTEGER(11) DEFAULT 0;

ALTER TABLE `user_follow` ADD CONSTRAINT `user_follow_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `user_follow` ADD CONSTRAINT `user_follow_FK_2`
	FOREIGN KEY (`user_id_follow`)
	REFERENCES `user` (`id`);

ALTER TABLE `video` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `video` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

ALTER TABLE `video` ADD CONSTRAINT `video_FK_1`
	FOREIGN KEY (`user_id`)
	REFERENCES `user` (`id`);

ALTER TABLE `video_purchase` CHANGE `user_id` `user_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `video_purchase` CHANGE `video_id` `video_id` INTEGER(11) DEFAULT 0;

ALTER TABLE `video_purchase` CHANGE `pdate` `pdate` INTEGER(11) DEFAULT 0;

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

ALTER TABLE `broadcast_flows` DROP FOREIGN KEY `broadcast_flows_FK_1`;

ALTER TABLE `broadcast_flows` CHANGE `event_id` `event_id` INTEGER DEFAULT 0;

ALTER TABLE `broadcast_flows` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `broadcast_flows` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `broadcast_flows` DROP `used`;

ALTER TABLE `broadcast_viewers` DROP FOREIGN KEY `broadcast_viewers_FK_1`;

ALTER TABLE `broadcast_viewers` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `broadcast_viewers` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `broadcast_viewers` CHANGE `udate` `udate` INTEGER DEFAULT 0;

ALTER TABLE `countries` CHANGE `sortid` `sortid` INTEGER DEFAULT 0;

ALTER TABLE `event` DROP FOREIGN KEY `event_FK_1`;

ALTER TABLE `event` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `event` CHANGE `event_type` `event_type` INTEGER DEFAULT 0;

ALTER TABLE `event_attend` DROP FOREIGN KEY `event_attend_FK_1`;

ALTER TABLE `event_attend` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `event_attend` CHANGE `event_id` `event_id` INTEGER DEFAULT 0;

ALTER TABLE `event_attend` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `event_purchase` DROP FOREIGN KEY `event_purchase_FK_1`;

ALTER TABLE `event_purchase` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `event_purchase` CHANGE `event_id` `event_id` INTEGER DEFAULT 0;

ALTER TABLE `event_purchase` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `event_video` DROP FOREIGN KEY `event_video_FK_1`;

ALTER TABLE `event_video` DROP FOREIGN KEY `event_video_FK_2`;

ALTER TABLE `event_video` CHANGE `event_id` `event_id` INTEGER DEFAULT 0;

ALTER TABLE `event_video` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `event_video` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `music` DROP FOREIGN KEY `music_FK_1`;

ALTER TABLE `music` DROP FOREIGN KEY `music_FK_2`;

ALTER TABLE `music` DROP FOREIGN KEY `music_FK_3`;

ALTER TABLE `music` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `music` CHANGE `album_id` `album_id` INTEGER DEFAULT 0;

ALTER TABLE `music` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `music_album` DROP FOREIGN KEY `music_album_FK_1`;

ALTER TABLE `music_album` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `music_album` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

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

ALTER TABLE `payout` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `payout` CHANGE `user_from` `user_from` INTEGER DEFAULT 0;

ALTER TABLE `payout` CHANGE `payment_info_id` `payment_info_id` INTEGER DEFAULT 0;

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

ALTER TABLE `shopping_log` CHANGE `event_id` `event_id` INTEGER DEFAULT 0;

ALTER TABLE `shopping_log` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `user` CHANGE `last_login` `last_login` INTEGER DEFAULT 0;

ALTER TABLE `user` CHANGE `last_reload` `last_reload` INTEGER DEFAULT 0;

ALTER TABLE `user` CHANGE `reg_date` `reg_date` INTEGER DEFAULT 0;

ALTER TABLE `user_follow` DROP FOREIGN KEY `user_follow_FK_1`;

ALTER TABLE `user_follow` DROP FOREIGN KEY `user_follow_FK_2`;

ALTER TABLE `user_follow` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `user_follow` CHANGE `user_id_follow` `user_id_follow` INTEGER DEFAULT 0;

ALTER TABLE `video` DROP FOREIGN KEY `video_FK_1`;

ALTER TABLE `video` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `video` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

ALTER TABLE `video_purchase` DROP FOREIGN KEY `video_purchase_FK_1`;

ALTER TABLE `video_purchase` DROP FOREIGN KEY `video_purchase_FK_2`;

ALTER TABLE `video_purchase` CHANGE `user_id` `user_id` INTEGER DEFAULT 0;

ALTER TABLE `video_purchase` CHANGE `video_id` `video_id` INTEGER DEFAULT 0;

ALTER TABLE `video_purchase` CHANGE `pdate` `pdate` INTEGER DEFAULT 0;

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