<?php
/**
 * Title: Archive WooCommerce Products Query
 * Slug: woo-query
 * Categories: wp-patterns-main
 */
?>
<!-- wp:spacer --><div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div><!-- /wp:spacer -->
<!-- wp:query {"queryId":0,"query":{"postType":"product","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"parents":[],"perPage":9999},"className":"alignwide wp-block-woocommerce-product-collection","layout":{"type":"constrained"}} -->
<div class="wp-block-query">
	<!-- wp:woocommerce/catalog-sorting /-->
	<!-- wp:woocommerce/product-results-count /-->
	<!-- wp:woocommerce/product-categories {"isDropdown":true,"className":"hidden"} /-->
	<!-- wp:woocommerce/product-template {"layout":{"type":"grid","columnCount":3},"__woocommerceNamespace":"woocommerce/product-query/product-template"} -->
		<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1","sizeSlug":"full"} /-->
		<!-- wp:woocommerce/product-sale-badge {"isDescendentOfQueryLoop":true,"backgroundColor":"green"} /-->
		<!-- wp:post-title {"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|black"},":hover":{"color":{"text":"var:preset|color|black"}}}}},"fontSize":"medium"} /-->
		<!-- wp:woocommerce/product-sku {"isDescendentOfQueryLoop":true} /-->
		<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true} /-->
		<!-- wp:read-more {"content":"\u003cstrong\u003eRead More\u003c/strong\u003e","className":"btn btn-primary","style":{"elements":{"link":{"color":{"text":"var:preset|color|black"}}}},"textColor":"black"} /-->
		<!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true} /-->
		<!-- /wp:woocommerce/product-template -->
	<!-- wp:query-pagination --><!-- wp:query-pagination-previous /--><!-- wp:query-pagination-numbers /--><!-- wp:query-pagination-next /--><!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->
<!-- wp:spacer --><div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div><!-- /wp:spacer -->