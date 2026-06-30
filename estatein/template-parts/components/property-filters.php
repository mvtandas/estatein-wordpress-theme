<?php
/**
 * Property archive filters — GET form posting back to the archive. Progressive
 * enhancement: works without JS; filters.js can refine the UX.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

$types     = get_terms( array( 'taxonomy' => 'property_type', 'hide_empty' => false ) );
$locations = get_terms( array( 'taxonomy' => 'property_location', 'hide_empty' => false ) );
$archive   = get_post_type_archive_link( 'property' );
?>
<form class="property-filters" action="<?php echo esc_url( $archive ); ?>" method="get" data-filters>
	<?php if ( ! is_wp_error( $locations ) && $locations ) : ?>
		<label class="property-filters__field">
			<span class="property-filters__label"><?php esc_html_e( 'Location', 'estatein' ); ?></span>
			<select name="property_location">
				<option value=""><?php esc_html_e( 'All locations', 'estatein' ); ?></option>
				<?php foreach ( $locations as $term ) : ?>
					<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( get_query_var( 'property_location' ), $term->slug ); ?>><?php echo esc_html( $term->name ); ?></option>
				<?php endforeach; ?>
			</select>
		</label>
	<?php endif; ?>

	<?php if ( ! is_wp_error( $types ) && $types ) : ?>
		<label class="property-filters__field">
			<span class="property-filters__label"><?php esc_html_e( 'Property type', 'estatein' ); ?></span>
			<select name="property_type">
				<option value=""><?php esc_html_e( 'All types', 'estatein' ); ?></option>
				<?php foreach ( $types as $term ) : ?>
					<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( get_query_var( 'property_type' ), $term->slug ); ?>><?php echo esc_html( $term->name ); ?></option>
				<?php endforeach; ?>
			</select>
		</label>
	<?php endif; ?>

	<button class="btn btn--primary" type="submit"><?php esc_html_e( 'Search', 'estatein' ); ?></button>
</form>
