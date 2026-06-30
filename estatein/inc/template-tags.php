<?php
/**
 * Template tags — small presentation helpers used across templates.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

/**
 * Safely read an ACF field with a fallback when ACF is not active.
 *
 * @param string   $selector Field name.
 * @param int|null $post_id  Optional post ID.
 * @param mixed    $default  Fallback value.
 * @return mixed
 */
function estatein_field( $selector, $post_id = null, $default = '' ) {
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $selector, $post_id );
		return ( null === $value || '' === $value ) ? $default : $value;
	}
	return $default;
}

/**
 * Format a numeric price as currency (no decimals).
 *
 * @param mixed  $amount Raw price.
 * @param string $symbol Currency symbol.
 * @return string
 */
function estatein_format_price( $amount, $symbol = '$' ) {
	$amount = is_numeric( $amount ) ? (float) $amount : 0;
	return $symbol . number_format_i18n( $amount );
}

/**
 * Echo a property's key spec line (beds · baths · area) for cards/detail.
 *
 * @param int|null $post_id Property post ID.
 */
function estatein_property_specs( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	$specs   = array(
		'beds'  => estatein_field( 'bedrooms', $post_id ),
		'baths' => estatein_field( 'bathrooms', $post_id ),
		'area'  => estatein_field( 'area_sqft', $post_id ),
	);

	echo '<ul class="property-specs" role="list">';
	if ( $specs['beds'] ) {
		printf(
			'<li class="property-specs__item"><span class="property-specs__label">%s</span> %s</li>',
			esc_html__( 'Bedrooms', 'estatein' ),
			esc_html( $specs['beds'] )
		);
	}
	if ( $specs['baths'] ) {
		printf(
			'<li class="property-specs__item"><span class="property-specs__label">%s</span> %s</li>',
			esc_html__( 'Bathrooms', 'estatein' ),
			esc_html( $specs['baths'] )
		);
	}
	if ( $specs['area'] ) {
		printf(
			'<li class="property-specs__item"><span class="property-specs__label">%s</span> %s</li>',
			esc_html__( 'Area (sqft)', 'estatein' ),
			esc_html( number_format_i18n( (float) $specs['area'] ) )
		);
	}
	echo '</ul>';
}

/**
 * Render a reusable section header (eyebrow + title + intro).
 *
 * @param array $args { title, eyebrow, intro }.
 */
function estatein_section_header( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'eyebrow' => '',
			'title'   => '',
			'intro'   => '',
			'align'   => 'left',
			'action'  => array(),
		)
	);
	get_template_part(
		'template-parts/components/section-header',
		null,
		$args
	);
}

/**
 * Accessible "read more" label including the post title for screen readers.
 */
function estatein_read_more_label( $text = '' ) {
	$text = $text ?: __( 'Learn more', 'estatein' );
	return sprintf(
		'%s <span class="screen-reader-text">%s</span>',
		esc_html( $text ),
		esc_html( get_the_title() )
	);
}

/**
 * Render a Contact Form 7 form by title, with the theme's form class applied.
 *
 * Keeps templates decoupled from CF7 post IDs and degrades gracefully: if CF7
 * is inactive or the form is missing, an empty string is returned so the page
 * still renders. The form markup is authored in the CF7 admin to mirror the
 * Figma layout, so the client can edit fields/recipients without code.
 *
 * @param string $title      CF7 form title (e.g. "Let's Connect").
 * @param string $html_class Extra class added to the <form> (e.g. "enquiry-form").
 * @return string Shortcode output, or '' when unavailable.
 */
function estatein_cf7_form( $title, $html_class = 'enquiry-form' ) {
	if ( ! shortcode_exists( 'contact-form-7' ) ) {
		return '';
	}
	$forms = get_posts(
		array(
			'post_type'        => 'wpcf7_contact_form',
			'title'            => $title,
			'posts_per_page'   => 1,
			'fields'           => 'ids',
			'suppress_filters' => false,
		)
	);
	if ( empty( $forms ) ) {
		return '';
	}
	return do_shortcode(
		sprintf( '[contact-form-7 id="%d" html_class="%s"]', (int) $forms[0], esc_attr( $html_class ) )
	);
}
