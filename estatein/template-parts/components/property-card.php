<?php
/**
 * Property card — home featured grid + property archive.
 *
 * Mirrors the Estatein Figma property card (75:564): inset image, title +
 * excerpt, a row of spec pills (beds/baths/area) and a footer with the price
 * and a purple "View Property Details" button.
 *
 * Expects the global post to be a `property` (call inside the Loop).
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

$price = estatein_field( 'price' );
$beds  = estatein_field( 'bedrooms' );
$baths = estatein_field( 'bathrooms' );

// Property type term (Figma's third pill shows e.g. "Villa").
$types = get_the_terms( get_the_ID(), 'property_type' );
$type  = ( $types && ! is_wp_error( $types ) ) ? $types[0]->name : '';

// Inline pill icons — solid/filled white (matches Figma).
$icon_bed  = '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M20 10V7c0-1.1-.9-2-2-2H6c-1.1 0-2 .9-2 2v3c-1.1 0-2 .9-2 2v5h1.33L4 19h1l.67-2h12.67l.66 2h1l.67-2H22v-5c0-1.1-.9-2-2-2zm-9 0H6V7h5v3zm7 0h-5V7h5v3z"/></svg>';
$icon_bath = '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M7 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm13 1V5.5A2.5 2.5 0 0 0 17.5 3c-.66 0-1.3.26-1.77.73L14.4 5.07a2 2 0 0 0-.6-.07 2 2 0 0 0-1.11.6L8.69 9.2a1 1 0 0 0 .09 1.38c.36.34.92.32 1.27-.03l2.71-2.71.7.7L7 13c-.55 0-1 .45-1 1H4c-1.1 0-2 .9-2 2v1a3 3 0 0 0 2 2.82V21h2v-1h12v1h2v-2.18A3 3 0 0 0 22 16v-1a2 2 0 0 0-2-2h-9.5l2.04-2.04L20 10z"/></svg>';
$icon_type = '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>';
?>
<article <?php post_class( 'property-card' ); ?>>
	<a class="property-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'estatein-property-card', array( 'loading' => 'lazy', 'alt' => get_the_title(), 'class' => 'property-card__img' ) );
		}
		?>
	</a>

	<div class="property-card__body">
		<div class="property-card__text">
			<h3 class="property-card__title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
			<p class="property-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 14 ) ); ?> <a class="property-card__readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'estatein' ); ?></a></p>
		</div>

		<?php if ( $beds || $baths || $type ) : ?>
			<ul class="property-card__pills" role="list">
				<?php if ( $beds ) : ?>
					<li class="pill"><?php echo $icon_bed; // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $beds ); ?>-Bedroom</span></li>
				<?php endif; ?>
				<?php if ( $baths ) : ?>
					<li class="pill"><?php echo $icon_bath; // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $baths ); ?>-Bathroom</span></li>
				<?php endif; ?>
				<?php if ( $type ) : ?>
					<li class="pill"><?php echo $icon_type; // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php echo esc_html( $type ); ?></span></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>

		<div class="property-card__footer">
			<?php if ( $price ) : ?>
				<p class="property-card__price">
					<span class="property-card__price-label"><?php esc_html_e( 'Price', 'estatein' ); ?></span>
					<span class="property-card__price-value"><?php echo esc_html( estatein_format_price( $price ) ); ?></span>
				</p>
			<?php endif; ?>
			<a class="btn btn--primary property-card__cta" href="<?php the_permalink(); ?>">
				<?php echo wp_kses_post( estatein_read_more_label( __( 'View Property Details', 'estatein' ) ) ); ?>
			</a>
		</div>
	</div>
</article>
