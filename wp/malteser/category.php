<?php
    get_header();
?>
<div class="page__section">
    <div class="g-container">
		<?php
			get_template_part( 'template-parts/content', 'breadcrumbs' );
		?>
		
		<div class="g-row">
			<section class="g-col g-col--two-thirds">
			<?php
				$term_id = get_query_var('cat');
			?>
				<h1 class="g-title"><?php pll_e( 'Categoria: ' ); ?><?php echo ' '.get_cat_name( $term_id ); ?></h1>
				<ul class="b-news">
				<?php
					if ( have_posts() ) :  while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'post_item' );
					endwhile;
					endif;
				?>
				</ul>
				<div class="b-pagination">
				<?php
					if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi(); wp_reset_query();
				?>
				</div>	
			</section>
			<?php get_sidebar('blog'); ?>
		</div><!--/.g-row--> 	
    </div>
</div>
<?php
    get_footer();
?>
