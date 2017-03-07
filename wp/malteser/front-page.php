<?php
    get_header();
?>

<?php
	$args = array(
		'posts_per_page' => 3,
		'orderby' => 'date',
		'order' => 'desc',
		'post_type' => 'slider'
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		$slider_count = $query -> post_count;
?>
<!--hero-->
<div class="b-hero">
	<div class="b-hero__wrap">
		<ul class="b-hero__list <?php if( $slider_count > 1 ) { echo 'js-slider'; } ?>">
<?php
		while ( $query->have_posts() ) {
			$query->the_post();
?>
			<li class="b-hero__item">
				<figure class="b-hero__inner">
					<div class="b-hero__thumb" data-src="<?php echo get_image('slider_img',1,1,0); ?>"></div>
					<figcaption class="b-hero__entry">
						<div class="g-container">
							<div class="b-hero__content">
								<span class="b-hero__title"><?php echo get_the_title(); ?></span>
								<p><?php echo get('slider_entry'); ?></p>
								<a href="<?php echo get('slider_link'); ?>" class="g-btn g-btn--large">
									<?php pll_e( 'Read more' ); ?>
									<i class="icon-more"></i>
								</a>
							</div>
						</div>
					</figcaption>
				</figure>
			</li>
<?php
		} //end while
?>
		</ul>
	</div>
	<script>
		(function () {
			//додамо бекграунд до першого слайду
			var thumb = document.getElementsByClassName('b-hero__thumb')[0];
			thumb.style.backgroundImage = 'url(' + thumb.getAttribute('data-src') + ')';
<?php
	if( $slider_count > 1 ){
?>
			//готуємо перший слайд до анімації текстового контенту
			var el = document.getElementsByClassName('b-hero__content')[0],
				className = 'js-animate';
			if (el.classList) {
				el.classList.add(className);
			} else {
				el.className += ' ' + className;
			}
<?php
	}
?>
		})();
	</script>
</div>
<!--/hero-->
<?php
	} //end if
	wp_reset_postdata();
?>
<!--about-->
<section class="page__section">
	<div class="g-container">
		<?php
			if ( have_posts() ) :  while ( have_posts() ) : the_post();
		?>
		<h1 class="g-title g-title--alt"><?php the_title(); ?></h1>
		<div class="page__inner page__entry">
			<?php the_content(); ?>
			<div class="g-text-center">
			<?php
				$about_link = "/about/";
				if ( pll_current_language() != 'uk' ) { $about_link = "/pl/o-nas/"; }
			?>
				<a href="<?php echo $about_link; ?>" class="g-btn g-btn--large">
					<?php pll_e( 'Learn more' ); ?>
					<i class="icon-more"></i>
				</a>
			</div>
		</div>
		<?php
			endwhile;
			endif;
		?>
	</div>
</section>
<!--/about-->
	
