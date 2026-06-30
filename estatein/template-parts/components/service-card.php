<?php
/**
 * Service card.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class( 'service-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="service-card__icon">
			<?php the_post_thumbnail( 'estatein-avatar', array( 'loading' => 'lazy', 'alt' => get_the_title() ) ); ?>
		</div>
	<?php endif; ?>
	<h3 class="service-card__title"><?php the_title(); ?></h3>
	<div class="service-card__text"><?php the_excerpt(); ?></div>
	<a class="link-arrow" href="<?php the_permalink(); ?>">
		<?php echo wp_kses_post( estatein_read_more_label( __( 'Learn more', 'estatein' ) ) ); ?>
	</a>
</article>
