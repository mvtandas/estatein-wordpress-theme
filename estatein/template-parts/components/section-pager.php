<?php
/**
 * Section pager ("01 of N" + prev/next) shown under the home card rows.
 *
 * Mirrors the Estatein Figma pager (75:596): a full-width top border, the
 * current/total count on the left and two circular arrow buttons on the right.
 *
 * @package Estatein
 * @var array $args { total:int, url:string }
 */

defined( 'ABSPATH' ) || exit;

$total = isset( $args['total'] ) ? (int) $args['total'] : 0;
$url   = $args['url'] ?? '#';
?>
<div class="section-pager">
	<span class="section-pager__count"><strong>01</strong> <?php echo esc_html_x( 'of', 'pagination', 'estatein' ); ?> <?php echo esc_html( str_pad( (string) max( 1, $total ), 2, '0', STR_PAD_LEFT ) ); ?></span>
	<div class="section-pager__btns">
		<span class="section-pager__btn" aria-hidden="true">&#8592;</span>
		<a class="section-pager__btn section-pager__btn--active" href="<?php echo esc_url( $url ); ?>" aria-label="<?php esc_attr_e( 'See more', 'estatein' ); ?>">&#8594;</a>
	</div>
</div>
