<?php

namespace BULK_IMPORT\Inc;
use BULK_IMPORT\Inc\Traits\Program_Logs;

defined( "ABSPATH" ) || exit( "Direct Access Not Allowed" );

use BULK_IMPORT\Inc\Traits\Singleton;

class Admin_Menu {

    use Singleton;
    use Program_Logs;

    public function __construct() {
        $this->setup_hooks();
    }

    public function setup_hooks() {
        add_action( 'admin_menu', [ $this, 'register_admin_menu' ] );
        // add_action( 'admin_menu', [ $this, 'register_csv_import_menu' ] );
        // add_action( 'admin_menu', [ $this, 'register_sheet_import_menu' ] );
        add_filter( 'plugin_action_links_' . BULK_PRODUCT_IMPORT_PLUGIN_BASE_NAME, [ $this, 'be_add_settings_link' ] );
        add_action( 'plugins_loaded', [ $this, 'bulk_product_import_plugin_load_textdomain' ] );
        add_action( 'wp_ajax_save_client_credentials', [ $this, 'save_client_credentials' ] );
        add_action( 'wp_ajax_save_table_prefix', [ $this, 'save_table_prefix' ] );
    }

    public function be_add_settings_link( $links ) {
        $settings_link = '<a href="admin.php?page=just_another_panel">' . __( 'Settings', 'just-another-panel' ) . '</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }

    public function bulk_product_import_plugin_load_textdomain() {
        load_plugin_textdomain( 'just-another-panel', false, BULK_PRODUCT_IMPORT_PLUGIN_DIR_NAME . '/languages' );
    }

    public function register_admin_menu() {
        add_menu_page(
            __( 'JAP SMM Settings', 'just-another-panel' ),
            __( 'JAP SMM Settings', 'just-another-panel' ),
            'manage_options',
            'just_another_panel',
            [ $this, 'bulk_product_import_page_html' ],
            'dashicons-cloud-upload',
            80
        );
    }

    public function register_csv_import_menu() {
        add_submenu_page(
            'just_another_panel',
            'CSV Import',
            'CSV Import',
            'manage_options',
            'bulk_product_csv_import',
            [ $this, 'bulk_product_csv_import_page_html' ]
        );
    }

    public function register_sheet_import_menu() {
        add_submenu_page(
            'just_another_panel',
            'Sheet Import',
            'Sheet Import',
            'manage_options',
            'bulk_product_sheet_import',
            [ $this, 'bulk_product_sheet_import_page_html' ]
        );
    }

    public function bulk_product_import_page_html() {
        ?>

        <div class="entry-header">
            <h1 class="entry-title text-center mt-5" style="color: #2271B1">
                <?php esc_html_e( 'JAP SMM Integration & sync with WooCommerce', 'just-another-panel' ); ?>
            </h1>
        </div>

        <div id="be-tabs" class="mt-5">
            <div id="tabs">

                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="#api"
                            class="nav-link be-nav-links"><?php esc_html_e( 'API', 'just-another-panel' ); ?></a></li>
                    <li class="nav-item"><a href="#tables"
                            class="nav-link be-nav-links"><?php esc_html_e( 'Table Prefix', 'just-another-panel' ); ?></a></li>
                    <li class="nav-item"><a href="#endpoints"
                            class="nav-link be-nav-links"><?php esc_html_e( 'Endpoints', 'just-another-panel' ); ?></a></li>
                </ul>

                <div id="api">
                    <?php include BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/inc/template-parts/template-api.php'; ?>
                </div>

                <div id="tables">
                    <?php include BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/inc/template-parts/template-tables.php'; ?>
                </div>

                <div id="endpoints">
                    <div id="api-endpoints">
                        <div id="api-endpoints-table">
                            <?php include BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/inc/template-parts/template-endpoints.php'; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php
    }

    public function bulk_product_csv_import_page_html() {
        ?>

        <div class="entry-header">
            <h1 class="entry-title text-center mt-3" style="color: #2271B1">
                <?php esc_html_e( 'WooCommerce Bulk Product Import CSV', 'just-another-panel' ); ?>
            </h1>
        </div>

        <div class="wrap">
            <?php include BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/inc/template-parts/template-csv.php'; ?>
        </div>

        <?php
    }

    public function bulk_product_sheet_import_page_html() {
        ?>

        <div class="entry-header">
            <h1 class="entry-title text-center mt-3" style="color: #2271B1">
                <?php esc_html_e( 'WooCommerce Bulk Product Import Sheet', 'just-another-panel' ); ?>
            </h1>
        </div>

        <div class="wrap">
            <?php include BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/inc/template-parts/template-sheet.php'; ?>
        </div>

        <?php
    }

    public function save_client_credentials() {
        check_ajax_referer( 'bulk_product_import_nonce', 'nonce' );

        if ( !current_user_can( 'manage_options' ) ) {
            wp_send_json_error( __( 'Unauthorized user', 'just-another-panel' ) );
        }

        $client_id     = sanitize_text_field( $_POST['client_id'] );
        $client_secret = sanitize_text_field( $_POST['client_secret'] );
        $jap_base_url  = sanitize_text_field( $_POST['jap_api_base_url'] );
        $jap_api_key   = sanitize_text_field( $_POST['jap_api_key'] );

        update_option( 'be-client-id', $client_id );
        update_option( 'be-client-secret', $client_secret );
        update_option( 'jap_api_base_url', $jap_base_url );
        update_option( 'jap_api_key', $jap_api_key );

        wp_send_json_success( __( 'Credentials saved successfully', 'just-another-panel' ) );
    }

    public function save_table_prefix() {

        check_ajax_referer( 'bulk_product_import_nonce', 'nonce' );

        if ( !current_user_can( 'manage_options' ) ) {
            wp_send_json_error( __( 'Unauthorized user', 'just-another-panel' ) );
        }

        $table_prefix = sanitize_text_field( $_POST['table_prefix'] );
        update_option( 'be-table-prefix', $table_prefix );

        wp_send_json_success( __( 'Table prefix saved successfully', 'just-another-panel' ) );
    }
}
