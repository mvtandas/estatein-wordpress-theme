<?php
/**
 * Front page (Home).
 *
 * Section order mirrors the Estatein Figma home frame:
 * hero → featured properties → why-choose-us → testimonials → FAQ → CTA.
 * Editable copy is pulled from ACF (Theme Settings / page fields) with sensible
 * fallbacks so the page renders before any content is entered.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<!-- Hero (Figma 121:1772) -->
<section class="hero">
	<div class="hero__inner">
		<div class="hero__content">
			<h1 class="hero__title"><?php echo esc_html( estatein_field( 'hero_title', get_the_ID(), __( 'Discover Your Dream Property with Estatein', 'estatein' ) ) ); ?></h1>
			<p class="hero__lede"><?php echo esc_html( estatein_field( 'hero_text', get_the_ID(), __( 'Your journey to finding the perfect property begins here. Explore our extensive range of properties tailored to your needs.', 'estatein' ) ) ); ?></p>
			<div class="hero__actions">
				<a class="btn btn--secondary" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'Learn More', 'estatein' ); ?></a>
				<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Browse Properties', 'estatein' ); ?></a>
			</div>

			<ul class="hero__stats" role="list">
				<?php
				$stats = estatein_field( 'hero_stats', get_the_ID(), array(
					array( 'value' => '200+', 'label' => __( 'Happy Customers', 'estatein' ) ),
					array( 'value' => '10k+', 'label' => __( 'Properties For Clients', 'estatein' ) ),
					array( 'value' => '16+', 'label' => __( 'Years of Experience', 'estatein' ) ),
				) );
				foreach ( $stats as $stat ) :
					?>
					<li class="hero__stat">
						<span class="hero__stat-value"><?php echo esc_html( $stat['value'] ); ?></span>
						<span class="hero__stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="hero__media">
			<img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/photos/hero-property.webp' ) ); ?>" alt="<?php esc_attr_e( 'Modern luxury property', 'estatein' ); ?>" width="920" height="814">
		</div>
		<svg class="hero__badge" viewBox="0 0 140 140" aria-hidden="true" focusable="false">
			<circle cx="70" cy="70" r="69" fill="#141414" stroke="#262626"></circle>
			<defs><path id="hero-badge-circle" d="M70,70 m-53,0 a53,53 0 1,1 106,0 a53,53 0 1,1 -106,0"></path></defs>
			<g class="hero__badge-ring">
				<text fill="#ffffff" font-family="Urbanist, sans-serif" font-size="10" font-weight="500">
					<textPath href="#hero-badge-circle" startOffset="0" textLength="333" lengthAdjust="spacing">DISCOVER YOUR DREAM PROPERTY&#160;&#10024;&#160;&#160;</textPath>
				</text>
			</g>
			<circle cx="70" cy="70" r="30" fill="#1a1a1a" stroke="#262626"></circle>
			<path d="M62 78 L78 62 M67 61.5 H78.5 V73" stroke="#ffffff" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"></path>
		</svg>
	</div>
</section>

<!-- Feature strip (Figma 121:1890) -->
<section class="feature-strip">
	<div class="feature-strip__inner">
		<?php
		$features = array(
			array( 'icon' => 'feature-1.svg', 'title' => __( 'Find Your Dream Home', 'estatein' ), 'url' => home_url( '/properties/' ) ),
			array( 'icon' => 'feature-2.svg', 'title' => __( 'Unlock Property Value', 'estatein' ), 'url' => home_url( '/services/' ) ),
			array( 'icon' => 'feature-3.svg', 'title' => __( 'Effortless Property Management', 'estatein' ), 'url' => home_url( '/services/' ) ),
			array( 'icon' => 'feature-4.svg', 'title' => __( 'Smart Investments, Informed Decisions', 'estatein' ), 'url' => home_url( '/about/' ) ),
		);
		foreach ( $features as $feature ) :
			?>
			<a class="feature-card" href="<?php echo esc_url( $feature['url'] ); ?>">
				<span class="feature-card__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17 L17 7 M8 7 H17 V16"/></svg></span>
				<span class="feature-card__icon"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/icons/' . $feature['icon'] ) ); ?>" alt="" aria-hidden="true"></span>
				<span class="feature-card__title"><?php echo esc_html( $feature['title'] ); ?></span>
			</a>
		<?php endforeach; ?>
	</div>
</section>

<!-- Featured properties -->
<section class="section">
	<div class="container">
		<?php
		estatein_section_header(
			array(
				'title'  => __( 'Featured Properties', 'estatein' ),
				'intro'  => __( 'Explore our handpicked selection of featured properties. Each listing offers a glimpse into exceptional homes available through Estatein.', 'estatein' ),
				'action' => array(
					'label' => __( 'View All Properties', 'estatein' ),
					'url'   => get_post_type_archive_link( 'property' ) ?: home_url( '/properties/' ),
				),
			)
		);

		$featured = new WP_Query(
			array(
				'post_type'      => 'property',
				'posts_per_page' => 6,
				'orderby'        => 'ID',
				'order'          => 'ASC',
				'meta_query'     => array(
					array( 'key' => 'featured', 'value' => '1', 'compare' => '=' ),
				),
				'no_found_rows'  => true,
			)
		);

		// Fall back to the latest properties if none are flagged featured yet.
		if ( ! $featured->have_posts() ) {
			$featured = new WP_Query(
				array( 'post_type' => 'property', 'posts_per_page' => 6, 'no_found_rows' => true )
			);
		}

		if ( $featured->have_posts() ) :
			?>
			<div class="slider" data-slider data-slider-perview="3">
				<div class="slider__track">
					<?php
					while ( $featured->have_posts() ) :
						$featured->the_post();
						echo '<div class="slider__slide">';
						get_template_part( 'template-parts/components/property-card' );
						echo '</div>';
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<div class="slider__controls section-pager">
					<a class="btn btn--secondary section-pager__viewall" href="<?php echo esc_url( get_post_type_archive_link( 'property' ) ?: home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'View All Properties', 'estatein' ); ?></a>
					<span class="section-pager__count"><strong>01</strong> <?php echo esc_html_x( 'of', 'pagination', 'estatein' ); ?> <?php echo esc_html( str_pad( (string) max( 1, (int) wp_count_posts( 'property' )->publish ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<div class="section-pager__btns">
						<button class="section-pager__btn" data-slider-prev aria-label="<?php esc_attr_e( 'Previous', 'estatein' ); ?>">&#8592;</button>
						<button class="section-pager__btn section-pager__btn--active" data-slider-next aria-label="<?php esc_attr_e( 'Next', 'estatein' ); ?>">&#8594;</button>
					</div>
				</div>
			</div>
			<?php else : ?>
				<p class="empty-state"><?php esc_html_e( 'Add some properties to see them featured here.', 'estatein' ); ?></p>
			<?php endif; ?>
	</div>
</section>

<!-- Testimonials -->
<?php
$testimonials = new WP_Query(
	array( 'post_type' => 'testimonial', 'posts_per_page' => 9, 'orderby' => 'ID', 'order' => 'ASC', 'no_found_rows' => true )
);
if ( $testimonials->have_posts() ) :
	?>
	<section class="section section--alt">
		<div class="container">
			<?php
			estatein_section_header(
				array(
					'title'  => __( 'What Our Clients Say', 'estatein' ),
					'intro'  => __( 'Read the success stories and heartfelt testimonials from our valued clients.', 'estatein' ),
					'action' => array(
						'label' => __( 'View All Testimonials', 'estatein' ),
						'url'   => home_url( '/about/' ),
					),
				)
			);
			?>
			<div class="slider" data-slider data-slider-perview="3">
				<div class="slider__track">
					<?php
					while ( $testimonials->have_posts() ) :
						$testimonials->the_post();
						echo '<div class="slider__slide">';
						get_template_part( 'template-parts/components/testimonial' );
						echo '</div>';
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<div class="slider__controls section-pager">
					<a class="btn btn--secondary section-pager__viewall" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'View All Testimonials', 'estatein' ); ?></a>
					<span class="section-pager__count"><strong>01</strong> <?php echo esc_html_x( 'of', 'pagination', 'estatein' ); ?> <?php echo esc_html( str_pad( (string) max( 1, (int) wp_count_posts( 'testimonial' )->publish ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<div class="section-pager__btns">
						<button class="section-pager__btn" data-slider-prev aria-label="<?php esc_attr_e( 'Previous', 'estatein' ); ?>">&#8592;</button>
						<button class="section-pager__btn section-pager__btn--active" data-slider-next aria-label="<?php esc_attr_e( 'Next', 'estatein' ); ?>">&#8594;</button>
					</div>
				</div>
			</div>
		</div>
			</div>
		</section>
<?php endif; ?>

<!-- FAQ -->
<?php
$faqs = new WP_Query(
	array( 'post_type' => 'faq', 'posts_per_page' => 6, 'no_found_rows' => true )
);
if ( $faqs->have_posts() ) :
	?>
	<section class="section">
		<div class="container">
			<?php
			estatein_section_header(
				array(
					'title'  => __( 'Frequently Asked Questions', 'estatein' ),
					'intro'  => __( 'Find answers to common questions about our services, the buying process, and more.', 'estatein' ),
					'action' => array(
						'label' => __( "View All FAQ's", 'estatein' ),
						'url'   => home_url( '/about/' ),
					),
				)
			);
			?>
			<div class="slider" data-slider data-slider-perview="3">
				<div class="slider__track">
					<?php
					while ( $faqs->have_posts() ) :
						$faqs->the_post();
						echo '<div class="slider__slide">';
						get_template_part( 'template-parts/components/faq-card' );
						echo '</div>';
					endwhile;
					wp_reset_postdata();
					?>
				</div>
				<div class="slider__controls section-pager">
					<a class="btn btn--secondary section-pager__viewall" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'View All FAQ\'s', 'estatein' ); ?></a>
					<span class="section-pager__count"><strong>01</strong> <?php echo esc_html_x( 'of', 'pagination', 'estatein' ); ?> <?php echo esc_html( str_pad( (string) max( 1, (int) wp_count_posts( 'faq' )->publish ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<div class="section-pager__btns">
						<button class="section-pager__btn" data-slider-prev aria-label="<?php esc_attr_e( 'Previous', 'estatein' ); ?>">&#8592;</button>
						<button class="section-pager__btn section-pager__btn--active" data-slider-next aria-label="<?php esc_attr_e( 'Next', 'estatein' ); ?>">&#8594;</button>
					</div>
								</div>
			</div>
		</section>
<?php endif; ?>

<?php
get_template_part( 'template-parts/components/cta-banner', null, array() );
get_footer();
