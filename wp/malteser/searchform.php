<form class="h-search" id="searchform" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" name="s" id="s" class="h-search__input" placeholder=" <?php pll_e( 'Search' ); ?>" maxlength="50" value="<?php echo get_search_query() ?>" />
	<button type="submit" class="h-search__btn" name="submit" id="searchsubmit">
		<i class="icon-search"></i>
	</button>
</form>
