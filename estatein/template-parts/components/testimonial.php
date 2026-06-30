<?php
/**
 * Testimonial card (home slider).
 *
 * Mirrors the Estatein Figma testimonial card (75:870): a row of star badges,
 * a bold headline, the quote, then avatar + name + location.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

$rating   = (int) estatein_field( 'rating', null, 5 );
$rating   = max( 0, min( 5, $rating ) );
$headline = estatein_field( 'testimonial_headline' );
$location = estatein_field( 'author_role' );

$star = '<svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.9 6.26L21.6 9l-5 4.6L18 21l-6-3.4L6 21l1.4-7.4-5-4.6 6.7-.74z"/></svg>';
?>
<article <?php post_class( 'testimonial' ); ?>>
	<div class="testimonial__rating" role="img" aria-label="<?php echo esc_attr( sprintf( _n( '%d out of 5 stars', '%d out of 5 stars', $rating, 'estatein' ), $rating ) ); ?>">
		<?php for ( $i = 0; $i < $rating; $i++ ) : ?>
			<span class="testimonial__star-badge"><?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<?php endfor; ?>
	</div>

	<?php if ( $headline ) : ?>
		<h3 class="testimonial__title"><?php echo esc_html( $headline ); ?></h3>
	<?php endif; ?>

	<blockquote class="testimonial__quote"><?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?></blockquote>

	<footer class="testimonial__author">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'estatein-avatar', array( 'class' => 'testimonial__avatar', 'loading' => 'lazy', 'alt' => get_the_title() ) ); ?>
		<?php endif; ?>
		<div>
			<p class="testimonial__name"><?php the_title(); ?></p>
			<?php if ( $location ) : ?>
				<p class="testimonial__role"><?php echo esc_html( $location ); ?></p>
			<?php endif; ?>
		</div>
	</footer>
</article>
