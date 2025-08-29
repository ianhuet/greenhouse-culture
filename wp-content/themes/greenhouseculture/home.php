<?php
/**
 * The home template file
 *
 * This template displays the blog posts index/homepage with masonry layout
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Greenhouseculture
 */

get_header();
?>

<section id="content" class="site-content posts-container">
	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-12 content-area">
				<main id="main" class="site-main">
					
				<?php
					/* Custom query for homepage posts - TiDB/MySQL compatible */
					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$posts_per_page = 12;
					
					// Get total count separately to ensure compatibility with TiDB
					global $wpdb;
					$total_posts = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status = 'publish'");
					
					// Standard WP_Query
					$args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'paged' => $paged,
						'posts_per_page' => $posts_per_page,
					);
					
					$query = new WP_Query( $args );
					
					// Always set pagination values explicitly for TiDB compatibility
					$query->found_posts = $total_posts;
					$query->max_num_pages = ceil($total_posts / $posts_per_page);

					if ( $query->have_posts() ) : ?>
						<div class="masonry-start">
							<div id="masonry-loop">
								<?php
								while ( $query->have_posts() ) :
									$query->the_post();
									get_template_part( 'template-parts/content', 'home' );
								endwhile;
								?>
							</div>
						</div>
					<?php else : ?>
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					<?php endif; ?>

					<?php if ( $query->max_num_pages > 1 ) : ?>
						<div class="pagination">
							<?php
							echo paginate_links( array(
								'current' => max( 1, get_query_var('paged') ),
								'end_size' => 2,
								'format' => '?paged=%#%',
								'mid_size' => 1,
								'next_text' => __('Next »'),
								'prev_next' => true,
								'prev_text' => __('« Previous'),
								'show_all' => false,
								'total' => $query->max_num_pages,
								'type' => 'list',
							));
							?>
						</div>
					<?php endif; ?>

					<?php wp_reset_postdata(); ?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
	</div>
</section>

<?php get_footer();