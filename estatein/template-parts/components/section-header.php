<?php
/**
 * Reusable section header: eyebrow + title + intro, with an optional
 * right-aligned action button (Figma puts "View All …" top-right of each section).
 *
 * @package Estatein
 * @var array $args { eyebrow, title, intro, align, action:{label,url} }
 */

defined( 'ABSPATH' ) || exit;

$eyebrow = $args['eyebrow'] ?? '';
$title   = $args['title'] ?? '';
$intro   = $args['intro'] ?? '';
$align   = $args['align'] ?? 'left';
$action  = $args['action'] ?? array();
?>
<div class="section-header section-header--<?php echo esc_attr( $align ); ?><?php echo ! empty( $action ) ? ' section-header--has-action' : ''; ?>">
	<div class="section-header__main">
		<img class="section-header__deco" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/icons/deco-sparkle.svg' ) ); ?>" alt="" aria-hidden="true" width="52" height="30">
		<?php if ( $eyebrow ) : ?>
			<p class="section-header__eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<?php endif; ?>
		<?php if ( $title ) : ?>
			<h2 class="section-header__title"><?php echo wp_kses_post( $title ); ?></h2>
		<?php endif; ?>
		<?php if ( $intro ) : ?>
			<p class="section-header__intro"><?php echo esc_html( $intro ); ?></p>
		<?php endif; ?>
	</div>
	<?php if ( ! empty( $action ) && ! empty( $action['label'] ) ) : ?>
		<a class="btn btn--secondary section-header__action" href="<?php echo esc_url( $action['url'] ?? '#' ); ?>">
			<?php echo esc_html( $action['label'] ); ?>
		</a>
	<?php endif; ?>
</div>
