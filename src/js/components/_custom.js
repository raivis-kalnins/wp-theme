document.addEventListener("DOMContentLoaded", function() {

	const $ = jQuery.noConflict(),
		win = $(window).width(),
		d = new Date(),
		n = d.getFullYear(),
		page = $('html, body'),
		pageUrl = window.location.href,
		i = 0;

	// WP Remove <p> tags
	$('div.row p:empty').hide();
	$('div.row p').each(function() {
		var $this = $(this);
		if ($this.html() === "&nbsp;") {
			$this.remove();
		}
	});

	$('.woocommerce-ordering select, .wc-block-product-categories select').select2( { minimumResultsForSearch: -1 } );

	/**
	* Menu Scroll
	*/
	$('.site-header').removeClass('sticky-header');
	
	const lastScrollTop = 500;
	
	$(window).scroll(function(e) {    
		const scroll = $(window).scrollTop();
		const st = $(this).scrollTop();
		lastScrollTop = st;

		if (scroll >= 500) {
			$('.scroll-up').removeClass('hidden');
			$('.site-header').addClass('sticky-header');
		} else {
			$('.scroll-up').addClass('hidden');
			$('.site-header').removeClass('sticky-header');
		}
	});

	// News Blogs filter
	$('.posts_cat-global .posts-blogs-categories a').on('click', function() {
		$('.posts_cat-global .posts-blogs-categories a').removeClass('active');
		$(this).addClass('active');

		var category = $(this).text().trim();
		
		var categorySlug = category.toLowerCase().replace(/\s+/g, '-');
		
		var safeCategory = categorySlug.replace(/[^\w-]/g, '');

		console.log('Category:', category, 'Slug:', safeCategory);

		if (category === 'All') {
			$('.posts_blogs-global .blog_posts').show();
		} else {
			$('.posts_blogs-global .blog_posts').each(function() {
				var postClasses = $(this).attr('class').split(' ');
				var hasCategory = false;
				
				for (var i = 0; i < postClasses.length; i++) {
					if (postClasses[i] === safeCategory) {
						hasCategory = true;
						break;
					}
				}
				
				if (hasCategory) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
		}
	});


	//Load more code for Single Posts
	$(".single-post .posts_blogs-global .blog_posts").slice(0,3).show();
	//Load more code for Archive posts
	$(".page-template-page-blog .posts_blogs-global .blog_posts").slice(0,9).show();
	//Load more code for Archive posts
	$(".single-case-study .posts_blogs-global .blog_posts").slice(0,3).show();
	//Load more code for Archive posts
	$(".post-type-archive-case-study .posts_blogs-global .blog_posts").slice(0,9).show();

	$("#seeMore").click(function(e){
		e.preventDefault();
		$(".posts_blogs-global .blog_posts:hidden").slice(0,3).fadeIn("slow");
		
		if($(".posts_blogs-global .blog_posts:hidden").length == 0){
			$("#seeMore").fadeOut("slow");
		}
	});

	$('.blog_posts__item.date.h6').each(function() {
		const $link = $(this).find('a');
		
		if ($link.find('img').length >= 3) {
			$link.css('display', 'block');
		}
	});

	$('.wp-block-query-pagination-next').addClass("btn btn-primary");
	$('.wp-block-query-pagination-previous').addClass("btn btn-primary");
});
