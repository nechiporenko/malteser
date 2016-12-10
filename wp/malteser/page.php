<?php
    get_header();
?>
<div class="page__section">
    <div class="g-container">
		<?php
			get_template_part( 'template-parts/content', 'breadcrumbs' );
		?>
    	<article class="page__entry">
    	<?php
    		if ( have_posts() ) :  while ( have_posts() ) : the_post();
    	?>
    		<h1 class="g-title"><?php the_title(); ?></h1>
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
