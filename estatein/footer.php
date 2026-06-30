<?php
/**
 * Site footer (Figma 89:3943): branding + email capture, five link columns,
 * and a bottom bar with copyright, terms and social buttons.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

$year = date_i18n( 'Y' );

// Footer link columns — labels match the Estatein Figma footer.
$columns = array(
	__( 'Home', 'estatein' )       => array( __( 'Hero Section', 'estatein' ), __( 'Features', 'estatein' ), __( 'Properties', 'estatein' ), __( 'Testimonials', 'estatein' ), __( "FAQ's", 'estatein' ) ),
	__( 'About Us', 'estatein' )   => array( __( 'Our Story', 'estatein' ), __( 'Our Works', 'estatein' ), __( 'How It Works', 'estatein' ), __( 'Our Team', 'estatein' ), __( 'Our Clients', 'estatein' ) ),
	__( 'Properties', 'estatein' ) => array( __( 'Portfolio', 'estatein' ), __( 'Categories', 'estatein' ) ),
	__( 'Services', 'estatein' )   => array( __( 'Valuation Mastery', 'estatein' ), __( 'Strategic Marketing', 'estatein' ), __( 'Negotiation Wizardry', 'estatein' ), __( 'Closing Success', 'estatein' ), __( 'Property Management', 'estatein' ) ),
	__( 'Contact Us', 'estatein' ) => array( __( 'Contact Form', 'estatein' ), __( 'Our Offices', 'estatein' ) ),
);

$socials = array(
	array( 'icon' => 'social-facebook.svg', 'label' => 'Facebook' ),
	array( 'icon' => 'social-linkedin.svg', 'label' => 'LinkedIn' ),
	array( 'icon' => 'social-twitter.svg', 'label' => 'Twitter' ),
	array( 'icon' => 'social-youtube.svg', 'label' => 'YouTube' ),
);
?>
</main><!-- #main -->

<footer class="site-footer" role="contentinfo">
	<div class="site-footer__top">
		<div class="site-footer__brand">
			<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="site-logo__mark" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/logo-symbol.svg' ) ); ?>" alt="" aria-hidden="true" width="40" height="40">
				<span class="site-logo__text"><?php bloginfo( 'name' ); ?></span>
			</a>
			<form class="newsletter" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" aria-label="<?php esc_attr_e( 'Newsletter signup', 'estatein' ); ?>">
				<span class="newsletter__icon" aria-hidden="true"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/icons/mail.svg' ) ); ?>" alt=""></span>
				<label class="screen-reader-text" for="newsletter-email"><?php esc_html_e( 'Email address', 'estatein' ); ?></label>
				<input id="newsletter-email" class="newsletter__input" type="email" name="email" placeholder="<?php esc_attr_e( 'Enter Your Email', 'estatein' ); ?>" required>
				<button class="newsletter__submit" type="submit" aria-label="<?php esc_attr_e( 'Subscribe', 'estatein' ); ?>">
					<img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/icons/send.svg' ) ); ?>" alt="" aria-hidden="true">
				</button>
			</form>
		</div>

		<nav class="site-footer__cols" aria-label="<?php esc_attr_e( 'Footer', 'estatein' ); ?>">
			<?php foreach ( $columns as $heading => $links ) : ?>
				<div class="footer-col">
					<p class="footer-col__title"><?php echo esc_html( $heading ); ?></p>
					<ul class="footer-col__links" role="list">
						<?php foreach ( $links as $link ) : ?>
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $link ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</nav>
	</div>

	<div class="site-footer__bottom">
		<div class="site-footer__legal">
			<span>&copy;<?php echo esc_html( $year ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All Rights Reserved.', 'estatein' ); ?></span>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Terms &amp; Conditions', 'estatein' ); ?></a>
		</div>
		<ul class="social-links" role="list" aria-label="<?php esc_attr_e( 'Social media', 'estatein' ); ?>">
			<?php foreach ( $socials as $social ) : ?>
				<li>
					<a class="social-links__btn" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( $social['label'] ); ?>" rel="noopener">
						<img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/icons/' . $social['icon'] ) ); ?>" alt="" aria-hidden="true">
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
