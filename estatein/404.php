<?php
/**
 * 404 — page not found.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="section section--center">
	<div class="container container--narrow">
		<p class="error-404__code">404</p>
		<h1 class="error-404__title"><?php esc_html_e( 'Page not found', 'estatein' ); ?></h1>
		<p class="error-404__text"><?php esc_html_e( 'The page you are looking for might have been moved or no longer exists.', 'estatein' ); ?></p>
		<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'estatein' ); ?></a>
	</div>
</section>

<?php
get_footer();
