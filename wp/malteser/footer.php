		<!--mobile menu-->
		<?php
			$lang_menu_class = 'js-lang-uk';
			if ( pll_current_language() != 'uk' ){ 
				$lang_menu_class = 'js-lang-pl';
			}
		?>
		<nav class="page__panel js-mmenu <?php echo $lang_menu_class; ?>">
			<?php bem_menu('main', 'm-menu'); ?>
		</nav>
		<!--/mobile menu-->  
    </main>
	<!--/MAIN CONTENT-->

    <!--FOOTER-->
    <footer class="b-footer">
        <div class="b-footer__main">
            <div class="b-footer__col">
				<?php
					$home_link = '/';
					if ( pll_current_language() != 'uk' ){ 
						$home_link = '/pl/dom/';
					}
                    if( is_front_page() ){
                ?>
                <div class="f-logo">
                <?php
                    } else {
                ?>
                <a href="<?php echo $home_link; ?>" class="f-logo" rel="home">
                <?php        
                    }
                ?>     
                    <figure class="f-logo__inner">
                        <div class="f-logo__thumb"></div>
                        <figcaption class="f-logo__entry">
                            <?php pll_e( 'Logo text' ); ?>
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
                <p><?php pll_e( 'Logo Description' ); ?></p>
                <?php get_template_part( 'template-parts/footer', 'contacts' ); ?>
            </div>
            <nav class="b-footer__col">
                <span class="b-footer__title"><?php pll_e( 'Footer title1' ); ?></span>
                <?php bem_menu('footer', 'f-menu'); ?>
            </nav>
            <nav class="b-footer__col">
                <span class="b-footer__title"><?php pll_e( 'Footer title2' ); ?></span>
                <ul class="f-menu">
				<?php
					if ( is_single() ){
						$args = array(
							'posts_per_page' => 5,
							'post__not_in' => array($post->ID),
							'order' => 'DESC',
							'orderby' => 'date'
						);
					} else {
						$args = array(
							'posts_per_page' => 5,
							'order' => 'DESC',
							'orderby' => 'date'
						);
					}
					$query = new WP_Query($args);
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
				?>
					<li class="f-menu__item">
                        <a href="<?php the_permalink(); ?>" class="f-menu__link">
							<?php the_title(); ?>
                        </a>
                    </li>
				<?php
						}
					}
					wp_reset_postdata();
				?>
                </ul>
            </nav>
            <div class="b-footer__col">
                <span class="b-footer__title"><?php pll_e( 'Footer title3' ); ?></span>
                <ul class="f-social">
					<?php get_template_part( 'template-parts/footer', 'social' ); ?>
                </ul>
            </div>
        </div>
        <div class="b-footer__sole">
            <p><?php echo $_SERVER['HTTP_HOST']; ?> © 2014-<?php echo date("Y"); ?></p>
        </div>
    </footer>
    <!--/FOOTER-->

    <!--scripts-->
    <script>
		(function () {
            var css = document.createElement("link");
            css.setAttribute("rel", "stylesheet");
            css.setAttribute("href", "<?php bloginfo('template_directory'); ?>/css/app.main.min.css?ver=0.0.2");
            document.getElementsByTagName("head")[0].appendChild(css);
        })();
    </script>
    <noscript>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/app.main.min.css?ver=0.0.2" />
    </noscript>
    <script>
        WebFontConfig = {
            google: {
                families: ['Open Sans:400,400i,600,700:cyrillic']
            },
            active: function () {
                sessionStorage.font_GOS = true;
            }
        };

        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php bloginfo('template_directory'); ?>/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?php bloginfo('template_directory'); ?>/js/app.min.js?ver=0.0.4"></script>
    <?php
		if( is_page_template('tmpl-contacts.php') ){
	?>
	<script src="<?php bloginfo('template_directory'); ?>/js/map.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js?hl=uk' async defer></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/contactForm.min.js"></script>
	<?php
		}
    ?>
    
    <?php
		if( is_page_template('tmpl-order.php') ){
	?>
	<script src='https://www.google.com/recaptcha/api.js?hl=uk' async defer></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/orderForm.min.js"></script>
	<?php
		}
    ?>
    
    <?php
		if( is_single() ){
	?>
	<!-- AddToAny BEGIN -->
	<script>
		var a2a_config = a2a_config || {};
		a2a_config.onclick = 1;
		a2a_config.locale = "uk";
		a2a_config.num_services = 4;
	</script>
	<script async src="https://static.addtoany.com/menu/page.js"></script>
	<!-- AddToAny END -->
	<?php
		}
    ?>
    <!--/scripts-->
    <?php
		wp_footer();
    ?>
</body>
</html>
