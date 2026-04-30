<section class="events-feed">
    <div class="container">
        <h2>Upcoming Events</h2>
        <?php
        $events = new WP_Query([
            'post_type'      => 'hbc_event',
            'posts_per_page' => 4,
            'orderby'        => 'date',
            'order'          => 'ASC',
        ]);

        if ($events->have_posts()) : ?>
            <div class="events-grid">
                <?php while ($events->have_posts()) : $events->the_post(); ?>
                    <article class="event-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="event-thumb">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="event-body">
                            <time><?php echo get_the_date(); ?></time>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php the_excerpt(); ?></p>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <a href="/events" class="btn btn-outline">View All Events</a>
        <?php else : ?>
            <p>No upcoming events. Check back soon.</p>
        <?php endif; ?>
    </div>
</section>
