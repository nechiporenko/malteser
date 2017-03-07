<!--sidebar-->
<aside class="g-col g-col--one-third">
	<span class="g-subtitle g-subtitle--alt">
		<i class="icon-news"></i>
		<?php pll_e( 'Last news' ); ?>
	</span>
	<?php
		if ( is_single() ){
			$args = array(
				'posts_per_page' => 3,
				'post__not_in' => array($post->ID),
				'order' => 'DESC',
				'orderby' => 'date'
			);
		} else {
			$args = array(
				'posts_per_page' => 3,
				'order' => 'DESC',
				'orderby' => 'date'
			);
		}
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
