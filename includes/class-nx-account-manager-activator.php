<?php

/**
 * Fired during plugin activation
 *
 * @link       https://newexsoft.com
 * @since      1.0.0
 *
 * @package    Nx_Account_Manager
 * @subpackage Nx_Account_Manager/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Nx_Account_Manager
 * @subpackage Nx_Account_Manager/includes
 * @author     NewEx Soft <newexsoft26@gmail.com>
 */
class Nx_Account_Manager_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::create_table();
	}

	public static function create_table(){
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		global $wpdb;

		$collate = 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';
		
		$nx_entry = $wpdb->prefix . "nx_entry";
		$nx_members = $wpdb->prefix . "nx_members";

		$sql = "CREATE TABLE $nx_entry (
			`en_id` bigint(20) NOT NULL AUTO_INCREMENT,
			`en_date` date NOT NULL,
			`en_purpose` text NOT NULL,
			`en_earn_cost` varchar(250) NOT NULL,
			`en_amount_taka` float(20) NOT NULL,
 			`en_amount_dollar` float(20) NOT NULL,
			`en_currency` varchar(250) NOT NULL,
			`en_loan_member_id` int(11) NOT NULL,
			`en_loan` varchar(250) NOT NULL,
			`created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			`updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
			PRIMARY KEY (`en_id`)
		   ) $collate ";
		   
		$sql2 = "CREATE TABLE $nx_members (
			`member_id` int(11) NOT NULL AUTO_INCREMENT,
			`member_name` varchar(250) NOT NULL,
			`member_join_date` date NOT NULL,
			`created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
			`updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
			PRIMARY KEY (`member_id`)
		   ) $collate ";
		   dbDelta( $sql2 );
	}

}
