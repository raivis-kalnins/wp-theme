<?php
/**
 * Single Product tabs Custom Template Owerride
 * @version 9.8.0
 */
global $product;
$heading_d = apply_filters( 'woocommerce_product_description_heading', __( 'Product Details', 'woocommerce' ) );
$heading_m = apply_filters( 'woocommerce_product_description_heading', __( 'Product Specifications', 'woocommerce' ) );
$theme_url = get_template_directory_uri();
$home_url = get_home_url();
$files = get_fields()["product_files"] ?? '';
$extra_variations = get_fields()["extra_variations"] ?? ''; //var_dump($extra_variations);
?>
<div class="woocommerce-tabs wc-tabs-wrapper container">
	<div class="row">
		<div class="col col-12 col-lg-6">
			<h2><?php echo esc_html( $heading_m ); ?></h2>
			<div class="product_meta">
				<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
				<?php do_action( 'woocommerce_product_meta_start' ); ?>
					<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
						<span class="sku_wrapper"><b><?php esc_html_e( 'SKU:', 'woocommerce' ); ?></b> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>
					<?php endif; ?>
					<?php if ( !empty($extra_variations) ) : ?>
						<table class="woocommerce-product-attributes shop_attributes" style="margin-top:-1px">
							<?php foreach( $extra_variations as $variation ) : $caption = $variation["caption"] ?? '';	$text = $variation["text"] ?? ''; ?>
								<tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_material"><th class="woocommerce-product-attributes-item__label" scope="row"><?=$caption?></th><td class="woocommerce-product-attributes-item__value"><p><?=$text?></p></td></tr>
							<?php endforeach; ?>
						</table>
					<?php endif; ?>
					<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( '<br><b>Category:</b>', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>
					<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( '<br><b>Tag:</b>', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>
				<?php do_action( 'woocommerce_product_meta_end' ); ?>				
			</div>
		</div>
		<div class="col col-12 col-lg-6">
			<?php /* =do_shortcode('[pi_shipping_calculator]') */ ?>
			<?php if ( !empty($files) ) : ?>
				<h2>Downloads</h2>
				<ul class="prod-files">
					<?php foreach( $files as $file ) : $f = $file["file"]['url'] ?? '';	$fname = $file["file"]["title"] ?? ''; ?>
						<li class="prod-files_file"><a href="<?=$f?>" target="_blank"><img src="<?=$theme_url?>/assets/img/svg/ico-pdf.svg" alt="pdf" /><br /><span><?=$fname?></span></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
		</div>
		<div class="col col-12">
			<hr />
			<h2><?php echo esc_html( $heading_d ); ?></h2>
			<?php the_content(); ?>
			<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
		</div>		
	</div>
	<?=do_shortcode('[tabbed_information][faq_accordion]')?>
</div>