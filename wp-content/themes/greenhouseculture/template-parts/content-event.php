<?php
/**
 * Template part for displaying events
 *
 * @package Greenhouseculture
 */

$event_date = get_post_meta(get_the_ID(), '_event_date', true);
$event_time = get_post_meta(get_the_ID(), '_event_time', true);
$event_location = get_post_meta(get_the_ID(), '_event_location', true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('event-item'); ?>>
    
    <?php if (has_post_thumbnail()) : ?>
        <div class="event-thumbnail">
            <?php the_post_thumbnail('greenhouseculture-related-size'); ?>
        </div>
    <?php endif; ?>

    <div class="event-content">
        <header class="entry-header">
            <h3 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
        </header>

        <div class="event-meta">
            <?php if ($event_date) : ?>
                <span class="event-date">
                    <strong>Date:</strong> <?php echo date('F j, Y', strtotime($event_date)); ?>
                </span>
            <?php endif; ?>
            
            <?php if ($event_time) : ?>
                <span class="event-time">
                    <strong>Time:</strong> <?php echo date('g:i A', strtotime($event_time)); ?>
                </span>
            <?php endif; ?>
            
            <?php if ($event_location) : ?>
                <span class="event-location">
                    <strong>Location:</strong> <?php echo esc_html($event_location); ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="entry-content">
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>" class="read-more">Learn More</a>
        </div>
    </div>

</article>