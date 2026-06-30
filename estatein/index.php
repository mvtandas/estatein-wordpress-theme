<?php
/**
 * Fallback template — blog index / archive of posts (the WordPress Loop).
 *
 * @package Estatein
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="section">
	<div class="container">
		<?php
		estatein_section_header(
			array(
				'eyebrow' => __( 'Our Blog', 'estatein' ),
				'title'   => is_home() ? __( 'Latest insights & news', 'estatein' ) : get_the_archive_title(),
				'intro'   => __( 'Stay informed with the latest real-estate trends and tips.', 'estatein' ),
			)
		);
		?>

		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/components/post-card' );
				endwhile;
				?>
			</div>

			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 1,
					'prev_text' => __( 'Previous', 'estatein' ),
					'next_text' => __( 'Next', 'estatein' ),
				)
			);
			?>
		<?php else : ?>
			<p class="empty-state"><?php esc_html_e( 'No posts found.', 'estatein' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
