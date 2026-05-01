<section class="events-feed">
    <div class="container">
        <h2>Upcoming Events</h2>
        <?php
        $events = new WP_Query([
            'post_type'      => 'hbc_event',
            'posts_per_page' => 4,
            'meta_key'       => 'event_date',
            'orderby'        => 'meta_value',
            'order'          => 'ASC',
            'meta_query'     => [
                [
                    'key'     => 'event_date',
                    'value'   => date('Y-m-d'),
                    'compare' => '>=',
                    'type'    => 'DATE',
                ],
            ],
        ]);

        if ($events->have_posts()) : ?>
            <div class="events-grid">
                <?php while ($events->have_posts()) : $events->the_post();
                    $date       = get_field('event_date');
                    $start_time = get_field('event_start_time');
                    $end_time   = get_field('event_end_time');
                    $type       = get_field('event_type');
                    $formatted_date = $date ? date('j M Y', strtotime($date)) : '';
                    $time_range = $start_time ? date('g:i a', strtotime($start_time)) : '';
                    if ($end_time) $time_range .= ' – ' . date('g:i a', strtotime($end_time));
                ?>
                    <article class="event-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="event-thumb">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="event-body">
                            <?php if ($type) : ?>
                                <span class="event-type event-type--<?php echo esc_attr($type); ?>">
                                    <?php echo esc_html(get_field_object('event_type')['choices'][$type] ?? $type); ?>
                                </span>
                            <?php endif; ?>
                            <time datetime="<?php echo esc_attr($date); ?>">
                                <?php echo esc_html($formatted_date); ?>
                                <?php if ($time_range) echo ' &bull; ' . esc_html($time_range); ?>
                            </time>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php the_excerpt(); ?></p>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <a href="/whats-on" class="btn btn-outline">View All Events</a>
        <?php else : ?>
            <p class="no-events">No upcoming events. Check back soon.</p>
        <?php endif; ?>
    </div>
</section>
