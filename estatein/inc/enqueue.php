<?php
/**
 * Enqueue styles and scripts.
 *
 * CSS is split into cascade layers (tokens → base → layout → components → responsive)
 * and registered in dependency order. JS is loaded in the footer and deferred.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

/**
 * Cache-bust by file mtime in dev, by theme version in production.
 */
function estatein_asset_version( $relative_path ) {
	$file = ESTATEIN_DIR . '/' . ltrim( $relative_path, '/' );
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG && file_exists( $file ) ) {
		return (string) filemtime( $file );
	}
	return ESTATEIN_VERSION;
}

/**
 * Front-end styles and scripts.
 */
function estatein_enqueue_assets() {
	// Fonts — preconnect handled via resource hints below; load Urbanist with swap.
	wp_enqueue_style(
		'estatein-fonts',
		'https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	// Ordered stylesheets; each depends on the previous so the cascade is deterministic.
	$styles = array(
		'estatein-tokens'     => 'assets/css/tokens.css',
		'estatein-base'       => 'assets/css/base.css',
		'estatein-layout'     => 'assets/css/layout.css',
		'estatein-components' => 'assets/css/components.css',
		'estatein-responsive' => 'assets/css/responsive.css',
	);
	$prev = array( 'estatein-fonts' );
	foreach ( $styles as $handle => $rel ) {
		wp_enqueue_style( $handle, ESTATEIN_URI . '/' . $rel, $prev, estatein_asset_version( $rel ) );
		$prev = array( $handle );
	}

	// The main stylesheet (theme header) loads last so overrides win.
	wp_enqueue_style( 'estatein-style', get_stylesheet_uri(), $prev, estatein_asset_version( 'style.css' ) );

	// Scripts — registered with defer (see estatein_defer_scripts) and footer placement.
	$scripts = array(
		'estatein-nav'     => 'assets/js/nav.js',
		'estatein-faq'     => 'assets/js/faq.js',
		'estatein-slider'  => 'assets/js/slider.js',
		'estatein-filters' => 'assets/js/filters.js',
		'estatein-gallery' => 'assets/js/gallery.js',
	);
	foreach ( $scripts as $handle => $rel ) {
		wp_enqueue_script( $handle, ESTATEIN_URI . '/' . $rel, array(), estatein_asset_version( $rel ), true );
	}

	// Motion layer — GSAP + ScrollTrigger (self-hosted), then the animation script.
	wp_enqueue_script( 'gsap', ESTATEIN_URI . '/assets/js/vendor/gsap.min.js', array(), '3.12.5', true );
	wp_enqueue_script( 'gsap-scrolltrigger', ESTATEIN_URI . '/assets/js/vendor/ScrollTrigger.min.js', array( 'gsap' ), '3.12.5', true );
	wp_enqueue_script( 'estatein-animations', ESTATEIN_URI . '/assets/js/animations.js', array( 'gsap', 'gsap-scrolltrigger' ), estatein_asset_version( 'assets/js/animations.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'estatein_enqueue_assets' );

/**
 * Add defer to our theme scripts for non-blocking loads.
 */
function estatein_defer_scripts( $tag, $handle ) {
	if ( 0 === strpos( $handle, 'estatein-' ) && false === strpos( $tag, 'defer' ) ) {
		$tag = str_replace( ' src', ' defer src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'estatein_defer_scripts', 10, 2 );

/**
 * Preconnect to the Google Fonts hosts to shave the font handshake.
 */
function estatein_resource_hints( $hints, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$hints[] = array( 'href' => 'https://fonts.googleapis.com' );
		$hints[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $hints;
}
add_filter( 'wp_resource_hints', 'estatein_resource_hints', 10, 2 );
