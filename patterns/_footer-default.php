<?php
/**
 * Title: Default Footer
 * Slug: footer-default
 * Categories: wp-patterns-main-core
 */
$theme_url = get_template_directory_uri();
$logo_url = $theme_url.'/assets/img/logo.png';
$wp_foo = 'Designed by WP ';
$home_url = get_home_url();
$f = get_fields('option'); //var_dump($f);
$company_address = $f['company_address'] ?? '';
$opening_hours = $f['opening_hours'] ?? '';
$company = $f['company'] ?? '';
$email = $f['email'] ?? '';
$tel_title = $f['tel']['title'] ?? '';
$tel_url = $f['tel']['url'] ?? '';
?>
<!-- wp:areoi/strip {"block_id":"b20c14ae-5a07-4949-92e4-c6b7b59544c8"} -->
<!-- wp:areoi/container {"block_id":"7d97df53-d95a-42f7-a9ba-92173536def4","height_dimension_xs":"100","height_unit_xs":"%"} -->
	<!-- wp:areoi/row {"block_id":"b289be32-57b1-4bec-b25e-557f59cacf54","height_dimension_xs":"100","height_unit_xs":"%"} -->
		<!-- wp:areoi/column {"block_id":"ef686268-218d-4087-8b40-9672a7435e8a"} -->
			<!-- wp:paragraph {"className":"h4"} --><p class="h4"><?=$company?></p><!-- /wp:paragraph -->
			<!-- wp:paragraph {"placeholder":"Column content"} -->
			<p><?=$company_address?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"placeholder":"Column content","col_xs":"col-12"} -->
			<p><br>email: <a href="mailto:<?=$email?>" target="_blank" rel="noreferrer noopener"><strong><?=$email?></strong></a><br>tel: <a href="tel:<?=$tel_url?>" target="_blank" rel="noreferrer noopener"><strong><?=$tel_title?></a></strong></p>
			<!-- /wp:paragraph -->
		<!-- /wp:areoi/column -->
		<!-- wp:areoi/column {"block_id":"05abf0fd-48b0-46c5-b968-84c96764a0c0","col_xs":"col-12","col_md":"col-md-3"} -->
			<!-- wp:paragraph {"className":"h4"} --><p class="h4">Opening Hours</p><!-- /wp:paragraph -->
			<!-- wp:paragraph --><p><?=$opening_hours?></p><!-- /wp:paragraph -->
		<!-- /wp:areoi/column -->
		<!-- wp:areoi/column {"block_id":"a5c2f334-b6da-4885-a37c-cb6d428a48eb","col_xs":"col-12","col_md":"col-md-3"} -->
			<!-- wp:paragraph {"className":"h4"} --><p class="h4"><?php _e( 'Follow us', 'text-domain' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:wp/soc-follow-block /-->
		<!-- /wp:areoi/column -->
	<!-- /wp:areoi/row -->
	<!-- wp:separator {"className":"is-style-wide","style":{"color":{"background":"#00000021"}}} --><hr class="wp-block-separator has-text-color has-alpha-channel-opacity has-background is-style-wide" style="background-color:#00000021;color:#00000021"/><!-- /wp:separator -->
	<!-- wp:areoi/row {"block_id":"cdabc16b-3f41-4e16-90b4-6c2b5420392e"} -->
		<!-- wp:areoi/column {"block_id":"8df08636-aba3-4147-9b07-9ac23bd12d90","col_xs":"col-12","col_sm":"col-sm-12","col_md":"col-md-6"} -->
			<!-- wp:image {"lightbox":{"enabled":false},"id":234,"sizeSlug":"large","linkDestination":"custom"} -->
			<figure class="wp-block-image size-large"><a href="<?=$home_url?>"><img src="<?=$logo_url?>" alt="" class="wp-image-234"/></a></figure>
			<!-- /wp:image -->
		<!-- /wp:areoi/column -->
		<!-- wp:areoi/column {"block_id":"8fac64bd-46ee-4005-b374-7dcdada72fad","col_xs":"col-12","col_sm":"col-sm-12","col_md":"col-md-6"} -->
			<!-- wp:paragraph {"placeholder":"Column content","className":"foo-copy"} --><p class="foo-copy">© <?=date("Y")?> <?=$company?> | <?=$wp_foo?></p><!-- /wp:paragraph -->
		<!-- /wp:areoi/column -->
	<!-- /wp:areoi/row -->
<!-- /wp:areoi/container -->
<!-- /wp:areoi/strip -->