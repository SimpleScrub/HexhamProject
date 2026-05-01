<?php get_header(); ?>

<?php while (have_posts()) : the_post();
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
    $formatted_date = $date ? date('l, j F Y', strtotime($date)) : '';
    $time_range     = $start_time ? date('g:i a', strtotime($start_time)) : '';
    if ($end_time) $time_range .= ' – ' . date('g:i a', strtotime($end_time));
?>

<main>
    <section class="page-hero <?php if (has_post_thumbnail()) echo 'page-hero--has-image'; ?>"
        <?php if (has_post_thumbnail()) : ?>
            style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>');"
        <?php endif; ?>>
        <div class="page-hero__overlay"></div>
        <div class="page-hero__content">
            <?php if ($type && isset($type_labels[$type])) : ?>
                <span class="event-type event-type--<?php echo esc_attr($type); ?>"><?php echo esc_html($type_labels[$type]); ?></span>
            <?php endif; ?>
            <h1><?php the_title(); ?></h1>
            <?php if ($formatted_date) : ?>
                <p><?php echo esc_html($formatted_date); ?><?php if ($time_range) echo ' &bull; ' . esc_html($time_range); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="inner-section">
        <div class="container container--narrow">
            <a href="<?php echo esc_url(get_post_type_archive_link('hbc_event')); ?>" class="back-link">&larr; Back to What's On</a>

            <div class="event-single-meta">
                <?php if ($formatted_date) : ?>
                    <div class="event-meta-item">
                        <strong>Date</strong>
                        <span><?php echo esc_html($formatted_date); ?></span>
                    </div>
                <?php endif; ?>
                <?php if ($time_range) : ?>
                    <div class="event-meta-item">
                        <strong>Time</strong>
                        <span><?php echo esc_html($time_range); ?></span>
                    </div>
                <?php endif; ?>
                <div class="event-meta-item">
                    <strong>Venue</strong>
                    <span>Hexham Bowling Club, 290 Old Maitland Road, Hexham NSW 2322</span>
                </div>
            </div>

            <div class="page-content">
                <?php the_content(); ?>
            </div>

            <div class="event-single-cta">
                <p>Questions about this event? Give us a call.</p>
                <a href="tel:0249648079" class="btn btn-primary">(02) 4964 8079</a>
            </div>
        </div>
    </section>
</main>

<?php endwhile; ?>

<?php get_footer(); ?>
