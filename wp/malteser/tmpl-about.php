<?php
/**
 * Template Name: About Page
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
    	<article class="page__entry">
    	<?php
    		if ( have_posts() ) :  while ( have_posts() ) : the_post();
    	?>
    		<h1 class="g-title"><?php the_title(); ?></h1>
		<?php
			the_content();
			endwhile;
			endif;
		?>
    	</article>
    </div>
    
    <!--order-->
	<section class="page__section page__section--action">
		<div class="g-container">
		<?php
			$args = array(
				'posts_per_page' => 1,
				'post_type' => 'block',
				'meta_key' => 'block_sort',
				'meta_value' => 7
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
		?>
			<h2 class="g-title g-title--alt">
				<?php the_title(); ?>
			</h2>
			<?php the_content(); ?>
			<a href="<?php echo get('block_link'); ?>" class="g-btn">
				<?php pll_e( 'Send order' ); ?>
			</a>
		<?php				
				}
			}
			wp_reset_postdata();
		?>	
		</div>
	</section>
	<!--/order-->
	
	<!--news-->
	<div class="page__section">
		<div class="g-container">
			<span class="g-title g-title--alt">
				<?php pll_e( 'Last news' ); ?>
			</span>
			<div class="g-row">
			<?php
				$args = array(
					'posts_per_page' => 3,
					'order' => 'DESC',
					'orderby' => 'date'
				);
				$query = new WP_Query($args);
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						get_template_part( 'template-parts/content', 'post_column' );
					}
				}
				wp_reset_postdata();
			?>
			</div><!--/.g-row-->
		</div>
	</div>
	<!--/news-->
</div>
<?php
    get_footer();
?>
