<?php
/**
 * Template Name: Gallery Page
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
			<?php the_content(); ?>
			<?php
				endwhile;
				endif;
			?>
		</article>
		<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(
				'post_type' => 'gallery',
				'posts_per_page' => 16,
				'orderby' => 'post_date',
				'order'   => 'DESC',
				'paged' => $paged
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
		?>
		<ul class="b-gallery js-gallery">
		<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				get_template_part( 'template-parts/content', 'photo_item' );
			}
		?>
		</ul>
		<?php
			} //end if
		?>
		<div class="b-pagination">
		<?php
			if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi( array( 'query' => $query ) );
			wp_reset_postdata();
		?>
		</div>
    </div>
</div>
<?php
    get_footer();
?>
