<?php
    get_header();
?>
<div class="page__section">
    <div class="g-container">
		<div class="g-row">
			<div class="g-col g-col--two-thirds">
				<section class="page__entry">
					<h1 class="g-title">Error 404</h1>
					<p><?php pll_e( 'Error 404' ); ?></p>
				</section>
				
				<hr />
				
				<section class="page__section">
					<h3 class="g-subtitle g-subtitle--alt">
						<i class="icon-tag"></i>
						<?php pll_e( 'Categories' ); ?>
					</h3>
					<?php
						$categories = get_categories();
						if( $categories ){
					?>
					<ul class="b-taglist">
					<?php
						foreach( $categories as $cat ){
							$cat_link = get_category_link( $cat->term_id )
					?>
						<li class="b-taglist__item">
							<a href="<?php echo $cat_link; ?>"><?php echo $cat->name; ?></a>
						</li>
					<?php
						}
					?>
					</ul>
					<?php
						} //end if
					?>
					<h4 class="g-subtitle g-subtitle--alt">
						<i class="icon-tags"></i>
						<?php pll_e( 'Tags' ); ?>
					</h4>
					<?php
						$tags = get_tags();
						if( $tags ){
					?>
					<ul class="b-taglist">
					<?php
						foreach( $tags as $tag ){
							$tag_link = get_tag_link($tag->term_id);
					?>
						<li class="b-taglist__item">
							<a href="<?php echo $tag_link; ?>"><?php echo $tag->name; ?></a>
						</li>
					<?php
						}
					?>
					</ul>
					<?php
						} //end if
					?>
				</section>	
			</div>			
			<?php get_sidebar(); ?>
		</div><!--/.g-row-->
    </div>
</div>
<?php
    get_footer();
?>
