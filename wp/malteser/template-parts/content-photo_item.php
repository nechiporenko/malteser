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
