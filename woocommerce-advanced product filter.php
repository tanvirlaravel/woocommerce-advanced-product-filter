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

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    
    // WooCommerce is active, add your custom functions here
}







