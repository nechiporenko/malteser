<li class="b-news__item">
	<article class="b-news__excerpt">
		<figure class="b-news__thumb" style="position:relative;">
			<a href="<?php the_permalink(); ?>" class="b-news__thumblink">
				<?php the_post_thumbnail('gallery-img', 'class=b-news__img'); ?>				
			</a>
		</figure>
		<div class="b-news__entry">
			<h3 class="b-news__title">
				<a href="<?php the_permalink(); ?>" class="b-news__link">
					<?php the_title(); ?>
				</a>
			</h3>
			<time class="b-news__date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('d/m/Y'); ?></time>
			<p>
				<?php kama_excerpt("maxchar=220"); ?>
			</p>
			<a href="<?php the_permalink(); ?>" class="b-news__more">
				<?php pll_e( 'Read more' ); ?>
				<i class="icon-more"></i>
			</a>
		</div>
	</article>
</li>
