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
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            $upcoming_events = new WP_Query(array(
                                'post_type' => 'event',
                                'posts_per_page' => 10,
                                'paged' => $paged,
                                'meta_key' => '_event_date',
                                'orderby' => 'meta_value',
                                'order' => 'ASC',
                                'meta_query' => array(
                                    array(
                                        'key' => '_event_date',
                                        'value' => date('Y-m-d'),
                                        'compare' => '>='
                                    )
                                )
                            ));

                            if ($upcoming_events->have_posts()) :
                                while ($upcoming_events->have_posts()) : $upcoming_events->the_post();
                                    get_template_part('template-parts/content', 'event');
                                endwhile;

                                if ($upcoming_events->max_num_pages > 1) :
                                    echo '<div class="pagination-upcoming">';
                                    echo paginate_links(array(
                                        'total' => $upcoming_events->max_num_pages,
                                        'current' => $paged,
                                        'format' => '?paged=%#%',
                                        'prev_text' => '‹ Previous',
                                        'next_text' => 'Next ›'
                                    ));
                                    echo '</div>';
                                endif;
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
                            $past_paged = (get_query_var('past_paged')) ? get_query_var('past_paged') : 1;
                            $past_events = new WP_Query(array(
                                'post_type' => 'event',
                                'posts_per_page' => 9,
                                'paged' => $past_paged,
                                'meta_key' => '_event_date',
                                'orderby' => 'meta_value',
                                'order' => 'DESC',
                                'meta_query' => array(
                                    array(
                                        'key' => '_event_date',
                                        'value' => date('Y-m-d'),
                                        'compare' => '<'
                                    )
                                )
                            ));

                            if ($past_events->have_posts()) :
                                while ($past_events->have_posts()) : $past_events->the_post();
                                    get_template_part('template-parts/content', 'event');
                                endwhile;

                                if ($past_events->max_num_pages > 1) :
                                    echo '<div class="pagination-past">';
                                    echo paginate_links(array(
                                        'total' => $past_events->max_num_pages,
                                        'current' => $past_paged,
                                        'format' => '?past_paged=%#%',
                                        'prev_text' => '‹ Previous',
                                        'next_text' => 'Next ›'
                                    ));
                                    echo '</div>';
                                endif;
                            else :
                                echo '<p>No past events found.</p>';
                            endif;
                            wp_reset_postdata();
                            ?>
                        </div>

                    </section>

                </main>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>