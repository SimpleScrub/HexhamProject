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

    <section class="inner-section">
        <div class="container container--narrow">
            <div class="page-content">
                <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
            </div>
        </div>
    </section>

    <section class="bowls-groups">
        <div class="container">
            <h2>Bowls Groups</h2>
            <div class="bowls-grid">

                <div class="bowls-group-card">
                    <h3>Hexham Bowlers Club</h3>
                    <ul class="schedule-list">
                        <li>
                            <strong>Thursday</strong>
                            <span>Gala games — mixed draw, partner provided, lunch included</span>
                        </li>
                        <li>
                            <strong>Saturday</strong>
                            <span>Afternoon nominated 3's — weekly jackpot available</span>
                        </li>
                        <li>
                            <strong>Pennant Season</strong>
                            <span>N.D.B.A competitive pennant competition</span>
                        </li>
                        <li>
                            <strong>Easter</strong>
                            <span>Annual Easter Bowls tournament</span>
                        </li>
                    </ul>
                    <p class="dress-note">Dress: Bowls uniform required for pennant. Smart casual for social games.</p>
                </div>

                <div class="bowls-group-card">
                    <h3>Hexham Greys</h3>
                    <ul class="schedule-list">
                        <li>
                            <strong>Sunday Morning</strong>
                            <span>Casual draw-for-partner games — mufti (casual) dress welcome</span>
                        </li>
                        <li>
                            <strong>Family Days</strong>
                            <span>Details announced throughout the season</span>
                        </li>
                    </ul>
                    <p class="dress-note">Dress: Casual — no bowls uniform required.</p>
                </div>

                <div class="bowls-group-card bowls-group-card--full">
                    <h3>Mixed Draw &amp; Social Bowls</h3>
                    <p>Open mixed draw games run regularly throughout the season. New players and visiting bowlers from other clubs are warmly welcomed — no experience necessary.</p>
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
                        'key'     => 'event_date',
                        'value'   => date('Y-m-d'),
                        'compare' => '>=',
                        'type'    => 'DATE',
                    ],
                    [
                        'key'     => 'event_type',
                        'value'   => 'bowls',
                        'compare' => '=',
                    ],
                ],
            ]);

            if ($bowls_events->have_posts()) : ?>
                <div class="events-archive-grid">
                    <?php while ($bowls_events->have_posts()) : $bowls_events->the_post();
                        $date       = get_field('event_date');
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
                <a href="tel:0249648079" class="btn btn-primary">(02) 4964 8079</a>
                <a href="/membership" class="btn btn-outline">View Membership</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
