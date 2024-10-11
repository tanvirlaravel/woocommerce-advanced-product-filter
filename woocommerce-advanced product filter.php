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


    

    // Apply filters to the product query
     /**
         * $query: This parameter represents the current query object that WordPress is using to fetch posts/products.
         */
    function apply_advanced_product_filters( $query ) {
       /**
        * !is_admin(): Ensures this code only runs on the front end, not in the admin dashboard.
        * $query->is_main_query(): Checks if the current query is the main WordPress query, preventing our filters from affecting any secondary queries.
        * is_shop(): Ensures our filters only apply on the WooCommerce shop page.
        */
        if ( !is_admin() && $query->is_main_query() && is_shop() ) {
            $meta_query = [];

            if ( isset( $_GET['filter_color'] ) && !empty( $_GET['filter_color'] ) ) {
                $meta_query[] = array(
                    'key' => '_color',
                    'value' => sanitize_text_field( $_GET['filter_color'] ),
                    'compare' => '='
                );
            }

            if ( isset( $_GET['filter_size'] ) && !empty( $_GET['filter_size'] ) ) {
                $meta_query[] = array(
                    'key' => '_size',
                    'value' => sanitize_text_field( $_GET['filter_size'] ),
                    'compare' => '='
                );
            }

            $price_query = [];
            if ( isset( $_GET['filter_min_price'] ) && is_numeric( $_GET['filter_min_price'] ) ) {
                $price_query[] = array(
                    'key' => '_price',
                    'value' => floatval( $_GET['filter_min_price'] ),
                    'type' => 'DECIMAL',
                    'compare' => '>='
                );
            }

            if ( isset( $_GET['filter_max_price'] ) && is_numeric( $_GET['filter_max_price'] ) ) {
                $price_query[] = array(
                    'key' => '_price',
                    'value' => floatval( $_GET['filter_max_price'] ),
                    'type' => 'DECIMAL',
                    'compare' => '<='
                );
            }

            // var_dump($meta_query);

            if ( !empty( $price_query ) ) {
                $meta_query[] = array_merge( array( 'relation' => 'AND' ), $price_query );
            }

            // var_dump($meta_query);

            /**
             * $query->set( 'meta_query', $meta_query );: Applies the meta query array to the main query, filtering the products based on the set conditions.
             */
            if ( !empty( $meta_query ) ) {
                $query->set( 'meta_query', $meta_query );
            }
        }
    }
    

    add_action( 'pre_get_posts', 'apply_advanced_product_filters' );

}


// array(2) {
//     [0]=>
//     array(3) {
//       ["key"]=>
//       string(6) "_color"
//       ["value"]=>
//       string(3) "red"
//       ["compare"]=>
//       string(1) "="
//     }
//     [1]=>
//     array(3) {
//       ["key"]=>
//       string(5) "_size"
//       ["value"]=>
//       string(5) "small"
//       ["compare"]=>
//       string(1) "="
//     }
//   }


// array(3) {
//     [0]=>
//     array(3) {
//       ["key"]=>
//       string(6) "_color"
//       ["value"]=>
//       string(4) "blue"
//       ["compare"]=>
//       string(1) "="
//     }
//     [1]=>
//     array(3) {
//       ["key"]=>
//       string(5) "_size"
//       ["value"]=>
//       string(5) "large"
//       ["compare"]=>
//       string(1) "="
//     }
//     [2]=>
//     array(3) {
//       ["relation"]=>
//       string(3) "AND"
//       [0]=>
//       array(4) {
//         ["key"]=>
//         string(6) "_price"
//         ["value"]=>
//         float(33)
//         ["type"]=>
//         string(7) "DECIMAL"
//         ["compare"]=>
//         string(2) ">="
//       }
//       [1]=>
//       array(4) {
//         ["key"]=>
//         string(6) "_price"
//         ["value"]=>
//         float(3333)
//         ["type"]=>
//         string(7) "DECIMAL"
//         ["compare"]=>
//         string(2) "<="
//       }
//     }
//   }