<?php
/*
 * Template Name: Functions
 */
get_header(); ?>

<main>
    <section class="page-hero page-hero--functions">
        <div class="page-hero__overlay"></div>
        <div class="page-hero__content">
            <h1>Functions &amp; Events</h1>
            <p>Weddings, conferences, birthdays, wakes and more — rooms to suit 10 to 300 people</p>
        </div>
    </section>

    <section class="inner-section">
        <div class="container container--narrow">
            <div class="page-content">
                <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
            </div>
        </div>
    </section>

    <section class="function-types">
        <div class="container">
            <h2>What We Cater For</h2>
            <div class="cards-grid">
                <div class="card">
                    <div class="card-icon">💍</div>
                    <h3>Weddings</h3>
                    <p>Celebrate your special day with customisable wedding reception packages</p>
                </div>
                <div class="card">
                    <div class="card-icon">💼</div>
                    <h3>Conferences</h3>
                    <p>Professional AV-equipped spaces for meetings and corporate events</p>
                </div>
                <div class="card">
                    <div class="card-icon">🎂</div>
                    <h3>Birthdays</h3>
                    <p>Make your milestone birthday one to remember</p>
                </div>
                <div class="card">
                    <div class="card-icon">🕊</div>
                    <h3>Wakes</h3>
                    <p>A warm and respectful space to gather and remember</p>
                </div>
            </div>
        </div>
    </section>

    <section class="room-hire">
        <div class="container">
            <h2>Room Hire</h2>
            <p class="section-intro">All rooms include complimentary projector, screen, whiteboard, flip chart, and wireless internet.</p>
            <div class="pricing-table">
                <div class="pricing-table__header">
                    <span>Room</span>
                    <span>Capacity</span>
                    <span>Half Day</span>
                    <span>Full Day</span>
                </div>
                <div class="pricing-table__row">
                    <span class="room-name">Board Room</span>
                    <span>Up to 10</span>
                    <span>$70</span>
                    <span>$120</span>
                </div>
                <div class="pricing-table__row">
                    <span class="room-name">Heritage Room</span>
                    <span>Up to 50</span>
                    <span>$100</span>
                    <span>$180</span>
                </div>
                <div class="pricing-table__row">
                    <span class="room-name">Auditorium</span>
                    <span>Up to 200</span>
                    <span>$150</span>
                    <span>$250</span>
                </div>
                <div class="pricing-table__row pricing-table__row--highlight">
                    <span class="room-name">Wedding Auditorium</span>
                    <span>Up to 300</span>
                    <span colspan="2">$400 hire</span>
                </div>
            </div>
        </div>
    </section>

    <section class="catering-section">
        <div class="container">
            <div class="catering-grid">
                <div class="catering-content">
                    <h2>Catering Options</h2>
                    <ul class="amenities-list">
                        <li>Bottomless tea &amp; coffee</li>
                        <li>Beverages with refreshments</li>
                        <li>Sandwich platters</li>
                        <li>Hot meal selections</li>
                    </ul>
                </div>
                <div class="catering-content">
                    <h2>AV &amp; Equipment</h2>
                    <ul class="amenities-list">
                        <li>Complimentary data projector</li>
                        <li>Projection screen</li>
                        <li>Whiteboard &amp; flip chart</li>
                        <li>Audio equipment</li>
                        <li>Wireless internet</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="wedding-cta">
        <div class="container container--narrow">
            <h2>Wedding Packages</h2>
            <p>Customisable wedding reception packages available. Download our wedding package guide or contact us to discuss your requirements.</p>
            <div class="cta-contacts">
                <a href="#" class="btn btn-primary">Download Wedding Package</a>
                <a href="tel:0249648079" class="btn btn-outline">(02) 4964 8079</a>
                <a href="mailto:events@hexhambc.com.au" class="btn btn-outline">events@hexhambc.com.au</a>
            </div>
            <p class="contact-barb">Ask for <strong>Barb</strong> for all functions enquiries</p>
        </div>
    </section>
</main>

<?php get_footer(); ?>