<!--what we do-->
<section class="page__section">
	<div class="g-container">
		<h2 class="g-title g-title--alt"><?php pll_e( 'What we do?' ); ?></h2>
		<div class="g-row">
			<div class="g-col g-col--one-fourth">
				<figure class="b-panel b-panel--has-icon" style="position:relative;">
					<div class="b-panel__icon">
						<svg class="b-panel__svg" viewBox="0 0 238 238" width="70" version="1.1">
							<path class="st1" d="M153.074 104.384l-23.74 61.013-21.61-30.64-12.705 16.606-23.97-39.62-12.946 29.68H0v17h50.607c23.858 24.93 57.768 51.348 59.365 52.587l3.053 2.37 3.063-2.357c1.693-1.304 41.74-32.226 64.866-58.28l7.385-8.32h-18.75l-16.52-40.04z" />
							<path class="st1" d="M208.207 115.423c4.28-8.712 7.777-19.8 7.064-34.004-.75-15.09-6.77-29.27-16.94-39.93-10.39-10.88-23.97-16.875-38.242-16.875-21.75 0-39.56 13.93-47.053 20.836-7.276-6.964-24.596-20.817-47.212-20.817-14.274 0-27.856 6-38.243 16.89C17.404 52.19 11.39 66.373 10.63 81.46c-.716 14.236 3.685 28.82 13.45 44.59l1.468 2.367h24.15l19.42-44.58 27.1 44.75 11.914-15.512 17.92 25.436 26.685-68.66 25.425 61.567H238v-16h-29.793z" />
						</svg>
					</div>
					<figcaption class="b-panel__entry">
						<div class="b-panel__content" data-match-height>
						<?php
							$args = array(
								'posts_per_page' => 1,
								'post_type' => 'block',
								'meta_key' => 'block_sort',
								'meta_value' => 1
							);
							$query = new WP_Query( $args );
							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) {
									$query->the_post();
						?>
							<span class="b-panel__title">
								<?php the_title(); ?>
							</span>
							<?php the_content(); ?>
						</div>
						<a href="<?php echo get('block_link'); ?>" class="g-btn">
							<?php pll_e( 'More' ); ?>
							<i class="icon-more"></i>
						</a>
						<?php
								}
							}
							wp_reset_postdata();
						?>
					</figcaption>
				</figure>
			</div>
			<div class="g-col g-col--one-fourth">
				<figure class="b-panel b-panel--has-icon" style="position:relative;">
					<div class="b-panel__icon">
						<svg class="b-panel__svg" viewBox="0 0 512.001 512.001" width="70" version="1.1">
							<path class="st1" d="M467.31 16.768H221.453c-6.128 0-11.095 4.967-11.095 11.095v86.45l12.304-7.64c3.13-1.944 6.475-3.256 9.884-3.977V38.958H456.21v160.016H232.55v-25.89l-22.19 13.778v23.208c0 6.128 4.966 11.095 11.094 11.095H467.31c6.126 0 11.094-4.967 11.094-11.095V27.863c0-6.128-4.968-11.095-11.095-11.095z" />
							<path class="st1" d="M306 78.356c-2.918-3.702-8.284-4.335-11.985-1.418l-38.217 30.133c3.65 2.39 6.85 5.58 9.3 9.53.696 1.12 1.3 2.27 1.835 3.43l37.65-29.68c3.703-2.92 4.337-8.28 1.418-11.98z" />
							<circle class="st1" cx="121.535" cy="31.935" r="31.935" />
							<path class="st1" d="M252.01 124.728c-4.49-7.23-13.987-9.45-21.218-4.963l-31.206 19.375-.144-28.81c-.1-20.006-16.458-36.282-36.464-36.282h-15.16c-12.95 33.588-8.778 21.12-19.77 49.63l4.622-20.13c.32-1.51.088-3.08-.655-4.43l-6.264-11.394 5.56-10.11c.83-1.507-.26-3.355-1.98-3.355h-15.27c-1.72 0-2.81 1.84-1.98 3.35l5.57 10.13-6.272 11.41c-.73 1.32-.966 2.86-.672 4.34l4.008 20.172-19.136-49.63H80.1c-20.005 0-36.363 16.274-36.464 36.28l-.57 113.2c-.042 8.51 6.82 15.443 15.33 15.486h.08c8.473 0 15.364-6.848 15.406-15.33l.57-113.2v-.054c.02-1.68 1.396-3.027 3.076-3.014 1.68.01 3.034 1.377 3.034 3.057l.008 160.38c14.106-.6 27.176 4.49 36.98 13.425V221.7h7.984v71.773c5.62 8.27 8.913 18.243 8.913 28.974 0 9.777-2.73 18.928-7.47 26.73 4.868.024 9.594.67 14.1 1.86 6.077-5.27 13.386-9.15 21.438-11.134 0-279.343-.334-106.628-.334-229.42 0-1.78 1.44-3.22 3.22-3.223 1.78-.003 3.227 1.433 3.235 3.21l.28 56.353c.03 5.58 3.07 10.71 7.954 13.41 4.873 2.695 10.834 2.555 15.582-.393l54.604-33.903c7.227-4.486 9.45-13.987 4.96-21.216z" />
							<circle class="st1" cx="429.221" cy="322.831" r="33.803" />
							<path class="st1" d="M511.46 405.81c-.108-21.175-17.422-38.403-38.6-38.403h-84.78c3.637 7.068 5.704 15.07 5.704 23.55 0 9.005-2.405 18.413-7.5 26.782 18.904.76 35.468 10.91 45.15 25.89h40.578V406.2c0-1.84 1.46-3.35 3.3-3.414s3.403 1.345 3.527 3.182l.19 37.66h32.62l-.19-37.823zm-220.99-14.854c0-8.63 2.137-16.763 5.893-23.92h-75.267c3.472 6.94 5.437 14.756 5.437 23.03 0 9.72-2.73 18.925-7.47 26.73 15.56.074 29.913 6.538 40.284 17.267 10.054-9.822 23.76-15.914 38.836-15.995-5.235-8.452-7.714-17.942-7.714-27.112zm-25.65-102.3c-18.67 0-33.805 15.13-33.805 33.802 0 18.628 15.107 33.803 33.804 33.803 18.51 0 33.8-14.96 33.8-33.8 0-18.65-15.11-33.8-33.81-33.8zm-141.603 101.41c0-8.253 1.956-16.054 5.41-22.98-1.456-.073 4.673-.05-89.484-.05-21.068 0-38.49 17.14-38.598 38.404l-.192 38.196h32.62l.192-38.03c.01-1.885 1.54-3.403 3.423-3.398 1.882.006 3.404 1.532 3.404 3.414v38.014H85.72c9.854-15.754 26.8-25.646 45.242-26.406-5.006-8.062-7.745-17.365-7.745-27.165zm-40.43-101.41c-18.67 0-33.804 15.133-33.804 33.802 0 18.584 15.046 33.803 33.803 33.803 18.536 0 33.804-15.01 33.804-33.8 0-18.67-15.135-33.8-33.804-33.8zm339.746 185.15c-.105-21.177-17.42-38.405-38.597-38.405H298.43c-21.177 0-39.602 17.23-39.71 38.41l-.274-.89c-.105-21.09-17.34-38.4-38.597-38.4h-85.51c-21.18 0-39.6 17.23-39.71 38.41L94.44 512h32.62l.192-38.922c.008-1.622 1.327-2.93 2.948-2.926 1.62.004 2.932 1.32 2.932 2.94v38.91h86.392v-38.91c0-1.735 1.405-3.143 3.14-3.148 1.736-.004 3.15 1.397 3.16 3.133l.19 38.923h65.134l.19-38.03v-.003c.01-1.62 1.33-2.928 2.95-2.924 1.62.004 2.93 1.32 2.93 2.94V512h86.394v-38.016c0-1.736 1.405-3.144 3.14-3.15 1.736-.003 3.15 1.398 3.16 3.134l.19 38.03h32.62l-.19-38.19z" />
							<circle class="st1" cx="175.934" cy="389.933" r="34.198" />
							<circle class="st1" cx="342.07" cy="390.821" r="34.198" />
						</svg>
					</div>
					<figcaption class="b-panel__entry">
						<div class="b-panel__content" data-match-height>
						<?php
							$args = array(
								'posts_per_page' => 1,
								'post_type' => 'block',
								'meta_key' => 'block_sort',
								'meta_value' => 2
							);
							$query = new WP_Query( $args );
							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) {
									$query->the_post();
						?>
							<span class="b-panel__title">
								<?php the_title(); ?>
							</span>
							<?php the_content(); ?>
						</div>
						<a href="<?php echo get('block_link'); ?>" class="g-btn">
							<?php pll_e( 'More' ); ?>
							<i class="icon-more"></i>
						</a>
						<?php
								}
							}
							wp_reset_postdata();
						?>
					</figcaption>
				</figure>
			</div>
			<div class="g-col g-col--one-fourth">
				<figure class="b-panel b-panel--has-icon" style="position:relative;">
					<div class="b-panel__icon">
						<svg class="b-panel__svg" viewBox="0 0 491.975 491.975" width="70" version="1.1">
							<path class="st1" d="M225.315 96.963c26.748 0 48.48-21.706 48.48-48.48C273.795 21.698 252.062 0 225.315 0c-26.78 0-48.493 21.7-48.493 48.482 0 26.775 21.713 48.48 48.492 48.48zm74.918 274.725c-12.883 44.732-54.12 77.583-102.946 77.583-59.126 0-107.21-48.082-107.21-107.19 0-43.754 26.397-81.413 64.067-98.054V198.58C92.454 217.16 47.38 274.427 47.38 342.078c0 82.65 67.247 149.897 149.906 149.897 60.238 0 112.16-35.8 135.966-87.17l-16.926-33.254c-4.75.04-10.255.09-16.093.14z" />
							<path class="st1" d="M441.48 429.237l-64.94-127.672C371.695 292.012 361.897 286 351.18 286h-83.173v-18.967h71.582c7.146 0 13.154-3.736 17.035-9.118 2.522-3.506 4.316-7.58 4.316-12.236 0-11.79-9.55-21.354-21.352-21.354h-71.583V160c0-17.692-13.118-42.704-42.69-42.704-23.583 0-42.702 19.122-42.702 42.704v139.372c0 24.058 19.503 43.56 43.562 43.56h107.55L390.75 455.05c5.01 9.875 15.01 15.573 25.39 15.573 4.35 0 8.76-.994 12.882-3.104 14.034-7.12 19.608-24.27 12.46-38.285z" />
						</svg>
					</div>
					<figcaption class="b-panel__entry">
						<div class="b-panel__content" data-match-height>
						<?php
							$args = array(
								'posts_per_page' => 1,
								'post_type' => 'block',
								'meta_key' => 'block_sort',
								'meta_value' => 3
							);
							$query = new WP_Query( $args );
							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) {
									$query->the_post();
						?>
							<span class="b-panel__title">
								<?php the_title(); ?>
							</span>
							<?php the_content(); ?>
						</div>
						<a href="<?php echo get('block_link'); ?>" class="g-btn">
							<?php pll_e( 'More' ); ?>
							<i class="icon-more"></i>
						</a>
						<?php
								}
							}
							wp_reset_postdata();
						?>
					</figcaption>
				</figure>
			</div>
			<div class="g-col g-col--one-fourth">
				<figure class="b-panel b-panel--has-icon" style="position:relative;">
					<div class="b-panel__icon">
						<svg class="b-panel__svg" viewBox="0 0 24.432 24.432" width="70" version="1.1">
							<path class="st1" d="M6.42 9.3c1.77 0 3.205-1.434 3.205-3.207 0-1.105.39-2.117-.465-2.69-.512-.35-2.76-.515-3.424-.515-.79 0-1.817.644-2.376 1.12-.695.586-.147 1.103-.147 2.084 0 1.774 1.433 3.21 3.207 3.21zM4.186 5.78c.59-.108.99.086.99.086l.983-.48s-.502.725-.052.48C7.11 5.53 8.23 5.67 8.8 5.782c.02.125.04.253.04.386 0 1.32-1.05 2.387-2.35 2.387-1.294 0-2.343-1.067-2.343-2.387 0-.133.018-.26.04-.39zM22.066 5.643c-.015-.183-.03-.365-.07-.54-.127-1.125-1.133-3.41-4.02-3.34-2.488.058-3.03 1.93-3.162 3.07-.088.28-.145.574-.164.88-3.236.564-2.88 3.848-.904 3.904-.188-1.715.63-2.745.945-3.076.292 1.772 1.82 3.133 3.673 3.133 1.756 0 3.222-1.223 3.62-2.858.302.534.81 1.628.687 2.803 3.113-.027 1.58-3.586-.604-3.975zm-3.703 2.974c-1.455 0-2.64-1.172-2.672-2.62.532-.194.926-1.114.926-1.114s.315.108.315 1.147c.552.192 1.51-1.614 1.51-1.614V5.84c.606.165 2.52-.055 2.52-.055l.07.06c.002.03.01.06.01.092.002 1.478-1.198 2.68-2.677 2.68zM19.143 9.77H16.253l-3.85 4.64-3.728-4.583H4.438L0 14.7l.93.958 3.177-2.71v5.257h.637v3.997H4.34v.47h1.844v-4.467h.69v4.467h1.842v-.47h-.404v-3.997h.773v-5.16l2.54 2.61 1.038-.257.575.144 2.877-3.293.164 1.304-2.673 4.592h3.082v3.998h-.406v.465h1.843v-.466h.002v-3.998h.688v4.463h1.844v-.466h-.405v-3.998h2.39l-2.355-4.592.13-1.606 2.248 3.014 1.49-.37-3.566-4.823" />
						</svg>
					</div>
					<figcaption class="b-panel__entry">
						<div class="b-panel__content" data-match-height>
						<?php
							$args = array(
								'posts_per_page' => 1,
								'post_type' => 'block',
								'meta_key' => 'block_sort',
								'meta_value' => 4
							);
							$query = new WP_Query( $args );
							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) {
									$query->the_post();
						?>
							<span class="b-panel__title">
								<?php the_title(); ?>
							</span>
							<?php the_content(); ?>
						</div>
						<a href="<?php echo get('block_link'); ?>" class="g-btn">
							<?php pll_e( 'More' ); ?>
							<i class="icon-more"></i>
						</a>
						<?php
								}
							}
							wp_reset_postdata();
						?>
					</figcaption>
				</figure>
			</div>
		</div><!--/.g-row-->
	</div>
