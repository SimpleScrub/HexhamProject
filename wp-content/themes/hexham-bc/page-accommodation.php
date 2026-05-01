<?php
/*
 * Template Name: Accommodation
 */
get_header(); ?>

<main>
    <section class="page-hero page-hero--accommodation">
        <div class="page-hero__overlay"></div>
        <div class="page-hero__content">
            <h1>Member Accommodation</h1>
            <p>Club cottages at Harrington — a lovely coastal retreat for Hexham BC members</p>
        </div>
    </section>

    <section class="inner-section">
        <div class="container container--narrow">
            <div class="page-content">
                <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
            </div>
        </div>
    </section>

    <section class="accom-overview">
        <div class="container">
            <div class="accom-intro">
                <h2>Hexham Cottages at Harrington</h2>
                <p>Four individual holiday units owned by the club, available primarily for members. Located in Harrington — a beautiful coastal tourist destination on the mid-north coast of NSW.</p>
            </div>

            <div class="accom-details-grid">
                <div class="accom-card">
                    <h3>The Cottages</h3>
                    <ul class="amenities-list">
                        <li>4 individual self-contained units</li>
                        <li>2 bedrooms per unit</li>
                        <li>1 double bed + 1 single bed per bedroom</li>
                        <li>Wheelchair accessible (Unit 3 has disabled shower)</li>
                        <li>Shared laundry facilities</li>
                    </ul>
                </div>

                <div class="accom-card">
                    <h3>What's Included</h3>
                    <ul class="amenities-list">
                        <li>Quilts, blankets &amp; pillows</li>
                        <li>Cooking utensils</li>
                        <li>Microwave</li>
                        <li>Heaters &amp; air conditioning</li>
                        <li>Television</li>
                    </ul>
                </div>

                <div class="accom-card accom-card--warning">
                    <h3>Please Bring Your Own</h3>
                    <ul class="amenities-list">
                        <li>Sheets &amp; pillowcases</li>
                        <li>Towels &amp; washcloths</li>
                        <li>Food &amp; groceries</li>
                        <li>Toilet paper</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="accom-pricing">
        <div class="container">
            <h2>Pricing</h2>
            <p class="section-intro">Active members are those who visit the club 4 or more times per year.</p>
            <div class="pricing-table">
                <div class="pricing-table__header">
                    <span>Member Type</span>
                    <span>Peak Season <small>(Nov 1 – Apr 30)</small></span>
                    <span>Off-Peak Season</span>
                </div>
                <div class="pricing-table__row">
                    <span class="room-name">Active Member</span>
                    <span>$550 / week</span>
                    <span>$425 / week</span>
                </div>
                <div class="pricing-table__row">
                    <span class="room-name">Non-Active Member</span>
                    <span>$650 / week</span>
                    <span>$525 / week</span>
                </div>
            </div>
            <p class="pricing-note">Non-active member rates are $100 per week above active member rates.</p>
        </div>
    </section>

    <section class="accom-booking">
        <div class="container container--narrow">
            <h2>Book a Cottage</h2>
            <p>To make a booking or enquiry, email us directly. A conditions of hire document is available to download before your stay.</p>
            <div class="cta-contacts">
                <a href="mailto:accommodation@hexhambc.com.au" class="btn btn-primary">accommodation@hexhambc.com.au</a>
                <a href="#" class="btn btn-outline">Download Conditions of Hire</a>
            </div>
            <p class="contact-barb">Available to members only. Contact the club office for eligibility queries: <a href="tel:0249648079">(02) 4964 8079</a></p>
        </div>
    </section>
</main>

<?php get_footer(); ?>
