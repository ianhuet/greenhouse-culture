<?php

/**
 * Template part for displaying events
 *
 * @package Greenhouseculture
 */

$event_date = get_post_meta(get_the_ID(), '_event_date', true);
$event_time = get_post_meta(get_the_ID(), '_event_time', true);
$event_location = get_post_meta(get_the_ID(), '_event_location', true);

// determine if upcoming or past
$is_upcoming = strtotime($event_date) >= strtotime(date('Y-m-d'));
?>


<article id="post-<?php the_ID(); ?>"
    <?php post_class($is_upcoming ? 'event-item upcoming-event-item' : 'event-item past-event-item'); ?>
    onclick="window.location='<?php the_permalink() ?>'">


    <?php if (has_post_thumbnail()) : ?>
        <div class="event-thumbnail <?php echo $is_upcoming ? 'upcoming-thumbnail' : 'past-thumbnail' ?><?php echo !has_post_thumbnail() ? ' no-thumbnail' : '' ?>">
            <?php the_post_thumbnail('greenhouseculture-related-size'); ?>
        </div>
    <?php endif; ?>

    <div class="event-content <?php echo $is_upcoming ? 'upcoming-content' : 'past-content' ?>">
        <div class="event-meta <?php echo $is_upcoming ? 'upcoming-event-meta' : 'past-event-meta'; ?>">
            <div class="event-schedule <?php echo $is_upcoming ? 'upcoming-event-schedule' : 'past-event-schedule'; ?>">

                <!-- always visible -->
                <header class="entry-header">
                    <h3 class="entry-title <?php echo $is_upcoming ? 'upcoming-entry-title' : 'past-entry-title' ?>">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                </header>

                <!-- Only show this event date for past dates -->
                <?php if (!$is_upcoming && $event_date) : ?>
                    <span class="event-date past-event-date">
                        <?php echo date('M j, Y', strtotime($event_date)); ?>
                    </span>
                <?php endif; ?>

                <?php if ($is_upcoming) : ?>
                    <div class="upcoming-event-time-and-location">

                        <!-- only show this date for upcoming events -->
                        <?php if ($is_upcoming && $event_date) : ?>
                            <span class="event-date">
                                <span class="dashicons dashicons-calendar-alt"></span>
                                <?php echo date('M j, Y', strtotime($event_date)); ?>
                            </span>
                        <?php endif; ?>

                        <!-- only show time for upcoming -->
                        <?php if ($event_time) : ?>
                            <span class="event-time">
                                <span class="dashicons dashicons-clock"></span>
                                <?php echo date('g:i A', strtotime($event_time)); ?>
                            </span>
                        <?php endif; ?>

                        <!-- Location always visible if present -->
                        <?php if ($event_location) : ?>
                            <span class="event-location">
                                <?php if ($is_upcoming) : ?>
                                    <span class="dashicons dashicons-location"></span>
                                <?php endif; ?>
                                <?php echo esc_html($event_location); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- only shows for upcoming event / checks if event has excerpt or content --->
                <?php if ($is_upcoming && (has_excerpt() || !empty(get_the_content()))) : ?>
                    <div class="event-excerpt upcoming-event-excerpt">
                        <?php if (has_excerpt()) {
                            echo wp_trim_words(get_the_excerpt(), 15, '...');
                        } else {
                            echo wp_trim_words(get_the_content(), 15, '...');
                        } ?>
                    </div>
                <?php endif; ?>

                <?php if ($event_location && !$is_upcoming) : ?>
                    <span class="event-location">
                        <?php if ($is_upcoming) : ?>
                            <span class="dashicons dashicons-location"></span>
                        <?php endif; ?>
                        <?php echo esc_html($event_location); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>

    </div>

</article>