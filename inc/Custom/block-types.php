<?php
/**
 * Custom Core WP & other block style types
 */
if (function_exists('register_block_style')) {

	register_block_style('core/list', [
		'name'         => 'tick-list',
		'label'        => 'Tick List',
		'is_default'   => false,
	]);

	register_block_style('core/list', [
		'name'         => 'contact-details-white',
		'label'        => 'Contact White',
		'is_default'   => false,
	]);

	register_block_style('core/list', [
		'name'         => 'no-bullets',
		'label'        => 'No bullets',
		'is_default'   => false,
	]);

	register_block_style('woocommerce/product-categories', [
		'name'         => 'prod-cat-h',
		'label'        => 'Prod Cat Horizontal',
		'is_default'   => false,
	]);
}