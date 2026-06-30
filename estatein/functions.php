<?php
/**
 * Estatein theme bootstrap.
 *
 * Loads the modular includes that set up the theme. Each concern lives in its own
 * file under inc/ to keep this entry point small and the codebase easy to navigate.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

define( 'ESTATEIN_VERSION', '1.0.0' );
define( 'ESTATEIN_DIR', get_template_directory() );
define( 'ESTATEIN_URI', get_template_directory_uri() );

/**
 * Require a theme include, failing loudly during development only.
 */
function estatein_require( $relative_path ) {
	$path = ESTATEIN_DIR . '/inc/' . $relative_path;
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}

estatein_require( 'theme-setup.php' );   // Theme supports, menus, image sizes.
estatein_require( 'enqueue.php' );        // Styles & scripts.
estatein_require( 'cpt.php' );            // Custom post types & taxonomies.
estatein_require( 'acf-fields.php' );     // ACF field groups (registered in PHP).
estatein_require( 'seo.php' );            // Meta description + Open Graph tags.
estatein_require( 'template-tags.php' );  // Presentation helpers used in templates.
