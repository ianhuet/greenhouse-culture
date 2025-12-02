<?php

/**
 * The template for displaying single events
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

                    <?php while (have_posts()) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <header class="entry-header">
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                            </header>

                            <?php if (has_post_thumbnail()) : ?>
                                <div class="event-featured-image">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="event-details">
                                <?php
                                $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                                $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                                $event_location = get_post_meta(get_the_ID(), '_event_location', true);
                                ?>

                                <?php if ($event_date) : ?>
                                    <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event_date)); ?></p>
                                <?php endif; ?>

                                <?php if ($event_time) : ?>
                                    <p><strong>Time:</strong> <?php echo date('g:i A', strtotime($event_time)); ?></p>
                                <?php endif; ?>

                                <?php if ($event_location) : ?>
                                    <p><strong>Location:</strong> <?php echo esc_html($event_location); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>

                        </article>

                    <?php endwhile; ?>

                </main>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>