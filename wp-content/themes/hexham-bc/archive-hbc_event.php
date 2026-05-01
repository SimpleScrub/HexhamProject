<?php get_header(); ?>

<main>
    <section class="page-hero">
        <div class="page-hero__overlay"></div>
        <div class="page-hero__content">
            <h1>What's On</h1>
            <p>Upcoming entertainment, events and activities at Hexham Bowling Club</p>
        </div>
    </section>

    <section class="inner-section">
        <div class="container">

            <div class="events-filter">
                <?php
                $types = [
                    ''            => 'All Events',
                    'live_music'  => 'Live Music',
                    'raffle'      => 'Raffles',
                    'promotion'   => 'Promotions',
                    'bowls'       => 'Bowls',
                    'other'       => 'Other',
                ];
                $active = isset($_GET['type']) ? sanitize_key($_GET['type']) : '';
                foreach ($types as $val => $label) :
                    $class = ($active === $val) ? 'filter-btn filter-btn--active' : 'filter-btn';
                    $url   = $val ? add_query_arg('type', $val) : remove_query_arg('type');
                ?>
                    <a href="<?php echo esc_url($url); ?>" class="<?php echo $class; ?>"><?php echo esc_html($label); ?></a>
                <?php endforeach; ?>
            </div>

            <?php
            $meta_query = [
                [
                    'key'     => 'event_date',
                    'value'   => date('Y-m-d'),
                    'compare' => '>=',
                    'type'    => 'DATE',
                ],
            ];

            if ($active) {
                $meta_query[] = [
                    'key'     => 'event_type',
                    'value'   => $active,
                    'compare' => '=',
                ];
                $meta_query['relation'] = 'AND';
            }

            $events = new WP_Query([
                'post_type'      => 'hbc_event',
                'posts_per_page' => 12,
                'meta_key'       => 'event_date',
                'orderby'        => 'meta_value',
                'order'          => 'ASC',
                'meta_query'     => $meta_query,
            ]);
            ?>

            <?php if ($events->have_posts()) : ?>
                <div class="events-archive-grid">
                    <?php while ($events->have_posts()) : $events->the_post();
                        $date       = get_field('event_date');
                        $start_time = get_field('event_start_time');
                        $end_time   = get_field('event_end_time');
                        $type       = get_field('event_type');
                        $type_labels = [
                            'live_music' => 'Live Music',
                            'raffle'     => 'Raffle',
                            'promotion'  => 'Promotion',
                            'bowls'      => 'Bowls',
                            'other'      => 'Other',
                        ];
                        $day        = $date ? date('j', strtotime($date)) : '';
                        $month      = $date ? date('M', strtotime($date)) : '';
                        $time_range = $start_time ? date('g:i a', strtotime($start_time)) : '';
                        if ($end_time) $time_range .= ' – ' . date('g:i a', strtotime($end_time));
                    ?>
                        <article class="event-archive-card">
                            <div class="event-archive-date">
                                <span class="event-archive-date__day"><?php echo esc_html($day); ?></span>
                                <span class="event-archive-date__month"><?php echo esc_html($month); ?></span>
                            </div>
                            <div class="event-archive-body">
                                <?php if ($type && isset($type_labels[$type])) : ?>
                                    <span class="event-type event-type--<?php echo esc_attr($type); ?>"><?php echo esc_html($type_labels[$type]); ?></span>
                                <?php endif; ?>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php if ($time_range) : ?>
                                    <p class="event-archive-time"><?php echo esc_html($time_range); ?></p>
                                <?php endif; ?>
                                <?php the_excerpt(); ?>
                            </div>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="event-archive-thumb">
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                                </div>
                            <?php endif; ?>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <?php if ($events->max_num_pages > 1) : ?>
                    <div class="pagination">
                        <?php echo paginate_links(['total' => $events->max_num_pages]); ?>
                    </div>
                <?php endif; ?>

            <?php else : ?>
                <p class="no-events">No upcoming events found. Check back soon.</p>
            <?php endif; ?>

        </div>
    </section>
</main>

<?php get_footer(); ?>
