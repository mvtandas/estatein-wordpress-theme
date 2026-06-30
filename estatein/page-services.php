<?php
/**
 * Template Name: Services
 *
 * Services page — pixel-built from the Estatein Figma "Services Page" (104:10350).
 *
 * Elevate hero + feature strip · Unlock Property Value · Effortless Property
 * Management · Smart Investments, Informed Decisions · CTA.
 *
 * Curated marketing landing (fixed copy, grouped categories) authored here.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

get_header();

$deco = get_theme_file_uri( 'assets/img/icons/deco-sparkle.svg' );

// Inline purple glyphs keyed by service name.
$ic = array(
	'bars'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M5 20V11M12 20V4M19 20v-6"/></svg>',
	'pie'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3a9 9 0 1 0 9 9h-9z"/><path d="M12 3v9h9A9 9 0 0 0 12 3z" opacity=".4" fill="currentColor" stroke="none"/></svg>',
	'coins'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><ellipse cx="12" cy="6" rx="7" ry="3"/><path d="M5 6v6c0 1.7 3.1 3 7 3s7-1.3 7-3V6M5 12v6c0 1.7 3.1 3 7 3s7-1.3 7-3v-6"/></svg>',
	'chat'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h16v11H8l-4 4z"/><path d="M9 10.5l2 2 4-4"/></svg>',
	'people'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="8" cy="9" r="3"/><circle cx="17" cy="10" r="2.3"/><path d="M3 19a5 5 0 0 1 10 0M14 19a4 4 0 0 1 7-2.6"/></svg>',
	'wrench'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 6.5a3.5 3.5 0 0 0 4.5 4.5L21 13l-8 8-2-2 1.9-1.9a3.5 3.5 0 0 1-4.5-4.5L4 10l2-2 4 4 .5-.5L6 7l2-2z"/></svg>',
	'finance' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 16l5-5 3 3 7-7M14 4h6v6"/></svg>',
	'shield'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"><path d="M12 3l7 3v5c0 4.4-3 7.7-7 9-4-1.3-7-4.6-7-9V6z"/><path d="M9.5 12l1.8 1.8 3.4-3.6"/></svg>',
	'refresh' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 12a8 8 0 1 1-2.3-5.6M20 4v4h-4"/></svg>',
	'target'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="4"/><circle cx="12" cy="12" r="1" fill="currentColor"/></svg>',
	'spark'   => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l1.8 6.2L20 10l-6.2 1.8L12 18l-1.8-6.2L4 10l6.2-1.8z"/></svg>',
);

// Hero feature strip — reuses the home component's markup/styles.
$strip = array(
	array( 'feature-1.svg', __( 'Find Your Dream Home', 'estatein' ), home_url( '/properties/' ) ),
	array( 'feature-2.svg', __( 'Unlock Property Value', 'estatein' ), '#unlock-value' ),
	array( 'feature-3.svg', __( 'Effortless Property Management', 'estatein' ), '#management' ),
	array( 'feature-4.svg', __( 'Smart Investments, Informed Decisions', 'estatein' ), '#investments' ),
);

$selling = array(
	array( $ic['bars'], __( 'Valuation Mastery', 'estatein' ), __( 'Discover the true worth of your property with our expert valuation services.', 'estatein' ) ),
	array( $ic['pie'], __( 'Strategic Marketing', 'estatein' ), __( 'Selling a property requires more than just a listing; it demands a strategic marketing.', 'estatein' ) ),
	array( $ic['coins'], __( 'Negotiation Wizardry', 'estatein' ), __( 'Negotiating the best deal is an art, and our negotiation experts are masters of it.', 'estatein' ) ),
	array( $ic['chat'], __( 'Closing Success', 'estatein' ), __( 'A successful sale is not complete until the closing. We guide you through the intricate closing process.', 'estatein' ) ),
);
$management = array(
	array( $ic['people'], __( 'Tenant Harmony', 'estatein' ), __( 'Our Tenant Management services ensure that your tenants have a smooth and reducing vacancies.', 'estatein' ) ),
	array( $ic['wrench'], __( 'Maintenance Ease', 'estatein' ), __( 'Say goodbye to property maintenance headaches. We handle all aspects of property upkeep.', 'estatein' ) ),
	array( $ic['finance'], __( 'Financial Peace of Mind', 'estatein' ), __( 'Managing property finances can be complex. Our financial experts take care of rent collection.', 'estatein' ) ),
	array( $ic['shield'], __( 'Legal Guardian', 'estatein' ), __( 'Stay compliant with property laws and regulations effortlessly.', 'estatein' ) ),
);
$investing = array(
	array( $ic['bars'], __( 'Market Insight', 'estatein' ), __( 'Stay ahead of market trends with our expert Market Analysis. We provide in-depth insights into real estate market conditions.', 'estatein' ) ),
	array( $ic['refresh'], __( 'ROI Assessment', 'estatein' ), __( 'Make investment decisions with confidence. Our ROI Assessment services evaluate the potential returns on your investments.', 'estatein' ) ),
	array( $ic['target'], __( 'Customized Strategies', 'estatein' ), __( 'Every investor is unique, and so are their goals. We develop Customized Investment Strategies tailored to your specific needs.', 'estatein' ) ),
	array( $ic['spark'], __( 'Diversification Mastery', 'estatein' ), __( 'Diversify your real estate portfolio effectively. Our experts guide you in spreading your investments across various property types and locations.', 'estatein' ) ),
);

/**
 * Render one service category card (icon + title inline, description below).
 */
