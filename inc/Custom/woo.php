<?php
/**
 * WooCommerce functions
 */

// Change Add to Cart button text on archive pages
function custom_add_to_cart_text( $text ) {
	return __( 'Buy', 'woocommerce' ); // Replace with your preferred text
}
add_filter( 'woocommerce_product_add_to_cart_text', 'custom_add_to_cart_text' );

// Hide H1 if Hero Shop archive page
add_filter('woocommerce_show_page_title', '__return_false');

/**
* Remove the breadcrumbs
*/
function woo_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
add_action( 'init', 'woo_remove_wc_breadcrumbs' );

/**
* Add description to Woo related items
*/
function woo_show_excerpt_shop_page() {
    global $product;
	echo '<p class="prod-desc">'.wp_trim_words( $product->post->post_excerpt, 12 ).'</p>'; 
}
add_action( 'woocommerce_after_shop_loop_item_title', 'woo_show_excerpt_shop_page', 5 );

/**
* Change Woo Product H1 Tag to H2 if hero H1
*/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
function sgl_template_single_title() {
    the_title( '<h2 class="product_title entry-title">', '</h2>' );
}
add_action( 'woocommerce_single_product_summary', 'sgl_template_single_title', 5 );

/**
 * WooCommerce Quantity +/- buttons
 */
function wc_display_quantity_minus() {
   if ( !is_product() ) return;
   echo '<button type="button" class="minus" >-</button>';
}
add_action( 'woocommerce_before_quantity_input_field', 'wc_display_quantity_minus' );
 
function wc_display_quantity_plus() {
   if ( ! is_product() ) return;
   echo '<button type="button" class="plus" >+</button>';
}
add_action( 'woocommerce_after_quantity_input_field', 'wc_display_quantity_plus' );
 
function wc_add_cart_quantity_plus_minus() {
   	wc_enqueue_js( "
		$('form.cart, .woocommerce-cart-form').on( 'click', 'button.plus, button.minus', function() {
			var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
			var val   = parseFloat(qty.val());
			var max = parseFloat(qty.attr( 'max' ));
			var min = parseFloat(qty.attr( 'min' ));
			var step = parseFloat(qty.attr( 'step' ));
			if ( $( this ).is( '.plus' ) ) {
				if ( max && ( max <= val ) ) {
					qty.val( max );
				} else {
					qty.val( val + step );
				}
			} else {
				if ( min && ( min >= val ) ) {
					qty.val( min );
				} else if ( val > 1 ) {
					qty.val( val - step );
				}
			}
		});
   " );
}
add_action( 'woocommerce_after_add_to_cart_quantity', 'wc_add_cart_quantity_plus_minus' );

/*
 * WooCommerce Total Product Price for single prod template
 */
function woocommerce_total_product_price() {
	global $woocommerce, $product;
	$currency = get_woocommerce_currency_symbol().number_format(wc_get_price_including_tax($product), 2).' each <i>&nbsp;</i> total: </span> <span class="product-total-price_sum price">'.get_woocommerce_currency_symbol().number_format(wc_get_price_including_tax($product), 2);
	echo <<<HTML
		<div id="product_total_price" class="product-total-price"><span class="product-total-price_caption" style="opacity:0.7">{$currency}</span></div>
	HTML;	
?>
	<script>
		document.addEventListener("DOMContentLoaded",function() {
			const 	$ = jQuery.noConflict(),
					price = <?=wc_get_price_including_tax($product)?>,
					currency = '<?=get_woocommerce_currency_symbol()?>';
			$('[name=quantity]').change(function(){
				if (!(this.value < 1)) {
					var product_total = parseFloat(price * this.value);
					$('#product_total_price .price').html(currency + product_total.toFixed(2));
				}
			});
			$('form.cart .quantity, .single_variation_wrap .quantity').on( 'click', 'button', function() {
				setTimeout(function() {
					const	inp_v = $('.quantity .qty').val(),
							product_t = parseFloat(price * inp_v);
					$('#product_total_price .price').html(currency + product_t.toFixed(2));
				}, 200);
			});
		});
	</script>
<?php
}
add_action( 'woocommerce_after_add_to_cart_quantity', 'woocommerce_total_product_price', 31 );

/*
 * WooCommerce Checkout show product images
 */
function ts_product_image_review_order_checkout( $name, $cart_item, $cart_item_key ) {
	if ( ! is_checkout() ) return $name;
	$product = $cart_item['data'];
	$thumbnail = $product->get_image( array( '70', '70' ), array( 'class' => 'alignleft' ) );
	return $thumbnail . $name;
}
add_filter( 'woocommerce_cart_item_name', 'ts_product_image_review_order_checkout', 9999, 3 );
