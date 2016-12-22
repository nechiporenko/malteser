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
				<ul class="b-gallery js-gallery">
				<?php get_template_part( 'template-parts/content', 'photo_item' ); ?>
				</ul>
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
