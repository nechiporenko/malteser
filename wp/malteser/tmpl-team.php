<?php
/**
 * Template Name: Team Page
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
		
		<section>
			<?php
				if ( have_posts() ) :  while ( have_posts() ) : the_post();
			?>
			<h1 class="g-title"><?php the_title(); ?></h1>			
			<?php
				$args = array(
					'post_type' => 'staff',
					'posts_per_page' => 1000,
					'orderby' => 'meta_value_num',
					'meta_key' => 'staff_pos',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$i=1;
			?>
			<div class="g-row">
				<div class="g-col g-col--one-fourth">
					<figure class="b-panel">
						<?php the_post_thumbnail('img-xs', 'class=b-panel__photo'); ?>
						<figcaption class="b-panel__entry">
							<div class="b-panel__content" data-match-height>
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
			<?php
						$i++;
						if($i==4){
			?>
			</div><!--/.g-row-->
			<?php
						}
			?>			
			<?php
					} //end while
				} //end if
				wp_reset_postdata();
			?>
		</section>
		<div class="page__entry">
			<?php
				the_content();
				endwhile;
				endif;
			?>
		</article>
    </div>
</div>
<?php
    get_footer();
?>
