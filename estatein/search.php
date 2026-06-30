<?php
/**
 * Search results.
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
				'title' => sprintf( __( 'Search results for: %s', 'estatein' ), '<span>' . get_search_query() . '</span>' ),
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
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p class="empty-state"><?php esc_html_e( 'Nothing matched your search. Try different keywords.', 'estatein' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
