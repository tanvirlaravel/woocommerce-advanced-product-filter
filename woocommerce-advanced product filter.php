<?php
/*
Plugin Name: Advanced Product Filter
Description: Adds advanced filtering options for WooCommerce products.
Version: 1.0
Author: Md Tanvirul Islam
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

// Include widget file
require_once plugin_dir_path(__FILE__) . 'filter-widget.php';

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    // WooCommerce is active

    // Register the widget
    function register_advanced_product_filter_widget() {
        register_widget( 'Advanced_Product_Filter_Widget' );
    }
    add_action( 'widgets_init', 'register_advanced_product_filter_widget' );

}
