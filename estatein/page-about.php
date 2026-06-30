<?php
/**
 * Template Name: About
 *
 * About Us page — pixel-built from the Estatein Figma "About Us Page" (89:5151).
 *
 * Sections: Our Journey · Our Values · Our Achievements · Navigating the
 * Estatein Experience · Meet the Estatein Team · Our Valued Clients · CTA.
 * Copy is taken verbatim from Figma; imagery lives in assets/img/about/.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

get_header();

$img  = get_theme_file_uri( 'assets/img/about' );
$deco = get_theme_file_uri( 'assets/img/icons/deco-sparkle.svg' );

$stats = array(
	array( '200+', __( 'Happy Customers', 'estatein' ) ),
	array( '10k+', __( 'Properties For Clients', 'estatein' ) ),
	array( '16+', __( 'Years of Experience', 'estatein' ) ),
);

// Value icons (purple, sit inside a purple-bordered circle).
$ic_trust  = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 1l8 3v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V4l8-3zm-1 14l6-6-1.4-1.4L11 12.2 8.4 9.6 7 11l4 4z"/></svg>';
$ic_excel  = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.9 5.9 6.5.9-4.7 4.6 1.1 6.5L12 17l-5.8 3 1.1-6.5L2.6 8.8l6.5-.9L12 2z"/></svg>';
$ic_client = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 2c-3.3 0-6 1.8-6 4v2h12v-2c0-2.2-2.7-4-6-4zm8.5-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm.5 2c-.6 0-1.2.1-1.7.3 1.3.9 2.2 2.2 2.2 3.7v2H22v-2c0-2.2-2-4-4-4z"/></svg>';
$ic_commit = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.4 7.4H22l-6 4.4 2.3 7.2L12 16.6 5.7 21l2.3-7.2-6-4.4h7.6L12 2z"/></svg>';

$values = array(
	array( $ic_trust,  __( 'Trust', 'estatein' ), __( 'Trust is the cornerstone of every successful real estate transaction.', 'estatein' ) ),
	array( $ic_excel,  __( 'Excellence', 'estatein' ), __( 'We set the bar high for ourselves. From the properties we list to the services we provide.', 'estatein' ) ),
	array( $ic_client, __( 'Client-Centric', 'estatein' ), __( 'Your dreams and needs are at the center of our universe. We listen, understand.', 'estatein' ) ),
	array( $ic_commit, __( 'Our Commitment', 'estatein' ), __( 'We are dedicated to providing you with the highest level of service, professionalism, and support.', 'estatein' ) ),
);

$achievements = array(
	array( __( '3+ Years of Excellence', 'estatein' ), __( "With over 3 years in the industry, we've amassed a wealth of knowledge and experience, becoming a go-to resource for all things real estate.", 'estatein' ) ),
	array( __( 'Happy Clients', 'estatein' ), __( 'Our greatest achievement is the satisfaction of our clients. Their success stories fuel our passion for what we do.', 'estatein' ) ),
	array( __( 'Industry Recognition', 'estatein' ), __( "We've earned the respect of our peers and industry leaders, with accolades and awards that reflect our commitment to excellence.", 'estatein' ) ),
);

$steps = array(
	array( 'Step 01', __( 'Discover a World of Possibilities', 'estatein' ), __( 'Your journey begins with exploring our carefully curated property listings. Use our intuitive search tools to filter properties based on your preferences, including location, type, size, and budget.', 'estatein' ) ),
	array( 'Step 02', __( 'Narrowing Down Your Choices', 'estatein' ), __( "Once you've found properties that catch your eye, save them to your account or make a shortlist. This allows you to compare and revisit your favorites as you make your decision.", 'estatein' ) ),
	array( 'Step 03', __( 'Personalized Guidance', 'estatein' ), __( 'Have questions about a property or need more information? Our dedicated team of real estate experts is just a call or message away.', 'estatein' ) ),
	array( 'Step 04', __( 'See It for Yourself', 'estatein' ), __( "Arrange viewings of the properties you're interested in. We'll coordinate with the property owners and accompany you to ensure you get a firsthand look at your potential new home.", 'estatein' ) ),
	array( 'Step 05', __( 'Making Informed Decisions', 'estatein' ), __( 'Before making an offer, our team will assist you with due diligence, including property inspections, legal checks, and market analysis. We want you to be fully informed and confident in your choice.', 'estatein' ) ),
	array( 'Step 06', __( 'Getting the Best Deal', 'estatein' ), __( "We'll help you negotiate the best terms and prepare your offer. Our goal is to secure the property at the right price and on favorable terms.", 'estatein' ) ),
);

$team = array(
	array( 'team-1', 'Max Mitchell', __( 'Founder', 'estatein' ) ),
	array( 'team-2', 'Sarah Johnson', __( 'Chief Real Estate Officer', 'estatein' ) ),
	array( 'team-3', 'David Brown', __( 'Head of Property Management', 'estatein' ) ),
	array( 'team-4', 'Michael Turner', __( 'Legal Counsel', 'estatein' ) ),
);

$clients = array(
	array( 'since' => 'Since 2019', 'name' => 'ABC Corporation', 'domain' => 'Commercial Real Estate', 'category' => 'Luxury Home Development', 'quote' => "Estatein's expertise in finding the perfect office space for our expanding operations was invaluable. They truly understand our business needs." ),
	array( 'since' => 'Since 2018', 'name' => 'GreenTech Enterprises', 'domain' => 'Commercial Real Estate', 'category' => 'Retail Space', 'quote' => "Estatein's ability to identify prime retail locations helped us expand our brand presence. They are a trusted partner in our growth." ),
);

$icon_globe = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>';
$icon_tag   = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" aria-hidden="true"><path d="M4 13l7-9 3 3-2 4h6l-7 9-3-3 2-4H4z"/></svg>';
$icon_send  = '<svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M3 11l18-8-8 18-2-7-8-3z"/></svg>';
?>

<!-- Our Journey -->
<section class="section about-journey">
	<div class="container about-journey__inner">
		<div class="about-journey__col">
			<div class="section-header__main">
				<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
				<h1 class="section-header__title"><?php esc_html_e( 'Our Journey', 'estatein' ); ?></h1>
				<p class="section-header__intro"><?php esc_html_e( "Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary. Over the years, we've expanded our reach, forged valuable partnerships, and gained the trust of countless clients.", 'estatein' ); ?></p>
			</div>
			<ul class="stat-cards" role="list">
				<?php foreach ( $stats as $s ) : ?>
					<li class="stat-card"><span class="stat-card__value"><?php echo esc_html( $s[0] ); ?></span><span class="stat-card__label"><?php echo esc_html( $s[1] ); ?></span></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="about-journey__media">
			<img src="<?php echo esc_url( $img . '/journey.webp' ); ?>" alt="<?php esc_attr_e( 'Estatein — our journey', 'estatein' ); ?>" loading="lazy">
		</div>
	</div>
</section>

<!-- Our Values -->
<section class="section about-values">
	<div class="container about-values__inner">
		<div class="section-header__main">
			<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
			<h2 class="section-header__title"><?php esc_html_e( 'Our Values', 'estatein' ); ?></h2>
			<p class="section-header__intro"><?php esc_html_e( 'Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary.', 'estatein' ); ?></p>
		</div>
		<div class="about-values__panel">
			<?php foreach ( $values as $v ) : ?>
				<div class="value-item">
					<div class="value-item__head">
						<span class="value-item__icon"><?php echo $v[0]; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<h3 class="value-item__title"><?php echo esc_html( $v[1] ); ?></h3>
					</div>
					<p class="value-item__text"><?php echo esc_html( $v[2] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Our Achievements -->
<section class="section about-achievements">
	<div class="container">
		<div class="section-header">
			<div class="section-header__main">
				<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
				<h2 class="section-header__title"><?php esc_html_e( 'Our Achievements', 'estatein' ); ?></h2>
				<p class="section-header__intro"><?php esc_html_e( 'Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary.', 'estatein' ); ?></p>
			</div>
		</div>
		<div class="about-cards-3">
			<?php foreach ( $achievements as $a ) : ?>
				<article class="info-card">
					<h3 class="info-card__title"><?php echo esc_html( $a[0] ); ?></h3>
					<p class="info-card__text"><?php echo esc_html( $a[1] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Navigating the Estatein Experience -->
<section class="section about-steps">
	<div class="container">
		<div class="section-header">
			<div class="section-header__main">
				<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
				<h2 class="section-header__title"><?php esc_html_e( 'Navigating the Estatein Experience', 'estatein' ); ?></h2>
				<p class="section-header__intro"><?php esc_html_e( "At Estatein, we've designed a straightforward process to help you find and purchase your dream property with ease. Here's a step-by-step guide to how it all works.", 'estatein' ); ?></p>
			</div>
		</div>
		<div class="steps-grid">
			<?php foreach ( $steps as $st ) : ?>
				<article class="step-card">
					<span class="step-card__num"><?php echo esc_html( $st[0] ); ?></span>
					<div class="step-card__body">
						<h3 class="step-card__title"><?php echo esc_html( $st[1] ); ?></h3>
						<p class="step-card__text"><?php echo esc_html( $st[2] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Meet the Estatein Team -->
<section class="section about-team">
	<div class="container">
		<div class="section-header">
			<div class="section-header__main">
				<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
				<h2 class="section-header__title"><?php esc_html_e( 'Meet the Estatein Team', 'estatein' ); ?></h2>
				<p class="section-header__intro"><?php esc_html_e( 'At Estatein, our success is driven by the dedication and expertise of our team. Get to know the people behind our mission to make your real estate dreams a reality.', 'estatein' ); ?></p>
			</div>
		</div>
		<div class="about-cards-4">
			<?php foreach ( $team as $t ) : ?>
				<article class="member-card">
					<div class="member-card__photo">
						<img src="<?php echo esc_url( $img . '/' . $t[0] . '.webp' ); ?>" alt="<?php echo esc_attr( $t[1] ); ?>" loading="lazy">
						<span class="member-card__twitter" aria-hidden="true"><svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M22 5.8a8.5 8.5 0 0 1-2.4.7 4.2 4.2 0 0 0 1.8-2.3c-.8.5-1.7.8-2.6 1a4.1 4.1 0 0 0-7 3.8A11.7 11.7 0 0 1 3.4 4.7a4.1 4.1 0 0 0 1.3 5.5c-.7 0-1.3-.2-1.9-.5v.1a4.1 4.1 0 0 0 3.3 4 4.1 4.1 0 0 1-1.9.1 4.1 4.1 0 0 0 3.8 2.9A8.3 8.3 0 0 1 2 18.3 11.7 11.7 0 0 0 8.3 20c7.5 0 11.7-6.3 11.7-11.7v-.5A8.3 8.3 0 0 0 22 5.8z"/></svg></span>
					</div>
					<div class="member-card__name"><?php echo esc_html( $t[1] ); ?></div>
					<div class="member-card__role"><?php echo esc_html( $t[2] ); ?></div>
					<a class="member-card__hello" href="#" aria-label="<?php echo esc_attr( sprintf( __( 'Say hello to %s', 'estatein' ), $t[1] ) ); ?>">
						<span><?php esc_html_e( 'Say Hello', 'estatein' ); ?> &#128075;</span>
						<span class="member-card__hello-btn"><?php echo $icon_send; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					</a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Our Valued Clients -->
<section class="section about-clients">
	<div class="container">
		<div class="section-header">
			<div class="section-header__main">
				<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
				<h2 class="section-header__title"><?php esc_html_e( 'Our Valued Clients', 'estatein' ); ?></h2>
				<p class="section-header__intro"><?php esc_html_e( "At Estatein, we have had the privilege of working with a diverse range of clients across various industries. Here are some of the clients we've had the pleasure of serving.", 'estatein' ); ?></p>
			</div>
		</div>
		<div class="client-grid">
			<?php foreach ( $clients as $c ) : ?>
				<article class="client-card">
					<div class="client-card__top">
						<div>
							<span class="client-card__since"><?php echo esc_html( $c['since'] ); ?></span>
							<h3 class="client-card__name"><?php echo esc_html( $c['name'] ); ?></h3>
						</div>
						<a class="btn btn--secondary" href="#"><?php esc_html_e( 'Visit Website', 'estatein' ); ?></a>
					</div>
					<div class="client-card__meta">
						<div class="client-card__meta-col">
							<span class="client-card__meta-label"><?php echo $icon_globe; // phpcs:ignore WordPress.Security.EscapeOutput ?> <?php esc_html_e( 'Domain', 'estatein' ); ?></span>
							<span class="client-card__meta-value"><?php echo esc_html( $c['domain'] ); ?></span>
						</div>
						<div class="client-card__meta-col">
							<span class="client-card__meta-label"><?php echo $icon_tag; // phpcs:ignore WordPress.Security.EscapeOutput ?> <?php esc_html_e( 'Category', 'estatein' ); ?></span>
							<span class="client-card__meta-value"><?php echo esc_html( $c['category'] ); ?></span>
						</div>
					</div>
					<div class="client-card__quote">
						<span class="client-card__quote-label"><?php esc_html_e( 'What They Said', 'estatein' ); ?> &#129303;</span>
						<p><?php echo esc_html( $c['quote'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="section-pager">
			<span class="section-pager__count"><strong>01</strong> <?php echo esc_html_x( 'of', 'pagination', 'estatein' ); ?> 10</span>
			<div class="section-pager__btns">
				<span class="section-pager__btn" aria-hidden="true">&#8592;</span>
				<span class="section-pager__btn section-pager__btn--active" aria-hidden="true">&#8594;</span>
			</div>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/components/cta-banner', null, array() );
get_footer();
