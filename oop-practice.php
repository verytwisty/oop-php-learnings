<?php

/**
 * Plugin Name: OOP Practice
 * Description: Practice for OOP PHP
 * Version: 1.0.0
 * Requires at least: 6.1.1
 */

namespace OOP_PHP;

use OOP_PHP\ADMIN_PAGES\Admin_Options;
use OOP_PHP\ADMIN_PAGES\Options_Interface;

/**
 * Define plugin constants
 */
define( 'OOP_PHP_VERSION', '1.0.0' );
define( 'OOP_PHP_URL', plugin_dir_url( __FILE__ ) );
define( 'OOP_PHP_ROOT_FILE', __FILE__ );
define( 'OOP_PHP_DIR', plugin_dir_path( __FILE__ ) );
define( 'OOP_PHP_PLUGIN_DIRNAME', basename( rtrim( dirname( __FILE__ ), '/' ) ) );
define( 'OOP_PHP_BASENAME', plugin_basename( __FILE__ ) );

add_action( 'plugins_loaded', __NAMESPACE__ . '\init' );

function init() {
	require_once OOP_PHP_DIR . 'includes/class-options-interface.php';
	require_once OOP_PHP_DIR . 'includes/class-abstract-admin-page.php';
	require_once OOP_PHP_DIR . 'includes/class-admin-options.php';

	$options = new Options_Interface();
	Admin_Options::register( $options );

}

function init_hooks() {
	register_activation_hook( __FILE__, __NAMESPACE__ . '\plugin_setup' );
	register_deactivation_hook( __FILE__, __NAMESPACE__ . '\deactivate_plugin' );
}

function plugin_setup() {}

function deactivate_plugin() {}

// init_hooks();
