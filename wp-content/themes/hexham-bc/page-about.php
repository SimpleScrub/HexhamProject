<?php
/*
 * Template Name: About
 */
get_header(); ?>

<main>
    <section class="page-hero page-hero--about">
        <div class="page-hero__overlay"></div>
        <div class="page-hero__content">
            <h1>About Hexham Bowling Club</h1>
            <p>A proud part of the Hexham community</p>
        </div>
    </section>

    <section class="about-intro inner-section">
        <div class="container container--narrow">
            <div class="about-intro__text">
                <h2>Welcome to Hexham Bowling Club</h2>
                <p>Hexham Bowling Club is one of the Hunter region's best-loved registered clubs, nestled in the heart of Hexham, NSW. We're a community club through and through — offering great food, live entertainment, social and competitive bowls, and a place where locals have gathered for generations.</p>
                <p>From our award-winning Riverside Bistro to our holiday cottages on the mid-north coast, we're proud to offer something for every member of the family. Whether you're here for a game of bowls, a meal out, or a function, you'll always find a warm welcome.</p>
            </div>
        </div>
    </section>

    <section class="about-ossie">
        <div class="container">
            <div class="about-ossie__grid">
                <div class="about-ossie__content">
                    <span class="about-ossie__tag">Our Mascot</span>
                    <h2>Meet Ossie the Mossie</h2>
                    <p>Standing proud at 3.5 metres tall at the corner of the Pacific Highway and Old Maitland Road, <strong>Ossie the Mossie</strong> is one of the Hunter's most iconic roadside landmarks — and the face of Hexham Bowling Club.</p>
                    <p>Ossie was built in 1994 at a cost of <strong>$17,200</strong>, funded entirely by club members. He was officially unveiled on <strong>10 March 1994</strong> by the then Lord Mayor of Newcastle, Councillor John McNaughton, alongside club chairman Jim Mehan.</p>
                    <p>Ossie represents the <em>Hexham Grey</em> (<em>Aedes alternans</em>) — a large, locally famous mosquito species native to the Hexham wetlands. The Hexham Grey is known for its size and has even inspired poetry, travel features, and a place on multiple "Top 20 Big Things in Australia" lists.</p>
                    <p>In 2010, Ossie received a makeover during the Pacific Highway widening — gaining glowing green eyes, a red belly, and a neon nose. In March 2015, the club celebrated Ossie's 21st birthday in style.</p>
                    <p>Our seniors bowls group, <strong>The Hexham Greys</strong>, is named in Ossie's honour.</p>
                </div>
                <div class="about-ossie__aside">
                    <div class="ossie-fact-card">
                        <div class="ossie-fact">
                            <span class="ossie-fact__num">3.5m</span>
                            <span class="ossie-fact__label">Tall</span>
                        </div>
                        <div class="ossie-fact">
                            <span class="ossie-fact__num">1994</span>
                            <span class="ossie-fact__label">Unveiled</span>
                        </div>
                        <div class="ossie-fact">
                            <span class="ossie-fact__num">$17,200</span>
                            <span class="ossie-fact__label">Built by members</span>
                        </div>
                        <div class="ossie-fact">
                            <span class="ossie-fact__num">Top 20</span>
                            <span class="ossie-fact__label">Big Things in Australia</span>
                        </div>
                    </div>
                    <p class="ossie-quote">"Ossie has become a beloved symbol not just of the club, but of Hexham itself."</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about-community inner-section">
        <div class="container container--narrow">
            <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
            <div class="about-cta">
                <h2>Join the Club</h2>
                <p>Membership starts from just $5 per year for social members. Become part of a club that's been at the heart of Hexham for generations.</p>
                <a href="/membership" class="btn btn-primary">View Membership Options</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
