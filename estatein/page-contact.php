<?php
/**
 * Template Name: Contact
 *
 * Contact page — pixel-built from the Estatein Figma "Contact Page" (104:12305).
 *
 * Get in Touch hero + contact strip · Let's Connect form · Discover Our Office
 * Locations · Explore Estatein's World gallery · CTA.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

get_header();

$deco    = get_theme_file_uri( 'assets/img/icons/deco-sparkle.svg' );
$phone   = estatein_field( 'contact_phone', 'option', '+1 (123) 456-7890' );
$email   = estatein_field( 'contact_email', 'option', 'info@estatein.com' );
$logo    = get_theme_file_uri( 'assets/img/logo-symbol.svg' );

$ic_mail  = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>';
$ic_phone = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.6 10.8a15 15 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.24 11 11 0 0 0 3.4.55 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11 11 0 0 0 .55 3.4 1 1 0 0 1-.25 1z"/></svg>';
$ic_pin   = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="9" r="2.5"/></svg>';

// Gallery collage images (reuse available team/office/interior photos).
$g = function ( $f ) { return get_theme_file_uri( 'assets/img/' . $f ); };
?>

<!-- Get in Touch hero -->
<section class="svc-hero">
	<div class="container">
		<h1 class="svc-hero__title"><?php esc_html_e( 'Get in Touch with Estatein', 'estatein' ); ?></h1>
		<p class="svc-hero__intro"><?php esc_html_e( "Welcome to Estatein's Contact Us page. We're here to assist you with any inquiries, requests, or feedback you may have. Whether you're looking to buy or sell a property, explore investment opportunities, or simply want to connect, we're just a message away. Reach out to us, and let's start a conversation.", 'estatein' ); ?></p>
	</div>
</section>

<!-- Contact strip -->
<section class="feature-strip">
	<div class="feature-strip__inner">
		<a class="feature-card" href="mailto:<?php echo esc_attr( $email ); ?>">
			<span class="feature-card__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17 L17 7 M8 7 H17 V16"/></svg></span>
			<span class="feature-card__icon feature-card__icon--svg"><?php echo $ic_mail; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			<span class="feature-card__title"><?php echo esc_html( $email ); ?></span>
		</a>
		<a class="feature-card" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>">
			<span class="feature-card__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17 L17 7 M8 7 H17 V16"/></svg></span>
			<span class="feature-card__icon feature-card__icon--svg"><?php echo $ic_phone; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			<span class="feature-card__title"><?php echo esc_html( $phone ); ?></span>
		</a>
		<a class="feature-card" href="#office-locations">
			<span class="feature-card__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17 L17 7 M8 7 H17 V16"/></svg></span>
			<span class="feature-card__icon feature-card__icon--svg"><?php echo $ic_pin; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			<span class="feature-card__title"><?php esc_html_e( 'Main Headquarters', 'estatein' ); ?></span>
		</a>
		<div class="feature-card feature-card--social">
			<span class="feature-card__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17 L17 7 M8 7 H17 V16"/></svg></span>
			<span class="feature-card__icon"><img src="<?php echo esc_url( $logo ); ?>" alt="" aria-hidden="true"></span>
			<span class="feature-card__title feature-card__socials">
				<a href="#">Instagram</a> <a href="#">LinkedIn</a> <a href="#">Facebook</a>
			</span>
		</div>
	</div>
</section>

<!-- Let's Connect -->
<section class="section">
	<div class="container">
		<div class="section-header">
			<div class="section-header__main">
				<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
				<h2 class="section-header__title"><?php esc_html_e( "Let's Connect", 'estatein' ); ?></h2>
				<p class="section-header__intro"><?php esc_html_e( "We're excited to connect with you and learn more about your real estate goals. Use the form below to get in touch with Estatein. Whether you're a prospective client, partner, or simply curious about our services, we're here to answer your questions and provide the assistance you need.", 'estatein' ); ?></p>
			</div>
		</div>

		<?php
		// Live form via Contact Form 7 (editable in the admin); static fallback if CF7 is unavailable.
		$estatein_cf7 = estatein_cf7_form( "Let's Connect", 'enquiry-form' );
		if ( $estatein_cf7 ) {
			echo $estatein_cf7; // phpcs:ignore WordPress.Security.EscapeOutput — CF7 shortcode output.
		} else {
			?>
			<form class="enquiry-form" method="post" action="#">
				<div class="enquiry-form__grid enquiry-form__grid--3">
					<label class="field"><span class="field__label"><?php esc_html_e( 'First Name', 'estatein' ); ?></span><input type="text" placeholder="<?php esc_attr_e( 'Enter First Name', 'estatein' ); ?>"></label>
					<label class="field"><span class="field__label"><?php esc_html_e( 'Last Name', 'estatein' ); ?></span><input type="text" placeholder="<?php esc_attr_e( 'Enter Last Name', 'estatein' ); ?>"></label>
					<label class="field"><span class="field__label"><?php esc_html_e( 'Email', 'estatein' ); ?></span><input type="email" placeholder="<?php esc_attr_e( 'Enter your Email', 'estatein' ); ?>"></label>
					<label class="field"><span class="field__label"><?php esc_html_e( 'Phone', 'estatein' ); ?></span><input type="tel" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'estatein' ); ?>"></label>
					<label class="field"><span class="field__label"><?php esc_html_e( 'Inquiry Type', 'estatein' ); ?></span><select><option><?php esc_html_e( 'Select Inquiry Type', 'estatein' ); ?></option></select></label>
					<label class="field"><span class="field__label"><?php esc_html_e( 'How Did You Hear About Us?', 'estatein' ); ?></span><select><option><?php esc_html_e( 'Select', 'estatein' ); ?></option></select></label>
					<label class="field field--full"><span class="field__label"><?php esc_html_e( 'Message', 'estatein' ); ?></span><textarea rows="3" placeholder="<?php esc_attr_e( 'Enter your Message here..', 'estatein' ); ?>"></textarea></label>
				</div>
				<div class="enquiry-form__foot">
					<label class="enquiry-form__agree"><input type="checkbox"> <span><?php esc_html_e( 'I agree with', 'estatein' ); ?> <a href="#"><?php esc_html_e( 'Terms of Use', 'estatein' ); ?></a> <?php esc_html_e( 'and', 'estatein' ); ?> <a href="#"><?php esc_html_e( 'Privacy Policy', 'estatein' ); ?></a></span></label>
					<button class="btn btn--primary" type="submit"><?php esc_html_e( 'Send Your Message', 'estatein' ); ?></button>
				</div>
			</form>
			<?php
		}
		?>
	</div>
</section>

<!-- Discover Our Office Locations -->
<section class="section" id="office-locations">
	<div class="container">
		<div class="section-header">
			<div class="section-header__main">
				<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
				<h2 class="section-header__title"><?php esc_html_e( 'Discover Our Office Locations', 'estatein' ); ?></h2>
				<p class="section-header__intro"><?php esc_html_e( "Estatein is here to serve you across multiple locations. Whether you're looking to meet our team, discuss real estate opportunities, or simply drop by for a chat, we have offices conveniently located to serve your needs. Explore the categories below to find the Estatein office nearest to you", 'estatein' ); ?></p>
			</div>
		</div>

		<div class="office-tabs" role="tablist">
			<button class="office-tab is-active" type="button"><?php esc_html_e( 'All', 'estatein' ); ?></button>
			<button class="office-tab" type="button"><?php esc_html_e( 'Regional', 'estatein' ); ?></button>
			<button class="office-tab" type="button"><?php esc_html_e( 'International', 'estatein' ); ?></button>
		</div>

		<div class="office-grid">
			<?php
			$offices = array(
				array(
					'label' => __( 'Main Headquarters', 'estatein' ),
					'title' => __( '123 Estatein Plaza, City Center, Metropolis', 'estatein' ),
					'text'  => __( 'Our main headquarters serve as the heart of Estatein. Located in the bustling city center, this is where our core team of experts operates, driving the excellence and innovation that define us.', 'estatein' ),
					'email' => 'info@estatein.com',
					'phone' => '+1 (123) 456-7890',
					'city'  => __( 'Metropolis', 'estatein' ),
				),
				array(
					'label' => __( 'Regional Offices', 'estatein' ),
					'title' => __( '456 Urban Avenue, Downtown District, Metropolis', 'estatein' ),
					'text'  => __( "Estatein's presence extends to multiple regions, each with its own dynamic real estate landscape. Discover our regional offices, staffed by local experts who understand the nuances of their respective markets.", 'estatein' ),
					'email' => 'info@restatein.com',
					'phone' => '+1 (123) 628-7890',
					'city'  => __( 'Metropolis', 'estatein' ),
				),
			);
			foreach ( $offices as $o ) :
				?>
				<article class="office-card">
					<span class="office-card__label"><?php echo esc_html( $o['label'] ); ?></span>
					<h3 class="office-card__title"><?php echo esc_html( $o['title'] ); ?></h3>
					<p class="office-card__text"><?php echo esc_html( $o['text'] ); ?></p>
					<div class="office-card__chips">
						<span class="office-chip"><span class="office-chip__icon"><?php echo $ic_mail; // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php echo esc_html( $o['email'] ); ?></span>
						<span class="office-chip"><span class="office-chip__icon"><?php echo $ic_phone; // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php echo esc_html( $o['phone'] ); ?></span>
						<span class="office-chip"><span class="office-chip__icon"><?php echo $ic_pin; // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php echo esc_html( $o['city'] ); ?></span>
					</div>
					<a class="btn btn--primary office-card__btn" href="#"><?php esc_html_e( 'Get Direction', 'estatein' ); ?></a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Explore Estatein's World -->
<section class="section">
	<div class="container">
		<div class="world-gallery">
			<div class="world-gallery__col">
				<figure class="world-cell"><img src="<?php echo esc_url( $g( 'world/w1.webp' ) ); ?>" alt="" loading="lazy"></figure>
				<figure class="world-cell"><img src="<?php echo esc_url( $g( 'world/w2.webp' ) ); ?>" alt="" loading="lazy"></figure>
				<div class="world-intro">
					<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
					<h2 class="section-header__title"><?php esc_html_e( "Explore Estatein's World", 'estatein' ); ?></h2>
					<p class="section-header__intro"><?php esc_html_e( 'Step inside the world of Estatein, where professionalism meets warmth, and expertise meets passion. Our gallery offers a glimpse into our team and workspaces, inviting you to get to know us better.', 'estatein' ); ?></p>
				</div>
			</div>
			<div class="world-gallery__col">
				<figure class="world-cell"><img src="<?php echo esc_url( $g( 'world/w3.webp' ) ); ?>" alt="" loading="lazy"></figure>
				<div class="world-gallery__pair">
					<figure class="world-cell"><img src="<?php echo esc_url( $g( 'world/w4.webp' ) ); ?>" alt="" loading="lazy"></figure>
					<figure class="world-cell"><img src="<?php echo esc_url( $g( 'world/w5.webp' ) ); ?>" alt="" loading="lazy"></figure>
				</div>
				<figure class="world-cell world-cell--tall"><img src="<?php echo esc_url( $g( 'world/w6.webp' ) ); ?>" alt="" loading="lazy"></figure>
			</div>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/components/cta-banner', null, array() );
get_footer();