</section>
<!--/what we do-->
	
<!--valuables-->
<section class="page__section page-section--has-img">
	<div class="g-container">
		<div class="g-col g-col--one-half">
			<?php
				$args = array(
					'posts_per_page' => 1,
					'post_type' => 'block',
					'meta_key' => 'block_sort',
					'meta_value' => 5
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
			?>
			<h3 class="g-subtitle g-subtitle--alt">
				<?php the_title(); ?>
			</h3>
			<?php
						the_content();
					}
				}
				wp_reset_postdata();
			?>
		</div>
		<figure class="page-section--has-img__img" style="background-image:url(<?php bloginfo('template_directory'); ?>/img/del/bg01.jpg)"></figure>
	</div>
</section>
<!--/valuables-->
	
<!--volunteer-->
<section class="page__section page__section--action">
	<div class="g-container">
	<?php
		$args = array(
			'posts_per_page' => 1,
			'post_type' => 'block',
			'meta_key' => 'block_sort',
			'meta_value' => 6
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
	?>
		<h3 class="g-title g-title--alt">
			<?php the_title(); ?>
		</h3>
		<?php the_content(); ?>
		<a href="<?php echo get('block_link'); ?>" class="g-btn">
			<?php pll_e( 'To join' ); ?>
		</a>
	<?php				
			}
		}
		wp_reset_postdata();
	?>
	</div>
