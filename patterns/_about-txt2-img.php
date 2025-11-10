<?php
/**
 * Title: About double text & wide Image
 * Slug: about-txt2-img
 * Categories: wp-patterns-main
 */
$theme_url = get_template_directory_uri();
$img1 = $theme_url.'/assets/img/bg/about-img1-min.png';
//$img2 = $theme_url.'/assets/img/bg/about-img2-min.png';
?>
<!-- wp:areoi/container {"block_id":"55a6402d-aefe-4d32-8fee-0cd96fa0c83b","padding_top_xs":"40","padding_bottom_xs":"40","padding_right_xl":"70","padding_left_xl":"70","className":"tpl__about-txt2-img"} -->
	<!-- wp:areoi/row {"block_id":"40d64cf1-933a-4f4c-8f3e-903dae029f64"} -->
		<!-- wp:areoi/column {"block_id":"d883f788-2c36-4b0c-9759-8f64dab271ba","col_xs":"col-12","col_lg":"col-lg-8"} -->
			<!-- wp:paragraph {"className":"h3","style":{"color":{"text":"#f28c2e"},"elements":{"link":{"color":{"text":"#f28c2e"}}}},"fontSize":"medium"} -->
			<p class="h3 has-text-color has-link-color has-medium-font-size" style="color:#f28c2e">Established in 1991 in West Sussex, <br>Anco is the largest trade-only supplier <br>of storage solutions in the UK.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:areoi/column -->
		<!-- wp:areoi/column {"block_id":"a850c375-e25d-4290-9e04-9f3e27ef5654","col_xs":"col-12","col_lg":"col-lg-4"} -->
			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size">Through its list of&nbsp;Premium Distributors&nbsp;and customers, Anco offers an extensive range of over 7,000 variations of products, covering all kinds of applications from industrial racking, multi-tier projects and mezzanine flooring, to office archive storage and modular shelving.<br>Anco stores over £3M worth of stock in their warehouse to facilitate quick turn-around times on orders.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:areoi/column -->
		<!-- wp:areoi/column {"block_id":"a926e2fa-f7a4-4bd9-a7e9-eed450d2ad31","padding_top_xs":"30","col_xs":"col-12"} -->
			<!-- wp:image {"id":440,"width":"1200px","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full is-resized"><img src="<?=$img1?>" alt="" class="wp-image-440" style="width:1200px"/></figure>
			<!-- /wp:image -->
		<!-- /wp:areoi/column -->
	<!-- /wp:areoi/row -->
<!-- /wp:areoi/container -->