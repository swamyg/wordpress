<?php
/**
 * Template Name: Database Functions
 *
 * All functions related to storing and retrieving testimonial shortcodes created by users
 *
 * @package     handsometestimonials
 * @copyright   Copyright (c) 2014, Kevin Marshall
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 *
 */

/*******************************************
Create/Upgrade DB Table for saving testimonial shortcode data
********************************************/
// Run the install scripts upon plugin activation
register_activation_hook( TSTMT_PLUGIN_DIR . '/handsometestimonials.php','hndtst_saved_tsts');

//Set DB Table Version
global $hndtst_db_version;
$hndtst_db_version = '1.0';


//Create testimonial shortcode database table upon installation
function hndtst_saved_tsts () {
   global $wpdb;
   global $hndtst_db_version;
   $hndtst_saved = $wpdb->prefix . 'hndtst_saved';

	$charset_collate = $wpdb->get_charset_collate();

	// create the ECPT metabox database table
	 if($wpdb->get_var("show tables like '$hndtst_saved'") != $hndtst_saved) 

	 {

		$sql = "CREATE TABLE " . $hndtst_saved . " (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name tinytext NOT NULL,
		shortcode text NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate; ";
 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		add_option( 'hndtst_db_version', $hndtst_db_version );
	 }

}

?>