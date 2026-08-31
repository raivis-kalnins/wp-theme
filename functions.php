<?php //ini_set('display_errors', 1);

if (file_exists('vendor/autoload.php')) {
	require_once 'vendor/autoload.php';
}
function wp_theme_enqueue_scripts_and_styles() {
	//error_log('parent theme enqueue stuff');
	$manifestPath = get_template_directory() . '/dist/manifest.json';
	$distUrl = trailingslashit(get_template_directory_uri()) . 'dist/';
	if (!file_exists($manifestPath)) {
		return; // Manifest file does not exist, exit the function
	}
	$manifest = json_decode(file_get_contents($manifestPath));
	$media_glightbox = get_field('media_glightbox', 'option') ?? '';
	$alpine_js = get_field('alpine_js', 'option') ?? '';
	$select2 = get_field('select2', 'option') ?? '';	
	$styleName = "src/scss/public.scss";
	$scriptName = "src/js/main.js";
	// Enqueue styles
	if ( $media_glightbox == 'true') {	wp_enqueue_style('glightbox-css','//cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.1/css/glightbox.min.css', [], '', 'all'); }
	if ( $select2 == 'true') {	wp_enqueue_style('select2-css','//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', [], '', 'all');  }
	wp_enqueue_style('WP-style', $distUrl . $manifest->$styleName->file, [], '', 'all');	
	
	// Enqueue scripts
	if ( $media_glightbox == 'true') {	wp_enqueue_script('glightbox-js', '//cdnjs.cloudflare.com/ajax/libs/glightbox/3.3.1/js/glightbox.min.js', [], '3.3.1', true); }
	if ( $select2 == 'true') {	wp_enqueue_script('select2-js', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', [], '4.0.13', true); }
	if ( $alpine_js == 'true') {	wp_enqueue_script('alpine-js', '//cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js', [], '3.14.3', true);  }
	wp_enqueue_script('WP-script', $distUrl . $manifest->$scriptName->file, ['jquery'], false, true);
}
add_action('wp_enqueue_scripts', 'wp_theme_enqueue_scripts_and_styles', 1); // Conected Child Theme enque

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
		'wp-header-top-menu'   => __( 'WP Header Top Menu', 'wp' ),
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
<?php echo do_shortcode('[wp_random_lp_rand_foo]'); ?>
<?php //include('tpl_megamenu.php'); ?>
<?php wp_reset_postdata(); edit_post_link(); ?>
<div class="scroll-up hidden"></div>
<script id="global-foo-js">
	document.addEventListener("DOMContentLoaded",function(){
		const $=jQuery.noConflict(),
			home_url='<?=home_url()?>';
		$('.btn-back-home').attr('href',home_url);
		<?php if ( is_page('get-a-quote') ) : ?>
			const prod_name = document.URL.substr(document.URL.indexOf('#')+1).replace(/%20/g,' ');
			if(window.location.hash) {
				setTimeout(function() {
					$('.prod-name input').val(prod_name);
				}, 500);
			} else {
				$('.prod-name input').val('');
			}
		<?php endif; ?>
		<?php if  ( is_page( array('jaunumi','news','case-studies','industries','projects') ) || ( is_single() && 'post' == get_post_type() ||  'case-study' == get_post_type() ) ) : ?>
			//Load more code for Archive posts
			$(".posts_blogs-global .blog_posts").slice(0,6).show();
			//Load more code for Single Posts
			$(".single-post .posts_blogs-global .blog_posts").slice(0,3).show();
			//Load more code for Archive posts
			$(".single-case-study .posts_blogs-global .blog_posts").slice(0,3).show();
			$("#seeMore").click(function(e){
				e.preventDefault();
				$(".posts_blogs-global .blog_posts:hidden").slice(0,3).fadeIn("slow");				
				if($(".posts_blogs-global .blog_posts:hidden").length == 0){
					$("#seeMore").fadeOut("slow");
				}
			});
			$('.blog_posts__item.date.h6').each(function() {
				const $link = $(this).find('a');				
				if ($link.find('img').length >= 3) {
					$link.css('display', 'block');
				}
			});
			// News Blogs filter
			$('.posts_cat-global .posts-blogs-categories a').each(function() {
				cat = $(this).children('span').text().toLowerCase().replace(/[ &]+/g, "-");
				$(this).attr('data-cat',cat);
			});
			$('.posts_cat-global .posts-blogs-categories a').click(function() {
				$('.posts_cat-global .posts-blogs-categories .all-btn a, .posts_cat-global .posts-blogs-categories a').removeClass('active');
				$(this).addClass('active');
				if ( $(this).hasClass('all') ) {
					$('.posts_cat-global .posts-blogs-categories a').removeClass('active');
					setTimeout(function() {
						$('.posts_blogs-global .blog_posts').slice(0,5).show();
						$('#seeMore').show();
						$('.all-btn').hide();
					}, 500);
				} else {
					$('.posts_blogs-global .blog_posts').each(function() {		
						const hasCategory =$('.posts_cat-global .posts-blogs-categories a.active').attr('data-cat');
						const item = $('.posts_cat-global .posts-blogs-categories a').attr('class');
						$('.posts_blogs-global .blog_posts, #seeMore').hide();
						$('.all-btn, .' + hasCategory).show();
					});
				}
			});
		<?php endif; ?>
		<?php if ( function_exists( 'is_woocommerce' ) ) : ?>
			<?php  if ( is_shop() || is_product_category() || is_product_tag() ) : ?>
				// Remove variable product variations form from list product cards in shop/archive pages
				$('.woocommerce ul.products li.product .variations_form').each(function() {	$(this).remove(); });
			<?php endif; ?>
		<?php endif; ?>
		<?php $select2 = get_field('select2', 'option') ?? '';	if ( $select2 == 'true') : ?>
			$('.woocommerce-ordering select, .wc-block-product-categories select').select2( { minimumResultsForSearch: -1 } );
			$('.wpcf7-select, .acf-form select').select2( { minimumResultsForSearch: 20 } );
		<?php endif; ?>
		<?php $media_glightbox = get_field('media_glightbox', 'option') ?? '';	if ( $media_glightbox == 'true') : ?>
			// Select all links that point to media files
			$('.wp-site-blocks a[href$=".jpg"], .wp-site-blocks.wp-site-blocks a[href$=".jpeg"], .wp-site-blocks a[href$=".png"], .wp-site-blocks a[href$=".gif"], .wp-site-blocks a[href$=".webp"], .wp-site-blocks a[href$=".avif"], .wp-site-blocks a[href$=".mp4"], .wp-site-blocks a[href$=".webm"], .wp-site-blocks a[href$=".ogg"], .wp-site-blocks a[href$=".pdf"], .wp-site-blocks a[href*="youtube.com"], .wp-site-blocks a[href*="vimeo.com"]').each(function() {
				// Add GLightbox class
				$(this).addClass('glightbox-media');
				// Optional: set data-type for videos
				const href = $(this).attr('href');
				if (href.includes('youtube.com') || href.includes('vimeo.com') || href.endsWith('.mp4')) {
					$(this).attr('data-type', 'video');
				} else if (href.endsWith('.pdf')) {
					$(this).attr('data-type', 'iframe'); // PDFs open in iframe
				}
			});
			// Initialize GLightbox
			const lightbox = GLightbox({
				selector: '.glightbox-media',
				autoplayVideos: false,
				touchNavigation: true,
				slideEffect: 'fade',
				openEffect: 'zoom',
				closeEffect: 'fade',
				cssEfects: {
					// This are some of the animations included, no need to overwrite
					fade: { in: 'fadeIn', out: 'fadeOut' },
					zoom: { in: 'zoomIn', out: 'zoomOut' }
				},	
				thumbnails: true,
				loop: true
			});
			//lightbox.open(); // if need to run lightboxon page load, otherwise it will open when user clicks on media links
		<?php endif; ?>
	});
</script>
<?php if ( function_exists( 'is_woocommerce' ) ) : ?>
	<?php  if ( is_shop() || is_product_category() || is_product_tag() ) : ?><style>.products .product .spswp_variations_form.variations_form  {display: none !important;}/* Remove variable product variations form from list product cards in shop/archive pages */</style><?php endif; ?>
<?php endif; ?>
<!-- /Footer WP Global -->
<?php
};

/**
 * Custom Admin Logo
 */
function my_login_logo() { ?><style type="text/css">#login h1 a,.login h1 a {background: url(<?=get_template_directory_uri()?>/assets/img/logo.png) center / 90% auto no-repeat;width:100px;padding:5px}</style><?php }
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

/**
 * SVG WP Support
 * define( 'ALLOW_UNFILTERED_UPLOADS', true ); - need to add wp-config.php as well
 */
function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

// show featured images in dashboard
add_image_size( 'haizdesign-admin-post-featured-image', 120, 120, false );

// Add the posts and pages columns filter. They both use the same function.
add_filter('manage_posts_columns', 'haizdesign_add_post_admin_thumbnail_column', 2);
add_filter('manage_pages_columns', 'haizdesign_add_post_admin_thumbnail_column', 2);

// Add the column
function haizdesign_add_post_admin_thumbnail_column($haizdesign_columns){
	$haizdesign_columns['haizdesign_thumb'] = __('Featured Image');
	return $haizdesign_columns;
}

// Manage Post and Page Admin Panel Columns
add_action('manage_posts_custom_column', 'haizdesign_show_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'haizdesign_show_post_thumbnail_column', 5, 2);

// Get featured-thumbnail size post thumbnail and display it
function haizdesign_show_post_thumbnail_column($haizdesign_columns, $haizdesign_id){
	switch($haizdesign_columns){
		case 'haizdesign_thumb':
		if( function_exists('the_post_thumbnail') ) {
			echo the_post_thumbnail( 'haizdesign-admin-post-featured-image' );
		}
		else
			echo 'hmm… your theme doesn\'t support featured image…';
		break;
	}
}

/**
 * Disable WordPress Comments
 */

function codesnippets_disable_comments() {
    // Remove comment support for posts
    remove_post_type_support( 'post', 'comments' );

    // Remove comment support for pages
    remove_post_type_support( 'page', 'comments' );

    // Remove comments from the admin menu
    remove_menu_page( 'edit-comments.php' );

    // Redirect comment-related URLs to the homepage
    add_action( 'template_redirect', 'codesnippets_disable_comments_redirect' );
}

function codesnippets_disable_comments_redirect() {
    global $wp_query;
    if ( is_single() || is_page() || is_attachment() ) {
        if ( have_comments() || comments_open() ) {
            wp_redirect( home_url(), 301 );
            exit;
        }
    }
}
add_action( 'admin_init', 'codesnippets_disable_comments' );

