<?php
$loc_pages = get_field('loc_pages', 'option') ?? '';

if ( $loc_pages == 'true') :

	/**
	 * Location pages
	 */
	function register_location_cpt() {
		register_post_type('lp', [
			'labels' => [
				'name' => 'Locations',
				'singular_name' => 'Location',
			],
			'public' => true,
			'has_archive' => true,
			'supports' => ['title', 'editor', 'thumbnail'],
			'menu_icon' => 'dashicons-location',
			'rewrite' => ['slug' => 'lp'],
		]);
	}
	add_action('init', 'register_location_cpt');

	add_action('admin_menu', function () {
		add_submenu_page(
			'edit.php?post_type=lp',
			'Generate LP',
			'Generate LP',
			'manage_options',
			'generate_locations',
			'render_generate_locations_blade_form'
		);
	});

	function render_generate_locations_blade_form() {
		?>
		<div class="wrap" style="max-width:900px; margin:0 auto; padding:2rem; font-family:sans-serif;">
			<h1 style="font-size:2rem; font-weight:700; margin-bottom:1.5rem;">Generate Location Pages</h1>

			<form method="post" enctype="multipart/form-data" style="background:#fff; padding:2rem; border-radius:0.5rem; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
				<?php wp_nonce_field('generate_locations_nonce', 'generate_locations_nonce'); ?>

				<table class="form-table" style="width:100%;">
					<tr>
						<th><label for="locations">Locations CSV/Textarea</label></th>
						<td>
							<textarea name="locations" id="locations" rows="10" cols="50" style="width:100%; padding:.5rem; border:1px solid #ccc; border-radius:.25rem;" placeholder="City|County JSON"></textarea>
							<p style="font-size:.85rem; color:#555;">One location per line, pipe-delimited. Optional fields allowed.</p>
						</td>
					</tr>

					<tr>
						<th><label for="locations_csv">Or Upload CSV</label></th>
						<td>
							<input type="file" name="locations_csv" accept=".csv" style="padding:.5rem; border:1px solid #ccc; border-radius:.25rem;" />
							<p style="font-size:.85rem; color:#555;">CSV columns: City, County JSON</p>
						</td>
					</tr>
				</table>

				<?php submit_button('Generate Locations', 'primary', 'submit', true, ['style'=>'padding:.75rem 1.5rem; font-size:1rem; border-radius:.25rem;']); ?>
			</form>
		</div>

		<?php
		// Process submission
		if (
			( !empty($_POST['lp']) || !empty($_FILES['locations_csv']['tmp_name']) ) &&
			check_admin_referer('generate_locations_nonce', 'generate_locations_nonce')
		) {
			$lines = [];

			// If textarea filled
			if (!empty($_POST['lp'])) {
				$text_lines = explode("\n", $_POST['lp']);
				$lines = array_merge($lines, $text_lines);
			}

			// If CSV uploaded
			if (!empty($_FILES['locations_csv']['tmp_name'])) {
				if (($handle = fopen($_FILES['locations_csv']['tmp_name'], 'r')) !== FALSE) {
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						$lines[] = implode('|', $data);
					}
					fclose($handle);
				}
			}

			$created_count = 0;

			foreach ($lines as $line) {
				$line = trim($line);
				if (!$line) continue;

				$data = str_getcsv($line, '|');

				list(
					$city, $county, $address, $phone,
					$lat, $lng, $business_name, $zip, $opening_hours_json
				) = array_pad(array_map('trim', $data), 9, '');

				$opening_hours = $opening_hours_json ? json_decode($opening_hours_json, true) : [];

				$post_id = create_location_post([
					'city' => $city,
					'county' => $county,
					'address' => $address,
					'phone' => $phone,
					'lat' => $lat,
					'lng' => $lng,
					'business_name' => $business_name,
					'zip' => $zip,
					'opening_hours' => $opening_hours,
				]);

				if ($post_id) $created_count++;
			}

			echo '<div class="notice notice-success"><p>Created ' . $created_count . ' location pages.</p></div>';
		}
	}

	function create_location_post($data) {
		if (empty($data['city']) || empty($data['county'])) return false;

		$title = !empty($data['city']) ? $data['county'] : "{$data['city']}, {$data['county']}";

		if (get_page_by_title($title, OBJECT, 'lp')) return false;

		$post_id = wp_insert_post([
			'post_title' => $title,
			'post_type' => 'lp',
			'post_status' => 'publish',
		]);

		if (is_wp_error($post_id)) return false;

		// Populate ACF fields
		foreach (['city','county'] as $field) {
			if (!empty($data[$field])) {
				update_field($field, $data[$field], $post_id);
			}
		}
		return $post_id;
	}

	add_action('wp_head', function() {
		if (!is_singular('lp')) return;
		$post_id = get_the_ID();

		$schema = [
			'@context' => 'https://schema.org',
			'@type' => get_field('business_type', $post_id) ?: 'LocalBusiness',
			'@id' => get_permalink($post_id) . '#localbusiness',
			'name' => get_field('business_name', $post_id) ?: get_the_title(),
			'url' => get_permalink($post_id),
			'telephone' => get_field('phone', $post_id),
			'address' => [
				'@type' => 'PostalAddress',
				'streetAddress' => get_field('address', $post_id),
				'addressLocality' => get_field('city', $post_id),
				'addressRegion' => get_field('county', $post_id),
				'postalCode' => get_field('zip', $post_id),
				'addressCountry' => 'US',
			],
			'geo' => [
				'@type' => 'GeoCoordinates',
				'latitude' => get_field('lat', $post_id),
				'longitude' => get_field('lng', $post_id),
			],
		];

		if ($logo = get_field('logo', 'option')) {
			$schema['logo'] = $logo['url'];
			$schema['image'] = $logo['url'];
		}

		if ($hours = get_field('opening_hours', $post_id)) {
			$schema['openingHoursSpecification'] = [];
			foreach ($hours as $row) {
				$schema['openingHoursSpecification'][] = [
					'@type' => 'OpeningHoursSpecification',
					'dayOfWeek' => $row['day'],
					'opens' => $row['open'],
					'closes' => $row['close'],
				];
			}
		}
		echo '<script type="application/ld+json">' .
			wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) .
		'</script>';		
	});

	add_action('pre_get_posts', function($query) {
		if (is_admin()) return;
		// Only target Query Loop block main query
		if ( isset($query->query_vars['block_type']) && $query->query_vars['block_type'] === 'core/query' ) {
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
			$query->set('paged', $paged);
		}		
	});

	// Shortcode: [wp_paginated_lp]
	add_shortcode('wp_paginated_lp', function($atts) {
		// Detect correct pagination variable
		$paged = 1;
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		}
		$query = new WP_Query([
			'post_type'              => 'lp',
			'posts_per_page'         => 35,
			'paged'                  => $paged,
			'ignore_sticky_posts'    => true,
			'no_found_rows'          => false, // required for pagination
			'suppress_filters'       => false,
		]);
		ob_start();
		if ($query->have_posts()) {
			echo '<div class="loc-pages_wrap"><ul class="loc-pages_items">';
			while($query->have_posts()) : $query->the_post();
				echo '<li class="loc-pages_item">';
				echo '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
				echo '</li>';
			endwhile;
			echo '</ul></div><style>.pagination .nav-links{display:inline-flex;width:100%;}.pagination .page-numbers{display:flex;justify-content:center;margin:5px;font-size:18px;}.pagination .page-numbers.current{font-weight:bold;}</style>';
			echo '<div class="pagination" style="margin:30px 0;">';
			echo paginate_links([
				'total'   => $query->max_num_pages,
				'current' => $paged,
				'mid_size'=> 2,
				'prev_text' => '<b>&#10094;</b>',
				'next_text' => '<b>&#x276F;</b>',
			]);
			echo '</div>';
		}
		wp_reset_postdata();
		return ob_get_clean();
	});
	// Shortcode: [wp_random_lp_rand_foo]
	add_shortcode('wp_random_lp_rand_foo', function($atts) {
		if ( !is_page('home') ) {
			return ''; // Don't show anywhere else
		}
		$query = new WP_Query([
			'post_type'           => 'lp',
			'posts_per_page'      => 10,
			'orderby'             => 'rand',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true, // performance boost (no pagination needed)
		]);
		ob_start();
		if ($query->have_posts()) {
			echo '<div class="loc-pages_wrap" style="position:absolute;width:fit-content;display:flex;transform:translateX(-50%);left:50%;margin:-40px 0 0 0"><ul class="loc-pages_items" style="display:inline-flex;margin:0">';
			while ($query->have_posts()) : $query->the_post();
				echo '<li class="loc-pages_item" style="color:rgba(255,255,255,0.5);font-size:12px;display:flex;padding-left:10px"><a href="'. esc_url(get_permalink()) .'" style="color:rgba(255,255,255,0.5);font-size:12px">'. esc_html(get_the_title()) .'</a></li>';
			endwhile;
			echo '</ul></div>';
		}
		wp_reset_postdata();
		return ob_get_clean();
	});
	// Shortcode to display 'county' field for CPT lp [loc_county]
	function shortcode_county_lp() { return '<span class="loc-county"></span>';}
	add_shortcode('loc_county','shortcode_county_lp');
	// Shortcode to display 'city' field for CPT lp [loc_city]
	function shortcode_city_lp() { return '<span class="loc-city"></span>';}
	add_shortcode('loc_city','shortcode_city_lp');
	// // Shortcode to display 'address' field for CPT lp [loc_address]
	// function shortcode_address_lp() { return '<span class="loc-address"></span>';}
	// add_shortcode('loc_address','shortcode_address_lp');
	// // Shortcode to display 'business_name' field for CPT lp [loc_business_name]
	// function shortcode_business_name_lp() { return '<span class="loc-business_name"></span>';}
	// add_shortcode('loc_business_name','shortcode_business_name_lp');
	// // Shortcode to display 'city' field for CPT lp [loc_zip]
	// function shortcode_zip_lp() { return '<span class="loc-zip"></span>';}
	// add_shortcode('loc_zip','shortcode_zip_lp');
	// // Shortcode to display 'phone' field for CPT lp [loc_phone]
	// function shortcode_phone_lp() { return '<span class="loc-phone"></span>';}
	// add_shortcode('loc_phone','shortcode_phone_lp');
endif;
