<?php
/**
 * Team member card.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

$role     = estatein_field( 'role' );
$email    = estatein_field( 'email' );
$linkedin = estatein_field( 'linkedin' );
?>
<article <?php post_class( 'team-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="team-card__photo">
			<?php the_post_thumbnail( 'estatein-property-card', array( 'loading' => 'lazy', 'alt' => get_the_title() ) ); ?>
		</div>
	<?php endif; ?>
	<h3 class="team-card__name"><?php the_title(); ?></h3>
	<?php if ( $role ) : ?>
		<p class="team-card__role"><?php echo esc_html( $role ); ?></p>
	<?php endif; ?>
	<ul class="team-card__links" role="list">
		<?php if ( $email ) : ?>
			<li><a href="mailto:<?php echo esc_attr( $email ); ?>"><span class="screen-reader-text"><?php the_title(); ?> </span><?php esc_html_e( 'Email', 'estatein' ); ?></a></li>
		<?php endif; ?>
		<?php if ( $linkedin ) : ?>
			<li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
		<?php endif; ?>
	</ul>
</article>