</section>
<!--/volunteer-->
	
<!--team-->
<div class="page__section">
	<div class="g-container">
		<span class="g-title g-title--alt">
			<?php pll_e( 'Our team' ); ?>
		</span>
		<div class="g-row">
		<?php
			$args = array(
				'post_type' => 'staff',
				'posts_per_page' => 3,
				'orderby' => 'meta_value_num',
				'meta_key' => 'staff_pos',
				'order' => 'DESC'
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
		?>
			<div class="g-col g-col--one-third">
				<figure class="b-panel">
					<?php the_post_thumbnail('img-sm', 'class=b-panel__photo'); ?>
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
				} //end while
			} //end if
			wp_reset_postdata();
		?>
		</div><!--/.g-row-->
		<div class="g-text-center">
		<?php
			$team_link = "/about/team/";
			if ( pll_current_language() != 'uk' ) { $team_link = "/pl/o-nas/zespol/"; }
		?>
			<a href="<?php echo $team_link; ?>" class="g-btn g-btn--large">
				<?php pll_e( 'Learn more' ); ?>
				<i class="icon-more"></i>
			</a>
		</div>
	</div>
</div>
<!--/team-->

<!--news-->
<div class="page__section">
	<div class="g-container">
		<span class="g-title g-title--alt">
			<?php pll_e( 'Last news' ); ?>
		</span>
		<div class="g-row">
		<?php
			$args = array(
				'posts_per_page' => 3,
				'order' => 'DESC',
				'orderby' => 'date'
			);
			$query = new WP_Query($args);
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					get_template_part( 'template-parts/content', 'post_column' );
				}
			}
			wp_reset_postdata();
		?>
		</div><!--/.g-row-->
	</div>
