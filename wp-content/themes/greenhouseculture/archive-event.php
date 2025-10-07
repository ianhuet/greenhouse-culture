<?php

/**
 * The template for displaying event archives
 *
 * @package Greenhouseculture
 */

get_header();
?>

<section id="content" class="site-content posts-container">
    <div class="container">
        <div class="row">
            <div class="breadcrumbs-wrap">
                <?php do_action('greenhouseculture_breadcrumb_options_hook'); ?>
            </div>
            <div id="primary" class="col-md-12 content-area">
                <main id="main" class="site-main">

                    <header class="page-header">
                        <h1 class="page-title">Events</h1>
                    </header>

                    <!-- Upcoming Events -->
                    <section class="upcoming-events">
                        <h2>Upcoming Events</h2>
                        <div class="event-grid">
                            <?php
                            $upcoming_events = new WP_Query(array(
                                'meta_key' => '_event_date',
                                'meta_query' => array(
                                    array(
                                        'compare' => '>=',
                                        'key' => '_event_date',
                                        'value' => date('Y-m-d')
                                    )
                                ),
                                'orderby' => 'meta_value',
                                'order' => 'ASC',
                                'post_type' => 'event',
                                'posts_per_page' => -1,
                            ));

                            if ($upcoming_events->have_posts()) :
                                while ($upcoming_events->have_posts()) : $upcoming_events->the_post();
                                    get_template_part('template-parts/content', 'event');
                                endwhile;
                            else :
                                echo '<p>No upcoming events found.</p>';
                            endif;

                            wp_reset_postdata();
                            ?>
                        </div>
                    </section>

                    <!-- Past Events -->
                    <section class="past-events">
                        <h2>Past Events</h2>
                        <div class="past-events-grid">
                            <?php
                            $page_num = (get_query_var('page_num')) ? get_query_var('page_num') : 1;

                            // Get all past events
                            $all_past_events = get_posts(array(
                                'meta_key' => '_event_date',
                                'meta_query' => array(
                                    array(
                                        'compare' => '<',
                                        'key' => '_event_date',
                                        'type' => 'CHAR',
                                        'value' => date('Y-m-d'),
                                    )
                                ),
                                'numberposts' => -1,
                                'order' => 'DESC',
                                'orderby' => 'meta_value',
                                'post_type' => 'event',
                                'suppress_filters' => true,
                            ));

                            // manual pagination
                            $posts_per_page = 6;
                            $total_posts = count($all_past_events);
                            $max_pages = ceil($total_posts / $posts_per_page);
                            $offset = ($page_num - 1) * $posts_per_page;
                            $current_page_events = array_slice($all_past_events, $offset, $posts_per_page);

                            if ($total_posts > 0) {
                                foreach ($current_page_events as $event_post) {
                                    $post = get_post($event_post->ID);
                                    setup_postdata($post);
                                    get_template_part("template-parts/content", "event");
                                }
                            } else {
                                echo "<p>No past events found.</p>";
                            }

                            wp_reset_postdata();

                            // pagination links 
                            if ($max_pages > 1) {
                                echo '<div class="pagination-past">';
                                echo paginate_links(array(
                                    'current' => $page_num,
                                    'end_size' => 1,
                                    'format' => '?page_num=%#%',
                                    'mid_size' => 1,
                                    'next_text' => 'Next ›',
                                    'prev_text' => '‹ Previous',
                                    'show_all' => false,
                                    'total' => $max_pages,
                                ));
                                echo '</div>';
                            }
                            ?>
                        </div>

                    </section>

                </main>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>