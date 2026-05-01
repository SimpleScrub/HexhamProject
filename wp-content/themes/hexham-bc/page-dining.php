<?php
/*
 * Template Name: Dining
 */
get_header(); ?>

<main>
    <section class="page-hero page-hero--dining">
        <div class="page-hero__overlay"></div>
        <div class="page-hero__content">
            <h1>The Riverside Bistro</h1>
            <p>The best Asian and Malaysian cuisine in Newcastle — open 7 days</p>
        </div>
    </section>

    <section class="dining-intro">
        <div class="container container--narrow">
            <div class="dining-intro__content">
                <h2>Asian &amp; Malaysian Cuisine</h2>
                <p>The Riverside Bistro at Hexham Bowling Club serves what many consider the best Asian and Malaysian cuisine in Newcastle. Dine in a relaxed, welcoming atmosphere right at 290 Old Maitland Road, Hexham.</p>
                <p>Open 7 days a week. Please contact the club to confirm availability on public holidays.</p>
                <div class="dining-intro__ctas">
                    <a href="tel:0249648350" class="btn btn-primary">Book a Table — (02) 4964 8350</a>
                    <a href="#" class="btn btn-outline">Download Menu (PDF)</a>
                </div>
            </div>
            <div class="page-content" style="margin-top:2rem;">
                <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
            </div>
        </div>
    </section>

    <section class="info-blocks">
        <div class="container">
            <div class="info-grid">
                <div class="info-block">
                    <h3>Opening Hours</h3>
                    <p>Open 7 days a week.</p>
                    <p class="hours-note">Contact us to confirm hours on public holidays.</p>
                    <a href="tel:0249648079" class="btn btn-outline">(02) 4964 8079</a>
                </div>
                <div class="info-block">
                    <h3>Reservations</h3>
                    <p>Book a table at the Riverside Bistro — call the bistro direct.</p>
                    <a href="tel:0249648350" class="btn btn-primary">(02) 4964 8350</a>
                </div>
                <div class="info-block">
                    <h3>Functions &amp; Private Dining</h3>
                    <p>Hosting a group or private event? We cater for all sizes.</p>
                    <a href="/functions" class="btn btn-outline">View Functions</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
