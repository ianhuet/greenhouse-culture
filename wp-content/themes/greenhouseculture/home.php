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
					/* Masonry wrapper start - hardcoded for homepage */

					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$args = array(
						'paged' => $paged,
						'posts_per_page' => 9,
					);
					$query = new WP_Query( $args );
                                      
					if ( $query->have_posts() ) :
				?>
					<div class="masonry-start">
						<div id="masonry-loop">

							<?php
								/* Start the Loop */

								while ( have_posts() ) :
									the_post();

									get_template_part( 'template-parts/content', 'home' );
								endwhile;

								/* Masonry wrapper end */
							?>
						</div>
					</div>

					<?php
						echo "<div class='pagination'>";
						echo paginate_links( array(
							'total' => $wp_query->max_num_pages,
							'current' => max( 1, get_query_var('paged') ),
							'format' => '?paged=%#%',
							'show_all' => false,
							'type' => 'list',
							'end_size' => 2,
							'mid_size' => 1,
							'prev_next' => true,
							'prev_text' => __('« Previous'),
							'next_text' => __('Next »'),
						));
						echo "</div>";

						else :
							get_template_part( 'template-parts/content', 'none' );

						endif;
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
	</div>
</section>

<?php get_footer();