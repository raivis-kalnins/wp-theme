<?php
// Get ACF Images for sub menus
function wp_nav_menu_objects( $items, $args ) {
	
	// Menu images
	foreach( $items as $item ) :
		$menu_img = wp_get_attachment_image_src( get_field('menu_image', $item) );
		if( $menu_img ) :
			$item->ID.= ' mega-img';
			$item->title.= '<img class="mega-img" src="'.$menu_img[0].'" alt="mega-img" />';
		endif;
	endforeach;

	// Check Sticky Header Class
	$menu = wp_get_nav_menu_object($args->menu);
	$stickyheader = get_field('sticky_header', $menu);
	if ( $stickyheader == 'true' ):
		$html_stickyheader = '<script>document.addEventListener("DOMContentLoaded", function() {const nav_menu = document.querySelector("header");nav_menu.className +=" sticky-header";});</script>';
		echo $html_stickyheader;
	endif;

	// Check Megamenu Class
	$menu = wp_get_nav_menu_object($args->menu);
	$megamenu = get_field('mega_menu', $menu);
	if ( $megamenu == 'true' ):
		$html_megamenu = '<script>document.addEventListener("DOMContentLoaded", function() {const nav_menu = document.querySelector(".header-nav");nav_menu.className +=" megamenu";});</script>';
		echo $html_megamenu;
	endif;

	// Check last item Button
	$lastnavbtn = get_field('last_button', $menu);
	if ( $lastnavbtn == 'true' ):
		$html_lastnavbtn = '<script>document.addEventListener("DOMContentLoaded", function() {const nav_menu = document.querySelector(".header-nav");nav_menu.className +=" lastnavbtn";});</script>';
		echo $html_lastnavbtn;
	endif;

	// Search - searchbox
	$menu = wp_get_nav_menu_object($args->menu);
	$search = get_field('search_bar', $menu);
	if ( $search == 'true' ):
		$html_search = '<script>document.addEventListener("DOMContentLoaded", function() {const nav_search = document.querySelector("body");nav_search.className +=" wp-nav-search";});</script>';
		echo $html_search;
	endif;

	// MyAccount - need to be added
	$menu = wp_get_nav_menu_object($args->menu);
	$account = get_field('customer_account', $menu);
	if ( $account == 'true' ):
		$html_account = '<script>document.addEventListener("DOMContentLoaded", function() {const nav_menu = document.querySelector("body");nav_menu.className +=" woo-account";});</script>';
		echo $html_account;
	endif;

	// Cart - need to be added
	$menu = wp_get_nav_menu_object($args->menu);
	$cart = get_field('mini_cart', $menu);
	if ( $cart == 'true' ):
		$html_cart = '<script>document.addEventListener("DOMContentLoaded", function() {const nav_menu = document.querySelector("body");nav_menu.className +=" woo-cart";});</script>';
		echo $html_cart;
	endif;

	// Light/Dark Theme Body Class
	$menu = wp_get_nav_menu_object($args->menu);
	$light_dark = get_field('light_dark', $menu);
	if ( $light_dark == 'true' ):
		$html_light_dark = '<script>document.addEventListener("DOMContentLoaded", function() {const nav_menu = document.querySelector("body");nav_menu.className +=" light-dark";});</script>';
		echo $html_light_dark;
	endif;

	// Languages Switch - need to be added
	$menu = wp_get_nav_menu_object($args->menu);
	$language = get_field('language_bar', $menu);
	if ( $language == 'true' ):
		$html_language = '<script>document.addEventListener("DOMContentLoaded", function() {const nav_menu = document.querySelector("body");nav_menu.className +=" menu-flags";});</script>';
		echo $html_language;
	endif;

	return $items;
}
add_filter('wp_nav_menu_objects', 'wp_nav_menu_objects', 10, 2);