		<!--mobile menu-->
		<nav class="page__panel js-mmenu">
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
						$home_link = '/pl/';
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
                <h5 class="b-footer__title"><?php pll_e( 'Footer title1' ); ?></h5>
                <?php bem_menu('footer', 'f-menu'); ?>
            </nav>
            <nav class="b-footer__col">
                <h5 class="b-footer__title"><?php pll_e( 'Footer title2' ); ?></h5>
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
                <h5 class="b-footer__title"><?php pll_e( 'Footer title3' ); ?></h5>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php bloginfo('template_directory'); ?>/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?php bloginfo('template_directory'); ?>/js/app.min.js"></script>
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
    <!--/scripts-->
    <?php
		wp_footer();
    ?>
</body>
</html>
