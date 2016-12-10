<?php
/**
 * Template Name: Order Page
 *
 * @since Malteser 1.0
 */
    get_header();
?>
<div class="page__section">
    <div class="g-container">
		<?php
			get_template_part( 'template-parts/content', 'breadcrumbs' );
		?>
		<div class="g-row">
			<section class="g-col g-col--two-thirds page__entry">
				<?php
					if ( have_posts() ) :  while ( have_posts() ) : the_post();
				?>
				<h1 class="g-title"><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php
					endwhile;
					endif;
				?>
				<?php get_template_part( 'template-parts/form', 'order' ); ?>
			</section>
			<?php get_sidebar(); ?>
		</div><!--/.g-row-->	
    </div>
</div>
<?php
    get_footer();
?>
