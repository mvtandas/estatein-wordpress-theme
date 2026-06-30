<?php
/**
 * Custom post types & taxonomies.
 *
 * Registered in the theme so the content model ships with it. (In a production
 * site that needs to outlive a theme switch, these would move to a small companion
 * plugin — noted in the docs as a deliberate trade-off for this assessment.)
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register all theme post types.
 */
function estatein_register_post_types() {
	$types = array(
		'property'    => array(
			'singular'  => __( 'Property', 'estatein' ),
			'plural'    => __( 'Properties', 'estatein' ),
			'icon'      => 'dashicons-admin-home',
			'slug'      => 'properties',
			'supports'  => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'has_archive' => true,
		),
		'service'     => array(
			'singular'  => __( 'Service', 'estatein' ),
			'plural'    => __( 'Services', 'estatein' ),
			'icon'      => 'dashicons-portfolio',
			'slug'      => 'services',
			'supports'  => array( 'title', 'editor', 'thumbnail' ),
			'has_archive' => false,
		),
		'team_member' => array(
			'singular'  => __( 'Team Member', 'estatein' ),
			'plural'    => __( 'Team', 'estatein' ),
			'icon'      => 'dashicons-groups',
			'slug'      => 'team',
			'supports'  => array( 'title', 'editor', 'thumbnail' ),
			'has_archive' => false,
		),
		'testimonial' => array(
			'singular'  => __( 'Testimonial', 'estatein' ),
			'plural'    => __( 'Testimonials', 'estatein' ),
			'icon'      => 'dashicons-format-quote',
			'slug'      => 'testimonials',
			'supports'  => array( 'title', 'editor', 'thumbnail' ),
			'has_archive' => false,
		),
		'faq'         => array(
			'singular'  => __( 'FAQ', 'estatein' ),
			'plural'    => __( 'FAQs', 'estatein' ),
			'icon'      => 'dashicons-editor-help',
			'slug'      => 'faqs',
			'supports'  => array( 'title', 'editor' ),
			'has_archive' => false,
		),
	);

	foreach ( $types as $key => $cfg ) {
		register_post_type( $key, estatein_build_cpt_args( $cfg ) );
	}
}
add_action( 'init', 'estatein_register_post_types' );

/**
 * Build register_post_type() args from a compact config array.
 */
function estatein_build_cpt_args( $cfg ) {
	$labels = array(
		'name'               => $cfg['plural'],
		'singular_name'      => $cfg['singular'],
		'add_new_item'       => sprintf( __( 'Add New %s', 'estatein' ), $cfg['singular'] ),
		'edit_item'          => sprintf( __( 'Edit %s', 'estatein' ), $cfg['singular'] ),
		'new_item'           => sprintf( __( 'New %s', 'estatein' ), $cfg['singular'] ),
		'view_item'          => sprintf( __( 'View %s', 'estatein' ), $cfg['singular'] ),
		'search_items'       => sprintf( __( 'Search %s', 'estatein' ), $cfg['plural'] ),
		'not_found'          => sprintf( __( 'No %s found', 'estatein' ), strtolower( $cfg['plural'] ) ),
		'all_items'          => $cfg['plural'],
		'menu_name'          => $cfg['plural'],
	);

	return array(
		'labels'        => $labels,
		'public'        => true,
		'show_in_rest'  => true, // Gutenberg + headless friendly.
		'has_archive'   => $cfg['has_archive'],
		'menu_icon'     => $cfg['icon'],
		'supports'      => $cfg['supports'],
		'rewrite'       => array( 'slug' => $cfg['slug'], 'with_front' => false ),
		'hierarchical'  => false,
	);
}

/**
 * Taxonomies for properties: type (apartment/villa…) and location.
 */
function estatein_register_taxonomies() {
	register_taxonomy(
		'property_type',
		'property',
		array(
			'labels'            => array(
				'name'          => __( 'Property Types', 'estatein' ),
				'singular_name' => __( 'Property Type', 'estatein' ),
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'property-type' ),
		)
	);

	register_taxonomy(
		'property_location',
		'property',
		array(
			'labels'            => array(
				'name'          => __( 'Locations', 'estatein' ),
				'singular_name' => __( 'Location', 'estatein' ),
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'rewrite'           => array( 'slug' => 'location' ),
		)
	);
}
add_action( 'init', 'estatein_register_taxonomies' );

/**
 * Flush rewrite rules once on theme activation so CPT permalinks work immediately.
 */
function estatein_rewrite_flush() {
	estatein_register_post_types();
	estatein_register_taxonomies();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'estatein_rewrite_flush' );
