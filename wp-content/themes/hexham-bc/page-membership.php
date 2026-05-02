<?php
/*
 * Template Name: Membership
 */
get_header(); ?>

<main>
    <section class="page-hero page-hero--membership">
        <div class="page-hero__overlay"></div>
        <div class="page-hero__content">
        </div>
    </section>

    <section class="inner-section">
        <div class="container">
            <div class="membership-grid">
                <div class="membership-content">
                    <h2>Membership Categories</h2>
                    <p class="section-intro">All members gain access to the Ozzie Rewards Program and exclusive member benefits.</p>

                    <div class="membership-table">
                        <div class="membership-table__header">
                            <span>Category</span>
                            <span>Annual Fee</span>
                        </div>
                        <div class="membership-table__row">
                            <span class="membership-category">Full Bowling Member</span>
                            <span class="membership-price"><?php echo esc_html(hbc_opt('mbr_full', '$50.00')); ?></span>
                        </div>
                        <div class="membership-table__row">
                            <span class="membership-category">Pensioner Bowling Member</span>
                            <span class="membership-price"><?php echo esc_html(hbc_opt('mbr_pensioner', '$40.00')); ?></span>
                        </div>
                        <div class="membership-table__row">
                            <span class="membership-category">Non-Bowling Member</span>
                            <span class="membership-price"><?php echo esc_html(hbc_opt('mbr_non_bowling', '$20.00')); ?></span>
                        </div>
                        <div class="membership-table__row">
                            <span class="membership-category">Pensioner Non-Bowling</span>
                            <span class="membership-price"><?php echo esc_html(hbc_opt('mbr_pensioner_non', '$12.00')); ?></span>
                        </div>
                        <div class="membership-table__row">
                            <span class="membership-category">Junior Member</span>
                            <span class="membership-price"><?php echo esc_html(hbc_opt('mbr_junior', '$12.00')); ?></span>
                        </div>
                        <div class="membership-table__row">
                            <span class="membership-category">Social Member</span>
                            <span class="membership-price"><?php echo esc_html(hbc_opt('mbr_social', '$5.00')); ?></span>
                        </div>
                        <div class="membership-table__row membership-table__row--highlight">
                            <span class="membership-category">3-Year Membership</span>
                            <span class="membership-price"><?php echo esc_html(hbc_opt('mbr_three_year', '$12.00')); ?></span>
                        </div>
                    </div>

                    <div class="page-content" style="margin-top:2rem;">
                        <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
                    </div>
                </div>

                <aside class="membership-sidebar">
                    <div class="sidebar-card">
                        <h3>Renew Online</h3>
                        <p>Already a member? Renew your membership quickly online.</p>
                        <a href="<?php echo esc_url(hbc_opt('mbr_renew_url', 'https://hexhambowlingclub.com.au/membership-purchase/')); ?>" class="btn btn-primary" target="_blank" rel="noopener">Renew Now</a>
                    </div>
                    <div class="sidebar-card">
                        <h3>Download Form</h3>
                        <p>Complete the membership form at home and bring it to reception.</p>
                        <a href="https://hexhambowlingclub.com.au/wp-content/uploads/2023/03/Hexham-Membership-Forms.pdf" class="btn btn-outline" target="_blank" rel="noopener">Download Form</a>
                    </div>
                    <div class="sidebar-card">
                        <h3>Questions?</h3>
                        <p>Call us or visit reception at 290 Old Maitland Road, Hexham.</p>
                        <a href="<?php echo esc_attr(hbc_tel('phone_main', '0249648079')); ?>" class="btn btn-outline"><?php echo esc_html(hbc_opt('phone_main', '(02) 4964 8079')); ?></a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
