<?php
    get_header();
?>
<div class="page__section">
    <div class="g-container">
		<div class="g-row">
			<article class="g-col g-col--two-thirds">
				<?php
					if ( have_posts() ) :  while ( have_posts() ) : the_post();
				?>
				<h1 class="g-title"><?php the_title(); ?></h1>
				<!--noindex-->
				<a href="<?php echo get('partner_link'); ?>" class="b-partner__link" rel="nofollow" target="_blank">
					<?php the_post_thumbnail('', 'class=b-partner__img'); ?>			
				</a>
				<!--/noindex-->
				
				<?php
					endwhile;
					endif;
				?>
			</article>
			<?php get_sidebar(); ?>
		</div><!--/.g-row-->	
    </div>
</div>
<?php
    get_footer();
?>
