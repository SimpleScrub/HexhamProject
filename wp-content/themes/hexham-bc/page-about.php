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

    <section class="inner-section">
        <div class="container container--narrow">
            <div class="page-content">
                <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
