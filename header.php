<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="format-detection" content="telephone=no" />
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <?php wp_head();?>
    </head>
    <body <?php body_class(); ?>>
        <header role="banner" class="headersite" id="headersite">
            <button id="burger" class="burger" aria-label="Déplier le menu de navigation"><span>Menu</span></button>
            <div class="wrapper headersite_menu">
                <div class="headersite_logo">
                <?php if(!is_front_page()) { ?>
                    <img src="<?php bloginfo('template_directory'); ?>/assets/images/monlogo.svg" alt="Logo - <?php echo esc_html(get_bloginfo('name'));?>">
                <?php }else{ ?>
                    <a href="<?= home_url(); ?>" title="<?php echo esc_html(get_bloginfo('name'));?>- Accueil">
                        <img src="<?php bloginfo('template_directory'); ?>/assets/images/monlogo.svg" alt="">
                    </a>
                <?php } ?>
                </div>
                <nav class="mainmenu" id="site-navigation" role="navigation" aria-label="Menu de navigation principal">
                    <?php wp_nav_menu( array(
                    'theme_location' => 'main-menu',
                    'container' => '',
                    'menu_class' => '',
                    'menu_id' => '',
                    'container_id' => '',
                    'items_wrap' => '<ul>%3$s</ul>'
                    )); ?>
                </nav>
            </div>
        </header>
        <main class="site_content" role="main" id="site-main">