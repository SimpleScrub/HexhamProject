<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h3>Hexham Bowling Club</h3>
                <p>290 Old Maitland Road<br>Hexham NSW 2322</p>
            </div>
            <div class="footer-col">
                <h3>Contact</h3>
                <p>Club: <a href="tel:0249648079">(02) 4964 8079</a></p>
                <p>Bistro: <a href="tel:0249648350">(02) 4964 8350</a></p>
                <p>Functions: <a href="mailto:events@hexhambc.com.au">events@hexhambc.com.au</a></p>
            </div>
            <div class="footer-col">
                <h3>Quick Links</h3>
                <?php wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'footer-menu',
                    'depth'          => 1,
                ]); ?>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Hexham Bowling Club. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
