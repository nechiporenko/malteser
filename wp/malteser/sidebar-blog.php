<!--sidebar-->
<aside class="g-col g-col--one-third">
	<span class="g-subtitle g-subtitle--alt">
		<i class="icon-tag"></i>
		<?php pll_e( 'Categories' ); ?>
	</span>
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
	<span class="g-subtitle g-subtitle--alt">
		<i class="icon-tags"></i>
		<?php pll_e( 'Tags' ); ?>
	</span>
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
	<span class="g-subtitle g-subtitle--alt">
		<i class="icon-pictures"></i>
		<?php pll_e( 'Last photos' ); ?>
	</span>
	<?php
		$args = array(
			'post_type' => 'gallery',
			'posts_per_page' => 4,
			'orderby' => 'post_date',
			'order'   => 'DESC'
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
	?>
	<ul class="b-gallery b-gallery--sidebar js-gallery">
	<?php
		while ( $query->have_posts() ) {
			$query->the_post();
	?>
		<li class="b-gallery__item">
			<a href="<?php the_post_thumbnail_url(); ?>" class="b-gallery__link" style="position:relative;">
				<figure class="b-gallery__inner">
					<?php the_post_thumbnail('gallery-img', 'class=b-gallery__img'); ?>
					<figcaption class="b-gallery__entry">
						<?php the_title(); ?>
					</figcaption>
				</figure>
			</a>
		</li>
	<?php
		}
	?>
	</ul>
	<?php
		} //end if
		wp_reset_postdata();
	?>
</aside>
<!--/sidebar-->
