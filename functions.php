<?php //ini_set('display_errors', 1);

if (file_exists('vendor/autoload.php')) {
	require_once 'vendor/autoload.php';
}
function wp_load_styles_scripts_from_manifest() {
	//error_log('parent theme enqueue stuff');
	$manifestPath = get_template_directory() . '/dist/manifest.json';
	$distUrl = trailingslashit(get_template_directory_uri()) . 'dist/';
	if (!file_exists($manifestPath)) {
		return; // Manifest file does not exist, exit the function
	}
	$manifest = json_decode(file_get_contents($manifestPath));
	$styleName = "src/scss/public.scss";
	$scriptName = "src/js/main.js";
	// Enqueue styles
	wp_enqueue_style('wp-style', $distUrl . $manifest->$styleName->file);
	wp_enqueue_style('select2-css','//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', [], '', 'all');
	
	// Enqueue scripts
	wp_enqueue_script('alpine-js', '//cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js', [], '3.14.3', true);
	wp_enqueue_script('select2-js', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', [], '4.0.13', true);
	wp_enqueue_script('wp-script', $distUrl . $manifest->$scriptName->file, [], false, true);
}
add_action('wp_enqueue_scripts', 'wp_load_styles_scripts_from_manifest', 1); // Conected Child Theme enque

// Admin Style
function wp_enqueue_custom_admin_script_style() {
	$manifestPath = get_template_directory() . '/dist/manifest.json';
    $distUrl = trailingslashit(get_template_directory_uri()) . 'dist/';
	if (!file_exists($manifestPath)) {
		return; // Manifest file does not exist, exit the function
	}
	$manifest = json_decode(file_get_contents($manifestPath));
	$adminStyles = 'src/scss/admin.scss';
	$adminJS = 'src/js/admin.js';
	wp_enqueue_style('admin-css', $distUrl . $manifest->$adminStyles->file, [], '', 'all');
	wp_enqueue_script('admin-js', $distUrl . $manifest->$adminJS->file, ['jquery'], '', 'all');
}
add_action('admin_enqueue_scripts', 'wp_enqueue_custom_admin_script_style');

/**
 * Register Default Menus
 */
function wp_menus() {
	$locations = array(
		'wp-header-menu'   => __( 'WP Header Menu', 'wp' ),
		'wp-footer-menu'  => __( 'WP Footer Menu', 'wp' ),
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'wp_menus' );

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Post Edit Link New Tab
 */
add_filter( 'edit_post_link', function( $link, $post_id, $text ) {
	// Add the target attribute 
	if( false === strpos( $link, 'target=' ) )
		$link = str_replace( '<a ', '<a target="_blank" ', $link );
	return $link;
}, 10, 3 );

/**
 * Add page name class to body tag
 */
function my_class_names( $classes ) {
	global $post;	
	// add 'post_name' to the $classes array 
	$classes[] = $post->post_name;
	// return the $classes array
	return $classes;
}
add_filter( 'body_class', 'my_class_names' );

/**
 * Body Class Name for parrent pages
 */
add_filter( 'body_class', 'dc_parent_body_class' );
	function dc_parent_body_class( $classes ) {
		if( is_page() ) { 
			$parents = get_post_ancestors( get_the_ID() );
			$id = ($parents) ? $parents[count($parents)-1]: get_the_ID();
			$parent_slug = get_post_field( 'post_name', get_post($id) );
		if ($id) {
			$classes[] = 'top-parent-' . strtolower($parent_slug);
		} else {
			$classes[] = 'top-parent-' . get_the_ID();
		}
	}

	return $classes;
}

/**
 * Footer Global / Scripts & global settings - before </body>
 */
add_action('wp_footer', 'footer_global');
function footer_global() {
?>
<!-- Footer WP Global -->
<?php //include('tpl_megamenu.php'); ?>
<?php wp_reset_postdata(); edit_post_link(); ?>
<div class="scroll-up hidden"></div>
<script id="global-foo-js">
	document.addEventListener("DOMContentLoaded",function(){
		var $=jQuery.noConflict(),
			home_url='<?=home_url()?>';
		$('.btn-back-home').attr('href',home_url);
	});
</script>
<!-- /Footer WP Global -->
<?php
};

/**
 * Custom Admin Logo
 */
function my_login_logo() { ?><style type="text/css">#login h1 a,.login h1 a {background: url(<?=get_template_directory_uri()?>/assets/img/logo.png) center / 90% auto no-repeat;width:280px;padding:5px}</style><?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/**
 * Custom Functions
 */
foreach ( glob( __DIR__ . '/inc/Custom/*.php' ) as $filename ) :
	require_once $filename;
endforeach;

/**
 * Register pattern categories.
 */

 if ( ! function_exists( 'wp_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 */
	function wp_pattern_categories() {
		register_block_pattern_category('wp-patterns-main', array( 'label' => __( '| WP Templates |', 'wp' )));
	}
endif;

add_action( 'init', 'wp_pattern_categories' );
