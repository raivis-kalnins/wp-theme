<?php
/**
 * Shortcodes linked
 */

// Add short code for Login  Only Pages [need_login]
function shortcode_needLogin() {
	if (!is_user_logged_in()) {
		//auth_redirect();
		//$redirect_url = wp_safe_redirect( get_home_url().'/my-account/' );
		$login_form = do_shortcode('[woocommerce_my_account]');
		return '<div class="container login-form" style="margin-bottom:70px;">'.$login_form.'</div><style>.entry-content .row{display:none !important;}/*.woocommerce .col2-set .col-1, .woocommerce-page .col2-set .col-1{float:none;width:fit-content;margin: 0 auto;}*/</style>';
	} else {
		return '';
	}
}
add_shortcode('need_login', 'shortcode_needLogin');

// Add short code for Single Blog Post [single_blog_post_intro]
function shortcode_single_blog_post_intro() {
	$single_blog_post_intro = $f = get_fields()['single_blog_post_intro'] ?? '';
	return '<span>'.$single_blog_post_intro.'</span>';
}
add_shortcode('single_blog_post_intro', 'shortcode_single_blog_post_intro');

// Add short code for Single Blog Post [single_blog_post_more_posts_intro]
function shortcode_single_blog_post_more_posts_intro() {
	$single_blog_post_more_posts_intro = $f = get_fields()['single_blog_post_more_posts_intro'] ?? '';
	if (get_locale() == 'lv') { $btn_txt = 'Uz blogu'; } if (get_locale() == 'en_GB') { $btn_txt = 'Back to Blog'; }
	return '<a href="../about/blog/" class="btn btn-dark btn-dark--back" style="position:absolute;top:-40px;right:10px;">'.$btn_txt.'</a><span>'.$single_blog_post_more_posts_intro.'</span>';
}
add_shortcode('single_blog_post_more_posts_intro', 'shortcode_single_blog_post_more_posts_intro');

// Add short code for WooCommerce Single Product Reviews On/Off [product_reviews]
function shortcode_product_reviews() {
	$product_reviews = $f = get_fields()['product_reviews'] ?? '';
	if ( $product_reviews == true ) {
		return do_blocks( '<!-- wp:woocommerce/product-reviews --><div class="wp-block-woocommerce-product-reviews"><!-- wp:woocommerce/product-reviews-title /--><!-- wp:woocommerce/product-review-template /--><!-- wp:woocommerce/product-reviews-pagination /--><!-- wp:woocommerce/product-review-form /--></div><!-- /wp:woocommerce/product-reviews -->' );
	} else {
		return '';
	}
}
add_shortcode('product_reviews', 'shortcode_product_reviews');

// Add short code for Single Products [products_items]
include( get_template_directory() . '/templates/components/shortcodes/products_items.php' );

// Add short code Testimonials [testimonials]
include( get_template_directory() . '/templates/components/shortcodes/testimonials.php' );

// Add short code Posts Blogs [posts_cpt]
include( get_template_directory() . '/templates/components/shortcodes/posts_cpt.php' );

// Add short code Custom Heros [custom_hero_shop] - Theme Options for archive etc
include( get_template_directory() . '/templates/components/shortcodes/custom-hero.php' );

// Add short code Load More button [load_more_cards] - Theme Options for any place
include( get_template_directory() . '/templates/components/shortcodes/load-more.php' );

// Add short code Posts Blogs [cat_listed_cpt]
include( get_template_directory() . '/templates/components/shortcodes/cat_listed_cpt.php' );

// Add short code Posts Blogs [avatar_cpt]
include( get_template_directory() . '/templates/components/shortcodes/avatar_cpt.php' );

// Add short code Posts Blogs [cs_img]
include( get_template_directory() . '/templates/components/shortcodes/cs_img.php' );

// Add short code WooCommerce Product Category bottom description [woo_cat_bottom_desc]
include( get_template_directory() . '/templates/components/shortcodes/woo_cat_bottom_desc.php' );

// Add short code Products Query [products-loop]
include( get_template_directory() . '/templates/components/shortcodes/products-loop.php' );

// Add short code Testimonials [tabbed_information]
include( get_template_directory() . '/templates/components/shortcodes/product_tabs.php' );

// Add short code Testimonials [faq_accordion]
include( get_template_directory() . '/templates/components/shortcodes/product_faq.php' );
