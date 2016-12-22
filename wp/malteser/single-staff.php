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
				<div class="g-row">
					<div class="g-col g-col--one-half">
						<figure class="b-panel">
						<?php the_post_thumbnail('img-sm', 'class=b-panel__photo'); ?>
						<figcaption class="b-panel__entry">
							<div class="b-panel__content">
								<span class="b-panel__subtitle">
									<?php the_title(); ?>
								</span>
								<p>
									<?php echo get('staff_desc'); ?>
								</p>
							</div>
						</figcaption>
					</figure>
					</div>
				</div>
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
