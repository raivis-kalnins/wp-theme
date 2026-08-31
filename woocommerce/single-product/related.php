<?php
/**
 * Single Product Related
 * @version 10.3.0
 */
?>
<section class="related products">
	<?php
		$home_url = get_home_url();
		$f = get_fields() ?? '';
		$rec_prod_btn = $f['rec_prod_btn'] ?? '';
		$rec_products = $f['rec_products'] ?? '';
		$w = get_fields('option') ?? '';
		$related_title = $w['related_title'] ?? '';
		$related_desc = $w['related_desc'] ?? '';
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( "$related_title", "woocommerce" ) );
	if ( $heading ) :
	?>
		<h2 class="woo-related_title"><?php echo esc_html( $heading ); ?></h2>
		<p class="woo-related_desc"><?=$related_desc?></p>
	<?php endif; ?>
	<?php if( $rec_prod_btn == 'true' ) { ?>
		<ul class="products columns-4">
			<?php foreach( $rec_products as $product ):
				$product_id = $product->ID;
				$post_title = $product->post_title;
				$post_excerpt = $product->post_excerpt;
				$post_link = get_permalink( $product_id );
				$get_the_post_thumbnail_url = get_the_post_thumbnail_url( $product_id );
				//$price = do_blocks('<!-- wp:woocommerce/product-price --><!-- /wp:woocommerce/product-price -->');
				$prod = wc_get_product( $product_id );
				$price = $prod->get_price_html();
			?>
				<li id="pduct_id_<?=$product_id?>" class="product type-product post-<?=$product_id?>">
					<a href="<?=$post_link?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
						<img width="300" height="300" src="<?=$get_the_post_thumbnail_url?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="<?=$post_title?>" />
						<h2 class="woocommerce-loop-product__title"><?=$post_title?></h2>
						<p class="prod-desc"><?=$post_excerpt?></p>
						<div style="height:15px" aria-hidden="true" class="wp-block-spacer"></div>
						<span class="price"><?=$price?></span>
						<a href="<?=$post_link?>" class="button wp-element-button product_type_variable add_to_cart_button" data-product_id="<?=$product_id?>">Buy</a>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php } else { ?>
		<?php woocommerce_product_loop_start(); ?>
			<?php 
				foreach ( $related_products as $related_product ) :
					$post_object = get_post( $related_product->get_id() );
					setup_postdata( $GLOBALS['post'] =& $post_object );
					wc_get_template_part('content','product');
				endforeach;
			?>
		<?php woocommerce_product_loop_end(); echo '<a class="btn areoi-has-url position-relative btn-primary" href="'.$home_url.'/products/">Discover More</a>'; ?>
	<?php } ?>
</section>