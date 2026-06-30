<?php
/**
 * CTA band — full-width call-to-action near the foot of most pages.
 *
 * Mirrors the Estatein Figma CTA (181:2): a full-bleed Grey/08 band bordered
 * top and bottom, heading + lede on the left, a purple button on the right.
 *
 * @package Estatein
 * @var array $args { title, text, button_label, button_url }
 */

defined( 'ABSPATH' ) || exit;

$title = $args['title'] ?? __( 'Start Your Real Estate Journey Today', 'estatein' );
$text  = $args['text'] ?? __( "Your dream property is just a click away. Whether you're looking for a new home, a strategic investment, or expert advice, Estatein is here to assist you every step of the way.", 'estatein' );
$label = $args['button_label'] ?? __( 'Explore Properties', 'estatein' );
$url   = $args['button_url'] ?? home_url( '/properties/' );
?>
<section class="cta-banner">
	<img class="cta-banner__skyline cta-banner__skyline--left" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/icons/cta-skyline-left.svg' ) ); ?>" alt="" aria-hidden="true">
	<img class="cta-banner__skyline cta-banner__skyline--right" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/icons/cta-skyline-right.svg' ) ); ?>" alt="" aria-hidden="true">
	<div class="cta-banner__inner">
		<div class="cta-banner__text">
			<h2 class="cta-banner__title"><?php echo esc_html( $title ); ?></h2>
			<p class="cta-banner__lede"><?php echo esc_html( $text ); ?></p>
		</div>
		<a class="btn btn--primary" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a>
	</div>
</section>
