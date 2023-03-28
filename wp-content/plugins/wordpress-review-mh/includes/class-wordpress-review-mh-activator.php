<?php

/**
 * Fired during plugin activation
 *
 * @link       https://dominhhai.com/
 * @since      1.0.0
 *
 * @package    Wordpress_Review_Mh
 * @subpackage Wordpress_Review_Mh/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wordpress_Review_Mh
 * @subpackage Wordpress_Review_Mh/includes
 * @author     Đỗ Minh Hải <minhhai27121994@gmail.com>
 */
class Wordpress_Review_Mh_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		$sqls = [
			"CREATE TABLE `dmh_rv_products` (
			 `id` int(11) NOT NULL AUTO_INCREMENT,
			 `post_id` int(11) NOT NULL,
			 `average` float NOT NULL DEFAULT '0',
			 `total` int(11) NOT NULL DEFAULT '0',
			 `sold` int(11) NOT NULL DEFAULT '0',
			 `star_stats` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
			 `created_at` datetime,
			 PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8",
			 "CREATE TABLE `dmh_rv_reviews` (
			 `id` int(11) NOT NULL AUTO_INCREMENT,
			 `post_id` int(11) NOT NULL,
			 `comment_id` int(11) DEFAULT NULL,
			 `post_type` varchar(20) DEFAULT NULL,
			 `type` tinyint(2) NOT NULL DEFAULT '1',
			 `stars` float NOT NULL DEFAULT '0',
			 `likes` int(11) NOT NULL DEFAULT '0',
			 `message` varchar(1500) NOT NULL,
			 `status` tinyint(2) NOT NULL DEFAULT '1',
			 `buyed` tinyint(1) NOT NULL DEFAULT '1',
			 `customer_phone` varchar(25) NOT NULL,
			 `customer_phone_hidden` varchar(20) NOT NULL,
			 `customer_name` varchar(100) NOT NULL,
			 `customer_email` varchar(100) NOT NULL,
			 `customer_gender` tinyint(4) DEFAULT NULL,
			 `attactments` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
			 `video` varchar(255) DEFAULT NULL,
			 `parent_id` int(11) NOT NULL DEFAULT '0',
			 `by_admin` tinyint(4) NOT NULL DEFAULT '0',
			 `is_admin_message` tinyint(2) NOT NULL DEFAULT '0',
			 `ip` varchar(100) NOT NULL,
			 `created_at` datetime,
			 PRIMARY KEY (`id`),
			 KEY `post_id` (`post_id`),
			 KEY `parent_id` (`parent_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8",
			//"ALTER TABLE dmh_rv_reviews ADD comment_id int(11) DEFAULT NULL AFTER post_id"
		];
		$charset = $wpdb->get_charset_collate();
	    $charset_collate = $wpdb->get_charset_collate();
	    foreach ($sqls as $key => $sql) {
	    	dbDelta( $sql );
	    }

		    
	}

}
