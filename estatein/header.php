<?php
/**
 * Site header: promo banner, branding, primary navigation, mobile toggle.
 *
 * Structure mirrors the Estatein Figma "Header" node (60:3125): a top promo
 * banner (60:3094) above the navigation bar (60:3124).
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'estatein' ); ?></a>

<header class="site-header" id="site-header">
	<!-- Promo banner (Figma 60:3094) -->
	<div class="promo-banner" data-promo>
		<p class="promo-banner__text">
			<span class="promo-banner__sparkle" aria-hidden="true">✨</span>
			<?php esc_html_e( 'Discover Your Dream Property with Estatein', 'estatein' ); ?>
			<a class="promo-banner__link" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein' ); ?></a>
		</p>
		<button class="promo-banner__close" type="button" data-promo-close aria-label="<?php esc_attr_e( 'Dismiss', 'estatein' ); ?>">
			<img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/banner-close.svg' ) ); ?>" alt="" aria-hidden="true">
		</button>
	</div>

	<!-- Navigation bar (Figma 60:3124) -->
	<div class="site-nav-bar">
		<div class="container site-nav-bar__inner">
			<div class="site-header__brand">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img class="site-logo__mark" src="<?php echo esc_url( get_theme_file_uri( 'assets/img/logo-symbol.svg' ) ); ?>" alt="" aria-hidden="true" width="32" height="32">
						<span class="site-logo__text"><?php bloginfo( 'name' ); ?></span>
					</a>
				<?php endif; ?>
			</div>

			<button class="nav-toggle" aria-expanded="false" aria-controls="primary-menu">
				<span class="nav-toggle__bars" aria-hidden="true"></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'estatein' ); ?></span>
			</button>

			<nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary', 'estatein' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'site-nav__menu',
						'container'      => false,
						'fallback_cb'    => false,
						'depth'          => 2,
					)
				);
				?>
			</nav>

			<div class="site-header__cta">
				<a class="btn btn--secondary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
					<?php esc_html_e( 'Contact Us', 'estatein' ); ?>
				</a>
			</div>
		</div>
	</div>
</header>

<main id="main" class="site-main" tabindex="-1">
