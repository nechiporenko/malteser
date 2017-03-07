<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <title><?php echo wp_get_document_title(); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <script>
        (function () {
            if (sessionStorage.font_GOS) {
                document.documentElement.classList.add('wf-active');
            }
        })();
    </script>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/app.head.min.css?ver=0.0.1">
    <?php /* <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/app.min.css?ver=0.1.9"> */?>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->
    <link rel="canonical" href="<?php 
        $domain = "http://".$_SERVER['HTTP_HOST']."/";
        $uri = explode('/', $_SERVER['REQUEST_URI']); 
		$result = count($uri); 
		echo $domain;
		for ($i=0; $i<$result; $i++) {
			if ($uri[$i]) {
				if ($uri[$i]!="page") {
					$element = preg_match("/(.*).html/",$uri[$i]);
					if ($element) {
						echo $uri[$i];
					} else {
						echo $uri[$i]."/";
					}
				} else {
					break;
				}
			}
		}           
	?>" />	
	<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/img/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php bloginfo('template_directory'); ?>/img/favicons/manifest.json">
	<link rel="mask-icon" href="<?php bloginfo('template_directory'); ?>/img/favicons/safari-pinned-tab.svg">
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favicons/favicon.ico">
	<meta name="msapplication-config" content="<?php bloginfo('template_directory'); ?>/img/favicons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
    <?php
		wp_deregister_script( 'jquery' );
        wp_head();
    ?>
</head>
<body class="page <?php if( is_front_page() ) { echo 'page--home'; } ?>">
    <!--HEADER-->
    <header class="b-header">
        <div class="b-header__top">
            <div class="g-container">
                <!--lang switcher-->              
                <ul class="h-lang">
				<?php
					$langs = pll_the_languages( array( 'raw' => 1) );
					foreach ($langs as $lang){
				?>
					<li class="h-lang__item <?php if ($lang['current_lang']) { echo 'h-lang__item--active'; } ?>">
					<?php if( $lang['current_lang'] ) { ?>
						<span class="h-lang__link"><?php echo $lang['slug']; ?></span>
					<?php } else { ?>
						<a href="<?php echo $lang['url']; ?>" class="h-lang__link" hreflang="<?php echo $lang['slug']; ?>"><?php echo $lang['slug']; ?></a>
					<?php } ?>
					</li>
				<?php
					} //end foreach
                ?>
                </ul>
                <!--/lang switcher-->
                <!--search form-->
                <?php get_search_form(); ?>
                <!--/search form-->
                <!--header action list-->
                <ul class="h-action">
                    <li class="h-action__item">
                        <a href="tel:+380442273728" class="h-action__link">
                            <span class="h-action__icon">
                                <i class="icon-phone"></i>
                            </span>
                            (044) 227-37-28
                        </a>
                    </li>
                    <li class="h-action__item">
					<?php
						$order_link = '/order/';
						$help_link = '/help-us/';
						if ( pll_current_language() != 'uk' ){ 
							$order_link = '/pl/zamowienie-uslugi/';
							$help_link = '/pl/pomoz-nam/';
						}
						
						if ( is_page_template('tmpl-order.php') ) {
					?>
						<span class="h-action__link h-action__link--current">
					<?php } else { ?>
						<a href="<?php echo $order_link; ?>" class="h-action__link">
					<?php } ?>
                            <span class="h-action__icon">
                                <i class="icon-heart"></i>
                            </span>
                            <?php pll_e( 'Order services' ); ?>
                    <?php if ( is_page_template('tmpl-order.php') ) { ?>
						</span>
					<?php } else { ?>
						</a>
					<?php } ?>
                    </li>
                    <li class="h-action__item">
					<?php if ( is_page_template('tmpl-help.php') ) { ?>
						<span class="h-action__link h-action__link--current">
					<?php } else { ?>
                        <a href="<?php echo $help_link; ?>" class="h-action__link">
                    <?php } ?>
                            <span class="h-action__icon">
                                <i class="icon-donate"></i>
                            </span>
                            <?php pll_e( 'Help Us' ); ?>
                    <?php if ( is_page_template('tmpl-help.php') ) { ?>
						</span>
					<?php } else { ?>
						</a>
					<?php } ?>
                    </li>
                </ul>
                <!--/header action list-->
            </div>
        </div>
        <div class="b-header__main js-header">
            <nav class="g-container">
                <!--logo-->
                <?php
					$home_link = '/';
					if ( pll_current_language() != 'uk' ){ 
						$home_link = '/pl/';
					}
                    if( is_front_page() ){
                ?>
                <div class="h-logo">
                <?php
                    } else {
                ?>
                <a href="<?php echo $home_link; ?>" class="h-logo" rel="home">
                <?php        
                    }
                ?>                
                    <figure class="h-logo__inner">
                        <div class="h-logo__thumb"></div>
                        <figcaption class="h-logo__entry">
                            <span class="h-logo__name h-logo__name--xs"><?php pll_e( 'Logo short text' ); ?></span>
                            <span class="h-logo__name h-logo__name--xl"><?php pll_e( 'Logo text' ); ?></span>
                            <span class="h-logo__city"><?php pll_e( 'Logo city' ); ?></span>
                        </figcaption>
                    </figure>
                <?php
                    if( is_front_page() ){
                ?>
                </div>
                <?php
                    } else {
                ?>
                </a>
                <?php        
                    }
                ?>
                <!--/logo-->
                <!--desktop menu-->
                <?php bem_menu('main', 'h-menu', 'js-menu'); ?>
                <!--/desktop menu-->

                <!--mobile menu switcher-->
                <button type="button" class="b-header__mtoggl js-mtoggl">
                    <i class="icon-menu"></i>
                </button>
                <!--/mobile menu switcher-->
            </nav>
        </div>
    </header>
    <!--/HEADER-->
	<!--MAIN CONTENT-->
    <main class="page__content">
