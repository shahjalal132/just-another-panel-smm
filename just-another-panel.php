<?php

/**
 * Plugin Name: Just Another Panel API Integration and sync with woocommerce
 * Plugin URI:  https://github.com/shahjalal132/just-another-panel-smm
 * Author:      Shah jalal
 * Author URI:  https://github.com/shahjalal132
 * Description: Integrate Just Another Panel API Integration and sync with woocommerce
 * Version:     1.0.0
 * Domain Path: /languages
 * text-domain: just-another-panel
 */

defined( "ABSPATH" ) || exit( "Direct Access Not Allowed" );

if ( !defined( 'BULK_PRODUCT_IMPORT_PLUGIN_PATH' ) ) {
    define( 'BULK_PRODUCT_IMPORT_PLUGIN_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
}

if ( !defined( 'BULK_PRODUCT_IMPORT_PLUGIN_URL' ) ) {
    define( 'BULK_PRODUCT_IMPORT_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
}

if ( !defined( 'BULK_PRODUCT_IMPORT_ASSETS_URL' ) ) {
    define( 'BULK_PRODUCT_IMPORT_ASSETS_URL', BULK_PRODUCT_IMPORT_PLUGIN_URL . '/assets' );
}

if ( !defined( 'BULK_PRODUCT_IMPORT_PLUGIN_BASE_NAME' ) ) {
    define( 'BULK_PRODUCT_IMPORT_PLUGIN_BASE_NAME', plugin_basename( __FILE__ ) );
}

if ( !defined( 'BULK_PRODUCT_IMPORT_PLUGIN_DIR_NAME' ) ) {
    define( 'BULK_PRODUCT_IMPORT_PLUGIN_DIR_NAME', basename( dirname( __FILE__ ) ) );
}

if ( !defined( 'ADMIN_AJAX_URL' ) ) {
    define( 'ADMIN_AJAX_URL', admin_url( 'admin-ajax.php' ) );
}

// require autoloader files
require_once BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/inc/helpers/autoloader.php';
require_once BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/load.php';

function bulk_product_import_get_theme_instance() {
    \BULK_IMPORT\Inc\Autoloader::get_instance();
}

bulk_product_import_get_theme_instance();

// create db tables
register_activation_hook( __FILE__, 'create_db_tables' );
// removes db tables
// register_deactivation_hook( __FILE__, 'remove_db_tables' );