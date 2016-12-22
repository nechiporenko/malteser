<?php
    get_header();
?>
<div class="page__section">
    <div class="g-container">
		<div class="g-row">
			<section class="g-col g-col--two-thirds">
				<h1 class="g-title">
					<?php pll_e( 'Search result' ); ?>: <?php echo get_search_query(); ?>
				</h1>
			<?php
				global $wp_query;
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;
				if ( have_posts() ) :  while ( have_posts() ) : the_post();
			?>
				<article class="page__entry">
					<h3 class="g-subtitle g-subtitle--alt"><?php the_title() ?></h3>
					<p>
						<?php kama_excerpt("maxchar=320"); ?>
					</p>
					<a href="<?php the_permalink() ?>" class="g-btn">
						<?php pll_e( 'Read more' ); ?>
						<i class="icon-more"></i>
					</a>
				</article>
				<hr />
			<?php
				endwhile;
			?>	
				<div class="b-pagination">
				<?php
					if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi( array( 'query' => $wp_query ) );
				?>
				</div>
				
			<?php	
				else :
			?>
				<p><?php pll_e( 'No search' ); ?></p>
			<?php
				endif;
			?>
			</section>
			<?php get_sidebar(); ?>
		</div><!--/.g-row-->
    </div>
</div>
<?php
    get_footer();
?>
