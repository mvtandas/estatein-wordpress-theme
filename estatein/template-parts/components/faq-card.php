<?php
/**
 * FAQ card — used in the home "Frequently Asked Questions" 3-up grid.
 *
 * Mirrors the Estatein Figma FAQ cards: question title, a short answer excerpt
 * and a "Read More" button. (The accordion variant — faq-item.php — is used on
 * dedicated FAQ/about pages.)
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;
?>
<article <?php post_class( 'faq-card' ); ?>>
	<h3 class="faq-card__question"><?php the_title(); ?></h3>
	<div class="faq-card__answer"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_content() ), 24 ) ); ?></div>
	<a class="btn btn--secondary faq-card__more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'estatein' ); ?></a>
</article>
