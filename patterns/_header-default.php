<?php //phpinfo(); die();
/**
 * Title: Default Header
 * Slug: header-default
 * Categories: wp-patterns-main-core
 */
$home_url = get_home_url();
$f = get_fields('option');
$email = $f['email'] ?? '';
$tel_title = $f['tel']['title'] ?? '';
$tel_url = $f['tel']['url'] ?? '';
?>
<!-- wp:areoi/strip {"block_id":"ed2ffb65-6dc7-4d80-9e36-e4dc78d93af7","background_display":false,"className":"header-top-menu"} -->
	<!-- wp:areoi/container {"block_id":"5a50db58-6a8d-4abe-a7d2-a304e2c99d88","height_dimension_xs":"100","height_unit_xs":"%"} -->
		<!-- wp:areoi/row {"block_id":"38a12afc-0dd1-46cc-869d-523f1613c9fc","height_dimension_xs":"100","height_unit_xs":"%"} -->
			<!-- wp:areoi/column {"block_id":"1f5609fa-f193-4a04-bb67-966c02862a0b"} -->
				<!-- wp:acf/menuoption {"name":"acf/menuoption","data":{"field_690dfcad101e4":"WP Header Top Menu"},"mode":"preview"} /-->
			<!-- /wp:areoi/column -->
		<!-- /wp:areoi/row -->
	<!-- /wp:areoi/container -->
<!-- /wp:areoi/strip -->
<!-- wp:areoi/strip {"block_id":"a373d977-5955-4ce6-a7e4-e8347e72640c"} -->
	<!-- wp:areoi/container {"block_id":"70f0219d-a639-4cef-8deb-028fafb8bda9","height_dimension_xs":"100","height_unit_xs":"%"} -->
		<!-- wp:areoi/row {"block_id":"c8a6830f-e100-4263-87ac-fc64ac8ec00d","height_dimension_xs":"100","height_unit_xs":"%"} -->
			<!-- wp:areoi/column {"block_id":"43f70fd1-3d69-4f1c-b372-7348450195a4","vertical_align_xs":"align-self-center","col_xs":"col-12","col_lg":"col-lg-4"} -->
				<!-- wp:site-logo {"width":260,"shouldSyncIcon":false} /-->
			<!-- /wp:areoi/column -->
			<!-- wp:areoi/column {"block_id":"56dff0a7-933e-4624-b7a1-486fb46e6ca9","col_xs":"col-12","col_lg":"col-lg-8","className":"d-flex flex-row "} -->
				<!-- wp:fibosearch/search /-->
				<!-- wp:areoi/button {"block_id":"d7b87fcb-c353-422b-a012-244957d394e4","url":"http://anco-storage.local/my-account/","text":"Login/register"} /-->
				<!-- wp:paragraph {"className":"top-contacts"} -->
					<p class="top-contacts"><em>email:</em> <a href="mailto:<?=$email?>" target="_blank" rel="noreferrer noopener"><strong><?=$email?></strong></a>&nbsp;<em>tel:</em> <a href="tel:<?=$tel_url?>" target="_blank" rel="noreferrer noopener"><strong><?=$tel_title?></strong></a></p>
				<!-- /wp:paragraph -->
			<!-- /wp:areoi/column -->
		<!-- /wp:areoi/row -->
	<!-- /wp:areoi/container -->
<!-- /wp:areoi/strip -->
<!-- wp:areoi/strip {"block_id":"ed2ffb65-6dc7-4d80-9e36-e4dc78d93af7","background_display":false,"className":"main-top-menu"} -->
	<!-- wp:areoi/container {"block_id":"5a50db58-6a8d-4abe-a7d2-a304e2c99d88","height_dimension_xs":"100","height_unit_xs":"%"} -->
		<!-- wp:areoi/row {"block_id":"38a12afc-0dd1-46cc-869d-523f1613c9fc","height_dimension_xs":"100","height_unit_xs":"%"} -->
			<!-- wp:areoi/column {"block_id":"1f5609fa-f193-4a04-bb67-966c02862a0b"} -->
			 	<!-- wp:acf/menuoption {"name":"acf/menuoption","data":{"field_690dfcad101e4":"WP Header Menu"},"mode":"preview"} /-->
			<!-- /wp:areoi/column -->
		<!-- /wp:areoi/row -->
	<!-- /wp:areoi/container -->
<!-- /wp:areoi/strip -->