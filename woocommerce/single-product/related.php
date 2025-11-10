<section class="related products">
	<?php
		$home_url = get_home_url();
		$w = get_fields('option') ?? '';
		$related_title = $w['related_title'] ?? '';
		$related_desc = $w['related_desc'] ?? '';
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( "$related_title", "woocommerce" ) );
		if ( $heading ) :
	?>
	<h2 class="woo-related_title"><?php echo esc_html( $heading ); ?></h2>
	<p class="woo-related_desc"><?=$related_desc?></p>
	<?php endif; ?>    
	<?php woocommerce_product_loop_start(); ?>
		<?php 
			foreach ( $related_products as $related_product ) : 
				$post_object = get_post( $related_product->get_id() );
				setup_postdata( $GLOBALS['post'] =& $post_object );
				wc_get_template_part('content','product');
		   endforeach;
		?>
	<?php woocommerce_product_loop_end(); echo '<a class="btn areoi-has-url position-relative btn-primary" href="'.$home_url.'/shop/">Discover More</a>'; ?>
</section>