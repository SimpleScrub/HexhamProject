<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <?php if (!has_site_icon()) : ?>
    <link rel="icon" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.png" type="image/png">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="topbar">
        <span>Club: <a href="<?php echo esc_attr(hbc_tel('phone_main', '0249648079')); ?>"><?php echo esc_html(hbc_opt('phone_main', '(02) 4964 8079')); ?></a></span>
        <span>Bistro: <a href="<?php echo esc_attr(hbc_tel('phone_bistro', '0249648350')); ?>"><?php echo esc_html(hbc_opt('phone_bistro', '(02) 4964 8350')); ?></a></span>
    </div>

    <div class="header-main">
        <div class="container">
            <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Hexham Bowling Club logo">
                <span>Hexham Bowling Club</span>
            </a>

            <button class="nav-toggle" aria-label="Toggle navigation">
                <span></span><span></span><span></span>
            </button>

            <nav class="primary-nav">
                <?php wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'nav-menu',
                ]); ?>
            </nav>
        </div>
    </div>
</header>
