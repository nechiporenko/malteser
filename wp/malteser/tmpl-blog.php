<?php
/**
 * Template Name: Blog Page
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
			<section class="g-col g-col--two-thirds">
			<?php
				if ( have_posts() ) :  while ( have_posts() ) : the_post();
			?>
				<h1 class="g-title"><?php the_title(); ?></h1>
			<?php
				endwhile;
				endif;
				
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
					'post_type' => 'post',
					'orderby'=>'post_date',
					'order'    => 'DESC',
					'paged'=> $paged
				);
				$query = new WP_Query( $args );
			?>
				<ul class="b-news">
				<?php
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							get_template_part( 'template-parts/content', 'post_item' );
						}
					}
				?>
				</ul>
				<div class="b-pagination">
				<?php
					if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi( array( 'query' => $query ) );
					wp_reset_postdata();
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
