<?php
/**
 * Single property detail — pixel-built from the Estatein Figma
 * "Property Details Page" (102:8754).
 *
 * Title + location + price · gallery (thumb strip + duo + pager) ·
 * Description & stats + Key Features · Inquire form ·
 * Comprehensive Pricing Details · FAQ · CTA.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$price    = (float) ( estatein_field( 'price', null, 1250000 ) ?: 1250000 );
	$address  = estatein_field( 'address', null, __( 'Malibu, California', 'estatein' ) );
	$gallery  = estatein_field( 'gallery', null, array() );
	$features = estatein_field( 'features', null, array() );
	$beds     = estatein_field( 'bedrooms', null, '04' );
	$baths    = estatein_field( 'bathrooms', null, '03' );
	$area     = estatein_field( 'area_sqft', null, '2500' );
	$deco     = get_theme_file_uri( 'assets/img/icons/deco-sparkle.svg' );

	// Build a gallery image list (featured → ACF gallery → cycling fallbacks).
	$images = array();
	if ( has_post_thumbnail() ) {
		$images[] = get_the_post_thumbnail_url( null, 'large' );
	}
	foreach ( $gallery as $g ) {
		$images[] = $g['sizes']['large'] ?? $g['url'];
	}
	$fallbacks = array( 'property-1.webp', 'property-2.webp', 'property-3.webp', 'hero-property.webp' );
	$i = 0;
	while ( count( $images ) < 9 ) {
		$images[] = get_theme_file_uri( 'assets/img/photos/' . $fallbacks[ $i % 4 ] );
		$i++;
	}

	// Feature fallback mirrors the Figma sample so the section is never empty.
	$feature_list = array();
	foreach ( $features as $f ) {
		if ( ! empty( $f['feature'] ) ) {
			$feature_list[] = $f['feature'];
		}
	}
	if ( empty( $feature_list ) ) {
		$feature_list = array(
			__( 'Expansive oceanfront terrace for outdoor entertaining', 'estatein' ),
			__( 'Gourmet kitchen with top-of-the-line appliances', 'estatein' ),
			__( 'Private beach access for morning strolls and sunset views', 'estatein' ),
			__( 'Master suite with a spa-inspired bathroom and ocean-facing balcony', 'estatein' ),
			__( 'Private garage and ample storage space', 'estatein' ),
		);
	}

	// Pricing figures — derived from the listing price (matches Figma for $1.25M).
	$transfer = round( $price * 0.02 );
	$legal    = 3000;
	$inspect  = 500;
	$ins_year = 1200;
	$add_tot  = $transfer + $legal + $inspect + $ins_year;
	$down     = round( $price * 0.20 );
	$mortgage = $price - $down;
	$fmt      = 'estatein_format_price';
	?>
	<article <?php post_class( 'property-detail' ); ?>>

		<!-- Title + location + price -->
		<div class="container">
			<header class="pd-head">
				<div class="pd-head__title">
					<h1 class="pd-head__name"><?php the_title(); ?></h1>
					<span class="pd-head__loc">
						<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="9" r="2.5"/></svg>
						<?php echo esc_html( $address ); ?>
					</span>
				</div>
				<p class="pd-head__price">
					<span class="pd-head__price-label"><?php esc_html_e( 'Price', 'estatein' ); ?></span>
					<span class="pd-head__price-value"><?php echo esc_html( $fmt( $price ) ); ?></span>
				</p>
			</header>

			<!-- Gallery -->
			<?php
			$gallery_imgs = array_slice( $images, 0, 8 );
			$per_view     = 2;
			$pages        = max( 1, (int) ceil( count( $gallery_imgs ) / $per_view ) );
			?>
			<div class="pd-gallery" data-gallery data-gallery-perview="<?php echo (int) $per_view; ?>">
				<ul class="pd-gallery__thumbs" role="list">
					<?php foreach ( $gallery_imgs as $idx => $src ) : ?>
						<li>
							<button type="button" class="pd-gallery__thumb<?php echo 0 === $idx ? ' is-active' : ''; ?>" data-gallery-thumb="<?php echo (int) $idx; ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View photo %d', 'estatein' ), $idx + 1 ) ); ?>">
								<img src="<?php echo esc_url( $src ); ?>" alt="" loading="lazy">
							</button>
						</li>
					<?php endforeach; ?>
				</ul>
				<div class="pd-gallery__viewport">
					<div class="pd-gallery__track">
						<?php foreach ( $gallery_imgs as $src ) : ?>
							<figure class="pd-gallery__cell"><img src="<?php echo esc_url( $src ); ?>" alt="<?php the_title_attribute(); ?>"></figure>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="pd-gallery__pager">
					<button type="button" class="pd-gallery__nav" data-gallery-prev aria-label="<?php esc_attr_e( 'Previous photos', 'estatein' ); ?>">&#8592;</button>
					<span class="pd-gallery__dots">
						<?php for ( $i = 0; $i < $pages; $i++ ) : ?>
							<i<?php echo 0 === $i ? ' class="is-active"' : ''; ?>></i>
						<?php endfor; ?>
					</span>
					<button type="button" class="pd-gallery__nav pd-gallery__nav--alt" data-gallery-next aria-label="<?php esc_attr_e( 'Next photos', 'estatein' ); ?>">&#8594;</button>
				</div>
			</div>

			<!-- Description + Key Features -->
			<div class="pd-info">
				<div class="pd-card pd-desc">
					<div class="pd-desc__text">
						<h2 class="pd-card__title"><?php esc_html_e( 'Description', 'estatein' ); ?></h2>
						<p><?php echo esc_html( get_the_excerpt() ?: __( 'Discover your own piece of paradise with the Seaside Serenity Villa. With an open floor plan, breathtaking ocean views from every room, and direct access to a pristine sandy beach, this property is the epitome of coastal living.', 'estatein' ) ); ?></p>
					</div>
					<ul class="pd-stats" role="list">
						<li class="pd-stat">
							<span class="pd-stat__label"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 12V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v5M3 12h18M3 12v5m18-5v5M7 9h4M13 9h4"/></svg> <?php esc_html_e( 'Bedrooms', 'estatein' ); ?></span>
							<strong class="pd-stat__value"><?php echo esc_html( str_pad( (string) (int) $beds, 2, '0', STR_PAD_LEFT ) ); ?></strong>
						</li>
						<li class="pd-stat">
							<span class="pd-stat__label"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 12h16v3a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4v-3zM6 12V6a2 2 0 0 1 2-2 2 2 0 0 1 2 2"/></svg> <?php esc_html_e( 'Bathrooms', 'estatein' ); ?></span>
							<strong class="pd-stat__value"><?php echo esc_html( str_pad( (string) (int) $baths, 2, '0', STR_PAD_LEFT ) ); ?></strong>
						</li>
						<li class="pd-stat">
							<span class="pd-stat__label"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 8V4h4M21 8V4h-4M3 16v4h4M21 16v4h-4"/></svg> <?php esc_html_e( 'Area', 'estatein' ); ?></span>
							<strong class="pd-stat__value"><?php echo esc_html( number_format_i18n( (float) $area ) ); ?> <?php esc_html_e( 'Square Feet', 'estatein' ); ?></strong>
						</li>
					</ul>
				</div>

				<div class="pd-card pd-features">
					<h2 class="pd-card__title"><?php esc_html_e( 'Key Features and Amenities', 'estatein' ); ?></h2>
					<ul class="pd-features__list" role="list">
						<?php foreach ( $feature_list as $feat ) : ?>
							<li class="pd-feature">
								<svg class="pd-feature__icon" viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M13 2 4 14h6l-1 8 9-12h-6l1-8z"/></svg>
								<span><?php echo esc_html( $feat ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>

		<!-- Inquire -->
		<section class="section">
			<div class="container">
				<div class="pd-inquire">
					<div class="pd-inquire__text">
						<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
						<h2 class="section-header__title"><?php printf( esc_html__( 'Inquire About %s', 'estatein' ), get_the_title() ); ?></h2>
						<p class="section-header__intro"><?php esc_html_e( 'Interested in this property? Fill out the form below, and our real estate experts will get back to you with more details, including scheduling a viewing and answering any questions you may have.', 'estatein' ); ?></p>
					</div>
					<?php
					// Live inquiry via CF7; the "Selected Property" field is auto-filled by JS from this value.
					$estatein_inquire = estatein_cf7_form( 'Inquire About Property', 'enquiry-form enquiry-form--compact' );
					if ( $estatein_inquire ) :
						?>
						<div class="pd-inquire__form" data-selected-property="<?php echo esc_attr( get_the_title() . ', ' . $address ); ?>">
							<?php echo $estatein_inquire; // phpcs:ignore WordPress.Security.EscapeOutput — CF7 shortcode output. ?>
						</div>
					<?php else : ?>
						<form class="enquiry-form enquiry-form--compact" method="post" action="#">
							<div class="enquiry-form__grid enquiry-form__grid--2">
								<label class="field"><span class="field__label"><?php esc_html_e( 'First Name', 'estatein' ); ?></span><input type="text" placeholder="<?php esc_attr_e( 'Enter First Name', 'estatein' ); ?>"></label>
								<label class="field"><span class="field__label"><?php esc_html_e( 'Last Name', 'estatein' ); ?></span><input type="text" placeholder="<?php esc_attr_e( 'Enter Last Name', 'estatein' ); ?>"></label>
								<label class="field"><span class="field__label"><?php esc_html_e( 'Email', 'estatein' ); ?></span><input type="email" placeholder="<?php esc_attr_e( 'Enter your Email', 'estatein' ); ?>"></label>
								<label class="field"><span class="field__label"><?php esc_html_e( 'Phone', 'estatein' ); ?></span><input type="tel" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'estatein' ); ?>"></label>
								<label class="field field--full">
									<span class="field__label"><?php esc_html_e( 'Selected Property', 'estatein' ); ?></span>
									<span class="field__input-icon field__input-icon--right">
										<input type="text" value="<?php echo esc_attr( get_the_title() . ', ' . $address ); ?>" readonly>
										<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="9" r="2.5"/></svg>
									</span>
								</label>
								<label class="field field--full"><span class="field__label"><?php esc_html_e( 'Message', 'estatein' ); ?></span><textarea rows="3" placeholder="<?php esc_attr_e( 'Enter your Message here..', 'estatein' ); ?>"></textarea></label>
							</div>
							<div class="enquiry-form__foot">
								<label class="enquiry-form__agree"><input type="checkbox"> <span><?php esc_html_e( 'I agree with', 'estatein' ); ?> <a href="#"><?php esc_html_e( 'Terms of Use', 'estatein' ); ?></a> <?php esc_html_e( 'and', 'estatein' ); ?> <a href="#"><?php esc_html_e( 'Privacy Policy', 'estatein' ); ?></a></span></label>
								<button class="btn btn--primary" type="submit"><?php esc_html_e( 'Send Your Message', 'estatein' ); ?></button>
							</div>
						</form>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<!-- Comprehensive Pricing Details -->
		<section class="section">
			<div class="container">
				<div class="section-header">
					<div class="section-header__main">
						<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
						<h2 class="section-header__title"><?php esc_html_e( 'Comprehensive Pricing Details', 'estatein' ); ?></h2>
						<p class="section-header__intro"><?php esc_html_e( 'At Estatein, transparency is key. We want you to have a clear understanding of all costs associated with your property investment. Below, we break down the pricing for this property to help you make an informed decision.', 'estatein' ); ?></p>
					</div>
				</div>

				<div class="pd-note">
					<strong class="pd-note__label"><?php esc_html_e( 'Note', 'estatein' ); ?></strong>
					<span class="pd-note__sep" aria-hidden="true"></span>
					<span class="pd-note__text"><?php esc_html_e( 'The figures provided above are estimates and may vary depending on the property, location, and individual circumstances.', 'estatein' ); ?></span>
				</div>

				<div class="pd-pricing">
					<div class="pd-pricing__listing">
						<span class="pd-pricing__listing-label"><?php esc_html_e( 'Listing Price', 'estatein' ); ?></span>
						<strong class="pd-pricing__listing-value"><?php echo esc_html( $fmt( $price ) ); ?></strong>
					</div>

					<div class="pd-pricing__cards">
						<?php
						$cards = array(
							array(
								'title' => __( 'Additional Fees', 'estatein' ),
								'rows'  => array(
									array(
										array( __( 'Property Transfer Tax', 'estatein' ), $fmt( $transfer ), __( 'Based on the sale price and local regulations', 'estatein' ) ),
										array( __( 'Legal Fees', 'estatein' ), $fmt( $legal ), __( 'Approximate cost for legal services, including title transfer', 'estatein' ) ),
									),
									array(
										array( __( 'Home Inspection', 'estatein' ), $fmt( $inspect ), __( 'Recommended for due diligence', 'estatein' ) ),
										array( __( 'Property Insurance', 'estatein' ), $fmt( $ins_year ), __( 'Annual cost for comprehensive property insurance', 'estatein' ) ),
									),
									array(
										array( __( 'Mortgage Fees', 'estatein' ), __( 'Varies', 'estatein' ), __( 'If applicable, consult with your lender for specific details', 'estatein' ) ),
									),
								),
							),
							array(
								'title' => __( 'Monthly Costs', 'estatein' ),
								'rows'  => array(
									array(
										array( __( 'Property Taxes', 'estatein' ), $fmt( 1250 ), __( 'Approximate monthly property tax based on the sale price and local rates', 'estatein' ) ),
										array( __( "Homeowners' Association Fee", 'estatein' ), $fmt( 300 ), __( 'Monthly fee for common area maintenance and security', 'estatein' ) ),
									),
								),
							),
							array(
								'title' => __( 'Total Initial Costs', 'estatein' ),
								'rows'  => array(
									array(
										array( __( 'Listing Price', 'estatein' ), $fmt( $price ), '' ),
										array( __( 'Additional Fees', 'estatein' ), $fmt( $add_tot ), __( 'Property transfer fee, legal fees, inspection, insurance', 'estatein' ) ),
									),
									array(
										array( __( 'Down Payment', 'estatein' ), $fmt( $down ), '20%' ),
										array( __( 'Mortgage Amount', 'estatein' ), $fmt( $mortgage ), __( 'If applicable', 'estatein' ) ),
									),
								),
							),
							array(
								'title' => __( 'Monthly Expenses', 'estatein' ),
								'rows'  => array(
									array(
										array( __( 'Property Taxes', 'estatein' ), $fmt( 1250 ), '' ),
										array( __( "Homeowners' Association Fee", 'estatein' ), $fmt( 300 ), '' ),
									),
									array(
										array( __( 'Mortgage Payment', 'estatein' ), __( 'Varies', 'estatein' ), __( 'Based on terms and interest rate', 'estatein' ) ),
										array( __( 'Property Insurance', 'estatein' ), $fmt( 100 ), __( 'Approximate monthly cost', 'estatein' ) ),
									),
								),
							),
						);

						foreach ( $cards as $card ) :
							?>
							<div class="pd-fee-card">
								<header class="pd-fee-card__head">
									<h3 class="pd-fee-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
									<button class="btn pd-fee-card__more" type="button"><?php esc_html_e( 'Learn More', 'estatein' ); ?></button>
								</header>
								<div class="pd-fee-card__rows">
									<?php foreach ( $card['rows'] as $row ) : ?>
										<div class="pd-fee-row<?php echo ( count( $row ) === 1 ) ? ' pd-fee-row--full' : ''; ?>">
											<?php foreach ( $row as $idx => $item ) : ?>
												<?php if ( $idx > 0 ) : ?><span class="pd-fee-row__sep" aria-hidden="true"></span><?php endif; ?>
												<div class="pd-fee">
													<span class="pd-fee__label"><?php echo esc_html( $item[0] ); ?></span>
													<span class="pd-fee__val">
														<strong><?php echo esc_html( $item[1] ); ?></strong>
														<?php if ( '' !== $item[2] ) : ?><span class="pd-fee__note"><?php echo esc_html( $item[2] ); ?></span><?php endif; ?>
													</span>
												</div>
											<?php endforeach; ?>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>

		<?php
		// FAQ — same component and layout as the home page.
		$faqs = new WP_Query( array( 'post_type' => 'faq', 'posts_per_page' => 6, 'no_found_rows' => true ) );
		if ( $faqs->have_posts() ) :
			?>
			<section class="section">
				<div class="container">
					<?php
					estatein_section_header(
						array(
							'title'  => __( 'Frequently Asked Questions', 'estatein' ),
							'intro'  => __( "Find answers to common questions about Estatein's services, property listings, and the real estate process. We're here to provide clarity and assist you every step of the way.", 'estatein' ),
							'action' => array( 'label' => __( "View All FAQ's", 'estatein' ), 'url' => home_url( '/about/' ) ),
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
							<a class="btn btn--secondary section-pager__viewall" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( "View All FAQ's", 'estatein' ); ?></a>
							<span class="section-pager__count"><strong>01</strong> <?php echo esc_html_x( 'of', 'pagination', 'estatein' ); ?> <?php echo esc_html( str_pad( (string) max( 1, (int) wp_count_posts( 'faq' )->publish ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<div class="section-pager__btns">
								<button class="section-pager__btn" data-slider-prev aria-label="<?php esc_attr_e( 'Previous', 'estatein' ); ?>">&#8592;</button>
								<button class="section-pager__btn section-pager__btn--active" data-slider-next aria-label="<?php esc_attr_e( 'Next', 'estatein' ); ?>">&#8594;</button>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

	</article>
	<?php
endwhile;

get_template_part( 'template-parts/components/cta-banner', null, array() );
get_footer();
