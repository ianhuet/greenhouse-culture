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

                            <?php if (has_post_thumbnail()) : ?>
                                <div class="event-featured-image">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php endif; ?>

                            <header class="entry-header">
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                            </header>

                            <div class="event-details">
                                <?php
                                $event_date     = get_post_meta(get_the_ID(), '_event_date', true);
                                $event_time     = get_post_meta(get_the_ID(), '_event_time', true);
                                $event_location = get_post_meta(get_the_ID(), '_event_location', true);
                                ?>

                                <?php if ($event_date) : ?>
                                    <p class="event-meta event-date">
                                        <span class="dashicons dashicons-calendar-alt"></span>
                                        <?php echo date('F j, Y', strtotime($event_date)); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($event_time) : ?>
                                    <p class="event-meta event-time">
                                        <span class="dashicons dashicons-clock"></span>
                                        <?php echo date('g:i A', strtotime($event_time)); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($event_location) : ?>
                                    <p class="event-meta event-location">
                                        <span class="dashicons dashicons-location"></span>
                                        <?php echo esc_html($event_location); ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>

                            <?php
                            $event_tagline = get_post_meta(get_the_ID(), '_event_tagline', true);
                            if ($event_tagline) : ?>
                                <p class="event-tagline"><?php echo esc_html($event_tagline); ?></p>
                            <?php endif; ?>

                            <?php
                            $event_gallery = get_post_meta(get_the_ID(), '_event_gallery', true);
                            if (!is_array($event_gallery)) {
                                $event_gallery = array_filter(array_map('intval', explode(',', $event_gallery)));
                            }
                            if (!empty($event_gallery)) : ?>
                                <div class="event-gallery">
                                    <h3><?php esc_html_e('Gallery', 'greenhouseculture'); ?></h3>
                                    <div class="event-gallery-grid">
                                        <?php
                                        $row_patterns = [
                                            [25, 25, 25, 25],
                                            [25, 50, 25],
                                            [50, 25, 25],
                                            [100],
                                            [50, 50],
                                            [33, 34, 33],
                                            [25, 75],
                                        ];

                                        $i = 0;
                                        $total = count($event_gallery);

                                        foreach ($row_patterns as $row_index => $pattern) {
                                            echo '<div class="gallery-row gallery-row-' . ($row_index + 1) . '">';

                                            foreach ($pattern as $width) {
                                                if ($i >= $total) break;

                                                $attachment_id = $event_gallery[$i];
                                                if (!$attachment_id) {
                                                    $i++;
                                                    continue;
                                                }

                                                $mime = get_post_mime_type($attachment_id);

                                                echo '<div class="gallery-col" style="flex: 0 0 ' . $width . '%; max-width: ' . $width . '%;">';

                                                if (strpos($mime, 'video') === 0) {
                                                    echo '<video src="' . esc_url(wp_get_attachment_url($attachment_id)) . '" controls preload="metadata"></video>';
                                                } else {
                                                    echo wp_get_attachment_image($attachment_id, 'large');
                                                }

                                                echo '</div>';
                                                $i++;
                                            }

                                            echo '</div>';

                                            if ($i >= $total) break;
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php
                            $event_secondary = get_post_meta(get_the_ID(), '_event_secondary_content', true);
                            if ($event_secondary) : ?>
                                <div class="event-secondary-content">
                                    <?php echo wpautop(esc_html($event_secondary)); ?>
                                </div>
                            <?php endif; ?>

                            <?php
                            $event_testimonials = get_post_meta(get_the_ID(), '_event_testimonials', true);
                            if (!empty($event_testimonials) && is_array($event_testimonials)) : ?>
                                <div class="event-testimonials">
                                    <h3><?php esc_html_e('Testimonials', 'greenhouseculture'); ?></h3>
                                    <div class="testimonials-grid">
                                        <?php foreach ($event_testimonials as $testimonial) :
                                            if (empty($testimonial['quote'])) continue; ?>
                                            <blockquote class="testimonial-item">
                                                <p class="testimonial-quote">"<?php echo esc_html($testimonial['quote']); ?>"</p>
                                                <footer class="testimonial-author">
                                                    <strong class="testimonial-name"><?php echo esc_html($testimonial['name']); ?></strong>
                                                    <?php if (!empty($testimonial['role'])) : ?>
                                                        <span class="testimonial-role"> — <?php echo esc_html($testimonial['role']); ?></span>
                                                    <?php endif; ?>
                                                </footer>
                                            </blockquote>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php
                            $event_supporters = get_post_meta(get_the_ID(), '_event_supporters', true);
                            if (!is_array($event_supporters)) {
                                $event_supporters = array_filter(array_map('intval', explode(',', $event_supporters)));
                            }
                            if (!empty($event_supporters)) : ?>
                                <div class="event-supporters">
                                    <h3><?php esc_html_e('Supporters & Collaborators', 'greenhouseculture'); ?></h3>
                                    <div class="supporters-grid">
                                        <?php foreach ($event_supporters as $id) :
                                            if (!$id) continue; ?>
                                            <div class="supporter-item">
                                                <?php echo wp_get_attachment_image($id, 'medium'); ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </article>

                    <?php endwhile; ?>

                </main>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>