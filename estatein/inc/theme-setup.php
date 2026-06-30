<?php
/**
 * Theme setup: supports, menus, image sizes, content width.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register core theme supports and navigation menus.
 */
function estatein_setup() {
	load_theme_textdomain( 'estatein', ESTATEIN_DIR . '/languages' );

	// Let WordPress manage the document <title>.
	add_theme_support( 'title-tag' );

	// Featured images, used heavily by the Property CPT.
	add_theme_support( 'post-thumbnails' );

	// Output valid HTML5 markup for core features.
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);

	// Responsive embeds and accessible automatic feed links.
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'customize-selective-refresh-widgets' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'estatein' ),
			'footer'  => __( 'Footer Menu', 'estatein' ),
		)
	);

	// Image sizes tuned to the design's card and hero crops.
	add_image_size( 'estatein-property-card', 600, 420, true );
	add_image_size( 'estatein-property-hero', 1280, 760, true );
	add_image_size( 'estatein-avatar', 120, 120, true );
}
add_action( 'after_setup_theme', 'estatein_setup' );

/**
 * Set the embedded content width.
 */
function estatein_content_width() {
	$GLOBALS['content_width'] = 1200;
}
add_action( 'after_setup_theme', 'estatein_content_width', 0 );

/**
 * Register widget areas (footer columns).
 */
function estatein_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'estatein' ),
			'id'            => 'footer-1',
			'description'   => __( 'Footer widget area.', 'estatein' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'estatein_widgets_init' );

/**
 * Contact Form 7: disable automatic <p>/<br> insertion so our forms keep the
 * exact grid markup authored in the CF7 admin (the Figma layout relies on the
 * .field elements being direct children of the .enquiry-form__grid container).
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );
