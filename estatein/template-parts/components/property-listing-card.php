<?php
/**
 * Property listing card (Properties archive) — Figma 97:8536.
 * Image, category tag pill, title, excerpt + Read More, price + CTA.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

$price = estatein_field( 'price' );
$types = get_the_terms( get_the_ID(), 'property_type' );
$tag   = ( $types && ! is_wp_error( $types ) ) ? $types[0]->name : __( 'Featured', 'estatein' );
// Fallback photo so cards without a featured image never render empty.
$fallback = get_theme_file_uri( 'assets/img/photos/property-' . ( ( get_the_ID() % 3 ) + 1 ) . '.webp' );
?>
<article <?php post_class( 'property-card listing-card' ); ?>>
	<a class="property-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'estatein-property-card', array( 'loading' => 'lazy', 'alt' => get_the_title(), 'class' => 'property-card__img' ) ); ?>
		<?php else : ?>
			<img class="property-card__img" src="<?php echo esc_url( $fallback ); ?>" alt="" loading="lazy">
		<?php endif; ?>
	</a>
	<div class="property-card__body">
		<div class="listing-card__head">
			<span class="listing-card__tag"><?php echo esc_html( $tag ); ?></span>
			<div class="property-card__text">
				<h3 class="property-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="property-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 14 ) ); ?> <a class="property-card__readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'estatein' ); ?></a></p>
			</div>
		</div>
		<div class="property-card__footer">
			<?php if ( $price ) : ?>
				<p class="property-card__price">
					<span class="property-card__price-label"><?php esc_html_e( 'Price', 'estatein' ); ?></span>
					<span class="property-card__price-value"><?php echo esc_html( estatein_format_price( $price ) ); ?></span>
				</p>
			<?php endif; ?>
			<a class="btn btn--primary property-card__cta" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Property Details', 'estatein' ); ?></a>
		</div>
	</div>
</article>
