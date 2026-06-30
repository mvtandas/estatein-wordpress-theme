<?php
/**
 * Blog post card.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class( 'post-card' ); ?>>
	<a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'estatein-property-card', array( 'loading' => 'lazy', 'alt' => get_the_title(), 'class' => 'post-card__img' ) );
		}
		?>
	</a>
	<div class="post-card__body">
		<p class="post-card__meta">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		</p>
		<h3 class="post-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<p class="post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
		<a class="link-arrow" href="<?php the_permalink(); ?>">
			<?php echo wp_kses_post( estatein_read_more_label( __( 'Read more', 'estatein' ) ) ); ?>
		</a>
	</div>
</article>
