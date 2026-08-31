<?php
$loc_pages = get_field('loc_pages', 'option') ?? '';

if ( $loc_pages == 'true') :
	/**
	 * Title: Location Pages Content
	 * Slug: location-page
	 */
	$loc_random_text = get_field('loc_random_text', 'option') ?: '';
	$loc_random_images = get_field('loc_random_images', 'option') ?: [];
	$county = get_field('county') ?? '';
	$city = get_field('city') ?? '';
	// $address = get_field('address') ?? '';
	// $business_name = get_field('business_name') ?? '';
	// $zip = get_field('zip') ?? '';
	// $phone = get_field('phone') ?? '';
?>
	<!-- wp:spacer {"height":"50px"} --><div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div><!-- /wp:spacer -->
	<!-- wp:media-text {"mediaPosition":"right","mediaType":"image","verticalAlignment":"top"} -->
	<div class="wp-block-media-text has-media-on-the-right is-stacked-on-mobile is-vertically-aligned-top">
		<div class="wp-block-media-text__content" style="animation:fade-in 2s linear both"><?=$loc_random_text?></div>
		<figure class="wp-block-media-text__media">
			<img src="<?php if ($loc_random_images) {echo $loc_random_images[array_rand($loc_random_images)];} ?>" alt="" style="object-position:50% 50%"/>
		</figure>
	</div>
	<!-- /wp:media-text -->
	<!-- wp:html --><script id="single-loc-js">document.addEventListener("DOMContentLoaded",function() {const $=jQuery.noConflict();$('.loc-county').text('<?=$county?>');$('.loc-city').text('<?=$city?>');});</script><!-- /wp:html -->
<?php
endif;