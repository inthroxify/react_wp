<?php
/**
 * Plugin Name: REST API Home Page Image Url
 * Plugin URI:  http://localhost
 *
 * Description: Add frontpage image to WordPress REST API
 * Version:     0.0.1
 * Author:      Inthroxify
 *
 * License: Public domain. Have at it.
 */

if ( ! defined( 'ABSPATH' ) ) {
    die();
}

if ( ! function_exists( 'rest_api_homepage_image_init' ) ) {

    function get_home_page_image_url() {
        $url = "";
        $id  = get_option( 'page_on_front' );

        if ( $id > 0 ) {
            $post = get_post( $id );
            $url  = ["url" => get_the_post_thumbnail_url( $post, false )];
        }

        return $url ?? new WP_Error( '404', __( 'no home page image found' ) );
    }

    function rest_api_homepage_image_init() {

        function register_route() {
            register_rest_route( 'wp/v2', '/homepage_image', [
                'callback' => 'get_home_page_image_url',
                'methods'  => WP_REST_Server::READABLE
            ] );
        }

        add_filter( 'rest_api_init', 'register_route' );
    }

    add_action( 'init', 'rest_api_homepage_image_init' );

} //if ! function_exists
