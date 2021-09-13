<?php
/**
 * Plugin Name: Job Board
 * Plugin URI: https://developers-hub.com/
 * Description: Manage job listings from the WordPress admin panel, and allow HR to post jobs directly to your site.
 * Version: 1.0.0
 * Author: Developers Hub
 * Author URI: https://developers-hub.com/
 * Text Domain: job-board
 * Domain Path: /languages/
 *
 * @package developersHub
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __FILE__ ) . '/include/function-admin.php';