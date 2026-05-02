<?php
/*
 * Template Name: Bowls
 */
get_header(); ?>

<main>
    <section class="page-hero page-hero--bowls">
        <div class="page-hero__overlay"></div>
        <div class="page-hero__content">
            <h1>Lawn Bowls at Hexham</h1>
            <p>Social and competitive lawn bowls for players of all levels — new and visiting bowlers always welcome</p>
        </div>
    </section>

    <?php while (have_posts()) : the_post(); if (get_the_content()) : ?>
    <section class="inner-section">
        <div class="container container--narrow">
            <div class="page-content">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    <?php endif; endwhile; ?>

    <section class="bowls-groups">
        <div class="container">
            <h2>Bowls Groups</h2>
            <div class="bowls-grid">

                <div class="bowls-group-card">
                    <h3>Hexham Bowlers Club</h3>
                    <ul class="schedule-list">
                        <li>
                            <strong>Thursday — Gala</strong>
                            <span>10am (names in by 9am) — mixed draw, partner provided, lunch included</span>
                        </li>
                        <li>
                            <strong>Saturday — Nominated 3's</strong>
                            <span>12:30pm (names in by 10am) — weekly jackpot available</span>
                        </li>
                        <li>
                            <strong>Mixed Games</strong>
                            <span>1pm (names in by 10am) — draw for partners</span>
                        </li>
                        <li>
                            <strong>Pennant Season</strong>
                            <span>1pm — N.D.B.A competitive pennant competition</span>
                        </li>
                        <li>
                            <strong>Easter Bowls</strong>
                            <span>1pm (names in by 10am Saturday) — annual tournament</span>
                        </li>
                    </ul>
                    <p class="dress-note">Dress: Bowls uniform required for Thursday, Saturday &amp; Pennant. Mufti for Mixed Games &amp; Easter.</p>
                </div>

                <div class="bowls-group-card">
                    <h3>Hexham Greys</h3>
                    <ul class="schedule-list">
                        <li>
                            <strong>Sunday</strong>
                            <span>10am (names in by 9am) — draw for partner, mufti dress welcome</span>
                        </li>
                        <li>
                            <strong>Family Days</strong>
                            <span>Details announced throughout the season</span>
                        </li>
                    </ul>
                    <p class="dress-note">Dress: Mufti — no bowls uniform required.</p>
                </div>

                <div class="bowls-group-card bowls-group-card--full">
                    <h3>New &amp; Visiting Bowlers</h3>
                    <p>New players and visiting bowlers from other clubs are always welcome across all groups. No experience necessary — give us a call and come along.</p>
                    <a href="/membership" class="btn btn-outline">View Membership</a>
                </div>

            </div>
        </div>
    </section>

    <section class="bowls-events">
        <div class="container">
            <h2>Upcoming Bowls Events</h2>
            <?php
            $bowls_events = new WP_Query([
                'post_type'      => 'hbc_event',
                'posts_per_page' => 3,
                'meta_key'       => 'event_date',
                'orderby'        => 'meta_value',
                'order'          => 'ASC',
                'meta_query'     => [
                    'relation' => 'AND',
                    [
                        'relation' => 'OR',
                        [
                            'key'     => 'event_date',
                            'value'   => date('Y-m-d'),
                            'compare' => '>=',
                            'type'    => 'DATE',
                        ],
                        [
                            'relation' => 'AND',
                            ['key' => 'is_recurring', 'value' => '1', 'compare' => '='],
                            ['key' => 'recurrence_end_date', 'value' => date('Y-m-d'), 'compare' => '>=', 'type' => 'DATE'],
                        ],
                    ],
                    ['key' => 'event_type', 'value' => 'bowls', 'compare' => '='],
                ],
            ]);

            if ($bowls_events->have_posts()) : ?>
                <div class="events-archive-grid">
                    <?php while ($bowls_events->have_posts()) : $bowls_events->the_post();
                        $date       = hbc_event_display_date(get_the_ID());
                        $start_time = get_field('event_start_time');
                        $end_time   = get_field('event_end_time');
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
                                <span class="event-type event-type--bowls">Bowls</span>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php if ($time_range) : ?>
                                    <p class="event-archive-time"><?php echo esc_html($time_range); ?></p>
                                <?php endif; ?>
                                <?php the_excerpt(); ?>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php else : ?>
                <p class="no-events">No upcoming bowls events. Check back soon.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="enquiry-cta">
        <div class="container container--narrow">
            <h2>Get Involved</h2>
            <p>New to lawn bowls or looking to join a club? Give us a call — all skill levels welcome.</p>
            <div class="cta-contacts">
                <a href="<?php echo esc_attr(hbc_tel('phone_main', '0249648079')); ?>" class="btn btn-primary"><?php echo esc_html(hbc_opt('phone_main', '(02) 4964 8079')); ?></a>
                <a href="/membership" class="btn btn-outline">View Membership</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
