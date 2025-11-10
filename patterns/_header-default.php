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
<!-- wp:areoi/strip {"block_id":"a373d977-5955-4ce6-a7e4-e8347e72640c"} -->
	<!-- wp:areoi/container {"block_id":"70f0219d-a639-4cef-8deb-028fafb8bda9","height_dimension_xs":"100","height_unit_xs":"%"} -->
		<!-- wp:areoi/row {"block_id":"c8a6830f-e100-4263-87ac-fc64ac8ec00d","height_dimension_xs":"100","height_unit_xs":"%"} -->
			<!-- wp:areoi/column {"block_id":"43f70fd1-3d69-4f1c-b372-7348450195a4"} -->
				<!-- wp:site-logo {"width":260,"shouldSyncIcon":false} /-->
				<!-- /wp:areoi/column -->
				<!-- wp:areoi/column {"block_id":"56dff0a7-933e-4624-b7a1-486fb46e6ca9","className":"d-flex flex-row "} -->
				<!-- wp:fibosearch/search /-->
				<!-- wp:areoi/button {"block_id":"d7b87fcb-c353-422b-a012-244957d394e4","url":"http://anco-storage.local/my-account/","text":"Login/register"} /-->
				 <!-- wp:paragraph {"className":"top-contacts"} -->
					<p class="top-contacts"><em>email:</em> <a href="mailto:<?=$email?>" target="_blank" rel="noreferrer noopener"><strong><?=$email?></strong></a>&nbsp;<em>tel:</em> <a href="tel:<?=$tel_url?>" target="_blank" rel="noreferrer noopener"><strong><?=$tel_title?></a></strong></p>
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
			 	<?php // TemplateHelper::main_menu_section(); ?>
				<!-- wp:areoi/list-group {"block_id":"84e320a2-2bad-4dad-a9a3-fba528924d1e","flush":"Default","layout":"list-group-horizontal","className":"main-top-menu\u002d\u002dnav"} -->
					<!-- wp:areoi/list-group-item {"block_id":"d3b5ffbb-4158-4106-8bb0-ee466c49f2e6","item_style":"Default","url":"<?=$home_url?>/shop/","text":"PRODUCTS"} /-->
					<!-- wp:areoi/list-group-item {"block_id":"e1b123cf-e63d-4a0f-888f-eeefb4a191e0","url":"<?=$home_url?>/blog/","text":"PREMIUM DISTRIBUTORS"} /-->
					<!-- wp:areoi/list-group-item {"block_id":"8a3a22ab-3a6f-43f1-bc28-0cad6c3e78a1","url":"<?=$home_url?>/case-study/","text":"TALK TO THE EXPERTS"} /-->
					<!-- wp:areoi/list-group-item {"block_id":"0c88fbdc-7886-41b0-9403-a57ca533270c","url":"<?=$home_url?>/about/","text":"ABOUT"} /-->
					<!-- wp:areoi/list-group-item {"block_id":"6ffcc0c4-4ea1-4945-a6d8-f6ddec9be574","url":"<?=$home_url?>/trade-zone/","text":"TRADE ZONE"} /-->
					<!-- wp:woocommerce/customer-account {"displayStyle":"icon_only","iconStyle":"alt","iconClass":"wc-block-customer-account__account-icon","backgroundColor":"#333333","textColor":"white","style":{"elements":{"link":{"color":{"text":"var:preset|color|black"}}}}} /-->
					<!-- wp:woocommerce/mini-cart {"miniCartIcon":"bag","addToCartBehaviour":"open_drawer","hasHiddenPrice":false,"priceColor":{"name":"White","slug":"white","color":"#ffffff","class":"has-white-product-count-color"},"iconColor":{"name":"White","slug":"white","color":"#ffffff","class":"has-white-product-count-color"},"productCountColor":{"color":"#f28c2e"}} /-->
					<!-- /wp:areoi/list-group -->
			<!-- /wp:areoi/column -->
		<!-- /wp:areoi/row -->
	<!-- /wp:areoi/container -->
<!-- /wp:areoi/strip -->