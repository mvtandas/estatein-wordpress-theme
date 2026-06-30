<?php
/**
 * Property archive — pixel-built from the Estatein Figma "Properties Page" (97:7288).
 *
 * Sections: Find Your Dream Property (search + filters) · Discover a World of
 * Possibilities (listings + pager) · Let's Make it Happen (enquiry form) · CTA.
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

get_header();

$deco = get_theme_file_uri( 'assets/img/icons/deco-sparkle.svg' );

$filters = array(
	array( 'Location', '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/><circle cx="12" cy="9" r="2.5"/></svg>' ),
	array( 'Property Type', '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 11l9-7 9 7M5 10v10h14V10"/></svg>' ),
	array( 'Pricing Range', '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9"/><path d="M12 7v10M9.5 9.5h4a1.5 1.5 0 0 1 0 3h-3a1.5 1.5 0 0 0 0 3h4"/></svg>' ),
	array( 'Property Size', '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 8V4h4M21 8V4h-4M3 16v4h4M21 16v4h-4"/></svg>' ),
	array( 'Build Year', '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 9h18M8 3v4M16 3v4"/></svg>' ),
);
$chevron = '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>';
?>

<!-- Find Your Dream Property -->
<section class="prop-hero">
	<div class="prop-hero__intro">
		<div class="container">
			<h1 class="section-header__title"><?php esc_html_e( 'Find Your Dream Property', 'estatein' ); ?></h1>
			<p class="section-header__intro"><?php esc_html_e( 'Welcome to Estatein, where your dream property awaits in every corner of our beautiful world. Explore our curated selection of properties, each offering a unique story and a chance to redefine your life. With categories to suit every dreamer, your journey', 'estatein' ); ?></p>
		</div>
	</div>
	<div class="container prop-search">
		<form class="prop-search__bar" role="search" method="get" action="<?php echo esc_url( get_post_type_archive_link( 'property' ) ?: home_url( '/properties/' ) ); ?>">
			<input class="prop-search__input" type="search" name="s" placeholder="<?php esc_attr_e( 'Search For A Property', 'estatein' ); ?>">
			<button class="btn btn--primary prop-search__btn" type="submit">
				<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/></svg>
				<?php esc_html_e( 'Find Property', 'estatein' ); ?>
			</button>
		</form>
		<div class="prop-filters">
			<?php foreach ( $filters as $f ) : ?>
				<button class="prop-filter" type="button">
					<span class="prop-filter__icon"><?php echo $f[1]; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<span class="prop-filter__sep" aria-hidden="true"></span>
					<span class="prop-filter__label"><?php echo esc_html( $f[0] ); ?></span>
					<span class="prop-filter__chevron"><?php echo $chevron; // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				</button>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- Discover a World of Possibilities -->
<section class="section">
	<div class="container">
		<div class="section-header">
			<div class="section-header__main">
				<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
				<h2 class="section-header__title"><?php esc_html_e( 'Discover a World of Possibilities', 'estatein' ); ?></h2>
				<p class="section-header__intro"><?php esc_html_e( 'Our portfolio of properties is as diverse as your dreams. Explore the following categories to find the perfect property that resonates with your vision of home.', 'estatein' ); ?></p>
			</div>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="slider" data-slider data-slider-perview="3">
				<div class="slider__track">
					<?php
					while ( have_posts() ) :
						the_post();
						echo '<div class="slider__slide">';
						get_template_part( 'template-parts/components/property-listing-card' );
						echo '</div>';
					endwhile;
					?>
				</div>
				<div class="slider__controls section-pager">
					<span class="section-pager__count"><strong>01</strong> <?php echo esc_html_x( 'of', 'pagination', 'estatein' ); ?> <?php echo esc_html( str_pad( (string) max( 1, (int) wp_count_posts( 'property' )->publish ), 2, '0', STR_PAD_LEFT ) ); ?></span>
					<div class="section-pager__btns">
						<button class="section-pager__btn" data-slider-prev aria-label="<?php esc_attr_e( 'Previous', 'estatein' ); ?>">&#8592;</button>
						<button class="section-pager__btn section-pager__btn--active" data-slider-next aria-label="<?php esc_attr_e( 'Next', 'estatein' ); ?>">&#8594;</button>
					</div>
				</div>
			</div>
		<?php else : ?>
			<p class="empty-state"><?php esc_html_e( 'No properties match your criteria. Try adjusting the filters.', 'estatein' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<!-- Let's Make it Happen -->
<section class="section">
	<div class="container">
		<div class="section-header">
			<div class="section-header__main">
				<img class="section-header__deco" src="<?php echo esc_url( $deco ); ?>" alt="" aria-hidden="true" width="52" height="30">
				<h2 class="section-header__title"><?php esc_html_e( "Let's Make it Happen", 'estatein' ); ?></h2>
				<p class="section-header__intro"><?php esc_html_e( "Ready to take the first step toward your dream property? Fill out the form below, and our real estate wizards will work their magic to find your perfect match. Don't wait; let's embark on this exciting journey together.", 'estatein' ); ?></p>
			</div>
		</div>

		<?php
		// Live form via Contact Form 7 (editable in the admin); static fallback if CF7 is unavailable.
		$estatein_lmih = estatein_cf7_form( "Let's Make it Happen", 'enquiry-form' );
		if ( $estatein_lmih ) {
			echo $estatein_lmih; // phpcs:ignore WordPress.Security.EscapeOutput — CF7 shortcode output.
		} else {
			?>
		<form class="enquiry-form" method="post" action="#">
			<div class="enquiry-form__grid">
				<label class="field"><span class="field__label"><?php esc_html_e( 'First Name', 'estatein' ); ?></span><input type="text" placeholder="<?php esc_attr_e( 'Enter First Name', 'estatein' ); ?>"></label>
				<label class="field"><span class="field__label"><?php esc_html_e( 'Last Name', 'estatein' ); ?></span><input type="text" placeholder="<?php esc_attr_e( 'Enter Last Name', 'estatein' ); ?>"></label>
				<label class="field"><span class="field__label"><?php esc_html_e( 'Email', 'estatein' ); ?></span><input type="email" placeholder="<?php esc_attr_e( 'Enter your Email', 'estatein' ); ?>"></label>
				<label class="field"><span class="field__label"><?php esc_html_e( 'Phone', 'estatein' ); ?></span><input type="tel" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'estatein' ); ?>"></label>
				<label class="field"><span class="field__label"><?php esc_html_e( 'Preferred Location', 'estatein' ); ?></span><select><option><?php esc_html_e( 'Select Location', 'estatein' ); ?></option></select></label>
				<label class="field"><span class="field__label"><?php esc_html_e( 'Property Type', 'estatein' ); ?></span><select><option><?php esc_html_e( 'Select Property Type', 'estatein' ); ?></option></select></label>
				<label class="field"><span class="field__label"><?php esc_html_e( 'No. of Bathrooms', 'estatein' ); ?></span><select><option><?php esc_html_e( 'Select no. of Bathrooms', 'estatein' ); ?></option></select></label>
				<label class="field"><span class="field__label"><?php esc_html_e( 'No. of Bedrooms', 'estatein' ); ?></span><select><option><?php esc_html_e( 'Select no. of Bedrooms', 'estatein' ); ?></option></select></label>
				<label class="field field--wide"><span class="field__label"><?php esc_html_e( 'Budget', 'estatein' ); ?></span><select><option><?php esc_html_e( 'Select Budget', 'estatein' ); ?></option></select></label>
				<div class="field field--wide">
					<span class="field__label"><?php esc_html_e( 'Preferred Contact Method', 'estatein' ); ?></span>
					<div class="field__pair">
						<label class="contact-method">
							<span class="contact-method__icon"><svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8a15 15 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.24 11 11 0 0 0 3.4.55 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11 11 0 0 0 .55 3.4 1 1 0 0 1-.25 1z"/></svg></span>
							<input class="contact-method__input" type="tel" placeholder="<?php esc_attr_e( 'Enter Your Number', 'estatein' ); ?>">
							<input class="contact-method__radio" type="radio" name="contact_method" value="phone" checked>
						</label>
						<label class="contact-method">
							<span class="contact-method__icon"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></span>
							<input class="contact-method__input" type="email" placeholder="<?php esc_attr_e( 'Enter Your Email', 'estatein' ); ?>">
							<input class="contact-method__radio" type="radio" name="contact_method" value="email">
						</label>
					</div>
				</div>
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

<?php
get_template_part( 'template-parts/components/cta-banner', null, array() );
get_footer();