</div>
<!--/news-->

<!--order-->
<section class="page__section page__section--action">
	<div class="g-container">
	<?php
		$args = array(
			'posts_per_page' => 1,
			'post_type' => 'block',
			'meta_key' => 'block_sort',
			'meta_value' => 7
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
	?>
		<h4 class="g-title g-title--alt">
			<?php the_title(); ?>
		</h4>
		<?php the_content(); ?>
		<a href="<?php echo get('block_link'); ?>" class="g-btn">
			<?php pll_e( 'Send order' ); ?>
		</a>
	<?php				
			}
		}
		wp_reset_postdata();
	?>	
	</div>
</section>
<!--/order-->

<!--photos-->
<div class="page__section">
	<div class="g-container">
		<span class="g-title g-title--alt">
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
		<ul class="b-gallery js-gallery">
		<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				get_template_part( 'template-parts/content', 'photo_item' );
			}
		?>
		</ul>
		<?php
			} //end if
			wp_reset_postdata();
		?>
		<div class="g-text-center">
		<?php
			$gallery_link = "/about/gallery/";
			if ( pll_current_language() != 'uk' ) { $gallery_link = "/pl/o-nas/zdjecia/"; }
		?>
			<a href="<?php echo $gallery_link; ?>" class="g-btn g-btn--large">
				<?php pll_e( 'All photos' ); ?>
				<i class="icon-more"></i>
			</a>
		</div>
	</div>
</div>
<!--/photos-->

<!--partners-->
<div class="page__section">
	<div class="g-container">
		<span class="g-title g-title--alt">
			<?php pll_e( 'Our partners' ); ?>
		</span>
		<div class="page__inner">
			<div class="b-partner">
			<?php
				$args = array(
					'post_type' => 'partner',
					'posts_per_page' => 50
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
			?>
			<!--noindex-->
				<a href="<?php echo get('partner_link'); ?>" class="b-partner__link" rel="nofollow" target="_blank">
					<?php the_post_thumbnail('', 'class=b-partner__img'); ?>			
				</a>
			<!--/noindex-->
			<?php
					}
				}
				wp_reset_postdata();
			?>
			</div>
		</div>             
	</div>
</div>
<!--/partners-->
<?php
    get_footer();
?>
