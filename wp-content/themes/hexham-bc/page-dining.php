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
                    <a href="https://hexhambowlingclub.com.au/wp-content/uploads/2025/12/Riverside-Bistro-Menu-Dec-2025.pdf" class="btn btn-outline" target="_blank" rel="noopener">Download Menu (PDF)</a>
                </div>
            </div>
            <div class="page-content" style="margin-top:2rem;">
                <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
            </div>
        </div>
    </section>

    <section class="menu-samples">
        <div class="container">
            <h2>Menu Highlights</h2>
            <p>A taste of what's on offer at the Riverside Bistro — full menu available to download.</p>
            <div class="menu-samples-grid">

                <div class="menu-category">
                    <div class="menu-category__header">Entrees</div>
                    <ul class="menu-category__items">
                        <li><span class="menu-item-name">Spring Rolls (4 pcs)</span><span class="menu-item-price">$10.50</span></li>
                        <li><span class="menu-item-name">Satay Chicken Skewers</span><span class="menu-item-price">$13.00</span></li>
                        <li><span class="menu-item-name">Prawn Crackers</span><span class="menu-item-price">$7.00</span></li>
                        <li><span class="menu-item-name">Dim Sims (Steamed or Fried)</span><span class="menu-item-price">$9.50</span></li>
                        <li><span class="menu-item-name">Soup of the Day</span><span class="menu-item-price">$9.00</span></li>
                    </ul>
                </div>

                <div class="menu-category">
                    <div class="menu-category__header">Mains</div>
                    <ul class="menu-category__items">
                        <li><span class="menu-item-name">Nasi Goreng</span><span class="menu-item-price">$19.50</span></li>
                        <li><span class="menu-item-name">Laksa (Chicken or Seafood)</span><span class="menu-item-price">$21.00</span></li>
                        <li><span class="menu-item-name">Beef Rendang</span><span class="menu-item-price">$22.50</span></li>
                        <li><span class="menu-item-name">Char Kway Teow</span><span class="menu-item-price">$20.00</span></li>
                        <li><span class="menu-item-name">Sweet &amp; Sour Pork</span><span class="menu-item-price">$20.50</span></li>
                        <li><span class="menu-item-name">Hainanese Chicken Rice</span><span class="menu-item-price">$21.00</span></li>
                    </ul>
                </div>

                <div class="menu-category">
                    <div class="menu-category__header">Desserts &amp; Drinks</div>
                    <ul class="menu-category__items">
                        <li><span class="menu-item-name">Mango Pudding</span><span class="menu-item-price">$9.00</span></li>
                        <li><span class="menu-item-name">Fried Ice Cream</span><span class="menu-item-price">$10.00</span></li>
                        <li><span class="menu-item-name">Teh Tarik (Pulled Tea)</span><span class="menu-item-price">$5.00</span></li>
                        <li><span class="menu-item-name">Soft Drinks</span><span class="menu-item-price">$4.00</span></li>
                        <li><span class="menu-item-name">Milo Dinosaur</span><span class="menu-item-price">$6.00</span></li>
                    </ul>
                </div>

            </div>
            <p class="menu-note">Prices and availability subject to change. Download the full menu or call the bistro to confirm current offerings.</p>
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
