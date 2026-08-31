<?php
/**
 * Title: Get In Touch
 * Slug: get-in-touch
 * Categories: wp-patterns-main
 */
$theme_url = get_template_directory_uri();
$img1 = $theme_url.'/assets/img/bg/img-left-min.jpg';
$img2 = $theme_url.'/assets/img/bg/img-right-min.jpg';
$img3 = $theme_url.'/assets/img/bg/img-left2-min.jpg';
$img4 = $theme_url.'/assets/img/bg/img-right2-min.jpg';
?>
<!-- wp:areoi/container {"block_id":"30b225d2-4325-48a3-9770-fd91c735216a","container":"container-fluid","background_display":true,"background_color":{"hex":"#f28c2e","rgb":{"r":242,"g":140,"b":46,"a":1},"hsv":{"h":29,"s":81,"v":95,"a":1},"hsl":{"h":29,"s":88,"l":56,"a":1},"source":"hex","oldHue":29},"height_dimension_xs":"100","height_unit_xs":"%","metadata":{"categories":["wp-patterns-main"],"patternName":"get-in-touch","name":"Get In Touch"},"className":"tpl__get-in-touch"} -->
	<!-- wp:areoi/row {"block_id":"06c1a595-000a-4f68-94d9-275a9f0a5f9c","height_dimension_xs":"100","height_unit_xs":"%"} -->
		<!-- wp:areoi/column {"block_id":"05c8ca03-5b58-465d-961b-7508d6a76d6c"} -->
			<!-- wp:areoi/container {"block_id":"c98969b6-640f-47c4-a750-b55e8fdfffeb"} -->
				<!-- wp:areoi/row {"block_id":"8b69e497-86f9-451c-a814-c80061a06961","padding_top_xs":"60","padding_bottom_xs":"60"} -->
					<!-- wp:areoi/column {"block_id":"2fc00083-e3f7-40ae-b798-feb5e9ace9d7","col_xs":"col-12","col_sm":"Default","col_xl":"col-xl-6"} -->
					<!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|black"}}}},"textColor":"black"} -->
						<h2 class="wp-block-heading has-black-color has-text-color has-link-color">Get in touch today!</h2>
					<!-- /wp:heading -->
					<!-- wp:paragraph --><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.Sed do eiusmod tempor incididunt ut labore et dolore.</p><!-- /wp:paragraph -->
					<!-- wp:spacer {"height":"20px"} --><div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div><!-- /wp:spacer -->
						<!-- wp:wsf-block/form-add {"form_id":"1"} /-->
					<!-- /wp:areoi/column -->
					<!-- wp:areoi/column {"block_id":"f4934f74-7ae2-42ff-9e05-4494c469142c","col_xs":"col-12","col_sm":"Default","col_xl":"col-xl-6"} -->
						<!-- wp:gallery {"linkTo":"none","metadata":{"categories":["gallery"],"patternName":"core/two-images-side-by-side","name":"Two images side by side"},"align":"center","className":"  two-images-side-by-side"} -->
							<figure class="wp-block-gallery aligncenter has-nested-images columns-default is-cropped  two-images-side-by-side">
								<!-- wp:image {"id":365,"sizeSlug":"full","linkDestination":"none","className":"is-style-rounded"} -->
								<figure class="wp-block-image size-full is-style-rounded"><img src="<?=$img1?>" alt="" class="wp-image-365"/></figure>
								<!-- /wp:image -->
								<!-- wp:image {"id":366,"sizeSlug":"full","linkDestination":"none","className":"is-style-rounded"} -->
								<figure class="wp-block-image size-full is-style-rounded"><img src="<?=$img2?>" alt="" class="wp-image-366"/></figure>
								<!-- /wp:image -->
							</figure>
						<!-- /wp:gallery -->
						<!-- wp:gallery {"linkTo":"none","metadata":{"categories":["gallery"],"patternName":"core/two-images-side-by-side","name":"Two images side by side"},"align":"center","className":"  two-images-side-by-side"} -->
						<figure class="wp-block-gallery aligncenter has-nested-images columns-default is-cropped  two-images-side-by-side">
							<!-- wp:image {"id":365,"sizeSlug":"full","linkDestination":"none","className":"is-style-rounded"} -->
								<figure class="wp-block-image size-full is-style-rounded"><img src="<?=$img3?>" alt="" class="wp-image-365"/></figure>
							<!-- /wp:image -->
							<!-- wp:image {"id":366,"sizeSlug":"full","linkDestination":"none","className":"is-style-rounded"} -->
								<figure class="wp-block-image size-full is-style-rounded"><img src="<?=$img4?>" alt="" class="wp-image-366"/></figure>
							<!-- /wp:image -->
						</figure>
						<!-- /wp:gallery -->
					<!-- /wp:areoi/column -->
				<!-- /wp:areoi/row -->
			<!-- /wp:areoi/container -->
		<!-- /wp:areoi/column -->
	<!-- /wp:areoi/row -->
<!-- /wp:areoi/container -->