function estatein_svc_card( $card ) {
	?>
	<article class="svc-card">
		<header class="svc-card__head">
			<span class="svc-card__icon"><?php echo $card[0]; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			<h3 class="svc-card__title"><?php echo esc_html( $card[1] ); ?></h3>
		</header>
		<p class="svc-card__text"><?php echo esc_html( $card[2] ); ?></p>
	</article>
	<?php
}
?>

<!-- Hero: Elevate Your Real Estate Experience -->
<section class="svc-hero">
	<div class="container">
		<h1 class="svc-hero__title"><?php esc_html_e( 'Elevate Your Real Estate Experience', 'estatein' ); ?></h1>
		<p class="svc-hero__intro"><?php esc_html_e( 'Welcome to Estatein, where your real estate aspirations meet expert guidance. Explore our comprehensive range of services, each designed to cater to your unique needs and dreams.', 'estatein' ); ?></p>
	</div>
</section>

<!-- Feature strip (Figma 121:1890) -->
<section class="feature-strip">
	<div class="feature-strip__inner">
		<?php foreach ( $strip as $f ) : ?>
			<a class="feature-card" href="<?php echo esc_url( $f[2] ); ?>">
				<span class="feature-card__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17 L17 7 M8 7 H17 V16"/></svg></span>
				<span class="feature-card__icon"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/icons/' . $f[0] ) ); ?>" alt="" aria-hidden="true"></span>
				<span class="feature-card__title"><?php echo esc_html( $f[1] ); ?></span>
			</a>
		<?php endforeach; ?>
	</div>
</section>

<!-- Unlock Property Value -->
<section class="section" id="unlock-value">
	<div class="container">
		<div class="section-header">
			<div class="section-header__main">
				<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
				<h2 class="section-header__title"><?php esc_html_e( 'Unlock Property Value', 'estatein' ); ?></h2>
				<p class="section-header__intro"><?php esc_html_e( 'Selling your property should be a rewarding experience, and at Estatein, we make sure it is. Our Property Selling Service is designed to maximize the value of your property, ensuring you get the best deal possible. Explore the categories below to see how we can help you at every step of your selling journey', 'estatein' ); ?></p>
			</div>
		</div>
		<div class="svc-grid">
			<?php foreach ( $selling as $card ) { estatein_svc_card( $card ); } ?>
			<div class="svc-cta">
				<div class="svc-cta__text">
					<h3 class="svc-cta__title"><?php esc_html_e( 'Unlock the Value of Your Property Today', 'estatein' ); ?></h3>
					<p class="svc-cta__lede"><?php esc_html_e( 'Ready to unlock the true value of your property? Explore our Property Selling Service categories and let us help you achieve the best deal possible for your valuable asset.', 'estatein' ); ?></p>
				</div>
				<a class="btn btn--secondary svc-cta__btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein' ); ?></a>
			</div>
		</div>
	</div>
</section>

<!-- Effortless Property Management -->
<section class="section" id="management">
	<div class="container">
		<div class="section-header">
			<div class="section-header__main">
				<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
				<h2 class="section-header__title"><?php esc_html_e( 'Effortless Property Management', 'estatein' ); ?></h2>
				<p class="section-header__intro"><?php esc_html_e( 'Owning a property should be a pleasure, not a hassle. Estatein\'s Property Management Service takes the stress out of property ownership, offering comprehensive solutions tailored to your needs. Explore the categories below to see how we can make property management effortless for you', 'estatein' ); ?></p>
			</div>
		</div>
		<div class="svc-grid">
			<?php foreach ( $management as $card ) { estatein_svc_card( $card ); } ?>
			<div class="svc-cta">
				<div class="svc-cta__text">
					<h3 class="svc-cta__title"><?php esc_html_e( 'Experience Effortless Property Management', 'estatein' ); ?></h3>
					<p class="svc-cta__lede"><?php esc_html_e( 'Ready to experience hassle-free property management? Explore our Property Management Service categories and let us handle the complexities while you enjoy the benefits of property ownership.', 'estatein' ); ?></p>
				</div>
				<a class="btn btn--secondary svc-cta__btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein' ); ?></a>
			</div>
		</div>
	</div>
</section>

<!-- Smart Investments, Informed Decisions -->
<section class="section" id="investments">
	<div class="container">
		<div class="svc-invest">
			<div class="svc-invest__aside">
				<div class="section-header__main">
					<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
					<h2 class="section-header__title"><?php esc_html_e( 'Smart Investments, Informed Decisions', 'estatein' ); ?></h2>
					<p class="section-header__intro"><?php esc_html_e( 'Building a real estate portfolio requires a strategic approach. Estatein\'s Investment Advisory Service empowers you to make smart investments and informed decisions.', 'estatein' ); ?></p>
				</div>
				<div class="svc-cta svc-cta--stack">
					<div class="svc-cta__text">
						<h3 class="svc-cta__title"><?php esc_html_e( 'Unlock Your Investment Potential', 'estatein' ); ?></h3>
						<p class="svc-cta__lede"><?php esc_html_e( 'Explore our Property Management Service categories and let us handle the complexities while you enjoy the benefits of property ownership.', 'estatein' ); ?></p>
					</div>
					<a class="btn btn--secondary svc-cta__btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein' ); ?></a>
				</div>
			</div>
			<div class="svc-invest__cards">
				<?php foreach ( $investing as $card ) { estatein_svc_card( $card ); } ?>
			</div>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/components/cta-banner', null, array() );
get_footer();
