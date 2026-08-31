<?php
/**
 * Shortcode: [products_items]
 * Displays technical specifications for single products
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Remove wpautop for content that contains our shortcode.
// Runs AFTER wpautop (priority 10) to unwrap the shortcode.
add_filter( 'the_content', function ( $content ) {
	if ( has_shortcode( $content, 'products_items' ) ) {
		$content = shortcode_unautop( $content );
	}
	return $content;
}, 11 );

/**
 * Render the [products_items] shortcode.
 *
 * @return string HTML output.
 */
function shortcode_products_items() {

	// Guard: ACF Pro must be active.
	if ( ! function_exists( 'get_fields' ) ) {
		return '<p class="alert alert-warning">' . esc_html__( 'ACF plugin is required.', 'wp-theme' ) . '</p>';
	}

	$home_url   = get_site_url();
	$f          = get_fields() ?: [];
	$locale     = get_locale();
	$post_id    = get_the_ID();
	$post_title = get_the_title( $post_id );
	$photos     = $f['photos'] ?? [];

	// ── Labels (LV / EN) ──────────────────────────────────────────
	$labels = [
		'lv'    => [
			'garums'                                         => 'Kopējais garums (mm)',
			'platums'                                        => 'Kopējais platums (mm)',
			'augstums'                                       => 'Kopējais augstums (mm)',
			'maksimalais_pacelsanas_augstums_mm'             => 'Maksimālais pacelšanas augstums (mm)',
			'maksimalais_pacelsanas_augstums_pie_tapas_mm'   => 'Maksimālais pacelšanas augstums pie tapas (mm)',
			'celtspeja_kg'                                   => 'Celtspēja (kg)',
			'sakabes_veids'                                  => 'Sakabes veids',
			'minimalais_apgriesanas_radiuss_mm'              => 'Minimālais apgriešanas radiuss (mm)',
			'dizeldzinejs_cilindru_skaits_gab'               => 'Dīzeļdzinējs (cilindru skaits gab.)',
			'dzinejs'                                        => 'Dzinējs',
			'dzineja_jauda_kw'                               => 'Dzinēja jauda (kW)',
			'dzesesanas_veids'                               => 'Dzesēšanas veids',
			'dzineja_nominalie_apgriezieni'                  => 'Dzinēja nominālie apgriezieni',
			'dzineja_tuksgaitas_apgriezieni'                 => 'Dzinēja tukšgaitas apgriezieni',
			'pasmassa_kg'                                    => 'Pašmassa (kg)',
			'degvielas_paterins'                             => 'Degvielas patēriņš',
			'atrumu_skaits_gab'                              => 'Ātrumu skaits (gab.)',
			'maksimalais_atrums_kmh'                         => 'Maksimālais ātrums km/h',
			'dzineja_tilpums_l'                              => 'Dzinēja tilpums (l)',
			'maksimalais_griezes_moments_nm'                 => 'Maksimālais griezes moments (N·m)',
			'lad_kataloga_nr'                                => 'Lad kataloga Nr',
			'cena'                                           => 'Cena Eur',
		],
		'en_GB' => [
			'garums'                                         => 'Total length (mm)',
			'platums'                                        => 'Total width (mm)',
			'augstums'                                       => 'Total height (mm)',
			'maksimalais_pacelsanas_augstums_mm'             => 'Maximum lifting height (mm)',
			'maksimalais_pacelsanas_augstums_pie_tapas_mm'   => 'Maximum lifting height at pin (mm)',
			'celtspeja_kg'                                   => 'Load capacity (kg)',
			'sakabes_veids'                                  => 'Coupling type',
			'minimalais_apgriesanas_radiuss_mm'              => 'Minimum cutting radius (mm)',
			'dizeldzinejs_cilindru_skaits_gab'               => 'Diesel engine (number of cylinders)',
			'dzinejs'                                        => 'Engine',
			'dzineja_jauda_kw'                               => 'Engine power (kW)',
			'dzesesanas_veids'                               => 'Cooling type',
			'dzineja_nominalie_apgriezieni'                  => 'Rated engine speed',
			'dzineja_tuksgaitas_apgriezieni'                 => 'Engine idle speed',
			'pasmassa_kg'                                    => 'Curb weight (kg)',
			'degvielas_paterins'                             => 'Fuel consumption',
			'atrumu_skaits_gab'                              => 'Number of speeds (pcs.)',
			'maksimalais_atrums_kmh'                         => 'Maximum speed km/h',
			'dzineja_tilpums_l'                              => 'Engine displacement (l)',
			'maksimalais_griezes_moments_nm'                 => 'Maximum torque (N·m)',
			'lad_kataloga_nr'                                => 'Lad catalog No.',
			'cena'                                           => 'Price in Euros',
		],
	];

	$current_labels = $labels[ $locale ] ?? $labels['lv'];

	// ── Field map: ACF field name => label key ────────────────────
	// NOTE: Trailing underscores match the actual ACF field names.
	$field_map = [
		'garums'                                         => 'garums',
		'platums'                                        => 'platums',
		'augstums'                                       => 'augstums',
		'maksimalais_pacelsanas_augstums_mm'             => 'maksimalais_pacelsanas_augstums_mm',
		'maksimalais_pacelsanas_augstums_pie_tapas_mm'   => 'maksimalais_pacelsanas_augstums_pie_tapas_mm',
		'celtspeja_kg_'                                  => 'celtspeja_kg',
		'sakabes_veids'                                  => 'sakabes_veids',
		'minimalais_apgriesanas_radiuss_mm_'             => 'minimalais_apgriesanas_radiuss_mm',
		'dizeldzinejs_cilindru_skaits_gab'               => 'dizeldzinejs_cilindru_skaits_gab',
		'dzinejs'                                        => 'dzinejs',
		'dzineja_jauda_kw_'                              => 'dzineja_jauda_kw',
		'dzesesanas_veids'                               => 'dzesesanas_veids',
		'dzineja_nominalie_apgriezieni'                  => 'dzineja_nominalie_apgriezieni',
		'dzineja_tuksgaitas_apgriezieni'                 => 'dzineja_tuksgaitas_apgriezieni',
		'pasmassa_kg'                                    => 'pasmassa_kg',
		'degvielas_paterins'                             => 'degvielas_paterins',
		'atrumu_skaits_gab'                              => 'atrumu_skaits_gab',
		'maksimalais_atrums_kmh'                         => 'maksimalais_atrums_kmh',
		'dzineja_tilpums_l'                              => 'dzineja_tilpums_l',
		'maksimalais_griezes_moments_n·m_'               => 'maksimalais_griezes_moments_nm',
		'lad_kataloga_nr'                                => 'lad_kataloga_nr',
		'cena'                                           => 'cena',
	];

	// ── Build table rows ─────────────────────────────────────────
	$table_rows = '';
	foreach ( $field_map as $acf_field => $label_key ) {
		$value = $f[ $acf_field ] ?? '';
		if ( '' !== $value && null !== $value ) {
			$label = $current_labels[ $label_key ] ?? $label_key;
			$table_rows .= sprintf(
				'<tr><td><span>%s</span></td><td><b>%s</b></td></tr>',
				esc_html( $label ),
				esc_html( $value )
			);
		}
	}

	// ── Gallery ──────────────────────────────────────────────────
	$gallery_html = '';
	if ( ! empty( $photos ) && is_array( $photos ) ) {
		foreach ( $photos as $photo ) {
			if ( ! empty( $photo['url'] ) ) {
				$url = esc_url( $photo['url'] );
				$alt = ! empty( $photo['alt'] ) ? esc_attr( $photo['alt'] ) : esc_attr( $post_title );
				$gallery_html .= sprintf('<a href="%1$s" class="glightbox-media" data-type="image"><img src="%1$s" alt="%2$s" style="float:left;margin-right:20px;width:120px;height:auto" /></a>',$url,$alt);
			}
		}
	}

	// ── PDF Download ─────────────────────────────────────────────
	$product_file_item = '';
	if ( ! empty( $f['product_file'] ) ) {
		$pdf_url  = esc_url( $f['product_file'] );
		$icon_url = esc_url( get_template_directory_uri() . '/assets/img/svg/ico-pdf.svg' );
		$pdf_txt  = ( 'lv' === $locale )
			? 'Tehniskā<br>informācija'
			: 'Technical<br>information';

		$product_file_item = sprintf(
			'<hr style="width:100%%;margin:30px auto;border:none;border-top:1px solid #ccc;" />' .
			'<a href="%1$s" target="_blank" class="prod-file" style="text-align:center;width:100px;display:block">' .
			'<img src="%2$s" alt="PDF" style="margin-bottom:10px"><p>%3$s</p></a>',
			$pdf_url,
			$icon_url,
			$pdf_txt
		);
	}

	// ── Language-specific strings ────────────────────────────────
	$btn_url = ( 'lv' === $locale ) ? 'kontakti' : 'contact';
	$btn_txt = ( 'lv' === $locale ) ? 'Sagatavot piedāvājumu' : 'Quote';
	$h_txt   = ( 'lv' === $locale ) ? 'Standarta aprīkojums un parametri' : 'Standard equipment and parameters';

	$thumbnail_url = get_the_post_thumbnail_url( $post_id, 'full' );

	// ── ACF spec content (WYSIWYG field — Gutenberg markup) ────────
	// Strip all HTML comments and empty tags. Browsers fix minor tag issues.
	$specs_raw = $f['standarta_aprikojums_un_parametri'] ?? '';
	if ( $specs_raw ) {
		// 1. Strip ALL HTML comments (<!-- anything -->)
		$specs_clean = preg_replace( '/<!--.*?-->/s', '', $specs_raw );
		// 2. Strip empty tags: <ul></ul>, <li></li>, <p></p>, <div></div>
		$specs_clean = preg_replace( '/<(ul|li|p|div)[^>]*>\s*<\/\1>/s', '', $specs_clean );
		// 3. Normalize whitespace: collapse 3+ newlines to 2, trim ends
		$specs_clean = preg_replace( '/\n{3,}/s', "

", trim( $specs_clean ) );
	} else {
		$specs_clean = '';
	}

	// ── Build output ─────────────────────────────────────────────
	ob_start();
	?>
	<div class="row">
		<div class="col col-12 col-lg-6">
			<?php if ( $table_rows ) : ?>
				<table class="table table-bordered table-striped">
					<tbody>
						<?php echo $table_rows; // phpcs:ignore -- already escaped above ?>
					</tbody>
				</table>
			<?php else : ?>
				<p class="text-muted"><?php echo esc_html( ( 'lv' === $locale ) ? 'Nav pieejami parametri.' : 'No parameters available.' ); ?></p>
			<?php endif; ?>
			<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
		</div>
		<div class="col col-12 col-lg-6">
			<?php if ( $thumbnail_url ) : ?>
				<a href="<?php echo esc_url( $thumbnail_url ); ?>" class="glightbox-media" data-type="image"><img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $post_title ); ?>" style="width:100%;height:auto" /></a>
			<?php endif; ?>
			<?php if ( $gallery_html ) : ?>
				<div class="prod-gallery">
					<?php echo $gallery_html; // phpcs:ignore -- already escaped above ?>
				</div>
			<?php endif; ?>
			<?php echo $product_file_item; // phpcs:ignore -- already escaped above ?>
		</div>
	</div>
	<div class="row">
		<div class="col col-12">
			<h2><?php echo esc_html( $h_txt ); ?>:</h2><br>
			<?php if ( $specs_clean ) : ?><div><?php echo $specs_clean; // phpcs:ignore -- comments stripped, empty tags removed ?></div><?php endif; ?>
			<a href="<?php echo esc_url( $home_url . '/' . $btn_url ); ?>" class="btn btn-primary quote_btn"><?php echo esc_html( $btn_txt ); ?></a>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'products_items', 'shortcode_products_items' );