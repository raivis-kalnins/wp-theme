<?php //phpinfo(); die();
/**
 * Title: Default Header
 * Slug: header-default
 * Categories: wp-patterns-main-core
 */
$theme_url = get_template_directory_uri();
$tel = $theme_url.'/assets/img/svg/tel.svg';
$mail = $theme_url.'/assets/img/svg/mail.svg';
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
				<!-- wp:html --><span style="transform:translateY(-50%);position: absolute;color:white;top:50%;z-index:3"><a href="mailto:<?=$email?>" target="_blank" rel="noreferrer noopener"><strong style="color:white"><img src="<?=$mail?>" alt="mail" width="22" height="22" />&nbsp;<?=$email?></strong></a>&nbsp;&nbsp;<a href="tel:<?=$tel_url?>" target="_blank" rel="noreferrer noopener"><strong style="color:white"><img src="<?=$tel?>" alt="tel" width="22" height="22" />&nbsp;<?=$tel_title?></a></strong></span><!-- /wp:html -->
			 	<!-- wp:acf/menuoption {"name":"acf/menuoption","data":{"field_690dfcad101e4":"WP Header Top Menu"},"mode":"preview"} /-->
			<!-- /wp:areoi/column -->
		<!-- /wp:areoi/row -->
	<!-- /wp:areoi/container -->
<!-- /wp:areoi/strip -->
<!-- wp:areoi/strip {"block_id":"694d8161-3a3d-4629-9d84-d63e7c01bff1","hide_xs":true,"hide_sm":true,"hide_md":true,"hide_lg":true,"className":"header-top-logo"} -->
	<!-- wp:areoi/container {"block_id":"70f0219d-a639-4cef-8deb-028fafb8bda9","height_dimension_xs":"100","height_unit_xs":"%"} -->
		<!-- wp:areoi/row {"block_id":"c8a6830f-e100-4263-87ac-fc64ac8ec00d","height_dimension_xs":"100","height_unit_xs":"%"} -->
			<!-- wp:areoi/column {"block_id":"43f70fd1-3d69-4f1c-b372-7348450195a4","vertical_align_xs":"align-self-center","col_xs":"col-12"} -->
				<!-- wp:site-logo {"width":260,"shouldSyncIcon":false} /-->				
			<!-- /wp:areoi/column -->
		<!-- /wp:areoi/row -->
	<!-- /wp:areoi/container -->
<!-- /wp:areoi/strip -->
<!-- wp:areoi/strip {"block_id":"ed2ffb65-6dc7-4d80-9e36-e4dc78d93af7","background_display":false,"className":"main-top-menu"} -->
	<!-- wp:areoi/container {"block_id":"5a50db58-6a8d-4abe-a7d2-a304e2c99d88","height_dimension_xs":"100","height_unit_xs":"%"} -->
		<!-- wp:areoi/row {"block_id":"38a12afc-0dd1-46cc-869d-523f1613c9fc","height_dimension_xs":"100","height_unit_xs":"%"} -->
			<!-- wp:areoi/column {"block_id":"1f5609fa-f193-4a04-bb67-966c02862a0b"} -->
			 	<!-- wp:site-logo {"width":260,"shouldSyncIcon":false} /-->	
			 	<!-- wp:acf/menuoption {"name":"acf/menuoption","data":{"field_690dfcad101e4":"WP Header Menu"},"mode":"preview"} /-->
				<!-- wp:fibosearch/search /-->
				<!-- wp:html --><div class="mob-menu-wrap" style="display:flex"><span class="navbar-toggler-btn" data-target="#wp-header-menu"><em></em><em></em><em></em><input type="checkbox" class="checkbox" id="toggleBtn" /></span></div><!-- /wp:html -->
			<!-- /wp:areoi/column -->
		<!-- /wp:areoi/row -->
	<!-- /wp:areoi/container -->
<!-- /wp:areoi/strip -->