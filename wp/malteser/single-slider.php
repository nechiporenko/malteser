<?php
    get_header();
?>
<!--hero-->
<div class="b-hero">
	<div class="b-hero__wrap">
		<ul class="b-hero__list">
<?php
		if ( have_posts() ) :  while ( have_posts() ) : the_post();
?>
			<li class="b-hero__item">
				<figure class="b-hero__inner">
					<div class="b-hero__thumb" data-src="<?php echo get_image('slider_img',1,1,0); ?>"></div>
					<figcaption class="b-hero__entry">
						<div class="g-container">
							<div class="b-hero__content">
								<span class="b-hero__title"><?php echo get_the_title(); ?></span>
								<p><?php echo get('slider_entry'); ?></p>
								<a href="<?php echo get('slider_link'); ?>" class="g-btn g-btn--large">
									<?php pll_e( 'Read more' ); ?>
									<i class="icon-more"></i>
								</a>
							</div>
						</div>
					</figcaption>
				</figure>
			</li>
<?php
		endwhile;
		endif;
?>
		</ul>
	</div>
	<script>
		(function () {
			//додамо бекграунд до першого слайду
			var thumb = document.getElementsByClassName('b-hero__thumb')[0];
			thumb.style.backgroundImage = 'url(' + thumb.getAttribute('data-src') + ')';
		})();
	</script>
</div>
<!--/hero-->

<?php
    get_footer();
?>
