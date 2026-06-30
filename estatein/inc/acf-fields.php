<?php
/**
 * ACF field groups, registered in PHP so the content model travels with the theme
 * (no manual re-entry when deploying to cPanel). Also points ACF at /acf-json for
 * any UI-authored groups so they sync to version control.
 *
 * All registrations are guarded by function_exists() so the theme degrades
 * gracefully if ACF is not installed.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

/**
 * Save/Load ACF JSON inside the theme for portability.
 */
add_filter(
	'acf/settings/save_json',
	function () {
		return ESTATEIN_DIR . '/acf-json';
	}
);
add_filter(
	'acf/settings/load_json',
	function ( $paths ) {
		$paths[] = ESTATEIN_DIR . '/acf-json';
		return $paths;
	}
);

/**
 * Register field groups in code.
 */
function estatein_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	/* ---------------------------------------------------------------------
	 * Property details
	 * ------------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'      => 'group_property_details',
			'title'    => __( 'Property Details', 'estatein' ),
			'fields'   => array(
				array( 'key' => 'field_prop_price', 'label' => __( 'Price', 'estatein' ), 'name' => 'price', 'type' => 'number', 'prepend' => '$', 'wrapper' => array( 'width' => '33' ) ),
				array( 'key' => 'field_prop_status', 'label' => __( 'Status', 'estatein' ), 'name' => 'status', 'type' => 'select', 'choices' => array( 'for-sale' => __( 'For Sale', 'estatein' ), 'for-rent' => __( 'For Rent', 'estatein' ), 'sold' => __( 'Sold', 'estatein' ) ), 'default_value' => 'for-sale', 'wrapper' => array( 'width' => '33' ) ),
				array( 'key' => 'field_prop_featured', 'label' => __( 'Featured', 'estatein' ), 'name' => 'featured', 'type' => 'true_false', 'ui' => 1, 'wrapper' => array( 'width' => '34' ) ),
				array( 'key' => 'field_prop_beds', 'label' => __( 'Bedrooms', 'estatein' ), 'name' => 'bedrooms', 'type' => 'number', 'wrapper' => array( 'width' => '33' ) ),
				array( 'key' => 'field_prop_baths', 'label' => __( 'Bathrooms', 'estatein' ), 'name' => 'bathrooms', 'type' => 'number', 'wrapper' => array( 'width' => '33' ) ),
				array( 'key' => 'field_prop_area', 'label' => __( 'Area (sqft)', 'estatein' ), 'name' => 'area_sqft', 'type' => 'number', 'wrapper' => array( 'width' => '34' ) ),
				array( 'key' => 'field_prop_address', 'label' => __( 'Address', 'estatein' ), 'name' => 'address', 'type' => 'text' ),
				array( 'key' => 'field_prop_gallery', 'label' => __( 'Gallery', 'estatein' ), 'name' => 'gallery', 'type' => 'gallery', 'return_format' => 'array' ),
				array( 'key' => 'field_prop_features', 'label' => __( 'Key Features', 'estatein' ), 'name' => 'features', 'type' => 'repeater', 'button_label' => __( 'Add feature', 'estatein' ), 'sub_fields' => array(
					array( 'key' => 'field_prop_feature_text', 'label' => __( 'Feature', 'estatein' ), 'name' => 'feature', 'type' => 'text' ),
				) ),
			),
			'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'property' ) ) ),
		)
	);

	/* ---------------------------------------------------------------------
	 * Team member
	 * ------------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'      => 'group_team_member',
			'title'    => __( 'Team Member', 'estatein' ),
			'fields'   => array(
				array( 'key' => 'field_team_role', 'label' => __( 'Role', 'estatein' ), 'name' => 'role', 'type' => 'text', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_team_email', 'label' => __( 'Email', 'estatein' ), 'name' => 'email', 'type' => 'email', 'wrapper' => array( 'width' => '50' ) ),
				array( 'key' => 'field_team_linkedin', 'label' => __( 'LinkedIn URL', 'estatein' ), 'name' => 'linkedin', 'type' => 'url' ),
			),
			'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'team_member' ) ) ),
		)
	);

	/* ---------------------------------------------------------------------
	 * Testimonial
	 * ------------------------------------------------------------------- */
	acf_add_local_field_group(
		array(
			'key'      => 'group_testimonial',
			'title'    => __( 'Testimonial', 'estatein' ),
			'fields'   => array(
				array( 'key' => 'field_tst_headline', 'label' => __( 'Headline', 'estatein' ), 'name' => 'testimonial_headline', 'type' => 'text', 'instructions' => __( 'Short bold title above the quote, e.g. "Exceptional Service!".', 'estatein' ) ),
				array( 'key' => 'field_tst_rating', 'label' => __( 'Rating (1–5)', 'estatein' ), 'name' => 'rating', 'type' => 'number', 'min' => 1, 'max' => 5, 'default_value' => 5, 'wrapper' => array( 'width' => '33' ) ),
				array( 'key' => 'field_tst_author_role', 'label' => __( 'Author Location / Role', 'estatein' ), 'name' => 'author_role', 'type' => 'text', 'wrapper' => array( 'width' => '67' ) ),
			),
			'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'testimonial' ) ) ),
		)
	);

	/* ---------------------------------------------------------------------
	 * Theme options: contact details (used in header/footer/contact page)
	 * ------------------------------------------------------------------- */
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page(
			array(
				'page_title' => __( 'Theme Settings', 'estatein' ),
				'menu_title' => __( 'Theme Settings', 'estatein' ),
				'menu_slug'  => 'estatein-settings',
				'capability' => 'manage_options',
				'icon_url'   => 'dashicons-admin-customizer',
			)
		);

		acf_add_local_field_group(
			array(
				'key'      => 'group_theme_settings',
				'title'    => __( 'Contact & Social', 'estatein' ),
				'fields'   => array(
					array( 'key' => 'field_set_phone', 'label' => __( 'Phone', 'estatein' ), 'name' => 'contact_phone', 'type' => 'text', 'wrapper' => array( 'width' => '33' ) ),
					array( 'key' => 'field_set_email', 'label' => __( 'Email', 'estatein' ), 'name' => 'contact_email', 'type' => 'email', 'wrapper' => array( 'width' => '33' ) ),
					array( 'key' => 'field_set_address', 'label' => __( 'Office Address', 'estatein' ), 'name' => 'contact_address', 'type' => 'text', 'wrapper' => array( 'width' => '34' ) ),
					array( 'key' => 'field_set_social', 'label' => __( 'Social Links', 'estatein' ), 'name' => 'social_links', 'type' => 'repeater', 'button_label' => __( 'Add link', 'estatein' ), 'sub_fields' => array(
						array( 'key' => 'field_set_social_network', 'label' => __( 'Network', 'estatein' ), 'name' => 'network', 'type' => 'text', 'wrapper' => array( 'width' => '40' ) ),
						array( 'key' => 'field_set_social_url', 'label' => __( 'URL', 'estatein' ), 'name' => 'url', 'type' => 'url', 'wrapper' => array( 'width' => '60' ) ),
					) ),
				),
				'location' => array( array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'estatein-settings' ) ) ),
			)
		);
	}
}
add_action( 'acf/init', 'estatein_register_acf_fields' );
