<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="topbar">
        <span>Club: <a href="tel:0249648079">(02) 4964 8079</a></span>
        <span>Bistro: <a href="tel:0249648350">(02) 4964 8350</a></span>
    </div>

    <div class="header-main">
        <div class="container">
            <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <?php bloginfo('name'); ?>
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
