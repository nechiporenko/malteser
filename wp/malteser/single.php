<?php
    get_header();
?>
<div class="page__section">
	<div class="g-container">
		<?php
			get_template_part( 'template-parts/content', 'breadcrumbs' );
		?>
		<div class="g-row">
			<article class="g-col g-col--two-thirds">
			<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
				<h1 class="g-title"><?php the_title(); ?></h1>
				<figure class="g-text-center">
					<?php the_post_thumbnail('post-single-img'); ?>
				</figure>
				<div class="page__entry">
					<?php the_content(); ?>
				</div>							
				<?php
					//post video
					$video_url = get('post_video_youtube');					
					if($video_url){
						//get video id from youtube url
						function getYouTubeId($url){
							parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
							return $my_array_of_vars['v'];
						}
						$youtube_id = getYouTubeId($video_url);
						if($youtube_id){
				?>
				<!--youtube video-->
				<div class="b-meta">
					<span class="b-meta__title">
						<i class="icon-video"></i>
						<?php pll_e( 'Video: ' ); ?>
					</span>
				</div>
				<div class="g-video-wrap">
					<iframe src="https://www.youtube.com/embed/<?php echo $youtube_id; ?>?rel=0&amp;showinfo=0;"></iframe>
				</div>
				<!--/youtube video-->
				<?php
						} //end if
					} //end if
					//post gallery
					$photo_count = get_count_field('post_gallery_photo');
					if($photo_count > 1){
				?>
				<!--post gallery-->
				<div class="b-meta">
					<span class="b-meta__title">
						<i class="icon-pictures"></i>
						<?php pll_e( 'Photos: ' ); ?>
					</span>
				</div>
				<ul class="b-photo js-gallery">
				<?php
					$photos = get_order_field('post_gallery_photo');
					foreach($photos as $photo){
				?>
					<li class="b-photo__item">
						<a href="<?php echo get('post_gallery_photo', 1, $photo); ?>" class="b-photo__link">
							<?php
								$thumb = array ("w" => 300, "h" => 200);
								$attr = array("class" => "b-photo__img", "alt" => "");
							?>
							<?php echo get_image ('post_gallery_photo', 1, $photo, 1, 0 , 0, $attr, $thumb); ?>
						</a>
					</li>
				<?php
						} //end foreach
				?>
				</ul>
				<!--/post gallery-->
				<?php
					} //end if
				?>				
				<!--post meta-->
				<div class="b-meta">
					<p>
						<time class="b-meta__date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('d/m/Y'); ?></time>
					</p>
					<div class="g-row">
						<div class="g-col g-col--one-half">
							<span class="b-meta__title">
								<i class="icon-tag"></i>
								<?php pll_e( 'Categoria: ' ); ?>
							</span>
							<ul class="b-meta__list">
							<?php
								$categories = get_the_category();
								if($categories){
									foreach($categories as $cat){
							?>
								<li class="b-meta__item">
									<a href="<?php echo get_term_link($cat->cat_ID); ?>">
										<?php echo $cat->cat_name; ?>
									</a>
								</li>
							<?php
									}
								}
							?>								
							</ul>
						</div>
						
						<div class="g-col g-col--one-half">
							<span class="b-meta__title">
								<i class="icon-tags"></i>
								<?php pll_e( 'Tags' ); ?> :
							</span>
							<?php
								$tags = get_the_tags();
								if ($tags){
							?>
							<ul class="b-meta__list">
							<?php
								foreach($tags as $tag){
							?>
								<li class="b-meta__item">
									<a href="<?php echo get_term_link($tag->term_id); ?>">
										<?php echo $tag->name; ?>
									</a>
								</li>
							<?php	
								}
							?>
							</ul>
							<?php
								} else {
							?>
							<p><?php pll_e( 'No tags' ); ?></p>
							<?php
								}
							?>
						</div>
					</div>
				</div>
				<!--/post meta-->		
			<?php endwhile; ?>
			<?php endif; ?>	
			</article>
			<?php get_sidebar('single'); ?>
		</div><!--/.g-row-->
	</div>
</div>
<?php
    get_footer();
?>
