<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h3>Hexham Bowling Club</h3>
                <p><?php echo esc_html(hbc_opt('address_street', '290 Old Maitland Road')); ?><br><?php echo esc_html(hbc_opt('address_suburb', 'Hexham NSW 2322')); ?></p>
            </div>
            <div class="footer-col">
                <h3>Contact</h3>
                <p>Club: <a href="<?php echo esc_attr(hbc_tel('phone_main', '0249648079')); ?>"><?php echo esc_html(hbc_opt('phone_main', '(02) 4964 8079')); ?></a></p>
                <p>Bistro: <a href="<?php echo esc_attr(hbc_tel('phone_bistro', '0249648350')); ?>"><?php echo esc_html(hbc_opt('phone_bistro', '(02) 4964 8350')); ?></a></p>
                <p>Functions: <a href="mailto:<?php echo esc_attr(hbc_opt('email_events', 'events@hexhambc.com.au')); ?>"><?php echo esc_html(hbc_opt('email_events', 'events@hexhambc.com.au')); ?></a></p>
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
