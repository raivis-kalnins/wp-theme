<?php

/**
 * Remove <title> meta tag and keep Yoast SEO <title> tag
 */
function custom_remove_title_tag() {
	remove_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'custom_remove_title_tag', 10000 );

/**
 * Remove rel=shortlink WP head
 */
function remove_redundant_shortlink() {
	remove_action('wp_head', 'wp_shortlink_wp_head', 10);
	remove_action( 'template_redirect', 'wp_shortlink_header', 11);
}
add_filter('after_setup_theme', 'remove_redundant_shortlink');

/**
 * Remove xmlrpc WP head
 */
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
