<div class="g-col g-col--one-third">
	<figure class="b-panel b-panel--alt">
		<a href="<?php the_permalink(); ?>" class="b-panel__thumb">
			<?php the_post_thumbnail('post-img', 'class=b-panel__img'); ?>
		</a>
		<figcaption class="b-panel__entry">
			<div class="b-panel__content" data-match-height>
				<a href="<?php the_permalink(); ?>" class="b-panel__subtitle">
					<?php the_title(); ?>
				</a>
				<p>
					<?php kama_excerpt("maxchar=300"); ?>
				</p>
			</div>
			<a href="<?php the_permalink(); ?>" class="g-btn">
				<?php pll_e( 'Read more' ); ?>
				<i class="icon-more"></i>
			</a>
		</figcaption>
	</figure>
</div>
