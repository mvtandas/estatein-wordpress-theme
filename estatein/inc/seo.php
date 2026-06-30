<?php
/**
 * Lightweight SEO defaults.
 *
 * Provides a meta description and Open Graph / Twitter tags out of the box.
 * If a dedicated SEO plugin (Yoast, Rank Math) is active, it deactivates these
 * to avoid duplicate tags.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

/**
 * True when a major SEO plugin is handling meta output.
 */
function estatein_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' );
}

/**
 * Derive a clean meta description for the current view.
 */
function estatein_meta_description() {
	if ( is_singular() ) {
		$desc = has_excerpt() ? get_the_excerpt() : wp_strip_all_tags( get_the_content() );
	} elseif ( is_category() || is_tax() || is_tag() ) {
		$desc = term_description();
	} else {
		$desc = get_bloginfo( 'description' );
	}
	$desc = wp_strip_all_tags( (string) $desc );
	return trim( mb_substr( $desc, 0, 160 ) );
}

/**
 * Print meta description + Open Graph / Twitter card tags in <head>.
 */
function estatein_print_meta_tags() {
	if ( estatein_seo_plugin_active() ) {
		return;
	}

	$description = estatein_meta_description();
	$title       = wp_get_document_title();
	$url         = is_singular() ? get_permalink() : home_url( add_query_arg( null, null ) );
	$image       = ( is_singular() && has_post_thumbnail() ) ? get_the_post_thumbnail_url( null, 'estatein-property-hero' ) : '';

	if ( $description ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $description ) );
	}
	printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
	printf( '<meta property="og:type" content="%s">' . "\n", is_singular() ? 'article' : 'website' );
	printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
	if ( $description ) {
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $description ) );
	}
	if ( $image ) {
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );
	}
	printf( '<meta name="twitter:card" content="%s">' . "\n", $image ? 'summary_large_image' : 'summary' );
}
add_action( 'wp_head', 'estatein_print_meta_tags', 5 );

/**
 * Use a clean title separator.
 */
add_filter(
	'document_title_separator',
	function () {
		return '·';
	}
);

/**
 * Output JSON-LD structured data.
 *
 * - RealEstateAgent (the business) on every page.
 * - RealEstateListing on single property pages (price, beds/baths/area, image),
 *   which can earn rich results.
 *
 * Skipped when a dedicated SEO plugin is handling schema.
 */
function estatein_structured_data() {
	if ( estatein_seo_plugin_active() ) {
		return;
	}

	$blocks = array();

	// --- Business (sitewide) ---
	$org = array(
		'@context' => 'https://schema.org',
		'@type'    => 'RealEstateAgent',
		'@id'      => home_url( '/#organization' ),
		'name'     => get_bloginfo( 'name' ),
		'url'      => home_url( '/' ),
		'logo'     => get_theme_file_uri( 'assets/img/logo-symbol.svg' ),
	);
	$phone = estatein_field( 'contact_phone', 'option' );
	$email = estatein_field( 'contact_email', 'option' );
	$addr  = estatein_field( 'contact_address', 'option' );
	if ( $phone ) {
		$org['telephone'] = $phone;
	}
	if ( $email ) {
		$org['email'] = $email;
	}
	if ( $addr ) {
		$org['address'] = array( '@type' => 'PostalAddress', 'streetAddress' => $addr );
	}
	$blocks[] = $org;

	// --- Property listing (single property) ---
	if ( is_singular( 'property' ) ) {
		$listing = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'RealEstateListing',
			'name'        => get_the_title(),
			'url'         => get_permalink(),
			'datePosted'  => get_the_date( 'c' ),
			'description' => wp_strip_all_tags( get_the_excerpt() ),
		);
		if ( has_post_thumbnail() ) {
			$listing['image'] = get_the_post_thumbnail_url( null, 'estatein-property-hero' );
		}
		$price = estatein_field( 'price' );
		if ( $price ) {
			$listing['offers'] = array(
				'@type'         => 'Offer',
				'price'         => (string) (int) $price,
				'priceCurrency' => 'USD',
				'availability'  => 'https://schema.org/InStock',
			);
		}
		$residence = array( '@type' => 'Residence', 'name' => get_the_title() );
		$beds = estatein_field( 'bedrooms' );
		$area = estatein_field( 'area_sqft' );
		$loc  = estatein_field( 'address' );
		if ( $loc ) {
			$residence['address'] = array( '@type' => 'PostalAddress', 'addressLocality' => $loc );
		}
		if ( $beds ) {
			$residence['numberOfRooms'] = (int) $beds;
		}
		if ( $area ) {
			$residence['floorSize'] = array( '@type' => 'QuantitativeValue', 'value' => (int) $area, 'unitCode' => 'FTK' );
		}
		$listing['about'] = $residence;
		$blocks[] = $listing;
	}

	foreach ( $blocks as $block ) {
		echo '<script type="application/ld+json">' . wp_json_encode( $block ) . "</script>\n";
	}
}
add_action( 'wp_head', 'estatein_structured_data', 6 );

/**
 * Provide an SVG favicon from the theme when no Site Icon is set in the Customizer
 * (a Customizer Site Icon still takes precedence).
 */
function estatein_favicon() {
	if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
		return;
	}
	printf(
		'<link rel="icon" href="%s" type="image/svg+xml">' . "\n",
		esc_url( get_theme_file_uri( 'assets/img/logo-symbol.svg' ) )
	);
}
add_action( 'wp_head', 'estatein_favicon' );
