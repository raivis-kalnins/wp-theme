<?php
/**
 * Single Product tabs Custom Template Owerride
 */
global $product;
$heading_d = apply_filters( 'woocommerce_product_description_heading', __( 'Product details', 'woocommerce' ) );
$heading_m = apply_filters( 'woocommerce_product_description_heading', __( 'Weight & measurements', 'woocommerce' ) );
$theme_url = get_template_directory_uri();
$home_url = get_home_url();
$files = get_fields()["product_files"]; //var_dump($files);
?>
<div class="woocommerce-tabs wc-tabs-wrapper container">
	<div class="row">
		<div class="col col-12 col-sm-6">
			<h2><?php echo esc_html( $heading_m ); ?></h2>
			<div class="product_meta">				
				<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
				<?php do_action( 'woocommerce_product_meta_start' ); ?>
					<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( ProductType::VARIABLE ) ) ) : ?>
						<span class="sku_wrapper"><b><?php esc_html_e( 'SKU:', 'woocommerce' ); ?></b> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>
					<?php endif; ?>
					<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( '<br><b>Category:</b>', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>
					<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( '<br><b>Tag:</b>', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>
				<?php do_action( 'woocommerce_product_meta_end' ); ?>
				<hr />
				<ul class="prod-files">
					<?php 
						if ( !empty($files) ) :
							foreach( $files as $file ) : //var_dump($file);
								$f = $file["file"]['url'] ?? '';
								$fname = $file["file"]["title"] ?? '';
					?>
						<li class="prod-files_file"><a href="<?=$f?>" target="_blank"><img src="<?=$theme_url?>/assets/img/svg/ico-pdf.svg" alt="pdf" /><br /><span><?=$fname?></span></a></li>
					<?php 
							endforeach;
						endif;
					?>
				</ul>
				<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
			</div>
		</div>
		<div class="col col-12 col-sm-6">
			<h2><?php echo esc_html( $heading_d ); ?></h2>
			<?php the_content(); ?>
			<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
		</div>
	</div>
</div>