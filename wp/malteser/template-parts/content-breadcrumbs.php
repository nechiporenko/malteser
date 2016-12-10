<?php
	$home = 'Головна';
	$home_link = '/';
	if ( pll_current_language() != 'uk' ){ 
		$home = 'Dom';
		$home_link = '/pl/';
	}
	if( !is_front_page() && !is_search() && !is_404() ){
		echo '<ol class="b-crumb" itemscope itemtype="http://schema.org/BreadcrumbList">';
		echo '<li class="b-crumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
		echo '<a href="'.$home_link.'" class="b-crumb__link" itemprop="item">';
		echo '<span itemprop="name" class="b-crumbs__inner">'.$home.'</span>';
		echo '<meta itemprop="position" content="1" />';
		echo '</a>';
		echo '</li>';
		
		if( is_category() ){
			$term_id = get_query_var('cat');
			echo '<li class="b-crumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
			echo '<span class="b-crumb__curr" itemprop="item">';
			echo '<span itemprop="name" class="b-crumb__inner">'.get_cat_name( $term_id ).'</span>';
			echo '<meta itemprop="position" content="2" />';
			echo '</span>';
			echo '</li>';
		}
		
		if( is_tag() ){
			echo '<li class="b-crumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
			echo '<span class="b-crumb__curr" itemprop="item">';
			echo '<span itemprop="name" class="b-crumb__inner">'.single_tag_title( '', false ).'</span>';
			echo '<meta itemprop="position" content="2" />';
			echo '</span>';
			echo '</li>';
		}
		
		if( is_single() ){
			$post_id = get_the_ID();
			$cat_id = get_the_category($post_id);
			echo '<li class="b-crumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
			echo '<a href="'.get_category_link($cat_id[0]->cat_ID).'" class="b-crumb__link" itemprop="item">';
			echo '<span itemprop="name" class="b-crumb__inner">'.$cat_id[0]->cat_name.'</span>';
			echo '<meta itemprop="position" content="2" />';
			echo '</a>';
			echo '</li>';
			echo '<li class="b-crumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
			echo '<span class="b-crumb__curr" itemprop="item">';
			echo '<span itemprop="name" class="b-crumb__inner">'.get_the_title().'</span>';
			echo '<meta itemprop="position" content="3" />';
			echo '</span>';
			echo '</li>';
		}
		
		if( is_page() ){		
			$page_id = get_the_ID();
			$parent = get_ancestors($page_id, 'page');
			if($parent[0]){
				echo '<li class="b-crumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
				echo '<a href="'.get_page_link($parent[0]).'" class="b-crumb__link" itemprop="item">';
				echo '<span itemprop="name" class="b-crumb__inner">'.get_the_title($parent[0]).'</span>';
				echo '<meta itemprop="position" content="2" />';
				echo '</a>';
				echo '</li>';
				echo '<li class="b-crumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
				echo '<span class="b-crumb__curr" itemprop="item">';
				echo '<span itemprop="name" class="b-crumb__inner">'.get_the_title().'</span>';
				echo '<meta itemprop="position" content="3" />';
				echo '</span>';
				echo '</li>';
			} else {
				echo '<li class="b-crumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
				echo '<span class="b-crumb__curr" itemprop="item">';
				echo '<span itemprop="name" class="b-crumb__inner">'.get_the_title().'</span>';
				echo '<meta itemprop="position" content="2" />';
				echo '</span>';
				echo '</li>';
			}			
		}
		echo '</ol>';
	}
?>
