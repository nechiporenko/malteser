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
		<i class="icon-news"></i>
		<?php pll_e( 'Last news' ); ?>
	</span>
	<?php
		$args = array(
			'posts_per_page' => 3,
			'post__not_in' => array($post->ID),
			'order' => 'DESC',
			'orderby' => 'date'
		);
		$query = new WP_Query($args);
		if ( $query->have_posts() ) {
	?>
	<ul class="b-side-news">
	<?php
		while ( $query->have_posts() ) {
			$query->the_post();
	?>
		<li class="b-side-news__item">
			<article class="b-side-news__entry">
				<h5 class="b-side-news__title">
					<a href="<?php the_permalink(); ?>" class="b-side-news__link">
						<?php the_title(); ?>
					</a>
				</h5>
				<p><?php kama_excerpt("maxchar=120"); ?></p>
				<a href="<?php the_permalink(); ?>" class="b-side-news__more"><?php pll_e( 'Read more' ); ?> <i class="icon-more"></i></a>
			</article>
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
